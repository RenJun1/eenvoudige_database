<?php

session_start();

$_SESSION['login'] = false;
$_SESSION['name'] = 'Ren Jun';

echo $_SESSION['name'];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <main>
        <form actiom="session.php" method="post">
            <p>
                <label>username</label>
                <input type="text" name="username">
            </p>
            <p>
                <label>password</label>
                <input type="password" name="password">
            </p>
            <input type="submit" value="login" name="submit">
        </form>
    </main>
</body>
</html>
<?php
if(isset($_POST['submit']))
{
    $inputUsername = $_POST['username'];
    $inputPassword = $_POST['password'];

    if($inputUsername == "Jan" && $inputPassword == "1234")
    {
        echo 'je bent succesvol ingelogd';
        $_SESSION['login'] = true;
    }
    else
    {
        echo 'probeer opnieuw';
    }
}
