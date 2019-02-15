<?php
/**
 * Created by PhpStorm.
 * User: nicholasagner
 * Date: 2019-02-14
 * Time: 12:36
 */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/user/WaiverWaveUser.php";
if (empty($_POST['API-TOKEN'])) {
    $error['error'] = true;
    $error['message'] = "'API-TOKEN' is a required POST parameter.";
    die(json_encode($error));
}
if (empty($_POST['ID'])) {
    $error['error'] = true;
    $error['message'] = "'ID' is a required POST parameter.";
    die(json_encode($error));
}
$user = new WaiverWaveUser($_POST['ID']);
if (!$user->isExistant()) {
    $error['error'] = true;
    $error['message'] = "Invalid target user.";
    die(json_encode($error));
}
$current = new WaiverWaveUser($_POST['API-TOKEN']);
if ($current->getId() != $user->getId()) {
    if (!$current->getPermissions()->CanModifyUser()) {
        $error['error'] = true;
        $error['message'] = "No permission to edit others.";
        die(json_encode($error));
    }
}
if ($current->getId() === $user->getId()) {
    if (!$user->tryPassword($_POST['oldPassword'])) {
        $error['error'] = true;
        $error['message'] = "Old password is invalid.";
        die(json_encode($error));
    }
}
if (isset($_POST['username'])) {
    $user->setUsername($_POST['username']);
}
if (isset($_POST['email'])) {
    $user->setEmail($_POST['email']);
}
if (!empty($_POST['password'])) {
    $user->setPassword(password_hash($_POST['password'], PASSWORD_DEFAULT));
}
if(!empty($_POST['permissions'])){
    $user->setPermissionsFromJSON($_POST['permissions']);
}
if ($user->update()) {
    $success['error'] = false;
    $success['message'] = "Updated user #" . $user->getId();
    die(json_encode($success));
} else {
    $error['error'] = true;
    $error['message'] = "A unknown internal error has occurred";
    die(json_encode($error));
}