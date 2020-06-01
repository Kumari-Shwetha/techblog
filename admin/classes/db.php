<?php
class Database
{
    private $host="";
    private $user="";
    private $password="";
    private $database="";

    protected $con;
    protected $error;

    public function __construct()
    {
         $this->con=new mysqli($this->host,$this->user,$this->password,$this->database);
        /* if($this->con->connect_error)
         {
             die("Cannot connect to database". $this->con->connect_errno.$this->con->connect_error);
         }*/

        if(!$this->con)
        {
            $this->error="Connection Failed". $this->con->connect_error;
        }
        return $this->con;
    }
   
}



















?>