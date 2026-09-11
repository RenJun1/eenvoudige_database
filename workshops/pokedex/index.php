<?php
/*
 * Author: Remco Evers
 * Date: 7-9-26
 * Homepage Pokedex
 */

?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Pokedex</title>
        <link href="styles/style.css" rel="stylesheet">
    </head>
    <body>
        <header>
            <h1>Overzicht Pokemons</h1>
        </header>
        <main>
            <fieldset>
                <legend>
                    Filter
                </legend>
                <form method="get">
                    <label>Naam</label>
                    <input type="text" name="naam">
                </form>
                <form method="get">
                    <label>Type 1</label>
                    <input type="text" name="type1">
                </form>
                <form>
                    <label>Zoeken</label>
                    <input type="submit" value="Zoeken">
                </form>
            </fieldset>

            <!-- Alle pokemons worden hier ingeladen -->
            <?php
                include "includes/db_functions.php";

                $query = "SELECT * FROM pokemon";
                if(isset($_GET["naam"]))
                {
                    $search = $_GET["naam"];
                    $query = "SELECT * FROM pokemon WHERE name LIKE '%$search%'";
                    if($search != "")
                    {
                        echo "U heeft gezocht op: $search";
                    }
                }
                else
                {
                    $search = "";
                }

                if(isset($_GET["type1"]))
                {
                    $search = $_GET["type1"];
                    $query = "SELECT * FROM pokemon WHERE type1 LIKE '%$search%'";
                    if($search != "")
                    {
                        echo "U heeft gezocht op: $search";
                    }
                }

                //Verbinden met de database pokemon
                StartConnection("pokemondb");

                echo "<section>";

                if(isset($_GET[""]))
                {

                }


                $results = ExecuteSelectQuery($query);


                //var_dump($results);

                foreach($results as $pokemon)
                {
                    echo "<article>";
                        $pokemonName = $pokemon["name"];
                        $pokemonImage = $pokemon["picture"];
                        echo "<img src='$pokemonImage' alt=''>";
                        echo "<h2>$pokemonName</h2>";

                    echo "</article>";
                }










            ?>
            </section>
        </main>

    </body>
</html>


