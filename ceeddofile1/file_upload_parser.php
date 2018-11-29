<?php


    $fileName = $_FILES["file1"]["name"]; // The file name
    $fileTmpLoc = $_FILES["file1"]["tmp_name"]; // File in the PHP tmp folder
    $fileType = $_FILES["file1"]["type"]; // The type of file it is
    $fileSize = $_FILES["file1"]["size"]; // File size in bytes
    $fileErrorMsg = $_FILES["file1"]["error"]; // 0 for false... and 1 for true
    if (!$fileTmpLoc) { // if file not chosen
        echo "ERREUR: Choisir un fichier avant de cliquer sur le bouton envoyer";
        exit();
    }
    if(move_uploaded_file($fileTmpLoc, "upload/".$fileName)){
        echo "$fileName upload is complete";
    } else {
        echo "move_uploaded_file function failed";
    }
    
     

