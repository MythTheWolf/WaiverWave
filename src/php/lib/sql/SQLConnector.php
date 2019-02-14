<?php
/**
 * Created by PhpStorm.
 * User: nicholasagner
 * Date: 2019-01-02
 * Time: 21:48
 */

class SQLConnector
{
    private $user = "";
    private $pass = "";
    private $host = "";
    private $DB = "";

    function __construct()
    {
        $config = include("config.php");
        $this->user = $config['SQLUsername'];
        $this->pass = $config['SQLPass'];
        $this->DB = $config['SQLDatabase'];
        $this->host = $config['SQLHost'];
    }

    function getConnection()
    {
        try {
            $conn = new PDO("mysql:host=$this->host;dbname=" . $this->DB, $this->user, $this->pass);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            return null;
        }
    }

}