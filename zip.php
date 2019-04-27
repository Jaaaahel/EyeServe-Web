<?php

$id = $_GET['secure_id'];

if (!$id) exit;

/* creates a compressed zip file */
function create_zip($files = array(),$destination = '',$overwrite = false) {
    global $id;
    //if the zip file already exists and overwrite is false, return false
    if(file_exists($destination) && !$overwrite) { return false; }
    //vars
    $valid_files = array();
    //if files were passed in...
    if(is_array($files)) {
        //cycle through each file
        foreach($files as $file) {
            //make sure the file exists
            if(file_exists($file)) {
                $valid_files[] = $file;
            }
        }
    }
    //if we have good files...
    if(count($valid_files)) {
        //create the archive
        $zip = new ZipArchive();
        if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
            return false;
        }
        //add the files
        foreach($valid_files as $file) {
            $fileName = substr($file, strrpos($file,'/') + 1);

            $zip->addFile($file, $id . '/' . $fileName);
        }
        //debug
        //echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;
        
        //close the zip -- done!
        $zip->close();
        
        //check to make sure the file exists
        return file_exists($destination);
    }
    
    return false;
}

$folder = "recordings/$id/";
$destination = tempnam(null, null);

$files = array_diff(scandir($folder), array('.', '..'));

$files = array_map(function ($file) use (&$folder) {
    return $folder . $file;
}, $files);

$result = create_zip($files, $destination, true);

if ($result) {
    header("Content-Description: File Transfer"); 
    header("Content-Type: application/octet-stream"); 
    header("Content-Disposition: attachment; filename='recordings.zip'"); 

    readfile($destination);
}
