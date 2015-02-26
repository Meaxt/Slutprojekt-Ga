<?php
session_start();
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "slutprojekt");
$result = null;

$dbh = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_SERVER . ';charset=utf8', DB_USER, DB_PASSWORD);
include 'login.html.php';

if ($_SESSION["user"] != null) {
    echo 'Du är inloggad. ';
} else {
    $_SESSION["user"] = null;
}
if (isset($_POST["action"])) {

    if ($_POST["action"] == "login") {
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



        if ($result != null) {
            echo 'Du loggades in!';
            $_SESSION["user"] = $_POST["username"];
        } else {
            echo 'inlogg misslyckad';
        }
    }
}
$sql = "SELECT * FROM produkter";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$produkter = $stmt->fetchAll();

$sql = "SELECT * FROM produkter";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$adminprodukter = $stmt->fetchAll();

include 'reg.html.php';

if (isset($_POST["action"])) {
      //Registrering
    if ($_POST["action"] == "reg") {

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



    if ($_POST["action"] == "delete") {
        //ta bort en produkt
        echo "gör delete";
        $sql = "DELETE FROM produkter WHERE id='" . $_POST["id"] . "'";
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        header("Location:?");
    }


    if ($_POST["action"] == "Accept") {
        //Ändra produkter
        echo "Gör accept";
        $namn = filter_input(INPUT_POST, 'namn', FILTER_SANITIZE_SPECIAL_CHARS);
        $pris = filter_input(INPUT_POST, 'pris', FILTER_SANITIZE_SPECIAL_CHARS);
        //uppdatera en produkt
        $sql = "UPDATE produkter SET namn='" . $namn . "' WHERE id='" . $_POST["id"] . "'";
        $sql = "UPDATE produkter SET pris='" . $pris . "' WHERE id='" . $_POST["id"] . "'";
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        header("Location:?");
    }


    
    if ($_POST["action"] == "New") {
        //Lägga in nya produkter
        echo "Gör new";
        $namn = filter_input(INPUT_POST, 'namn', FILTER_SANITIZE_SPECIAL_CHARS);
        $pris = filter_input(INPUT_POST, 'pris', FILTER_SANITIZE_SPECIAL_CHARS);
        $brand = filter_input(INPUT_POST, 'brand', FILTER_SANITIZE_SPECIAL_CHARS);
        $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_SPECIAL_CHARS);
        $color = filter_input(INPUT_POST, 'color', FILTER_SANITIZE_SPECIAL_CHARS);
        //skapa ny
        
        $sql = "INSERT INTO produkter(namn, pris, brand, category, color) VALUES ('$namn', '$pris','$brand','$category','$color')";
//        echo $sql;
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        header("Location:?");
    }




    if ($_POST["action"] == "add") {
        $add_to_cart = true;
        for ($i = 0; $i < count($_SESSION["cart"]); $i++) {
            if ($_SESSION["cart"][$i]["id"] == $_POST["id"]) {
                //öka antal
                $_SESSION["cart"][$i]["antal"] ++;
                $add_to_cart=false;
            }
        }
        if ($add_to_cart) {
            $_SESSION["cart"][] = array("id" => $_POST["id"], "pris" => $_POST["pris"], "namn" => $_POST["namn"], "antal" => 1);
        }
    }


    
    
}
    if( isset($_POST["handling"])){
        $category = $_POST["category"];
        $sortby = $_POST["sortby"];
        $sortord = $_POST["sortord"];
        
        
        $sql = "SELECT * FROM produkter ";
        if($category !=""){
            $sql .= "WHERE category='$category' "; 
        }
        if($sortby !=""){
            $sql .= "ORDER BY $sortby $sortord";
        }
        echo $sql;
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $produkter = $stmt->fetchAll();
        echo '<br>';
        var_dump($produkter);
    }
//hämta produkter


//var_dump($_SESSION);
echo "";
echo"<br>";
echo"<br>";
echo"<br>";



echo "<form method='post'>";
echo "<input type=radio name=category value=T-shirt>T-shirt";
echo "<br>";
echo "<input type=radio name=category value=Skjortor>Skjortor";
echo "<br>";
echo "<input type=radio name=category value=Jacka>Jacka";
echo "<br>";
echo "<input type=radio name=category value=Jeans>Jeans";
echo "<br>";
echo "<input type=radio name=category value=>Ingen";
echo "<br>";
echo "<br>";
echo "<input type=radio name=sortby value=Pris>Pris";
echo "<br>";
echo "<input type=radio name=sortby value=A-Z>A-Z";
echo "<br>";
echo "<input type=radio name=sortby value=>Ingen";
echo "<br>";
echo "<br>";
echo "<input type=radio name=sortord value=DESC>Stigande";
echo "<br>";
echo "<input type=radio name=sortord value=ASC>Fallande";
echo "<br>";
echo "<input type=submit name=handling value=sortera>";
echo "<br>";
echo "</form>";


//var_dump($_SESSION);

echo "Produkter";
foreach ($produkter as $produkt) {

    echo "<tr>";
    echo "<form method='post'>";
    echo "<td>" . $produkt[1] . " " . $produkt[2] . " Kr</td>";
    echo "<td><input type='submit' name='action' value='add'></td>";
    echo "<input type='hidden' value='" . $produkt[1] . "' name='namn'>";
    echo "<input type='hidden' value='" . $produkt[2] . "' name='pris'>";
    echo "<input type='hidden' value='" . $produkt[0] . "' name='id'>";
    echo "</form>";
    echo "</tr>";
}
echo "Sortering";
echo "<form method='post'>";
echo "<input type='submit' name='action' value='Billigast'>";
echo "<input type='submit' name='action' value='Dyrast'>";
echo "<input type='submit' name='action' value='A-Z'>";
echo "<input type='submit' name='action' value='Z-A'>";
echo "</form>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";

echo 'Admin shit';
foreach ($adminprodukter as $produkt) {

    echo "<tr>";
    echo "<form method='post'>";
    echo "<td>" . $produkt[1] . " " . $produkt[2] . "</td>";
    echo "<td><input type='submit' name='action' value='edit'><input type='submit' name='action' value='delete'></td>";
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
echo "Namn<input type='text' name='namn'>";
echo "Pris<input type='text' name='pris'>";
echo "Brand<input type='text' name='brand'>";
echo "Category<input type='text' name='category'>";
echo "Color<input type='text' name='color'>";
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
        <a href="kill.php">KILL!</a>

        <br>
    </body>
</html>
