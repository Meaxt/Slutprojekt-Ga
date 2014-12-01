<?php

define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "slutprojekt");
$result = null;

$dbh = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_SERVER . ';charset=utf8', DB_USER, DB_PASSWORD);

if(isset($_POST["action"])){
    
    if($_POST["action"] == "login"){
       
        $user = $_POST["username"];
        $password = $_POST["password"];
     
//        $pass = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_SPECIAL_CHARS);
//        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
        $sql = "SELECT * FROM inlogg WHERE username=:username AND password=:password";
        
//        
        
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":username", $user);
        $stmt->execute();
        $result = $stmt->fetch();
//        var_dump($result);
        
        
        
        if($result !=null){
            echo 'Du loggades in!';
        }else{
            echo 'inlogg misslyckad';
        }
        
    }
  
    include 'index.html.php';
    if(isset($_POST["action"])){
        
        if($_POST["action"] == "reg"){
            
            $regusername = $_POST["reguser"];
            $regpassword = $_POST["regpass"];
            echo $regpassword;
            echo $regusername;
        $sql = "INSERT INTO 'inlogg'('username', 'password') VALUES (:username, :password)";            
            
            
            
            
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(":password", $regpassword);
        $stmt->bindParam(":username", $regusername);
        $stmt->execute();
        
            
        }
            
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
            <br>
            Registrera dig
            <br>
            
            Username:<input type="text" name="reguser"><br>
            Password:<input type="password" name="regpass"><br>
            <input type="submit" value="reg" name="action">
        </form>
    </body>
</html>
