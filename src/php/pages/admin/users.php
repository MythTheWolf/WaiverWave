<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/wrapper.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/user/WaiverWaveUser.php";
if (!$user->isExistant()) {
    die("<div id=\"noAccessDiv\" align=\"center\">
    <img src=\"/img/logo_transparent.png\" width=\"30%\" height=\"30%\"> <br/>
    <h3>You must log in to view this page.</h3>
</div>");
}
if (!$user->getPermissions()->CanViewUsers()) {
    die("
<div align=\"center\">
    <img src=\"/img/no-access.png\" width=\"30%\" height=\"30%\"> <br/>
    <h3>You do not have permission to access this page.</h3>
</div>");
}

?>

<body id="theBody">
<script>
    function editUser(id) {
        $('#dummy-Div').iziModal('destroy');
        var data = {"API-TOKEN": "<?php echo $user->getApiToken(); ?>", "ID": id};
        var modal = $("#dummy-Div").iziModal({
            zindex: 2147483647,
            restoreDefaultContent: true,
            width: 800,
            top: 20,
            bottom: 20,
            onOpening: function (modal) {

                modal.startLoading();
                $.ajax({
                    type: "POST",
                    url: "/api/user/getUserEditHTML.php",
                    data: data, // serializes the form's elements.
                    success: function (data) {
                        let jsonRaw = data.split('\n')[0];
                        if (!isJsonString(jsonRaw)) {
                            console.log("Unparsable response: " + data);
                            var modal2 = $("#dummy-Div").iziModal({
                                title: "Error",
                                subtitle: "A internal error has occurred. See console for details.",
                                icon: 'fas fa-exclamation-triangle',
                                headerColor: '#BD5B5B',
                                width: 600,
                                timeout: 3000,
                                timeoutProgressbar: true,
                                transitionIn: 'fadeInDown',
                                transitionOut: 'fadeOutDown',
                                pauseOnHover: true
                            });
                            modal2.iziModal("open");
                        }
                        let json = JSON.parse(jsonRaw);
                        if (json.error === true) {
                            if(json.message === "No permission to edit users"){
                                modal.stopLoading();
                                $("#dummy-Div .iziModal-content").html("<div align=\"center\">\n    <img src=\"/img/no-access.png\" width=\"30%\" height=\"30%\"> <br/>\n    <h3>You do not have permission to access this function.</h3>\n</div>");
                            }else{
                                modal.stopLoading();
                                $("#dummy-Div .iziModal-content").html("<div align=\"center\">\n    <img src=\"/img/no-access.png\" width=\"30%\" height=\"30%\"> <br/>\n    <h3>A error has occurred,cannot continue.</h3>\n</div>");
                            }

                        } else {
                            modal.stopLoading();
                            $("#dummy-Div .iziModal-content").html(data.replace(jsonRaw,""));
                        }
                    }
                });
            }

        });
        modal.iziModal("open");
    }

    $(document).ready(function () {
        $("#search").attr("placeholder", "Search users..");
        let data = {"API-TOKEN": "<?php echo $user->getApiToken(); ?>", "searchParam": $("#search").val()};
        $.ajax({
            type: "POST",
            url: "/api/user/getUsers.php",
            beforeSend: function () {
                $("#searchButton").html("<i class=\"fa fa-cog fa-spin\" style=\"font-size:24px\"></i>");
                $("#searchButton").addClass("disabled");
            },
            data: data, // serializes the form's elements.
            success: function (data) {
                if (!isJsonString(data)) {
                    console.log("Unparsable response: " + data);
                    var modal = $("#dummy-Div").iziModal({
                        title: "Error",
                        subtitle: "A internal error has occurred. See console for details.",
                        icon: 'fas fa-exclamation-triangle',
                        headerColor: '#BD5B5B',
                        width: 600,
                        timeout: 3000,
                        timeoutProgressbar: true,
                        transitionIn: 'fadeInDown',
                        transitionOut: 'fadeOutDown',
                        pauseOnHover: true
                    });
                    modal.iziModal("open");
                } else {
                    let result = JSON.parse(data);
                    let base = "<tr>\n" +
                        "<td>[ID]</td>" +
                        "    <td>[UN]</td>\n" +
                        "    <td>[EM]</td>\n" +
                        "    <td>[SU]</td>\n" +
                        "    <td>[LS]</td>\n" +
                        "</tr>";
                    for (let user of result.users) {
                        let x = base.replace("[ID]", user.ID);
                        let perms = JSON.parse(user.permissions);
                        x = x.replace("[UN]", "<a href='#' onclick='editUser(\"" + user.ID + "\")'>" + user.username + "<\/a>");
                        x = x.replace("[EM]", user.email);
                        x = x.replace("[SU]", perms.superUser);
                        x = x.replace("[LS]", user.lastSeen);
                        $("#tableBody").append(x);
                    }
                    $("#searchButton").removeClass("disabled");
                    $("#searchButton").html("Search <i class=\"fa fa-search\" aria-hidden=\"true\"></i>");
                }
            }
        });

    });
</script>
<input id="ignoreDefaultSearch" value="1" hidden>
<div class="container" align="center">
    <div><h2 id="mainHeader">[HEAD]</h2>
        <p>Click on any user to edit their properties.</p></div>
</div>

<div id="dummy-Div"></div>
<table class="table table-dark table-hover">
    <thead>
    <tr>
        <th># ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Super User</th>
        <th>Last Logged in</th>
    </tr>
    </thead>
    <tbody id="tableBody">
    </tbody>
</table>

</body>