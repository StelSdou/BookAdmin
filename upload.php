<?php
include_once ("connection.php");
if ($_POST["submit"]){

    $pdf_file = $_FILES['inpPdf'];
    
    $upload_dir = 'C:/xampp/htdocs/BookAdmin/uploads/';
    $upload_file = $upload_dir . basename($pdf_file['name']);
    if (!move_uploaded_file($pdf_file['tmp_name'], $upload_file)) { 
        die("Possible file upload attack!");
    }
    echo $upload_file;

    try {
        $imagick = new Imagick();

        $imagick->readImage($upload_file);

        foreach ($imagick as $i => $page) {
            $page->setImageFormat('jpg');
            $imageBlob = $page->getImageBlob();
            
            $stmt = $conn->prepare("INSERT INTO october (NAME, yearD, num, image) VALUES (?, ?, ?, ?)");
            // $stmt->bind_param("ib", $i, $imageBlob);
            $stmt->bind_param("ssib", $_POST['name'], $_POST['Year'], $i, $imageBlob);
            $stmt->send_long_data(3, $imageBlob);
            $stmt->execute();
        }    
    } catch (Exception $e) {
        echo 'Caught exception: <br>',  $e->getMessage(), "\n";
    }
}