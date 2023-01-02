<?php require_once 'config.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <style>
        body {
            background-color: #151f32;
        }
        .card {
            background-color: #18366e;
            color: #fff;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="card w-50 h-50 my-5 p-4 mx-auto">
        <div class="container">
            <div class="row">
                <h1 class="my-3 text-success">Login</h1>
                <?php if (isset($_SESSION['error'])) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                        ?>
                    </div>
                <?php } ?>
                <?php if (isset($_SESSION['success'])) { ?>
                    <div class="alert alert-success" role="alert">
                        <?php
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                        ?>
                    </div>
                <?php } if(isset($_SESSION['success'])) {
                        unset($_SESSION['success']);
                    } 
                    if(isset($_SESSION['error'])) {
                        unset($_SESSION['error']);
                    } 
                ?>
                <form id="form1" action="prologin.php" method="post">
                    <div class="form-group">
                        <label for="Username" class="form-label">Username</label>
                        <input type="username" name="username" class="form-control txtOnly" id="user">
                        <span class="text-danger" id="msg_user">&nbsp;</span>
                    </div>
                    <div class="form-group">
                        <label for="Password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="pass">
                        <span class="text-danger" id="msg_pass">&nbsp;</span>
                    </div>
                    <div class="form-group">
                        <input class="w-50 border-1 border-gray-100 rounded outline-0" id="captcha_code" name="captcha_code" type="text">
                        <img src="<?php echo CAPTCHA_URL . rand(); ?>" id='captchaimg'>
                        <a class="btn btn-warning" href="javascript: refreshCaptcha();"><i class="bi bi-arrow-clockwise"></i></a>
                        <span class="text-danger" id="msg_cap">&nbsp;</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <p><a href="form.php">Click</a> for register</p>
                        <a class="btn btn-outline-warning" href="forgot.php">Forget Password</a>
                    </div>

                    <input class="mt-3 btn btn-success form-control" type="submit" name="send" id="send" value="Send">
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $('#send').click(function() {
            var user = $('#user').val();
            var pass = $('#pass').val();
            var captcha_code = $('#captcha_code').val();

            $('*[id*=msg_]').html('&nbsp;');
            if (user == "") {
                $('#user').focus();
                $('#msg_user').html('Please enter username');
                return false;
            }
            if (pass == "") {
                $('#pass').focus();
                $('#msg_pass').html('Please enter password');
                return false;
            }
            if (captcha_code == "") {
                $('#captcha_code').focus();
                $('#msg_cap').html('Please enter captcha code');
                return false;
            }
            var post_user = JSON.parse(chk_login(user, pass, captcha_code));
            // console.log(post_user.code);
            if(post_user.code != "200") {
                $("#user").focus();
                $("#msg_user").html('* '+post_user.msg);
                return false;
            }
            $('#form1').submit();
        });

        //func captcha validation
        function refreshCaptcha() {
            var img = document.images['captchaimg'];
            img.src = img.src.substring(0, img.src.lastIndexOf("?")) + "?rand=" + Math.random() * 1000;
        }
        function chk_login(user, pass, code) {
            var result;
            result = $.ajax({
                type: "POST",
                url: "login-ajax.php",
                data: "input_user="+user+"&input_pass="+pass+"&captcha_code="+code,
                cache: false,
                async: false,

            });
            return result.responseText;
        }
    </script>

</body>
</html>