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
        <title>Bewerken</title>
    </head>
    <body class="m-2">
        <?php
            // this gets the klantenId from the url and saves it in $id
            $id = $_GET["klantenId"];

            // if there isn't an id or if you're not logged in, you automatically go back to index.php
            if (!isset($id) || $_SESSION["login"] == false)
            {
                header("location: ../index.php");
                die();
            }
        ?>
        <main>
            <a href="../index.php">Database</a>
            <h2>Klant bewerken</h2>
            <?php
                // this selects everything from klanten where the id is the same as $id
                $query = "SELECT * FROM klanten WHERE id = $id";

                // this starts the query and saves the information in $klanten
                $result = ExecuteSelectQuery($query);
                $klanten = $result[0];

                // creates an empty variable for later
                $melding = "";


                // this checks if you clicked on the bewerken button
                if(isset($_POST["bewerken"]))
                {
                    // this stores the information of every column in its own variable
                    $klantenId = $_POST["id"];
                    $klantenVoornaam = $_POST["voornaam"];
                    $klantenAchternaam = $_POST["achternaam"];
                    $klantenWoonplaats = $_POST["woonplaats"];
                    $klantenAdres = $_POST["adres"];
                    $klantenEmail = $_POST["email"];
                    $klantenTelefoonnummer = $_POST["telefoonnummer"];

                    // this query replaces the information with the information that is filled in in the input fields
                    $updateQuery = "UPDATE klanten SET id = $klantenId, voornaam = '$klantenVoornaam', achternaam = '$klantenAchternaam', woonplaats = '$klantenWoonplaats', adres = '$klantenAdres', email = '$klantenEmail', telefoonnummer = '$klantenTelefoonnummer' WHERE id = $id";

                    $rowsAffected = ExecuteQuery($updateQuery);

                    // this checks if there's at least 1 row affected
                    if($rowsAffected > 0)
                    {
                        // this refreshes the information of the klant
                        $query = "SELECT * FROM klanten WHERE id = $id";

                        $result = ExecuteSelectQuery($query);
                        $klanten = $result[0];

                        // gives $melding a new text
                        $melding = $klantenVoornaam . " " . $klantenAchternaam . " is succesvol aangepast";
                    }
                    else
                    {
                        // gives $melding a new text
                        $melding = "Er is iets misgegaan";
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
                    <!-- post sends the information to the background instead of the url -->
                    <form name="bewerken" action="bewerken.php?klantenId=<?php echo $id?>" method="POST">
                        <!-- readonly makes it so that you can't edit the field -->
                        <td><input readonly type="number" name="id" value="<?php echo $klanten["id"];?>"></td>
                        <td><input type="text" name="voornaam" value="<?php echo $klanten["voornaam"];?>"></td>
                        <td><input type="text" name="achternaam" value="<?php echo $klanten["achternaam"];?>"></td>
                        <td><input type="text" name="woonplaats" value="<?php echo $klanten["woonplaats"];?>"></td>
                        <td><input type="text" name="adres" value="<?php echo $klanten["adres"];?>"></td>
                        <td><input type="email" name="email" value="<?php echo $klanten["email"];?>"></td>
                        <td><input type="text" name="telefoonnummer" value="<?php echo $klanten["telefoonnummer"];?>"></td>
                        <td><input type="submit" name="bewerken" value="Bewerken"></td>
                    </form>
                </tr>
            </table>
            <?php
                // shows a text depending on if you've updated or not
                echo $melding;
            ?>
        </main>
    </body>
</html>
