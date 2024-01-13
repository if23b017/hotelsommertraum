<?php
session_start();

$_SESSION['zimmer'] = 'Luxussuite mit Jacuzzi und Sauna';

header("Location: reservierung.php");
exit();
?>