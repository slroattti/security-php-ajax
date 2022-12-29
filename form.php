<?php require_once 'config.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>

<body>
    <div class="card w-50 h-50 my-5 p-4 mx-auto">
        <div class="container">
            <div class="row">
                <h1 class="mt-5 px-4 mb-3 text-info">Register</h1>
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
                <form id="form1" action="process.php" method="post">
                    <div class="form-group">
                        <label for="Firstname" class="form-label">Firstname</label>
                        <input type="text" name="firstname" class="form-control txtOnly" id="firstname">
                        <span class="text-danger" id="msg1">&nbsp;</span>
                    </div>
                    <div class="form-group">
                        <label for="lastname" class="form-label">Lastname</label>
                        <input type="text" name="lastname" class="form-control txtOnly" id="lastname">
                        <span class="text-danger" id="msg2">&nbsp;</span>
                    </div>
                    <div class="form-group">
                        <label for="Nickname" class="form-label">Nickname</label>
                        <input type="text" name="nickname" class="form-control txtOnly" id="nickname">
                        <span class="text-danger" id="msg3">&nbsp;</span>
                    </div>
                    <div class="form-group">
                        <label for="Phone" class="form-label">Phone</label>
                        <input type="number" class="form-control allownumericwithoutdecimal" max-length="10" id="phone" name="phone">
                        <span class="text-danger" id="msg4">&nbsp;</span>
                    </div>
                    <div class="form-group">
                        <label for="Email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="email">
                        <span class="text-danger" id="msg5">&nbsp;</span>
                    </div>
                    <div class="form-group">
                        <label for="Username" class="form-label">Username</label>
                        <input type="username" name="username" class="form-control txtOnly" id="user">
                        <span class="text-danger" id="msg6">&nbsp;</span>
                    </div>
                    <div class="form-group">
                        <label for="Password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="pass">
                        <span class="text-danger" id="msg7">&nbsp;</span>
                    </div>
                    <div class="form-group">
                        <label for="Comfirm Password" class="form-label">Comfirm Password</label>
                        <input type="password" name="comfirm_password" class="form-control" id="c_pass">
                        <span class="text-danger" id="msg8">&nbsp;</span>
                    </div>
                    <div class="form-group">
                        <label for="ID Card" class="form-label">ID Card</label>
                        <input type="number" name="id_card" class="form-control" max-length="13" id="idCard">
                        <span class="text-danger" id="msg9">&nbsp;</span>
                    </div>
                    <div class="form-group">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" name="address" id="address" cols="30" rows="5"></textarea>
                        <span class="text-danger" id="msg10">&nbsp;</span>
                    </div>
                    <div class="form-group">
                        <input class="w-50 border-1 border-gray-100 rounded outline-0" id="captcha_code" name="captcha_code" type="text">
                        <img src="<?php echo CAPTCHA_URL . rand(); ?>" id='captchaimg'>
                        <a class="btn btn-warning" href="javascript: refreshCaptcha();"><i class="bi bi-arrow-clockwise"></i></a>
                        <span class="text-danger" id="msg11">&nbsp;</span>
                    </div>

                    <input class="mt-3 btn btn-info form-control" type="submit" name="send" id="send" value="Send">
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $('#send').click(function() {
            var firstN = $('#firstname').val();
            var lastN = $('#lastname').val();
            var nickN = $('#nickname').val();
            var phone = $('#phone').val();
            var email = $('#email').val();
            var user = $('#user').val();
            var pass = $('#pass').val();
            var c_pass = $('#c_pass').val();
            var idCard = $('#idCard').val();
            var address = $('#address').val();
            var captcha_code = $('#captcha_code').val();

            $('*[id*=msg]').html('&nbsp;');
            // check values empty
            if (firstN == "") {
                $('#firstname').focus();
                $('#msg1').html('Please enter firstname a-z/A-Z only.');
                return false;
            }
            if (lastN == "") {
                $('#lastname').focus();
                $('#msg2').html('Please enter lastname a-z/A-Z only.');
                return false;
            }
            if (nickN == "") {
                $('#nickname').focus();
                $('#msg3').html('Please enter nickname a-z/A-Z only.');
                return false;
            }
            if (phone == "") {
                $('#phone').focus();
                $('#msg4').html('Please enter phone');
                return false;
            }
            if (email == "") {
                $('#email').focus();
                $('#msg5').html('Please enter email');
                return false;
            }
            if (IsEmail(email) == false) {
                $('#email').focus();
                $('#msg5').html('Invalid email.');
                return false;
            }

            if (user == "") {
                $('#user').focus();
                $('#msg6').html('Please enter username');
                return false;
            }
            if (pass == "") {
                $('#pass').focus();
                $('#msg7').html('Please enter password');
                return false;
            }
            if (c_pass == "") {
                $('#c_pass').focus();
                $('#msg8').html('Please enter comfirm password');
                return false;
            }
            if (idCard == "") {
                $('#idCard').focus();
                $('#msg9').html('Please enter ID Card');
                return false;
            }
            if(address == "") {
                $('#address').focus();
                $('#msg10').html('Please enter address');
                return false;
            }
            if (captcha_code == "") {
                $('#captcha_code').focus();
                $('#msg10').html('Please enter captcha code');
                return false;
            }
            if (pass != c_pass) {
                $('#c_pass').focus();
                $('#msg8').html('password and confirm password do not match.');
                return false;
            }
            if (user == pass) {
                $('#pass').focus();
                $('#msg7').html('Invalid username and password incorrect!');
            }

            //check length of input
            if (phone.length < '10') {
                $('#phone').focus();
                $('#msg4').html('Input phone min character length is 10 characters.');
                return false;
            }
            if (user.length < "6") {
                $('#user').focus();
                $('#msg6').html('Input username min character length is 6 characters.');
                return false;
            }
            if (pass.length < "6") {
                $('pass').focus();
                $('#msg7').html('Input password min character length is 6 characters.');
                return false;
            }
            if (c_pass.length < "6") {
                $('c_pass').focus();
                $('#msg8').html('Input comfirm password min character length is 6 characters.');
                return false;
            }
            if (idCard.length < "13" || idCard.length > "13") {
                $('#idCard').focus();
                $('#msg9').html('Input ID Card min character length is 13 characters.');
                return false;
            }

            //regex username
            var chkUser = new RegExp(/^([a-zA-Z0-9_-]+)$/);
            if (!(chkUser.test(user))) {
                $("#user").focus();
                $("#msg6").html('* Input username not allow special character!');
                return false;
            }

            // check input exists username|phone|email|id_card
            var chk_phone = JSON.parse(chk_data('phone', phone));
            if(chk_phone.code != "200") {
                $("#phone").focus();
                $("#msg4").html('* Username is exists!');
                return false;
            }
            var chk_email = JSON.parse(chk_data('email', email));
            if(chk_email.code != "200") {
                $("#email").focus();
                $("#msg5").html('* Username is exists!');
                return false;
            }
            var chk_name = JSON.parse(chk_data('username', user));
            if(chk_name.code != "200") {
                $("#user").focus();
                $("#msg6").html('* Username is exists!');
                return false;
            }
            var chk_id_card = JSON.parse(chk_data('id_card', idCard));
            if(chk_id_card.code != "200") {
                $("#id_card").focus();
                $("#msg9").html('* Username is exists!');
                return false;
            }
            $('#form1').submit();
        })


        $(document).ready(function() {
            $('input[type=number][max-length]:not([max-length=""])').on('input', function(ev) {
                var $this = $(this);
                var maxlength = $this.attr('max-length');
                var value = $this.val();
                if (value && value.length >= maxlength) {
                    $this.val(value.substr(0, maxlength));
                }
            });


            $(".allownumericwithdecimal").on("keypress keyup blur", function(event) {
                //this.value = this.value.replace(/[^0-9\.]/g,'');
                $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
                if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                    event.preventDefault();
                }
            });

            $(".allownumericwithoutdecimal").on("keypress keyup blur", function(event) {
                $(this).val($(this).val().replace(/[^\d].+/, ""));
                if ((event.which < 48 || event.which > 57)) {
                    event.preventDefault();
                }
            });

            $(".txtOnly").keypress(function(e) {
                var key = e.keyCode;
                if (key >= 48 && key <= 57) {
                    e.preventDefault();
                }
            });

            
        })

        // func of email validation
        function IsEmail(email) {
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!regex.test(email)) {
                return false;
                return regex.test(email);
            } else {
                return true;
            }
        }

        //func captcha validation
        function refreshCaptcha() {
            var img = document.images['captchaimg'];
            img.src = img.src.substring(0, img.src.lastIndexOf("?")) + "?rand=" + Math.random() * 1000;
        }

        function chk_data(input_name, input_value) {
            var result;
            result = $.ajax({
                type: "POST",
                url: "chk_data.php",
                data: "input_name="+input_name+"&input_value="+input_value,
                cache: false,
                async: false,
            });
            return result.responseText;
        }
    </script>
</body>

</html>