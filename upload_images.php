<html>
<head>
<title>Upload Images to BaoVer</title>
</head>

<body>
    <form action="upload_images.php" method="post" enctype="multipart/form-data">
        <p>Select Image(s) to Upload:</p>
        <p><input type="file" name="images[]" multiple></p>
        <p><input type="submit" name="upload" value="Upload"></p>
        <progress value="0" max="100"></progress>
    </form>
</body>


</html>


<?php
    $available_space = floor(disk_free_space("/") / 1000000000);
    $total_space = floor(disk_total_space("/") / 1000000000);
    echo "Available Space: " . $available_space . " GB<br>";
    echo "Total Space: " . $total_space . " GB<br><hr>";
    $files_errors = "";

    if (isset($_FILES['images'])){ 
        $upload_size = 0;
        $image_name = $_FILES['images']['name'];
        $image_type = $_FILES['images']['type'];
        $image_size = $_FILES['images']['size'];
        $image_tmp_name = $_FILES['images']['tmp_name']; 
        $image_error = $_FILES['images']['error'];
        
        //Check if any files are selected
        if($image_name[0] == ''){
            echo "<script>alert('Select Images to Upload First')</script>";
            exit();
        }else{
            for($x = 0; $x < count($image_size); $x++){
                $upload_size += $image_size[$x];
            }

            //Check if theres enough space to store files; reserve 1 GB
            if ($upload_size > (disk_free_space("/") - 1000000000)){
                echo "Error: Not enough space";
            }

            echo "<b>Feedbacks:</b><br>";
            for($i = 0; $i < count($image_tmp_name); $i++){
                //Check that the uploaded files are images
                $iname = strtolower($image_name[$i]);
                if (endsWith($iname,".jpeg") || endsWith($iname,".jpg") || endsWith($iname, ".png")){
                    //Move the files to photos/ folder on the server
                    if (move_uploaded_file($image_tmp_name[$i], "photos/". $image_name[$i])){
                        echo $image_name[$i] . " uploaded successfully<br>";
                    }else{
                        echo "Unable to upload " . $image_name[$i] . "<br>";
                    }
                }else{
                    $files_errors .= $image_name[$i] . " | ";
                }
            }
            if ($files_errors != ""){
                echo "Did not upload files: " . $files_errors ;
            }    
    }
            
    }

    function startsWith($haystack, $needle){
        $length = strlen($needle);
        return (substr($haystack, 0, $length) === $needle);
    }

    function endsWith($haystack, $needle){
        $length = strlen($needle);
        if ($length == 0) {
            return true;
        }   

        return (substr($haystack, -$length) === $needle);
    }
?>    
