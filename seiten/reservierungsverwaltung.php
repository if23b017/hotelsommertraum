<?php

if ($_SESSION['role'] !== 'admin') {
    header("location: index.php?page=landing&error=notAdmin");
    exit();
}

require_once "utils/dbaccess.php";

//TODO: Datenbank Tabelle reservations erstellen
$sql = "SELECT * FROM reservations;";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: index.php?page=landing&error=stmtfailed");
    exit();
    /* Fehlermeldung */
}


/* Überprüfung ob zumindest eine Reservierung in der Datenbank ist */

$sql = "SELECT COUNT(*) FROM reservations";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

if ($row[0] > 0) {

}

/* alle Reservierungen ausgeben mithilfe einer while Schleife ausgeben */

//TODO: Reservierung updaten

$sql = "UPDATE reservations SET /* room = ?, arrivalDate = ?, ... */ WHERE reservationId = ?";

//TODO: Filter mithilfe eines weiteren Formulars und verschiedenen SELECT-Statements einbauen