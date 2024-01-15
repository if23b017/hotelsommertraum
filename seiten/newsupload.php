<?php
require_once 'utils/dbaccess.php';
?>

<div class="container" style="margin-bottom: 100px;">
    <h1>
        News-Upload
    </h1>
    <form action="utils/upload.php" method="post" enctype="multipart/form-data">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12 mx-auto">
                    <div class="mb-3">
                        <label for="title" class="form-label">
                            Newstitel:
                        </label>
                        <input type="text" class="form-control" name="title" placeholder="Newstitel" id="title"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="newstext" class="form-label">
                            Newstext
                        </label>
                        <textarea class="form-control" id="newstext" rows="3" name="newstext" required></textarea>
                        <br>Bild auswählen
                        <p><input type="file" name="fileToUpload" id="fileToUpload" required></p>
                        <div class="d-grid gap-3 col-3 mx-auto"></div>
                        <input class="btn btn-primary" type="submit" value="Uploaden">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>