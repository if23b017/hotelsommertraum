<?php
session_start();

$_SESSION['zimmer'] = 'Doppelbettzimmer';

header("Location: reservierung.php");
exit();
?>