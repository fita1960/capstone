<?php 

require('connect.inc.php');
 
$targetDir = "../img/gallery/"; 
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if(!empty($_FILES["file"]["name"])){ 

        $image_name =  $_POST['image_name'];

        $fileName = basename($_FILES["file"]["name"]); 
        $targetFilePath = $targetDir . $fileName; 
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION); 
     
        // Allow certain file formats 
        $allowTypes = array('JPG','PNG','JPEG','GIF','WEBP','jpg','png','jpeg','gif','webp'); 
        
        if(in_array($fileType, $allowTypes)){ 
            // Upload file to server 
            if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){ 
                // Insert image file name into database 
                $sql = "INSERT into gallery (image_name, image_filename) VALUES ('$image_name', '$fileName')";
                if(mysqli_query($conn, $sql)){ 
                    header("Location: ../adm_gallery.php");
                }else{ 
                    header("Location: ../adm_gallery.php");
                }  
            }else{ 
                header("Location: ../adm_gallery.php");
            } 
        }else{ 
            header("Location: ../adm_gallery.php");
        } 
    }else{ 
        header("Location: ../adm_gallery.php");
    } 
} 
