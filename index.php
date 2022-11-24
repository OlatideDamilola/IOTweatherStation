<?php
 session_start();
    require_once "inc/dbCon.php";
    $GLOBALS['pState']="0";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["btnLogin"])) {
            if(veriPW(trim($_POST["tbxPw"]))) {
                $_SESSION['stateLog']='s';
                header("location:dashboard.php");
                exit(); }
            else {
                $GLOBALS['pState']="1";
                session_unset();
                session_destroy();
            }
        }
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <title>IOT Weather Station</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="asset/css/appstyle.css" rel="stylesheet" type="text/css">
    <style>
        .Lform {
            max-width: 350px;
            height: auto;
            top: 50%;
            margin-top: -160px;
        }
    </style>
</head>
    <body class="h-vh-100 bg-brandColor2">
        <form action="index.php" method="post" id="fLogin" class="Lform mx-auto bg-white ani-bounce shadow-4 p-5">
            <span class="mif-vpn-lock mif-4x place-right" style="margin-top: -10px;"></span>
            <h3 class="text-light">IOT Weather Station</h3>
            <input type="hidden" id="ps" value="<?php echo $GLOBALS['pState']?>">
            <input type="password" name="tbxPw" id="tbxPw" data-role="input" data-prepend="<span class='mif-key'>" placeholder="Enter your password...">
            <input type="submit" value="Login" name="btnLogin" onclick="doLogin()" class="button shadowed w-100 mt-5">
        </form>

        <div class="info-box" data-role="info-box" id="msgBox" data-type="alert" data-auto-hide="4000" data-overlay-click-close="true">
            <span class="button square closer"></span>
            <div class="info-box-content">
                <h4><span class="mif mif-info"></span> INVALID</h4>
                <p>The Password you provided is invalid. Please check.</p>
            </div>
        </div>

    <script src="asset/js/metro.min.js"  type="text/javascript"></script>
        <script>
            $(function(){
                if($("#ps").val()=="1") Metro.getPlugin('#msgBox', 'info-box').open();
            })

            function doLogin(){
                if($("#tbxPw").val()==""){
                    var form  = $('#fLogin');
                    form.removeClass("ani-bounce");
                    form.addClass("ani-ring");
                    setTimeout(function(){
                        form.removeClass("ani-ring");
                        form.addClass("ani-bounce");
                    }, 1000);
                    $("#tbxPw").focus();
                    event.preventDefault();}
            }
        </script>
    </body>
</html>
