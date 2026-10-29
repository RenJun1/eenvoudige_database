<?php

session_start();
require "../includes/db_functions.php";
StartConnection("eindopdracht");

$_SESSION['login'] = false;

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <link href="../styles/style.css" rel="stylesheet">
        <title>Login</title>
    </head>
    <body class="m-2">
        <main>
            <a href="../index.php">Database</a>

            <form method="post">
                <p>
                    <label>Gebruikersnaam</label>
                    <input type="text" name="username">
                </p>
                <p>
                    <label>Wachtwoord</label>
                    <input type="password" name="password">
                </p>
                <input type="submit" value="login" name="submit">
            </form>

            <?php
            if (isset($_POST['submit']))
            {
                $inputUsername = $_POST['username'];
                $inputPassword = $_POST['password'];

                $query = "SELECT * FROM gebruikers WHERE gebruikersnaam = '$inputUsername' AND wachtwoord = '$inputPassword'";
                $result = ExecuteSelectQuery($query);

                if(count($result) > 0)
                {
                    $_SESSION['login'] = true;
                    echo "Je bent ingelogt";
                }
                else
                {
                    echo "Je bent niet ingelogt";
                }
            }
            ?>
        </main>
    </body>
</html>