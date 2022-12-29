<?php
require_once 'config.php';
$url = API_URL . '/get.php';
$response = curl_get($url);

if(is_login() == false) {
    echo '<script>
        alert("Please login now!");
        window.location.href= ' . API_URL . 'login.php
        window.history.forward()
    </script>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <style>
        body {
            background-color: #151f32;
        }
        .card {
            background-color: #18366e;
        }
        img {
            background-size: contain;
        }
    </style>
</head>
<body>
    
    <div class="container">
        <div class="row">
            <div class="d-flex justify-content-between px-3 mt-5">
                <div class="font-monospace fs-4 my-3">
                    <?php if(is_login() == true) : ?>
                    <h3 class="text-secondary">Welcome, User: <span class="text-info"><?php echo $_SESSION['username'] ?></span></h3><br>
                    <div class="card p-3" style="width: 20rem;">
                        <img height="150px" src="https://images.unsplash.com/photo-1634926878768-2a5b3c42f139?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=756&q=80" class="card-img-to rounded mb-2" alt="Photo">
                        <div id="show" class="d-none" class="card-body">
                            <h4 class="card-title text-secondary">Account details: </h4>
                            <ul class="card-text text-light fs-5">
                                <?php echo 'Name: '.$_SESSION['firstname'] .'&nbsp;'. $_SESSION['lastname'] .'<br>'.'Nickname: '. $_SESSION['nickname']?>
                            </ul>
                        </div>
                        <div>
                            <a class="btn btn-outline-info rounded-pill" style="width: 3rem;" id="shw-hd"><i id="icons" class="bi bi-eye-fill"></i></a>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="">
                    <a class="btn btn-danger form-label" href="logout.php">Logout</a>
                </div>
            </div>
            <div class="card p-5 mb-4">
                <h2 class="text-secondary">Top 5 OF User.</h2>
                <?php if(isset($response['result']) > 0) : ?>
                <table class="table table-light mt-5">
                    <tr>
                        <thead class="table-dark">
                            <th scope="col">#</th>
                            <th scope="col">Firstname</th>
                            <th scope="col">Lastname</th>
                            <th scope="col">Nickname</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Email</th>
                            <th scope="col">Address</th>
                        </thead>
                    </tr>
                    <?php for($i = 0; $i < count($response['result']); $i++) : ?>  
                        <tr>
                            <tbody>
                                <td scope="row"><?php echo $i + 1 ?></td>
                                <td scope="row"><?php echo $response['result'][$i]['firstname'] ?></td>
                                <td scope="row"><?php echo $response['result'][$i]['lastname'] ?></td>
                                <td scope="row"><?php echo $response['result'][$i]['nickname'] ?></td>
                                <td scope="row"><?php echo $response['result'][$i]['phone'] ?></td>
                                <td scope="row"><?php echo $response['result'][$i]['email'] ?></td>
                                <td scope="row"><?php echo $response['result'][$i]['address'] ?></td>
                            </tbody>
                        </tr>
                    <?php endfor; ?>
                </table>
                <?php else : ?>
                    <p class="text-dark fs-3 text-center mt-5 font-monospace">404 Not Data User!</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $('#shw-hd').click(function() {
            $('#show').toggle();
            $('#show').removeClass('d-none');
        })
    </script>
    
</body>
</html>