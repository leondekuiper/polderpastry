<?php

require 'Controller/ImageController.php';

$title = "Upload new image";
$page = "imageupload";
        
$content = '<a href="itemoverview.php" class=message-small>back to Overview</a></br></br>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="file">Filename: </label>
    <input type="file" name="file" id="file" class="upload-button">
    <input type="submit" name="submit" value="upload"></br></br>
</form>';
if(isset($_POST["submit"]))
{
    $filetype = $_FILES["file"]["type"];

    if(($filetype == "image/gif") ||
       ($filetype == "image/jpg") ||
       ($filetype == "image/jpeg") ||
       ($filetype == "image/png"))
    {
        if(file_exists("Images/" . $_FILES["file"]["name"]))
        {
            echo "File already exists";
        }
        else
        {
            move_uploaded_file($_FILES["file"]["tmp name"], "Images/" . $_FILES["file"]["name"]);
            echo "File Uploaded";
        }
    }
}
include 'template_admin.php';
