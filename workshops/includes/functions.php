<?php

function showName($lastName)
{
    echo "Mijn naam in Ren Jun $lastName.<br>";
}

function calculateMonths($month, $total)
{
    $totalMonths = $total / $month;
    $savedMoney = 0;
    $countMonths = 0;

    while($savedMoney < $total)
    {
        $savedMoney = $savedMoney + $month;
        $countMonths++;

        echo "na $countMonths maanden is mijn spaarbedrag $savedMoney. <br>";
    }

    echo "Ik ben $totalMonths maanden bezig dit bedrag te betalen.";
}
