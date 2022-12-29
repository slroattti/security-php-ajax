<?php

require_once 'config.php';

session_destroy();
header('location: login.php');

echo '<script type="javascript">
        window.history.forward()
    </script>';
?>