<?php

    // Increase upload file size and execution time limits
    ini_set('upload_max_filesize', '10M');  // Allow up to 10MB file size
    ini_set('post_max_size', '12M');        // Allow up to 12MB POST size
    ini_set('max_execution_time', '300');   // Allow longer script execution time

    // Establish DB connection
    $con = mysqli_connect("localhost:4306", "root", "", "webbbbbb");

    if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Get form data
        $car_name = mysqli_real_escape_string($con, $_POST['car-name']);
        $color = mysqli_real_escape_string($con, $_POST['car-color']);
        $model_year = mysqli_real_escape_string($con, $_POST['model-year']);
        $price = mysqli_real_escape_string($con, $_POST['price']);
        $stock = mysqli_real_escape_string($con, $_POST['no-of-stocks']);

        // File upload path
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["car-photo"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a valid image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["car-photo"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

        // Ensure the file name is unique by adding a timestamp or unique string
        if (file_exists($target_file)) {
            $target_file = $target_dir . uniqid() . "." . $imageFileType;  // Generate unique file name
        }

        // Check file size (limit to 10MB)
        if ($_FILES["car-photo"]["size"] > 10000000) {  // 10MB = 10,000,000 bytes
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            echo "Sorry, only JPG, JPEG, and PNG files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            // If everything is ok, try to upload the file
            if (move_uploaded_file($_FILES["car-photo"]["tmp_name"], $target_file)) {
                // Prepare SQL query
                $sql = "INSERT INTO cars (car_name, color, model_year, price, stock, car_photo) 
                        VALUES ('$car_name', '$color', '$model_year', '$price', '$stock', '$target_file')";

                if ($con->query($sql) === TRUE) {
                    header('location:admin.php');
                } else {
                    echo "Error: " . $sql . "<br>" . $con->error;
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    // Close connection
    $con->close();
?>
