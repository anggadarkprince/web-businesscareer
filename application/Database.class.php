<?php
	/**
	 * Created by Vanilla Developer.
	 * User: Angga Ari Wijaya
	 * Date: 11/15/13
	 * Time: 1:40 PM
	 * To change this template use File | Settings | File Templates.
	 */
	 
    class Database{
		
        /*** Declare instance ***/
        private static $instance = NULL;

        /*** Declare database property ***/
        private static $host = 'localhost';
        private static $username = 'root';
        private static $password = '';
        private static $database = 'businesscareer';

        /*** Declare query variables ***/
        private $query;
        private $result;
        public $statement;

        /**
        *
        * the constructor is set to private so
        * so nobody can create a new instance using new
        *
        */
        private function __construct() {
          /*** maybe set the db name here later ***/
        }

        /**
        *
        * Return DB instance or create initial connection
        * @return object (PDO)
        * @access public
        *
        */
        public static function getInstance() {

            if (!self::$instance)
            {
                self::$instance = new PDO("mysql:host=".self::$host.";dbname=".self::$database, self::$username, self::$password);
                self::$instance-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            return self::$instance;
        }

        public function Create($table,$data){
            try{
                $attr = '';
                $val = '';
                $first = true;

                foreach($data as $attribute => $value){
                    if($first){
                        $attr .= $attribute;
                        $val .= ":".$attribute;
                        $first = false;
                    }
                    else{
                        $attr .= ",".$attribute;
                        $val .= ",:".$attribute;
                    }
                }

                $this->query="INSERT INTO $table(".$attr.") VALUES(".$val.")";
                $this->statement = Database::getInstance()->prepare($this->query);
                $this->statement->execute($data);

                return true;
            }
            catch(PDOException $e){
                echo 'ERROR: ' . $e->getMessage(). '<br>';
                return false;
            }
        }
        public function Read($table){
            try{
                $this->query="SELECT * FROM $table";
                $this->statement = Database::getInstance()->prepare($this->query);
                $this->statement->execute();
                return true;
            }
            catch(PDOException $e){
                echo 'ERROR: ' . $e->getMessage(). '<br>';
                return false;
            }

        }
        public function ReadColumn($table,$attributes){
            try{
                $attr = '';
                $first = true;
                foreach($attributes as $attribute){
                    if($first){
                        $attr .= $attribute;
                        $first = false;
                    }
                    else{
                        $attr .= ",".$attribute;
                    }
                }
                $this->query="SELECT ".$attr." FROM $table";
                $this->statement = Database::getInstance()->prepare($this->query);
                $this->statement->execute();
            }
            catch(PDOException $e){
                echo 'ERROR: ' . $e->getMessage(). '<br>';
                return false;
            }
        }
        public function ReadWhere($table,$data){
            try{
                $attr = '';
                $first = true;
                foreach($data as $attribute => $value){
                    if($first){
                        $attr .= $attribute."=:".$attribute;
                        $first = false;
                    }
                    else{
                        $attr .= " AND ".$attribute."=:".$attribute;
                    }
                }
                $this->query="SELECT * FROM $table WHERE ".$attr;
                $this->statement = Database::getInstance()->prepare($this->query);
                $this->statement->execute($data);
                return true;
            }
            catch(PDOException $e){
                echo 'ERROR: ' . $e->getMessage(). '<br>';
                return false;
            }
        }
        public function ReadSingleData($table,$data){
            try{
                $attr = '';
                $first = true;
                foreach($data as $attribute => $value){
                    if($first){
                        $attr .= $attribute."=:".$attribute;
                        $first = false;
                    }
                    else{
                        $attr .= " AND ".$attribute."=:".$attribute;
                    }
                }
                $this->query="SELECT * FROM $table WHERE ".$attr;
                $this->statement = Database::getInstance()->prepare($this->query);
                $this->statement->execute($data);
                return true;
            }
            catch(PDOException $e){
                echo 'ERROR: ' . $e->getMessage(). '<br>';
                return false;
            }
        }
        public function Update($table,$data,$condition = null){
            try{
                $changes = '';
                $states = '';
                $first = true;
                foreach($data as $attribute => $val){
                    if($first){
                        $changes .= $attribute."=:".$attribute;
                        $first = false;
                    }
                    else{
                        $changes .= ",".$attribute."=:".$attribute;
                    }
                }
                if(!is_null($condition)){
                    $first = true;
                    foreach($condition as $key => $state){
                        if($first){
                            $states .= $key."=:state".$key;
                            $first = false;
                        }
                        else{
                            $states .= " AND ".$key."=:state".$key;
                        }
                        unset($condition["$key"]);
                        $condition["state$key"] = $state;
                    }
                    $binding = array_merge($data,$condition);
                }
                else{
                    $binding = $data;
                }

                if(is_null($condition)){
                    $this->query="UPDATE $table SET ".$changes;
                }
                else{
                    $this->query="UPDATE $table SET ".$changes." WHERE ".$states;
                }

                $this->statement = Database::getInstance()->prepare($this->query);
                $this->statement->execute($binding);
                return true;
            }
            catch(PDOException $e){
                echo 'ERROR: ' . $e->getMessage(). '<br>';
                return false;
            }

        }
        public function Delete($table,$data){
            try{
                $states = '';
                $first = true;
                foreach($data as $attribute => $val){
                    if($first){
                        $states .= $attribute."=:".$attribute;
                        $first = false;
                    }
                    else{
                        $states .= " AND ".$attribute."=:".$attribute;
                    }
                }
                $this->query = "DELETE FROM $table WHERE $states";

                $this->statement = Database::getInstance()->prepare($this->query);
                $this->statement->execute($data);
                return true;
            }
            catch(PDOException $e){
                echo 'ERROR: ' . $e->getMessage(). '<br>';
                return false;
            }
        }

        public function ManualQuery($query){
            try{
                $this->query = $query;
                $this->statement = Database::getInstance()->prepare($this->query);
                $this->statement->execute();
                return true;
            }
            catch(PDOException $e){
                echo 'ERROR: ' . $e->getMessage(). '<br>';
                return false;
            }
        }

        public function CountRow(){
            return $this->statement->rowCount();
        }
        public function FetchData(){
            return $this->result = $this->statement->fetchAll();
        }
        public function FetchDataRow(){
            return $this->result = $this->statement->fetch();
        }
    }
