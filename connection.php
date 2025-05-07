<?php

$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "mini_blog_shopping_cart";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>