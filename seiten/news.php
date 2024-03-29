<?php
require_once 'utils/dbaccess.php';
?>

<h1>News</h1>

<?php
// SQL-Abfrage, um alle News-Einträge abzurufen und nach dem Datum absteigend zu sortieren
$sql = "SELECT * FROM news ORDER BY newsdate DESC";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    // Weiterleitung zur Startseite mit Fehlermeldung, falls die SQL-Abfrage fehlschlägt
    header("location: index.php?page=landing&error=stmtfailed");
    exit();
}
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
if (mysqli_num_rows($result) > 0) {
    // Schleife, um durch alle News-Einträge zu iterieren
    while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <div style="margin-bottom: 100px;">
            <div class="d-grid gap-3 col-8 mx-auto">
                <div class="text-center">
                    <h2>
                        <?php echo $row['title']; ?>
                    </h2>
                </div>
                <?php ?>
                <div class="text-center">
                    <img src="<?php echo $row['thumbnail']; ?>" alt="Thumbnail" class="img-fluid"
                        style="max-width: 50%; height: auto;">
                </div>
                <p style="text-align: justify;">
                    <?php echo $row['newstext']; ?>
                </p>
                <h2>
                    <?php
                    // Formatierung des Hochladedatums im gewünschten Format
                    $newsdate = date("d.m.Y", strtotime($row["newsdate"]));
                    echo "Hochgeladen am " . $newsdate; ?>
                </h2>
            </div>
        </div>
        <?php
    }
} else {
    // Ausgabe einer Meldung, falls keine News-Einträge vorhanden sind
    echo "<h3 style='text-align:center;'>Keine News vorhanden</h3>";
}
?>