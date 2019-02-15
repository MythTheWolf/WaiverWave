<?php
/**
 * Created by PhpStorm.
 * User: nicholasagner
 * Date: 2019-02-13
 * Time: 21:28
 */
require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/wrapper.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/user/WaiverWaveUser.php";
?>
<div align="center">
</div>
<form id="updateForm">
    <input name="ID" id="ID" type="text" value="<?php echo $user->getId(); ?>">
    <input name="API-TOKEN" type="text" value="<?php echo $user->getApiToken(); ?>">
    <div class="form-group row">
        <label for="username" class="col-4 col-form-label">Username</label>
        <div class="col-8">
            <input id="username" name="username" placeholder="Username" type="text" class="form-control"
                   aria-describedby="usernameHelpBlock" value="<?php echo $user->getUsername(); ?>">
            <span id="usernameHelpBlock" class="form-text text-muted">Your desired username</span>
        </div>
    </div>
    <div class="form-group row">
        <label for="email" class="col-4 col-form-label">Email address</label>
        <div class="col-8">
            <input id="email" name="email" placeholder="Email" type="text" class="form-control"
                   aria-describedby="emailHelpBlock" value="<?php echo $user->getEmail(); ?>">
            <span id="emailHelpBlock" class="form-text text-muted">Your primary email address</span>
        </div>
    </div>
    <div class="form-group row">
        <label for="oldPassword" class="col-4 col-form-label">Current password</label>
        <div class="col-8">
            <input id="oldPassword" name="oldPassword" placeholder="Your current password" type="password"
                   class="form-control" aria-describedby="oldPasswordHelpBlock" required="true">
            <span id="oldPasswordHelpBlock"
                  class="form-text text-muted">Your password is required to make changes</span>
        </div>
    </div>
    <div class="form-group row">
        <label for="password" class="col-4 col-form-label">New password</label>
        <div class="col-8">
            <input id="password" name="password" placeholder="New password" type="password" class="form-control"
                   aria-describedby="passwordHelpBlock">
            <span id="passwordHelpBlock" class="form-text text-muted">New desired password, leave blank to keep your current one</span>
        </div>
    </div>
    <div class="form-group row">
        <div class="offset-4 col-8">
            <button id="submit" name="submit" type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
<script>
    $("#updateForm").submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "/api/user/updateUser.php",
            beforeSend: function () {
                // $("#submit").html("<i class=\"fa fa-cog fa-spin\" style=\"font-size:24px\"></i>");
                //$("#submit").addClass("disabled");
            },
            data: $("#updateForm").serialize(), // serializes the form's elements.
            success: function (data) {
                alert(data);
                let result = JSON.parse(data);
                if (result.error === true) {
                    iziToast.error({title: 'Error:', message: result.message,position: "center",transitionIn: "bounceInDown",timeout: 5000});
                }else{
                    iziToast.show({
                        theme: 'dark',
                        icon: 'icon-person',
                        title: 'Success!',
                        message: 'Your profile has been updated.',
                        position: 'center', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
                        progressBarColor: 'rgb(0, 255, 184)',
                        buttons: [
                            ['<button>Return Home</button>', function (instance, toast) {
                                    window.location = "/";
                            }, true], // true to focus
                            ['<button>Close</button>', function (instance, toast) {
                                instance.hide({
                                    transitionOut: 'fadeOutUp',
                                    onClosing: function(instance, toast, closedBy){
                                    }
                                }, toast, 'buttonName');
                            }]
                        ],
                        onOpening: function(instance, toast){
                            console.info('callback abriu!');
                        },
                        onClosing: function(instance, toast, closedBy){
                            console.info('closedBy: ' + closedBy); // tells if it was closed by 'drag' or 'button'
                        }
                    });
                }
            }
        });
    });
</script>