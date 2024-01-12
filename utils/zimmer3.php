<?php
session_start();

$_SESSION['zimmer'] = 'Luxussuite mit Jacuzzi';

header("Location: ../index.php?page=reservierung");
exit();
?>