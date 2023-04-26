<?php
function file_upload($photo, $source = "USER")
{
    $result = new stdClass(); //this object will carry status from file upload
    
    if (isset($_SESSION['ADMIN'])) {
        $result->fileName = 'admavatar.png';
    } else {
        $result->fileName = 'avatar.png';
    }
    $result->error = 1; //it could also be a boolean true/false
    //collect data from object $photo
    $fileName = $photo["name"];
    $fileType = $photo["type"];
    $fileTmpName = $photo["tmp_name"];
    $fileError = $photo["error"];
    $fileSize = $photo["size"];
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $filesAllowed = ["png", "jpg", "jpeg"];
    if ($fileError == 4) {
        $result->ErrorMessage = "No photo was chosen. You can add it later.";
        return $result;
    } else {
        if (in_array($fileExtension, $filesAllowed)) {
            if ($fileError === 0) {
                if ($fileSize < 500000) { //500kb this number is in bytes
                    //it gives a file name based microseconds
                    $fileNewName = uniqid('') . "." . $fileExtension; // 1233343434.jpg i.e
                    $destination = "images/$fileNewName";
                    if (move_uploaded_file($fileTmpName, $destination)) {
                        $result->error = 0;
                        $result->fileName = $fileNewName;
                        return $result;
                    } else {    
                        $result->ErrorMessage = "There was an error uploading this file.";
                        return $result;
                    }
                } else {                                      
                    $result->ErrorMessage = "This photo is bigger than the allowed 500Kb. <br> Please choose a smaller one and update the product.";
                    return $result;
                }
            } else {                              
                $result->ErrorMessage = "There was an error uploading - $fileError code. Check the PHP documentation.";
                return $result;
            }
        } else {                      
            $result->ErrorMessage = "This file type can't be uploaded.";
            return $result;
        }
    }
}