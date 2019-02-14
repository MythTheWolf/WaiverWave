<?php
/**
 * Created by PhpStorm.
 * User: nicholasagner
 * Date: 2019-02-14
 * Time: 12:36
 */
require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/user/WaiverWaveUser.php";
$user = new WaiverWaveUser($_GET['ID']);
if (empty($_POST['ID'])) {
    $error['error'] = true;
    $error['message'] = "'ID' is a required GET parameter.";
    die(json_encode($error));
}
if (isset($_POST['username'])) {
    $user->setUsername($_POST['username']);
}
if (isset($_POST['email'])) {
    $user->setEmail($_POST['email']);
}
if (isset($_POST['password'])) {
    $user->setPassword(password_hash($_POST['password'], PASSWORD_DEFAULT));
}