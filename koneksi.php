<?php
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'stokbarang';
    $db2 = 'login';
    $conn = mysqli_connect($host, $user, $pass, $db);
    $conn2 = mysqli_connect($host, $user, $pass, $db2);


    mysqli_select_db($conn, $db);
    