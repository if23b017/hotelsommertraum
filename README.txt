1.: XAMPP installieren und den entpackten Ordner in den htdocs Ordner in einen neuen weiteren Ordner namens "Hotel Sommertraum" entpacken
2.: XAMPP Control Panel starten und dann "Apache" und "MySQL" starten
3.: Bilderverkleinerung: Im XAMPP Control Panel auf Config und PHP (php.ini) klicken. In der Textdatei die Line ;extension=gd suchen und das Semicolon entfernen
4.: Datenbank: Im XAMPP Control Panel bei "MySQL" auf Admin und dann auf neu klicken und eine neue Datenbank namens hotel_db erstellen. 
Nun die neue Datenbank auf der linken Seite anklicken und bei importieren die inkludierte "hotel_db.sql" importieren.
5.: Zum Schluss oben auf Rechte klicken und ein Benutzerkonto mit dem Namen "admin", dem Hostnamen "localhost" und dem Passwort "" (Kein Passwort) erstellen.