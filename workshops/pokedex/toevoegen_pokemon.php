<?php
    session_start();
    require "includes/db_functions.php";
    StartConnection("pokemondb");
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pokemon toevoegen</title>
    <link href="styles/style.css" rel="stylesheet">
</head>
<body>
    <button>
        <a href="index.php">Ga terug naar pokedex</a>
    </button>
    <h1>pokemon toevoegen</h1>
    <fieldset>
        <form name="add_pokemon" action="toevoegen_pokemon.php" method="POST">
            <p>
                <label>Name</label>
                <input type="text" name="name">
            </p>
            <p>
                <label>Number</label>
                <input type="number" name="number">
            </p>
            <p>
                <label>Type1</label>
                <select name="type1">
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
                <select name="type2">
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
                <input type="text" name="ability">
            </p>
            <p>
                <label>Species</label>
                <input type="text" name="species">
            </p>
            <p>
                <label>Picture</label>
                <input type="text" name="picture">
            </p>
            <input type="submit" name="add" value="toevoegen">
        </form>
    </fieldset>
</body>
</html>

<?php
if(isset($_POST["add"]))
{
    $pokemonName = $_POST["name"];
    $pokemonNumber = $_POST["number"];
    $pokemonType1 = $_POST["type1"];
    $pokemonType2 = $_POST["type2"];
    $pokemonAbility = $_POST["ability"];
    $pokemonSpecies = $_POST["species"];
    $pokemonPicture = $_POST["picture"];

    $query = "INSERT INTO pokemon VALUE ('$pokemonName', $pokemonNumber, '$pokemonType1', '$pokemonType2', '$pokemonAbility', '$pokemonSpecies', '$pokemonPicture')";

    $rowsAffected = ExecuteQuery($query);

    if($rowsAffected > 0)
    {
        echo "Pokemon is succesvol toegevoegd.";
    }
    else
    {
        echo "Pokemon is niet toegevoegd, probeer het opnieuw.";
    }



}
