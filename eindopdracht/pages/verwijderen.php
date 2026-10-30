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
        <title>Verwijderen</title>
    </head>
    <body class="m-2">
        <?php
            // this gets the klantenId from the url and saves it in $id
            $id = $_GET["klantenId"];

            // if there isn't an id, you automatically go back to index.php
            if (!isset($id))
            {
                header("location: ../index.php");
                die();
            }
        ?>
        <main>
            <h2>Klant verwijderen</h2>

            <?php
                // this selects everything from klanten where the id is the same as $id
                $query = "SELECT * FROM klanten WHERE id = $id";

                // this starts the query and saves the information in $klanten
                $result = ExecuteSelectQuery($query);
                $klanten = $result[0];
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
                </tr>
                <tr>
                    <!-- this shows the information of specific columns in different cells -->
                    <td><?php echo $klanten["id"];?></td>
                    <td><?php echo $klanten["voornaam"];?></td>
                    <td><?php echo $klanten["achternaam"];?></td>
                    <td><?php echo $klanten["woonplaats"];?></td>
                    <td><?php echo $klanten["adres"];?></td>
                    <td><?php echo $klanten["email"];?></td>
                    <td><?php echo $klanten["telefoonnummer"];?></td>
                </tr>
            </table>

            <!-- post sends the information to the background instead of the url -->
            <form method="POST">
                <!-- this get the information of specific columns and shows it in the text -->
                <p>Weet je zeker dat je <?php echo $klanten["voornaam"] . " " . $klanten["achternaam"]?> wilt verwijderen</p>
                <input type="submit" name="delete" value="Verwijderen">
                <input type="submit" name="terug" value="Nee, terug naar database">
            </form>

            <?php
                // this checks if you clicked the terug button
                if (isset($_POST["terug"]))
                {
                    header("location: ../index.php");
                    die();
                }

                // this checks if you clicked the delete button
                if(isset($_POST["delete"]))
                {
                    // this query deletes everything from the klant with the same id as $id
                    $deleteQuery = "DELETE FROM klanten WHERE id = $id";
                    $rowsAffected = ExecuteQuery($deleteQuery);

                    // this checks if there's at least 1 row affected
                    if ($rowsAffected > 0)
                    {
                        // this saves the text in the variable $_SESSION["melding"]
                        $_SESSION["melding"] = $klanten["voornaam"] . " " . $klanten["achternaam"] . " is succesvol verwijderd!";

                        header("location: ../index.php");
                        die();
                    }
                    else
                    {
                        echo $klanten["voornaam"] . " " . $klanten["achternaam"] . " is niet verwijderd, probeer het opnieuw";
                    }
                }
            ?>
        </main>
    </body>
</html>