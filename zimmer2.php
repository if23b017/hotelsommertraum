<?php
session_start();

$_SESSION['zimmer'] = 'Doppelsuite';

header("Location: reservierung.php");
exit();
?>