
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
                $add_to_cart = false;
            }
        }
        if ($add_to_cart) {
            $_SESSION["cart"][] = array("id" => $_POST["id"], "pris" => $_POST["pris"], "namn" => $_POST["namn"], "antal" => 1);
        }
    }


    if ($_POST["action"] == "search") {

        $sökord = $_POST["search"];

        $sql = "SELECT * FROM produkter WHERE Namn LIKE '%$s�kord%' ";

        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $produkter = $stmt->fetchAll();

        var_dump($produkter);

//        if($produkter = ""){
//            echo "ojojojoj";
//        }
    }

//hämta produkter
} // isset action
if (isset($_GET["action"])) {
    if (($_GET["action"] == "välj")) {
//    echo 'hej';
        $gender = $_GET["gender"];
        $category = $_GET["category"];
        $sql = "SELECT * FROM produkter WHERE plagg='$category' AND gender='$gender'";

//    echo $sql;

        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $produkter = $stmt->fetchAll();
//    var_dump($produkter);

//        foreach ($produkter as $produkt) {
//
//            echo "<tr>";
//            echo "<form method='post'>";
//            echo "<td>" . $produkt[1] . " " . $produkt[2] . " Kr</td>";
//            echo "<td><input type='submit' name='action' value='add'></td>";
//            echo "<input type='hidden' value='" . $produkt[1] . "' name='namn'>";
//            echo "<input type='hidden' value='" . $produkt[2] . "' name='pris'>";
//            echo "<input type='hidden' value='" . $produkt[0] . "' name='id'>";
//            echo "</form>";
//            echo "</tr>";
//        }
    }
}

if (isset($_POST["handling"])) {

    $category = $_POST["category"];
    $sortby = $_POST["sortby"];
    $sortord = $_POST["sortord"];
    $gender = $_GET["gender"];
    $category = $_GET["category"];

    $sql = "SELECT * FROM produkter ";

    if ($category != "") {
        $sql .= "WHERE category='$category' ";
    }
    if (isset($_GET["action"])) {
        if (($_GET["action"] == "välj")) {
            $sql .= "WHERE plagg='$category' AND gender='$gender'";
        }
    }

    if ($sortby != "") {
        $sql .= "ORDER BY $sortby $sortord ";
    }

    echo $sql . "<br>";

    
}







$filt = "diesel,yoloswag,skank";



echo "<form method='post'>";
echo "<input type=submit name=hej value=sup>";


if($_POST["hej"]){
    $sql = "SELECT * FROM produkter ";
    $arr = explode(",",$filt);
    $sql .= "WHERE märke ='".$arr[0]."'";
    if(count($arr)> 1){
        for($i = 1; $i < count($arr); $i++){
            $sql .=" OR märke='".$arr[$i]."'";
        }
    }
    echo $sql;
//    var_dump($arr);
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $produkter = $stmt->fetchAll();
    var_dump($produkter);

//foreach ($arr as $rus){
    
//    
//    $sql .= "WHERE marke = ".$rus[0]."";
//    
//    echo $sql;  
//
//}
}


//hämta produkter
//var_dump($_SESSION);
echo "";
echo"<br>";
echo"<br>";
echo"<br>";
echo "<form method='get'>";
echo"<input type=text name=gender>";
echo"<input type=text name=category>";
echo "<input type=submit name=action value=välj>";
echo "</form>";


echo"<br>";
echo"<br>";
echo"<br>";
echo "<form method='post'>";
echo "<input type=radio name=category value=T-shirt>T-shirts";
echo "<br>";
echo "<input type=radio name=category value=Skjortor>Skjortor";
echo "<br>";
echo "<input type=radio name=category value=Jackor>Jackor";
echo "<br>";
echo "<input type=radio name=category value=Jeans>Jeans";
echo "<br>";
echo "<input type=radio name=category value=>Ingen";
echo "<br>";
echo "<br>";
echo "<input type=radio name=sortby value=Pris>Pris";
echo "<br>";
echo "<input type=radio name=sortby value=Namn>Namn";
echo "<br>";
echo "<input type=radio name=sortby value=>Ingen";
echo "<br>";
echo "<br>";
echo "<input type=radio name=sortord value=ASC>Stigande";
echo "<br>";
echo "<input type=radio name=sortord value=DESC>Fallande";
echo "<br>";
echo "<br>";
echo "<input type=submit name=handling value=sortera>";
echo "<br>";
echo "</form>";


echo "<br>";
echo "<br>";
echo "<br>";
//var_dump($_SESSION["cart"]);
echo 'KUNDVAGN';

$total = 0;

foreach ($_SESSION["cart"] as $kund => $cart){
    echo "<tr>";
        echo "<form method='post'>";

        echo "<td>" . $cart["namn"] . " " . $cart["antal"] . " st " . $cart["pris"] . " kr </td>";
        echo "<td><input type='submit' name='action' value='remove'></td>";
//        echo "<input type='hidden' value='" . $cart[1] . "' name='namn'>";
//        echo "<input type='hidden' value='" . $cart[2] . "' name='pris'>";
//        echo "<input type='hidden' value='" . $cart[0] . "' name='id'>";
        
        $total += $cart["pris"]*$cart["antal"];
        
        echo "</form>";
        echo "</tr>";
}

echo "<br>"."Totalt pris: ".$total . "kr";

echo "<br>";
echo "<br>";


echo "<form method='post'>";
echo "<input type=text name=search>";
echo " <input type=submit name=action value=search>";
echo "</form>";

echo "<br>";
echo "<br>";

//var_dump($_SESSION);

echo "Produkter";
echo "<br>";


//if ($produkter[1] != 0) {
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
//} else {
//    echo "<br>";
//    echo "Det du letade efter existerar inte. Idiot.";
//}
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
