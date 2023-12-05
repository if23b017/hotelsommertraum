<?php
session_start();

$_SESSION['zimmer'] = 'Luxussuite';

header("Location: reservierung.php");
exit();
?>