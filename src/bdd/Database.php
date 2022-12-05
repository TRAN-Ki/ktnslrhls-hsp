<?php
class Database
{

    private $bdd;
    private $host;
    private $dbname;
    private $user;
    private $pwd;

    public function __construct()
    {
        $this->host = "localhost";
        $this->dbname = "hsp-skh";
        $this->user = "root";
        $this->pwd = "";
    }


    /**
     * @return mixed
     */
    public function getBdd()
    {
        return $this->bdd = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname,$this->user,$this->pwd);
    }




}
