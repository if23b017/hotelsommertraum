<?php
session_start();

$_SESSION['zimmer'] = 'Luxussuite mit Jacuzzi';

header("Location: reservierung.php");
exit();
?>