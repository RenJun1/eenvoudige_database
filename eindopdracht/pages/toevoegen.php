<?php
    // this starts the session
    session_start();
    // this loads in db_dfunctions.php, it stops loading the rest of the page if it doesn't exist
    require "../includes/db_functions.php";
    // this starts the connection with the database
    StartConnection("eindopdracht");
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- links with bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <link href="../styles/style.css" rel="stylesheet">
        <title>Toevoegen</title>
    </head>
    <body class="m-2">
        <?php
            // if you aren't logged in, you automatically go back to index.php
            if($_SESSION['login'] == false)
            {
                header("location: ../index.php");
                die();
            }
        ?>
        <a href="../index.php">Database</a>
        <h2>klant toevoegen</h2>

        <!-- post sends the information to the background instead of the url -->
        <table class="table table-bordered">
            <tr>
                <th>Id</th>
                <th>Voornaam</th>
                <th>Achternaam</th>
                <th>Woonplaats</th>
                <th>Adres</th>
                <th>Email</th>
                <th>Telefoonnummer</th>
                <th>Toevoegen</th>
            </tr>
            <tr>
                <!-- post sends the information to the background instead of the url -->
                <form name="toevoegen" action="toevoegen.php" method="POST">
                    <td><input type="number" name="id"></td>
                    <td><input type="text" name="voornaam"></td>
                    <td><input type="text" name="achternaam"></td>
                    <td><input type="text" name="woonplaats"></td>
                    <td><input type="text" name="adres"></td>
                    <td><input type="email" name="email"></td>
                    <td><input type="text" name="telefoonnummer"></td>
                    <td><input type="submit" name="toevoegen" value="Toevoegen"></td>
                </form>
            </tr>
        </table>
        <?php
            // checks if you clicked on the toevoegen button
            if(isset($_POST["toevoegen"]))
            {
                // this stores the information of every column in its own variable
                $klantenId = $_POST["id"];
                $klantenVoornaam = $_POST["voornaam"];
                $klantenAchternaam = $_POST["achternaam"];
                $klantenWoonplaats = $_POST["woonplaats"];
                $klantenAdres = $_POST["adres"];
                $klantenEmail = $_POST["email"];
                $klantenTelefoonnummer = $_POST["telefoonnummer"];

                // creates a new row with the information that's filled in in the input fields
                $query = "INSERT INTO klanten VALUE ($klantenId, '$klantenVoornaam', '$klantenAchternaam', '$klantenEmail', '$klantenAdres', '$klantenWoonplaats', '$klantenTelefoonnummer')";

                $rowsAffected = ExecuteQuery($query);

                // this checks if there's at least 1 row affected
                if($rowsAffected > 0)
                {
                    echo $klantenVoornaam . " " . $klantenAchternaam . " is succesvol toegevoegd.";
                }
                else
                {
                    echo "Klant is niet toegevoegd, probeer het opnieuw.";
                }
            }
        ?>
    </body>
</html>