<?php

session_start();
if(isset($_SESSION['login']) && $_SESSION['login'] == true)
{
    echo 'je bent succesvol ingelogd';
}
else
{
    echo 'eerst inloggen aub';
}

