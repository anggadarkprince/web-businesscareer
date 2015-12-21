<?php

/**
 * Created by Vanilla Developer.
 * User: Angga Ari Wijaya
 * Date: 11/17/13
 * Time: 7:46 AM
 * To change this template use File | Settings | File Templates.
 */
class Employee extends Model
{
    // applied singleton pattern
    private static $instance = NULL;

    /**
     * default constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return null|object|Employee
     * get singleton instance
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Employee();
        }
        return self::$instance;
    }

    /**
     * retrieve player candidate, all haven't been hired yet.
     * invoked by: Model.GameServer.load_data()
     * @return array
     */
    public function get_candidate()
    {
        $player = $_SESSION['ply_id'];
        $query = "
            SELECT
              emp_id,
              emp_name,
              emp_profile,
              emp_salary_goal,
              emp_education,
              emp_experience,
              emp_atlas,
              CASE WHEN pem_id IS NULL THEN 'unemployed' ELSE 'hired' END as emp_status
            FROM
              bc_employee

            LEFT JOIN
              (
                SELECT *
                FROM bc_player_employee
                WHERE pem_player = $player
              ) bc_player_employee

              ON emp_id = pem_employee

            ORDER BY emp_id
        ";

        $result = $this->ManualQuery($query);
        if ($result && $this->CountRow() > 0) {
            return $this->FetchData();
        } else {
            return [];
        }
    }

    /**
     * retrieve player employee from database.
     * invoked by: Controller.Employee.get_player_employee()
     *             Model.GameServer.load_data()
     * @param null $player_id
     * @return array
     */
    public function get_player_employee($player_id = null)
    {
        if($player_id != null){
            $player = $player_id;
        }
        else{
            $player = $_SESSION['ply_id'];
        }

        $query = "
            SELECT
              emp_id,
              emp_name,
              emp_profile,
              emp_salary_goal,
              emp_education,
              emp_experience,
              emp_atlas,
              pem_salary,
              pem_hired,
              pem_morale,
              pem_services,
              pem_productivity,
              pem_late,
              pem_sick,
              pem_absent,
              pem_level
            FROM
              bc_employee

            INNER JOIN
            (
              SELECT *
              FROM bc_player_employee
              WHERE pem_player = $player
            ) bc_player_employee
              ON emp_id = pem_employee

            ORDER BY emp_id
        ";

        $result = $this->ManualQuery($query);
        if ($result && $this->CountRow() > 0) {
            return $this->FetchData();
        } else {
            return [];
        }
    }

    /**
     * save player employee into database.
     * invoked by: Controller.Employee.hire_employee()
     * @param $employee
     * @param $salary
     * @return bool
     */
    public function hire_employee($employee, $salary)
    {
        $data = array(
            "pem_player"    => $_SESSION['ply_id'],
            "pem_employee"  => $employee,
            "pem_salary"    => $salary
        );
        return $this->Create(Utility::TABLE_PLAYER_EMPLOYEE, $data);
    }

    /**
     * remove player employee from database.
     * invoked by: Controller.Employee.fired_employee()
     * @param $employee
     * @return bool
     */
    public function fired_employee($employee)
    {
        $condition = array(
            "pem_player"    => $_SESSION['ply_id'],
            "pem_employee"  => $employee
        );
        return $this->Delete(Utility::TABLE_PLAYER_EMPLOYEE, $condition);
    }

    /**
     * update level of employee.
     * invoked by: Controller.Employee.train_employee()
     * @param $employee
     * @param $level
     * @return bool
     */
    public function train_employee($employee, $level)
    {
        $data = array(
            "pem_level" => $level,
        );
        $condition = array(
            "pem_employee"  => $employee,
            "pem_player"    => $_SESSION['ply_id']
        );
        return $this->Update(Utility::TABLE_PLAYER_EMPLOYEE, $data, $condition);
    }

    /**
     * update employee status. decode json format to array and loop through then update one by one
     * invoked by: Controller.Employee.update_employee()
     *             Model.Memorycard.save_game_data()
     * @param $employee
     * @return bool
     */
    public function update_employee_status($employee)
    {
        $result = true;
        foreach (json_decode($employee) as $attribute) {
            $data = array(
                "pem_hired"         => $attribute->pem_hired,
                "pem_morale"        => $attribute->pem_morale,
                "pem_services"      => $attribute->pem_services,
                "pem_productivity"  => $attribute->pem_productivity,
                "pem_late"          => $attribute->pem_late,
                "pem_sick"          => $attribute->pem_sick,
                "pem_absent"        => $attribute->pem_absent,
                "pem_level"         => $attribute->pem_level
            );
            $condition = array(
                "pem_employee"      => $attribute->emp_id,
                "pem_player"        => $_SESSION['ply_id']
            );
            $result = $this->Update(Utility::TABLE_PLAYER_EMPLOYEE, $data, $condition);
        }

        return $result;
    }

}