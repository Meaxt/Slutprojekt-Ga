<?php

define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "slutprojekt");

$dbh = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_SERVER . ';charset=utf8', DB_USER, DB_PASSWORD);

if(isset($_POST["action"])){
    echo 'yey';
    if($_POST["action"] == "login"){
        
        $user = $_POST["username"];
        $password = $_POST["password"];
//        $pass = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_SPECIAL_CHARS);
//        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
        $sql = "SELECT * FROM user WHERE username=:username AND password=:password";
        
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":username", $user);
        $stmt->execute();
        $result = $stmt->fetch();
        
        echo 'it works';
        
    }
        
}

?>


<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form method="post">
            Username:<input type="text" name="username"><br>
            Password:<input type="password" name="password"><br>
            <input type="submit" value="login" name="action">
        </form>
    </body>
</html>
