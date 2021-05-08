<?php
if (isset($_POST['upload'])) { //if the submit button is clicked

    // create variables representing certain properties of the files.
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileType = $_FILES['file']['type'];
    $fileError = $_FILES['file']['error'];








    $fileExt = explode('.', $fileName); //This will break all the file name seperated by ".".
    $fileActualExt = strtolower(end($fileExt)); //This will call the last item of the array, which is the extension. e.g.: "jpg".

    $allowed = array('jpg', 'jpeg', 'png'); //These are allowed image extensions. In order to make it all case in-sensitive, hereby create the following statment:
    // the statement works as a validator for all the files uploaded.


    if (in_array($fileActualExt, $allowed)) { //only jpg,jpeg,png(case-insensitive)are allowed to be the extesion.
        if ($fileError === 0) { //
            if ($fileSize < 5000000) { //file can not be bigger than 500MB.
                // In this case we wont overwrite the picture due to the same name.
                $fileNameNew = uniqid('', true) . "." . $fileActualExt; //example: 60603f8f71a780.30525573.jpg
                $fileDestination = 'imgs/' . $fileNameNew; //e.g.: uploads/60603f8f71a780.30525573.jpg
                move_uploaded_file($fileTmpName, $fileDestination); //move the file from the temp to the images folder.
                echo 1;
            } else {
                echo "Error: File too big!";
            }
        } else {
            echo "Error: there was an error uploading your file.";
        }
    } else {
        echo 2;
        // if the program does not echo 1 or other Strings that contains "Error",
        // Then the javascript will tell the user that the file is invalid or empty.
    }
}
