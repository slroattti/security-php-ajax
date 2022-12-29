<?php require_once 'config.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>
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
                <h1 class="my-3 text-warning">Forgot Password</h1>
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
                <form id="form1" action="proforget.php" method="post">
                    <div class="form-group">
                        <label for="email">Email : </label>
                        <input type="email" name="email" class="form-control" placeholder="Enter Email">
                        <span class="text-danger" id="msg_email">&nbsp;</span>
                    </div>
                    <!-- <div class="form-group">
                        <label for="Password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="pass" placeholder="Enter Password">
                        <span class="text-danger" id="msg_pass">&nbsp;</span>
                    </div>
                    <div class="form-group">
                        <label for="comfirm password" class="form-label">Comfirm Password</label>
                        <input type="password" name="comfirm_password" class="form-control" id="c_pass" placeholder="Enter Comfirm Password">
                        <span class="text-danger" id="msg_cpass">&nbsp;</span>
                    </div> -->
                    <!-- <div class="form-group">
                        <input class="w-50 border-1 border-gray-100 rounded outline-0" id="captcha_code" name="captcha_code" type="text" placeholder="code">
                        <img src="<?php echo CAPTCHA_URL . rand(); ?>" id='captchaimg'>
                        <a class="btn btn-warning" href="javascript: refreshCaptcha();"><i class="bi bi-arrow-clockwise"></i></a>
                        <span class="text-danger" id="msg_cap">&nbsp;</span>
                    </div> -->
                    <hr>

                    <input class="mt-3 btn btn-warning form-control" type="submit" name="password-reset" id="send" value="Forget Password">
                </form>
            </div>
        </div>
    </div>
</body>
</html>