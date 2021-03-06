<?php
 // Requires PhpSpreadsheet https://github.com/PHPOffice/PhpSpreadsheet
$root = realpath($_SERVER["DOCUMENT_ROOT"]);

require $root . '/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$target_dir = $root . "/uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


// Allow certain file formats
if ($imageFileType != "xlsx") {
    echo "Sorry, only XLSX files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        // Read spreadsheet
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load($target_file);

        echo 'Spreadsheet: ' . $spreadsheet;
        // WORK ON ECHOING THE CONTENTS OF THE UPLOADED SPREADSHEET.

        echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
        // header('Location: '.'../upload_success.html');
        // die();
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
 