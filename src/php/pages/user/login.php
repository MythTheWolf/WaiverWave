<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Please log in</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
          integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }

        .form-signin {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: auto;
        }

        .form-signin .checkbox {
            font-weight: 400;
        }

        .form-signin .form-control {
            position: relative;
            box-sizing: border-box;
            height: auto;
            padding: 10px;
            font-size: 16px;
        }

        .form-signin .form-control:focus {
            z-index: 2;
        }

        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }

        .invalid {
            outline-color: red;
            /* also need animation and -moz-animation */
            -webkit-animation: shake .27s linear;
        }

        /* also need keyframes and -moz-keyframes */
        @-webkit-keyframes shake {
            8%, 41% {
                -webkit-transform: translateX(-30px);
            }
            25%, 58% {
                -webkit-transform: translateX(30px);
            }
            75% {
                -webkit-transform: translateX(-15px);
            }
            92% {
                -webkit-transform: translateX(15px);
            }
            0%, 100% {
                -webkit-transform: translateX(0);
            }
        }
    </style>
    <!-- Custom styles for this template -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" crossorigin="anonymous"></script>
    <script src="/js/bootstrap.min.js" crossorigin="anonymous"></script>
</head>
<body class="text-center">
<form class="form-signin" id="loginForm" name="loginForm">
    <img class="mb-4" src="/img/logo_transparent.png" alt="" width="55%" height="55%">
    <div class="submitForm">
        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="text" name="Username" class="form-control" placeholder="Username" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="inputPassword" class="form-control" placeholder="Password" required>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="button" id="submit" name="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted">WaiverWave - &copy; 2018-2018 Nicholas Agner</p>
</form>


<script>
    $(document).on('keypress', function (e) {
        if (e.which === 13) {
            $("#submit").click();
        }
    });
    $('#submit').on('click', function (e) {
        e.preventDefault();
        var datastring = $("#loginForm").serialize();
        $.ajax({
            type: "POST",
            url: "/api/user/auth.php",
            beforeSend: function () {
                $("#submit").html("<i class=\"fa fa-cog fa-spin\" style=\"font-size:24px\"></i>");
                $("#submit").addClass("disabled");
            },
            data: datastring, // serializes the form's elements.
            success: function (data) {
                if (data !== "1") {
                    var $formContainer = $('.submitForm');
                    $formContainer.addClass('invalid');
                    setTimeout(function () {
                        $formContainer.removeClass('invalid');
                    }, 500);
                    $("#submit").removeClass("disabled");
                    $("#submit").html("Sign in");
                } else {
                    document.location = "/";
                }
            }
        });
    });

</script>
</body>
</html>
