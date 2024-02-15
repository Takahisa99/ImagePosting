<?php

include('./dbConfig.php');

$targetDirectory = 'images/';
$imageId = $_GET['id'];

if(!empty($imageId)) {
    $sql = "SELECT file_name FROM imagePosting WHERE id = " . $imageId;

    $sth = $db->prepare($sql);
    $sth->execute();
    $getImageName = $sth->fetch();

    $deleteImage = unlink($targetDirectory . $getImageName['file_name']);

    if($deleteImage) {
        $deleteRecord = $db->query("DELETE FROM imagePosting WHERE id = " . $imageId);

        if($deleteRecord) {
            header('Location:' . './html/index.php', true, 303);
            exit();
        }
    }
}