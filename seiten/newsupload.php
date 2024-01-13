<div class="container" style="margin-bottom: 100px;">
    <h1>
        News-Upload
    </h1>
    <?php //FIXME: Daten in Datenbank speichern ?>
    <form action="utils/upload.php" method="post" enctype="multipart/form-data">
        <div class="cointainer">
            <div class="d-grid gap-4 col-4 mx-auto">
                <div class="mb-3">
                    <label for="exampleFormControlText" class="form-label">
                        Newstitel:
                    </label>
                    <input type="text" class="form-control" name="title" placeholder="Newstitel" id="title" required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label"></label>
                    Newstext
                    </label>
                    <textarea class="form-control" id="text" rows="3" name="text"></textarea>
                    <br>Bild auswählen
                    <p><input type="file" name="fileToUpload" id="fileToUpload"></p>
                    <div class="d-grid gap-3 col-3 mx-auto"></div>
                    <input class="btn btn-primary" type="submit" value="Uploaden">
                </div>
            </div>
        </div>
    </form>
</div>