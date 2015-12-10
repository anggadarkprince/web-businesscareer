<?php

/**
 * Created by Vanilla Developer.
 * User: Angga Ari Wijaya
 * Date: 11/16/13
 * Time: 6:56 AM
 * To change this template use File | Settings | File Templates.
 */
class EmployeeController extends Controller
{
    private $model_employee;

    public function index()
    {
        transport("error404");
    }

    public function hire_employee()
    {
        if (Authenticate::is_player()) {
            if (true || isset($_POST['token']) && Authenticate::is_valid_token($_POST['token'])) {
                $this->model_employee = Employee::getInstance();

                $employee = $_POST['employee_id'];
                $salary = $_POST['employee_salary'];

                $result = $this->model_employee->hire_employee($employee, $salary);

                $employee = $this->model_employee->get_player_employee();

                $binding = array
                (
                    "result_var" => "session_ready",
                    "status_var" => $result,
                    "employee_var" => json_encode($employee, JSON_PRETTY_PRINT)
                );

                binding_data($binding);
            } else {
                transport("error404");
            }
        } else {
            $binding = array("result_var" => "no_session");
            binding_data($binding);
        }
    }

    public function fired_employee()
    {
        if (Authenticate::is_player()) {
            if (true || isset($_POST['token']) && Authenticate::is_valid_token($_POST['token'])) {
                $this->model_employee = Employee::getInstance();

                $employee = $_POST['employee_id'];

                $result = $this->model_employee->fired_employee($employee);

                $binding = array
                (
                    "result_var" => "session_ready",
                    "status_var" => $result
                );

                binding_data($binding);
            } else {
                transport("error404");
            }
        } else {
            $binding = array("result_var" => "no_session");
            binding_data($binding);
        }

    }

    public function train_employee()
    {
        if (Authenticate::is_player()) {
            if (true || isset($_POST['token']) && Authenticate::is_valid_token($_POST['token'])) {
                $this->model_employee = Employee::getInstance();

                $employee = $_POST['employee_id'];
                $level = $_POST['employee_level'];

                $result = $this->model_employee->train_employee($employee, $level);

                $binding = array
                (
                    "result_var" => "session_ready",
                    "status_var" => $result
                );

                binding_data($binding);
            } else {
                transport("error404");
            }
        } else {
            $binding = array("result_var" => "no_session");
            binding_data($binding);
        }
    }

    public function update_employee()
    {
        $this->model_employee = Employee::getInstance();
        $employee = $_POST['employee_data'];
        $result = $this->model_employee->update_employee_status($employee);
        echo "result_var=$result";
    }
}