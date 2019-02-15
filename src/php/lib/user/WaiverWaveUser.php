<?php
/**
 * Created by PhpStorm.
 * User: nicholasagner
 * Date: 2019-02-13
 * Time: 20:17
 */
require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/sql/SQLConnector.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/user/UserPermissions.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/Utils.php";
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
    private $apiToken;

    function __construct(string $id)
    {
        $this->connector = new SQLConnector();
        if (startsWith($id, "$")) {
            $stmt = $this->getConnection()->prepare("SELECT * FROM `WW_Users` WHERE `apiToken` = :ID");
            $stmt->bindParam(":ID", $id);
            $stmt->execute();
            foreach ($stmt->fetchAll() as $row) {
                $this->id = $row['ID'];
                $this->username = $row['username'];
                $this->password = $row['password'];
                $this->permissions = new UserPermissions($row['permissions']);
                $this->lastSeen = $row['lastSeen'];
                $this->email = $row['email'];
                $this->exists = true;
                $this->apiToken = $row['apiToken'];
            }
        } else {
            $stmt = $this->getConnection()->prepare("SELECT * FROM `WW_Users` WHERE `ID` = :ID");
            $stmt->bindParam(":ID", $id);
            $stmt->execute();
            foreach ($stmt->fetchAll() as $row) {
                $this->id = $id;
                $this->username = $row['username'];
                $this->password = $row['password'];
                $this->permissions = new UserPermissions($row['permissions']);
                $this->lastSeen = $row['lastSeen'];
                $this->email = $row['email'];
                $this->exists = true;
                $this->apiToken = $row['apiToken'];
            }
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

    function update(): bool
    {
        $stmt = $this->getConnection()->prepare("UPDATE `WW_Users` SET `username` = :user, `email` = :email, `password` = :pass, `permissions` = :perm WHERE `ID` = :ID");
        $username = $this->getUsername();
        $stmt->bindParam(":user", $username);
        $email = $this->getEmail();
        $stmt->bindParam(":email", $email);
        $pass = $this->getPassword();
        $stmt->bindParam(":pass", $pass);
        $perms = $this->getPermissions()->toJSON();
        $stmt->bindParam(":perm", $perms);
        $id = $this->getId();
        $stmt->bindParam(":ID", $id);
        return $stmt->execute();
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
    public function getPermissions(): UserPermissions
    {
        return $this->permissions;
    }

    /**
     * @param mixed $permissions
     */
    public function setPermissions(UserPermissions $permissions)
    {
        $this->permissions = $permissions;
    }
    public function setPermissionsFromJSON(string $permissionStr){
        $this->setPermissions(new UserPermissions($permissionStr));
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
    public function getApiToken()
    {
        return $this->apiToken;
    }
}