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
<?php
    echo "Ik ben $name, ik ben $age jaar oud en ik ben een $studentText";<br>

    $name = "Ren Jun";
    $age = 19;
    $isStudent = true;
    $hasLicence = false;

    if($isStudent == true)
    {
        $studentText = "Is student";
    }
    else
    {
        $studentText = "Is geen student";
    }
    echo $name . " is " . $age;



    if($age >= 18 && $hasLicence == true)
    {
        $driveText = "Ik mag autorijden";
    }
    elseif($age >= 18)
    {
        $driveText = "Ik ben wel 18 maar ik mag niet autorijden";
    }
    else
    {
        $driveText = "Ik mag niet autorijden";
    }

    echo $driveText;
?>

</body>
</html>
