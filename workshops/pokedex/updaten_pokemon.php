<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update pokemon</title>
    <link href="styles/style.css" rel="stylesheet">
</head>
<body>
    <button>
        <a href="index.php">Ga terug naar pokedex</a>
    </button>
    <h1>
        Pokemon updaten
    </h1>
    <?php
    $id = $_GET["pokemonId"];

    if (!isset($id)) {
        header("location: index.php");
        die();
    }


    require "includes/db_functions.php";
    StartConnection("pokemondb");
    $query = "SELECT * FROM pokemon WHERE number = $id";

    $result = ExecuteSelectQuery($query);
    $pokemon = $result[0];


    if(isset($_POST["update"]))
    {
        $pokemonName = $_POST["name"];
        $pokemonNumber = $_POST["number"];
        $pokemonType1 = $_POST["type1"];
        $pokemonType2 = $_POST["type2"];
        $pokemonAbility = $_POST["ability"];
        $pokemonSpecies = $_POST["species"];
        $pokemonPicture = $_POST["picture"];

        echo $updateQuery = "UPDATE pokemon SET name = '$pokemonName', number = '$pokemonNumber', type1 = '$pokemonType1', type2 = '$pokemonType2', ability = '$pokemonAbility', species = '$pokemonSpecies', picture = '$pokemonPicture' WHERE number = $id";

        $rowsAffected = ExecuteQuery($updateQuery);

        if($rowsAffected >0)
        {
            echo $pokemonName . " is succesvol aangepast";
        }
        else
        {
            echo "Er is iets misgegaan";
        }
    }
    ?>
    <img src="<?php echo $pokemon["picture"];?>" width="200">

    <fieldset>
        <legend>Pokemon updaten</legend>
        <form name="update_pokemon" action="updaten_pokemon.php?pokemonId=<?php echo $id?>" method="POST">
            <p>
                <label>Name</label>
                <input type="text" name="name" value="<?php echo $pokemon["name"];?>">
            </p>
            <p>
                <label>Number</label>
                <input type="number" readonly name="number" value="<?php echo $pokemon["number"];?>">
            </p>
            <p>
                <label>Type1</label>
                <select name="type1" value="<?php echo $pokemon["type1"];?>">
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
                <label>Type2</label>
                <select name="type2" value="<?php echo $pokemon["type2"];?>">
                    <?php
                    $queryType2 = 'SELECT DISTINCT type2 FROM pokemon';
                    $resultType2 = ExecuteSelectQuery($queryType2);
                    foreach ($resultType2 as $type2)
                    {
                        echo "<option>".$type2['type2']."</option>";
                    }
                    ?>
                </select>
            </p>
            <p>
                <label>Ability</label>
                <input type="text" name="ability" value="<?php echo $pokemon["ability"];?>">
            </p>
            <p>
                <label>Species</label>
                <input type="text" name="species" value="<?php echo $pokemon["species"];?>">
            </p>
            <p>
                <label>Picture</label>
                <input type="text" name="picture" value="<?php echo $pokemon["picture"];?>">
            </p>
            <input type="submit" name="update" value="Updaten">
        </form>
    </fieldset>

</body>
</html>
