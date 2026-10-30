<?php
    // this starts the session
    session_start();
    // this loads in db_dfunctions.php, it stops loading the rest of the page if it doesn't exist
    require "includes/db_functions.php";
    // this starts the connection with the database
    StartConnection("eindopdracht");
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Database</title>
        <!-- links with bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <link href="styles/style.css" rel="stylesheet">
    </head>
    <body class="d-flex flex-column m-2">
        <section class="d-flex justify-content-between m-1">
            <div>
                <!-- get causes the form answers to go into the url -->
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
                    // this selects everything in the table 'klanten' and stores it in $query
                    $query = 'SELECT * FROM klanten';

                    // this checks if any of the 3 inputs are in the url
                    if(isset($_GET["voornaam"]) || isset($_GET["achternaam"]) || isset($_GET["woonplaats"]))
                    {
                        // this stores the inputs in different variables
                        $searchVoornaam = $_GET["voornaam"];
                        $searchAchternaam = $_GET["achternaam"];
                        $searchWoonplaats = $_GET["woonplaats"];
                        // this checks if the inputs aren't empty
                        if($searchVoornaam != "" || $searchAchternaam != "" || $searchWoonplaats != "")
                        {
                            echo "U heeft gezocht op: $searchVoornaam $searchAchternaam $searchWoonplaats<br>";
                        }
                    }
                    else
                    {
                        // this ensures that the variables are empty if they aren't in the url
                        $searchVoornaam = "";
                        $searchAchternaam = "";
                        $searchWoonplaats = "";
                    }

                    /* this selects everything from klanten where the voornaam contains the text in $searchVoornaam, the same goes for achternaam and woonplaats
                    if there are multiple inputs, the query will only get klanten where the information corresponds with all the inputs
                    % means that anything can come before/after it */
                    $query = "SELECT * FROM klanten WHERE voornaam LIKE '%$searchVoornaam%' AND achternaam LIKE '%$searchAchternaam%' AND woonplaats LIKE '%$searchWoonplaats%'";
                ?>
            </div>
            <div>
                <?php
                    // this checks if $_SESSION["melding"] exists
                    if(isset($_SESSION["melding"]))
                    {
                        echo $_SESSION["melding"];
                        // unset deletes the variable
                        unset($_SESSION["melding"]);
                    }
                ?>
            </div>
            <div>
                <?php
                    // this checks if you are logged in so it only shows the button when you're logged in
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
                        // this is so that you only see personal information if you're logged in
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

                    // this actually starts the query and stores the information in $results
                    $results = executeSelectQuery($query);

                    // this loops for each result of the query
                    foreach($results as $klanten)
                    {
                        // this gives every column its own id
                        $klantenId = $klanten["id"];
                        $klantenVoornaam = $klanten["voornaam"];
                        $klantenAchternaam = $klanten["achternaam"];
                        $klantenWoonplaats = $klanten["woonplaats"];
                        $klantenAdres = $klanten["adres"];
                        $klantenEmail = $klanten["email"];
                        $klantenTelefoonnummer = $klanten["telefoonnummer"];

                        // this is the table you see if you're logged in
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
                        // this is the table you see if you aren't logged in
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