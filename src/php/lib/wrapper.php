<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/user/WaiverWaveUser.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";
if ($_SESSION['isLoggedIn']) {
    $user = new WaiverWaveUser($_SESSION['userId']);
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Waiver Manager">
    <meta name="author" content="Nicholas Agner">
    <meta name="generator" content="">
    <title>Waiver Wave</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="css/mainStyle.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
    <script src="/js/bootstrap.min.js" crossorigin="anonymous"></script>
</head>

<style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }

    /* Move down content because we have a fixed navbar that is 3.5rem tall */
    body {
        padding-top: 3.5rem;
    }

    body {
        padding-top: 5rem;
    }

    .starter-template {
        padding: 3rem 1.5rem;
        text-align: center;
    }


</style>
<body>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <img src="/img/logo_transparent.png" width="4%" height="4%" class="navbar-brand">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
            aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item" id="HomeLink">
                <a class="nav-link" href="/" id="HomeSLink"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
            </li>
            <li class="nav-item" id="SubportalsLink">
                <a class="nav-link" href="/pages/events.php"><i class="fa fa-list" aria-hidden="true"></i> Venues</a>
            </li>
            <li class="nav-item" id="Waivers">
                <a class="nav-link" href="/pages/waivers.php"><i class="fa fa-book" aria-hidden="true"></i> Waivers</a>
            </li>
            <li class="nav-item" id="Users">
                <a class="nav-link" href="/pages/waivers.php"><i class="fa fa-users" aria-hidden="true"></i> Users</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <?php
            if ($_SESSION['isLoggedIn']) {
                ?>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown"
                           aria-haspopup="true"
                           aria-expanded="false"><i class="fa fa-user"
                                                    aria-hidden="true"></i> <?php echo $user->getUsername(); ?></a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="/pages/user/profile.php"><i class="fa fa-pencil"
                                                                                       aria-hidden="true"></i>Edit
                                Profile</a>
                            <a class="dropdown-item" href="/pages/user/logout.php">Logout</a>
                        </div>
                    </li>
                </ul>
                <script>
                    $(document).ready(function () {
                        $("#theBody").show();
                        $("#noAccessDiv").hide();
                    });
                </script>
            <?php
            } else {
            ?>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/pages/user/login.php"> Login</a>
                    </li>
                </ul>
                <script>
                    $(document).ready(function () {
                        $("#theBody").hide();
                        $("#noAccessDiv").show();
                    });
                </script>
                <?php
            }
            ?>
            <input class="form-control mr-sm-2" type="text" name="search" id="search"
                   placeholder="Name or @reservation id" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" id="searchButton"><i class="fa fa-search"
                                                                                                    aria-hidden="true"></i>
            </button>
        </form>
    </div>
</nav>
<script>
    function sleep(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }

    $("#searchButton").click(function (event) {
        event.preventDefault();
        window.location = '/pages/waivers.php?searchButton=' + $("#search").val();
    });

    function getUrlVars() {
        var vars = {};
        var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function (m, key, value) {
            vars[key] = value;
        });
        return vars;
    }

    function isEmpty(obj) {
        for (var prop in obj) {
            if (obj.hasOwnProperty(prop))
                return false;
        }

        return true;
    }
</script>