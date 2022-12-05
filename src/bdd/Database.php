<?php
require_once 'Env.php';
class Database
{

    private $bdd;
    private $host;
    private $dbname;
    private $user;
    private $pwd;

    public function __construct()
    {
        $env = new Env();
        $this->host = $env->getHost();
        $this->dbname = $env->getDbname();
        $this->user = $env->getUser();
        $this->pwd = $env->getPwd();
    }


    /**
     * @return mixed
     */
    public function getBdd()
    {
        return $this->bdd = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname,$this->user,$this->pwd);
    }




}
