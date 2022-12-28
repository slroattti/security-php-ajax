<?php
require_once 'config.php';
$url = BASE_URL . 'get.php';
$response = curl_get($url);

// echo '<pre>';
// print_r($response); die;
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
</head>
<body>
    
    <div class="container">
        <div class="row">
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
        </div>
    </div>

</body>
</html>