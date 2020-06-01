<?php
    require_once("classes/db.php");

    class Crud extends Database
    {
        //to execute all query
        public function execute($sql)
        {
            //mysqli_query($sql,$con)
            $result=$this->con->query($sql);
            
            if($result == false)
            {
                return false;
            }
            return true;
        }


        //select all data from table
        public function read($sql,$id=false)
        {
            
            $result=$this->con->query($sql);
            if($result == false)
            {
                return false;
            }
            $rows=array();
            
            //if id is not empty(id is there) send requrired row

            //if id is empty send all data
            if(!empty($id))
            {
                while($row=$result->fetch_array())
                {
                    $rows=$row;
                }
            }
            else
            {
                while($row=$result->fetch_array())
                {
                    $rows[]=$row;
                }

            }  
            return $rows;

        }


        //login
        public function login($sql)
        {
            $result=$this->con->query($sql);
             if($result->num_rows > 0)
            {
                $row=$result->fetch_array();
                return $row;
            }
            else
            {
                return false;
            }
        }

        //to escape the special charcters

        public function escapeString($value)
        {
            return $this->con->real_escape_string($value);
        }

        public function is_logged_in()
        {
		    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
            {
			    return true;
		    }
	    }

        public function numRows($sql){
           $result=$this->con->query($sql);
           return $result->num_rows;
        }

    }
$crud=new Crud();
?>