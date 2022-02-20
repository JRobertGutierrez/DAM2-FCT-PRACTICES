<?php

class Database
{  
    private $dbhost = 'localhost';
    private $dbuser = 'root';
    private $dbpassword = '';
    private $dbname = 'loginform';
    private $dbport = 3306;

    public function __construct($dbhost='',$dbuser='',$dbpassword='',$dbname='',$dbport='')
    {
        if(strcmp($dbhost,''))
        {
            $this->dbhost;
        }
        if(strcmp($dbuser,''))
        {
            $this->dbuser = $dbuser;
        }
        if(strcmp($dbpassword,''))
        {
            $this->dbpassword = $dbpassword;
        }
        if(strcmp($dbname,''))
        {
            $this->dbname = $dbname;
        }
        if(strcmp($dbport,''))
        {
            $this->port = $dbport;
        }
    }
    
    public function conectar()
    {
        return mysqli_connect($this->dbhost, $this->dbuser, $this->dbpassword, $this->dbname,$this->dbport); 
    }

}
