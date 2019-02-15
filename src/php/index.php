<?php
/**
 * Created by PhpStorm.
 * User: nicholasagner
 * Date: 2019-02-13
 * Time: 19:36
 */
require_once "lib/wrapper.php";
?>
<script>
    $("#HomeSLink").addClass("active");
</script>
<div id="theBody">
    <div align="center">
        <img src="img/logo_transparent.png" width="30%" height="30%"> <br/>
        <h3>Hello, <?php echo $user->getUsername(); ?>.</h3>
    </div>
</div>

<div id="noAccessDiv" align="center">
    <img src="img/logo_transparent.png" width="30%" height="30%"> <br/>
    <h3>You must log in to view this page!</h3>
</div>