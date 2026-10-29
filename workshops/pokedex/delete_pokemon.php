<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Delete pokemon</title>
    <link href="styles/style.css" rel="stylesheet">
</head>
<body>
    <h1>
        Pokemon deleten
    </h1>

    <?php

            $id = $_GET["pokemonId"];

            if (!isset($id))
            {
                header("location: index.php");
                die();
            }


            require "includes/db_functions.php";
            StartConnection("pokemondb");

            $query = "SELECT * FROM pokemon WHERE number = $id";

            $result = ExecuteSelectQuery($query);
            $pokemon = $result[0];

    ?>

    <form method="POST">
        <p>Weet je zeker dat je <?php echo $pokemon["name"];?> wilt verwijderen</p>
        <input type="submit" name="delete" value="Verwijderen">
        <input type="submit" name="terug" value="Nee, terug naar pokedex">
    </form>

    <?php
        if (isset($_POST["terug"]))
        {
            header("location: index.php");
            die();
        }

        if(isset($_POST["delete"]))
        {
            echo $deleteQuery = "DELETE FROM pokemon WHERE number = $id";
            $rowsAffected = ExecuteQuery($deleteQuery);

            if ($rowsAffected > 0)
            {
                header("location: index.php");
                die();
            }
            else
            {
                echo "Pokemon is niet verwijderd, porbeer het opnieuw";
            }
        }


    ?>
    <article class="deleteArticle">
        <img src="<?php echo $pokemon["picture"];?>" width="200">

        <h2><?php echo $pokemon["name"];?></h2>
    </article>



</body>
</html>

