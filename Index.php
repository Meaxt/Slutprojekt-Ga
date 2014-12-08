<?php
    var_dump($_POST);
    
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "slutprojekt");
$result = null;

$dbh = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_SERVER . ';charset=utf8', DB_USER, DB_PASSWORD);
include 'login.html.php';
if(isset($_POST["action"])){
    
    if($_POST["action"] == "login"){
//        var_dump($_POST);
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
  
    
    
        
}
include 'reg.html.php';
if(isset($_POST["action"])){
        
        if($_POST["action"] == "reg"){
            
            $regusername = $_POST["reguser"];
            $regpassword = $_POST["regpass"];
//            echo $regpassword;
//            echo $regusername;
        $sql = "INSERT INTO inlogg(username, password) VALUES (:username, :password)";
//        echo $sql;
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(":password", $regpassword);
        $stmt->bindParam(":username", $regusername);
        $stmt->execute();
        
            
        }
            
    }

if (isset($_POST["action"])) {
    var_dump($_POST);
    if ($_POST["action"] == "delete") {
        //ta bort en produkt
        echo "ja";
        $sql = "DELETE FROM produkter WHERE id='" . $_POST["id"] . "'";
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        header("Location:?");
    }
}
if (isset($_POST["action"])) {
    if ($_POST["action"] == "Accept") {
        $namn = filter_input(INPUT_POST, 'namn', FILTER_SANITIZE_SPECIAL_CHARS);
        $pris = filter_input(INPUT_POST, 'pris', FILTER_SANITIZE_SPECIAL_CHARS);
        //uppdatera en produkt
        $sql = "UPDATE produkter SET namn='" . $namn . "' WHERE id='" . $_POST["id"] . "'";
        $sql = "UPDATE produkter SET pris='" . $pris . "' WHERE id='" . $_POST["id"] . "'";
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        header("Location:?");
    }
}
if (isset($_POST["action"])) {
    if ($_POST["action"] == "New") {
        $namn = filter_input(INPUT_POST, 'namn', FILTER_SANITIZE_SPECIAL_CHARS);
        $pris = filter_input(INPUT_POST, 'pris', FILTER_SANITIZE_SPECIAL_CHARS);
        //skapa ny
        $sql = "INSERT INTO produkter(namn, pris) VALUES ('$namn', '$pris')";
        
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        header("Location:?");
    }
}

if(isset($_POST["action"])){
    if ($_POST["action"] == "add") {
        
    }
}

//hämta produkter
$sql = "SELECT * FROM produkter";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$produkter = $stmt->fetchAll();


echo "<br>";
foreach ($produkter as $produkt) {
    
    echo "<tr>";
    echo "<form method='post'>";
    echo "<td>" . $produkt[1] . " " . $produkt[2] . "</td>";
    echo "<td><input type='submit' name='action' value='edit'><input type='submit' name='action' value='delete'><input type='submit' name='action' value='add'></td>";
    echo "<input type='hidden' value='" . $produkt[1] . "' name='namn'>";
    echo "<input type='hidden' value='" . $produkt[2] . "' name='pris'>";
    echo "<input type='hidden' value='" . $produkt[0] . "' name='id'>";
    echo "</form>";
    echo "</tr>";
    
}



if (isset($_POST["action"])) {
    if ($_POST["action"] == "edit") {
       
echo "<form method='post'>";
echo "<input type='text' name='pris' value='" . $_POST["pris"] . "'>";
echo "<input type='submit' name='action' value='Accept'>";
echo "<input type='hidden' value='" . $_POST["id"] . "' name='id'>";
echo "<br>";
echo "</form>";
    }
}

echo "<form method='post'>";
echo "<input type='text' name='namn'>";
echo "<input type='text' name='pris'>";
echo "<input type='submit' name='action' value='New'>";
echo "</form>";



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
       
       <br>
    </body>
</html>
