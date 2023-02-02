<?php

$user = 'root';
$password = '';
$con = new PDO( 'mysql:host=localhost;dbname=matriciamentonovo', $user, $password );
$con->exec("SET CHARACTER SET utf8");


?>