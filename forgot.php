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
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lodash.js/0.10.0/lodash.min.js"></script>
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
                <?php }
                if (isset($_SESSION['success'])) {
                    unset($_SESSION['success']);
                }
                if (isset($_SESSION['error'])) {
                    unset($_SESSION['error']);
                }
                ?>
                <form id="form1" action="proforgot.php" method="post">
                    <p class="d-none" id="loading">LOADING....</p>
                    <div class="form-group">
                        <label for="email">Email : </label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Enter Email">
                        <span class="text-danger" id="msg_email">&nbsp;</span>
                    </div>
                    <hr>

                    <input class="mt-3 btn btn-warning form-control" type="button" id="send" value="Forget Password">
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $('#send').click(function() {
            $('#loading').fadeOut('slow');
            var email = $('#email').val();
            
            $('*[id*=msg_]').html('&nbsp;');
            if (email == "") {
                $('#email').focus();
                $('#msg_email').html('Please enter email');
                return false;
            }

            var isEmail = JSON.parse(reset_pass(email));
            // console.log(isEmail);
            // return false;
            if(isEmail.code != "200") {
                $("#email").focus();
                $("#msg_email").html('* '+isEmail.msg);
                return false;
            }
            
            $('#form1').submit();
        });
        function reset_pass(email) {
            var result;
            result = $.ajax({
                type: "POST",
                url: "forgotajax.php",
                dataType: "json",
                data: "email="+email,
                cache: false,
                async: false,
            });
            // console.log(result.responseText);
            // return false;
            return result.responseText;
        }
    </script>
</body>

</html>