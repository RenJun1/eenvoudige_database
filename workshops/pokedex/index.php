<?php
/*
 * Author: Ren Jun Huang
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
    <?php
        session_start();
        include "includes/db_functions.php";
        StartConnection("pokemondb");
    ?>
        <header>
            <h1>Overzicht Pokemons</h1>
        </header>
        <main>
            <button>
                <a href="toevoegen_pokemon.php">Voeg nieuwe pokemon toe</a>
            </button>
            <fieldset>
                <legend>
                    Filter
                </legend>
                <form method="get">
                    <p>
                        <label>Naam</label>
                        <input type="text" name="naam">
                    </p>
                    <p>
                        <label>Type 1</label>
                        <select name="type1">
                            <option>All</option>
                            <?php
                                $queryType1 = 'SELECT DISTINCT type1 FROM pokemon';
                                $resultType1 = ExecuteSelectQuery($queryType1);
                                foreach ($resultType1 as $type1)
                                {
                                    echo "<option>".$type1['type1']."</option>";
                                }
                            ?>
                        </select>
                    </p>
                    <p>
                        <label>Zoeken</label>
                        <input type="submit" value="Zoeken">
                    </p>
                </form>
            </fieldset>

            <!-- Alle pokemons worden hier
            ingeladen -->
            <?php


                $query = "SELECT * FROM pokemon";
                if(isset($_GET["naam"]))
                {
                    $search = $_GET["naam"];
                    if($search != "")
                    {
                        echo "U heeft gezocht op: $search <br>";
                    }
                }
                else
                {
                    $search = "";
                }


                if(isset($_GET["type1"]) && $_GET["type1"] != "All")
                {
                    $inputType1 = $_GET["type1"];
                    $query = "SELECT * FROM pokemon WHERE type1 = '$inputType1'";
                    echo "U heeft gezocht op: $inputType1";
                }
                else
                {
                    $query = "SELECT * FROM pokemon WHERE name LIKE '%$search%'";
                }
                //Verbinden met de database pokemon


                echo "<section>";


                $results = ExecuteSelectQuery($query);


                //var_dump($results);

                foreach($results as $pokemon)
                {
                    echo "<article>";
                        $pokemonName = $pokemon["name"];
                        $pokemonImage = $pokemon["picture"];
                        $pokemonId = $pokemon["number"];
                        echo "<img src='$pokemonImage' alt=''>";
                        echo "<h2>$pokemonName</h2>";
                        echo "<a href='updaten_pokemon.php?pokemonId=$pokemonId'>Bewerk</a>";

                    echo "</article>";
                }

            ?>
            </section>
        </main>
    </body>
</html>


