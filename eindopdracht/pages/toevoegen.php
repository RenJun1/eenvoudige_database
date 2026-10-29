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
        <title>Toevoegen</title>
    </head>
    <body class="m-2">
        <?php
            if($_SESSION['login'] == false)
            {
                header("location: ../index.php");
                die();
            }
        ?>
        <a href="../index.php">Database</a>
        <h2>klant toevoegen</h2>

        <form name="toevoegen" action="toevoegen.php" method="POST">
            <p>
                <label>Id</label>
                <input type="number" name="id">
            </p>
            <p>
                <label>Voornaam</label>
                <input type="text" name="voornaam">
            </p>
            <p>
            <p>
                <label>Achternaam</label>
                <input type="text" name="achternaam">
            </p>
            <p>
                <label>Woonplaats</label>
                <input type="text" name="woonplaats">
            </p>
            <p>
                <label>Adres</label>
                <input type="text" name="adres">
            </p>
            <p>
                <label>Email</label>
                <input type="email" name="email">
            </p>
            <p>
                <label>Telefoonnummer</label>
                <input type="text" name="telefoonnummer">
            </p>
            <input type="submit" name="toevoegen" value="toevoegen">
        </form>
        <?php
        if(isset($_POST["toevoegen"]))
        {
            $klantenId = $_POST["id"];
            $klantenVoornaam = $_POST["voornaam"];
            $klantenAchternaam = $_POST["achternaam"];
            $klantenWoonplaats = $_POST["woonplaats"];
            $klantenAdres = $_POST["adres"];
            $klantenEmail = $_POST["email"];
            $klantenTelefoonnummer = $_POST["telefoonnummer"];

            $query = "INSERT INTO klanten VALUE ($klantenId, '$klantenVoornaam', '$klantenAchternaam', '$klantenEmail', '$klantenAdres', '$klantenWoonplaats', '$klantenTelefoonnummer')";

            $rowsAffected = ExecuteQuery($query);

            if($rowsAffected > 0)
            {
                echo "Klant is succesvol toegevoegd.";
            }
            else
            {
                echo "Klant is niet toegevoegd, probeer het opnieuw.";
            }
        }
    ?>
    </body>
</html>