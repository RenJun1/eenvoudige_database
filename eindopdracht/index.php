<?php
    session_start();
    include "includes/db_functions.php";
    StartConnection("eindopdracht");
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Database</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <link href="styles/style.css" rel="stylesheet">
    </head>
    <body class="d-flex flex-column m-2">
        <section class="d-flex justify-content-between m-1">
            <div>
                <form method="get">
                    <p>
                        <label>Voornaam</label>
                        <input type="text" name="voornaam">
                    </p>
                    <p>
                        <label>Achternaam</label>
                        <input type="text" name="achternaam">
                    </p>
                    <p>
                        <label>Woonplaats</label>
                        <input type="text" name="woonplaats">
                    </p>
                    <p>
                        <input type="submit" value="Zoeken">
                    </p>
                </form>

                <?php
                    $query = 'SELECT * FROM klanten';

                    if(isset($_GET["voornaam"]) || isset($_GET["achternaam"]) || isset($_GET["woonplaats"]))
                    {
                        $searchVoornaam = $_GET["voornaam"];
                        $searchAchternaam = $_GET["achternaam"];
                        $searchWoonplaats = $_GET["woonplaats"];
                        if($searchVoornaam != "" || $searchAchternaam != "" || $searchWoonplaats != "")
                        {
                            echo "U heeft gezocht op: $searchVoornaam $searchAchternaam $searchWoonplaats<br>";
                        }
                    }
                    else
                    {
                        $searchVoornaam = "";
                        $searchAchternaam = "";
                        $searchWoonplaats = "";
                    }

                    $query = "SELECT * FROM klanten WHERE voornaam LIKE '%$searchVoornaam%' AND achternaam LIKE '%$searchAchternaam%' AND woonplaats LIKE '%$searchWoonplaats%'";
                ?>
            </div>
            <div>
                <?php
                    if(isset($_SESSION["melding"]))
                    {
                        echo $_SESSION["melding"];
                        unset($_SESSION["melding"]);
                    }
                ?>
            </div>
            <div>
                <?php
                    if($_SESSION['login'] == true)
                    {
                        echo '<a href="pages/toevoegen.php" class="align-self-start">toevoegen</a>';
                    }
                ?>
                <a href="pages/session.php" class="align-self-start">Log in</a>
            </div>
        </section>

        <article>
            <table class="table table-bordered">
                <tr>
                    <th>Id</th>
                    <th>Voornaam</th>
                    <th>Achternaam</th>
                    <th>Woonplaats</th>
                    <?php
                        if($_SESSION['login'] == true)
                        {
                            echo "<th>Adres</th>";
                            echo "<th>Email</th>";
                            echo "<th>Telefoonnummer</th>";
                            echo "<th>Aanpassen</th>";
                        }
                    ?>
                </tr>
                <?php

                    $results = executeSelectQuery($query);

                    foreach($results as $klanten)
                    {
                        $klantenId = $klanten["id"];
                        $klantenVoornaam = $klanten["voornaam"];
                        $klantenAchternaam = $klanten["achternaam"];
                        $klantenWoonplaats = $klanten["woonplaats"];
                        $klantenAdres = $klanten["adres"];
                        $klantenEmail = $klanten["email"];
                        $klantenTelefoonnummer = $klanten["telefoonnummer"];

                        if($_SESSION['login'] == true)
                        {
                            echo "<tr>";
                            echo "<td>$klantenId</td>";
                            echo "<td>$klantenVoornaam</td>";
                            echo "<td>$klantenAchternaam</td>";
                            echo "<td>$klantenWoonplaats</td>";
                            echo "<td>$klantenAdres</td>";
                            echo "<td>$klantenEmail</td>";
                            echo "<td>$klantenTelefoonnummer</td>";
                            echo "<td>
                                      <a href='pages/bewerken.php?klantenId=$klantenId'>Bewerk</a>
                                      <a href='pages/verwijderen.php?klantenId=$klantenId'>Verwijder</a>
                                  </td>";
                            echo "</tr>";
                        }
                        else
                        {
                            echo "<tr>";
                            echo "<td>$klantenId</td>";
                            echo "<td>$klantenVoornaam</td>";
                            echo "<td>$klantenAchternaam</td>";
                            echo "<td>$klantenWoonplaats</td>";
                            echo "<tr>";
                        }

                    }
                ?>

            </table>
        </article>

    </body>
</html>