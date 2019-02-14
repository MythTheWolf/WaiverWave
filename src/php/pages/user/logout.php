<?php
/**
 * Created by PhpStorm.
 * User: nicholasagner
 * Date: 2019-02-13
 * Time: 21:18
 */
require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/wrapper.php";
session_destroy();
session_unset();
if ($_SESSION['isLoggedIn']) {
    echo "<script>location.reload();</script>";
    die();
}
?>
<div align="center">
    <img src="/img/logo_transparent.png" width="30%" height="30%"> <br/>
    <h3>You have been logged out.</h3>
</div>
