<?php
/**
 * Created by PhpStorm.
 * User: nicholasagner
 * Date: 2019-02-13
 * Time: 20:17
 */
require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/sql/SQLConnector.php";

class WaiverWaveUser
{
    private $id;
    private $permissions;
    private $username;
    private $password;
    private $lastSeen;
    private $connector;
    private $exists = false;
    private $email;

    function __construct(string $id)
    {
        $this->connector = new SQLConnector();
        $stmt = $this->getConnection()->prepare("SELECT * FROM `WW_Users` WHERE `ID` = :ID");
        $stmt->bindParam(":ID", $id);
        $stmt->execute();
        foreach ($stmt->fetchAll() as $row) {
            $this->id = $id;
            $this->username = $row['username'];
            $this->password = $row['password'];
            $this->permissions = json_decode($row['permissions']);
            $this->lastSeen = $row['lastSeen'];
            $this->email = $row['email'];
            $this->exists = true;
        }
    }

    public function getConnection()
    {
        return $this->getConnector()->getConnection();
    }

    /**
     * @return SQLConnector
     */
    public function getConnector(): SQLConnector
    {
        return $this->connector;
    }

    /**
     * @return mixed
     */
    public function getLastSeen()
    {
        return $this->lastSeen;
    }

    /**
     * @param mixed $lastSeen
     */
    public function setLastSeen(string $lastSeen)
    {
        $this->lastSeen = $lastSeen;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getPermissions()
    {
        return $this->permissions;
    }

    /**
     * @param mixed $permissions
     */
    public function setPermissions(array $permissions)
    {
        $this->permissions = $permissions;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    /**
     * @return bool
     */
    public function isExistant(): bool
    {
        return $this->exists;
    }

    public function tryPassword(string $pass): bool
    {
        return password_verify($pass, $this->password) ? true : false;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }
}