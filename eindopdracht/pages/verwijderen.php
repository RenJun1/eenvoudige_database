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
        <title>Verwijderen</title>
    </head>
    <body class="m-2">
        <?php
            $id = $_GET["klantenId"];

            if (!isset($id))
            {
                header("location: ../index.php");
                die();
            }
        ?>
        <main>
            <a href="../index.php">Database</a>
            <h2>Klant verwijderen</h2>

            <?php
                $id = $_GET["klantenId"];

                $query = "SELECT * FROM klanten WHERE id = $id";

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
                    <td><?php echo $klanten["id"];?></td>
                    <td><?php echo $klanten["voornaam"];?></td>
                    <td><?php echo $klanten["achternaam"];?></td>
                    <td><?php echo $klanten["woonplaats"];?></td>
                    <td><?php echo $klanten["adres"];?></td>
                    <td><?php echo $klanten["email"];?></td>
                    <td><?php echo $klanten["telefoonnummer"];?></td>
                </tr>
            </table>

            <form method="POST">
                <p>Weet je zeker dat je <?php echo $klanten["voornaam"]," ",$klanten["achternaam"];?> wilt verwijderen</p>
                <input type="submit" name="delete" value="Verwijderen">
                <input type="submit" name="terug" value="Nee, terug naar database">
            </form>

            <?php
                if (isset($_POST["terug"]))
                {
                    header("location: ../index.php");
                    die();
                }

                if(isset($_POST["delete"]))
                {
                    $deleteQuery = "DELETE FROM klanten WHERE id = $id";
                    $rowsAffected = ExecuteQuery($deleteQuery);

                    if ($rowsAffected > 0)
                    {
                        $_SESSION["melding"] = "".$klanten["voornaam"]." ".$klanten["achternaam"]." is succesvol verwijderd!";

                        header("location: ../index.php");
                        die();
                    }
                    else
                    {
                        echo "".$klanten["voornaam"]." ".$klanten["achternaam"]." is niet verwijderd, porbeer het opnieuw";
                    }
                }
            ?>
        </main>
    </body>
</html>