<?php
    session_start();
    include "../includes/db_functions.php";
    StartConnection("eindopdracht");

?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <link href="../styles/style.css" rel="stylesheet">
        <title>Bewerken</title>
    </head>
    <body class="m-2">
        <?php
            $id = $_GET["klantenId"];

            if (!isset($id))
            {
                header("location: ../index.php");
                die();
            }

            $query = "SELECT * FROM klanten WHERE id = $id";

            $result = ExecuteSelectQuery($query);
            $klanten = $result[0];
        ?>
        <main>
            <a href="../index.php">Database</a>
            <h2>Klant bewerken</h2>
            <?php
                if(isset($_POST["bewerken"]))
                {
                    $klantenid = $_POST["id"];
                    $klantenVoornaam = $_POST["voornaam"];
                    $klantenAchternaam = $_POST["achternaam"];
                    $klantenWoonplaats = $_POST["woonplaats"];
                    $klantenAdres = $_POST["adres"];
                    $klantenEmail = $_POST["email"];
                    $klantenTelefoonnummer = $_POST["telefoonnummer"];

                    $updateQuery = "UPDATE klanten SET id = $klantenid, voornaam = '$klantenVoornaam', achternaam = '$klantenAchternaam', woonplaats = '$klantenWoonplaats', adres = '$klantenAdres', email = '$klantenEmail', telefoonnummer = '$klantenTelefoonnummer' WHERE id = $id";

                    $rowsAffected = ExecuteQuery($updateQuery);

                    if($rowsAffected >0)
                    {
                        $query = "SELECT * FROM klanten WHERE id = $id";

                        $result = ExecuteSelectQuery($query);
                        $klanten = $result[0];
                    }
                }
            ?>
            <table class="table table-bordered">
                <tr>
                    <th>Id</th>
                    <th>Voornaam</th>
                    <th>Achternaam</th>
                    <th>Woonplaats</th>
                    <th>Adres</th>
                    <th>Email</th>
                    <th>Telefoonnummer</th>
                    <th>Aanpassen</th>
                </tr>
                <tr>
                    <form name="bewerken" action="bewerken.php?klantenId=<?php echo $id?>" method="POST">
                        <td><input readonly type="text" name="id" value="<?php echo $klanten["id"];?>"></td>
                        <td><input type="text" name="voornaam" value="<?php echo $klanten["voornaam"];?>"></td>
                        <td><input type="text" name="achternaam" value="<?php echo $klanten["achternaam"];?>"></td>
                        <td><input type="text" name="woonplaats" value="<?php echo $klanten["woonplaats"];?>"></td>
                        <td><input type="text" name="adres" value="<?php echo $klanten["adres"];?>"></td>
                        <td><input type="text" name="email" value="<?php echo $klanten["email"];?>"></td>
                        <td><input type="text" name="telefoonnummer" value="<?php echo $klanten["telefoonnummer"];?>"></td>
                        <td><input type="submit" name="bewerken" value="Bewerken"></td>
                    </form>
                </tr>
            </table>
            <?php
                if($rowsAffected >0)
                {
                    echo $klantenVoornaam . " is succesvol aangepast";
                }
                else
                {
                    echo "Er is iets misgegaan";
                }
            ?>
        </main>
    </body>
</html>
