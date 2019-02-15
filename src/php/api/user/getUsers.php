<?php
/**
 * Created by PhpStorm.
 * User: nicholasagner
 * Date: 2019-02-14
 * Time: 19:01
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
$user = new WaiverWaveUser($_POST['API-TOKEN']);
if (!$user->isExistant()) {
    $error['error'] = true;
    $error['message'] = "Invalid API key";
    die(json_encode($error));
}
if (!$user->getPermissions()->CanViewUsers()) {
    $error['error'] = true;
    $error['message'] = "No permission to view user list.";
    die(json_encode($error));
}
if (!empty($_POST['searchParam'])) {
    $stmt = $user->getConnection()->prepare("SELECT * FROM `WW_Users` WHERE `username` LIKE :name");
    $searchStr = htmlspecialchars($_POST['searchParam'] . "%");
    $stmt->bindParam(":name", $searchStr);
} else {
    $stmt = $user->getConnection()->prepare("SELECT * FROM `WW_Users`");
}
if (!$stmt->execute()) {
    $error['error'] = true;
    $error['message'] = "A SQL error has occurred";
    die(json_encode($error));
}
$results = $stmt->fetchAll();
$return['users'] = array();
$numUsers = 0;
foreach ($results as $row) {
    $entry['ID'] = $row['ID'];
    $entry['username'] = $row['username'];
    $entry['email'] = $row['email'];
    $entry['permissions'] = $row['permissions'];
    $entry['lastSeen'] = $row['lastSeen'];
    array_push($return['users'], $entry);
    $numUsers++;
}
$return['error'] = false;
$return['userCount'] = $numUsers;
die(json_encode($return));
