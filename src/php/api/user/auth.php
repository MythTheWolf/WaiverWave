<?php
/**
 * Created by PhpStorm.
 * User: nicholasagner
 * Date: 2019-02-13
 * Time: 20:42
 */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/user/WaiverWaveUser.php";
$conn = new SQLConnector();
$stmt = $conn->getConnection()->prepare("SELECT * FROM `WW_Users` WHERE `username` = :USER");
$stmt->bindParam(":USER", $_POST['Username']);
$stmt->execute();
$results = $stmt->fetchAll();
$id = "";
foreach ($results as $row) {
    $id = $row['ID'];
}
$user = new WaiverWaveUser($id);

if (!$user->isExistant()) {
    die("0");
}

if ($user->tryPassword(htmlspecialchars($_POST['inputPassword']))) {
    session_start();
    $_SESSION['isLoggedIn'] = true;
    $_SESSION['userId'] = $user->getId();
    die("1");
}
die("0");