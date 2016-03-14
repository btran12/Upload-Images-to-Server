<html>
<head>
<title>Upload Images to BaoVer</title>
</head>

<body>
    <form action="upload_images.php" method="post" enctype="multipart/form-data">
        <p>Select Image(s) to Upload:</p>
        <p><input type="file" name="images[]" multiple></p>
        <p><input type="submit" name="upload" value="Upload"></p>
    </form>
</body>


</html>


<?php
        if (isset($_FILES['images'])){ 
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
                for($i = 0; $i < count($image_tmp_name); $i++){
                    if (move_uploaded_file($image_tmp_name[$i], "photos/". $image_name[$i])){
                        echo $image_name[$i] . " uploaded successfully<br>";
                    }else{
                        echo "Unable to upload " . $image_name[$i] . "<br>";
                    }
                }
            }
            
        }

?>    
