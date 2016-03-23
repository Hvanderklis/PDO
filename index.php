<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
    <?php
            if(isset($_POST["submit"])){
                $servername = "localhost";
                $username = "root";
                $password = "";
                try {
                    //Creating connection for mysql
                    $conn = new PDO("mysql:host=$servername;dbname=opdracht", $username, $password);
                    // set the PDO error mode to exception
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = $conn->prepare("INSERT INTO `phples` VALUES (:naam, :email, :bericht)");
                    $sql->bindParam(':naam', $_POST["naam"]);
                    $sql->bindParam(':email', $_POST["email"]);
                    $sql->bindParam(':bericht', $_POST["bericht"]);
                    if ($sql->execute()) {
                        echo "<div class=\"alert alert-success\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Geslaagd!</strong> Je gegevens zijn opgeslagen.</div>";
                    }else{
                        echo "<div class=\"alert alert-danger\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Fout!</strong> Er is iets misgegaan.</div>";
                    }
                    $conn = null;
                }catch(PDOException $e){
                    echo "<div class=\"alert alert-danger\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Fout!</strong> ".$e->getMessage()."</div>";
                }
            }
        ?>
        <form method="POST">
            <table>
                <tr>
                    <td>Naam:</td>
                    <td><input required type="text" name="naam"></td>
                </tr>
                <tr>
                    <td>E-Mail:</td>
                    <td><input required type="text" name="email"></td>
                </tr>
                <tr>
                    <td>Bericht:</td>
                    <td><input required type="text" name="bericht"></td>
                </tr>
                <tr>
                    <td><button type="submit" name="submit">Verstuur</button></td>
                </tr>
            </table>
        </form>
        <br>
        <button type="button" name="receive" onclick="AJAX()" >Ontvang database data</button>
        <div id="databasedata">
</body>
</html>