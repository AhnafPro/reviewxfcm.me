<?php
session_start(); // Start the session to track submission times

// Set the cooldown time to 1 hour (3600 seconds)
$cooldown = 1800; // 1 hour cooldown

// Check if the user has submitted a form recently
if (isset($_SESSION['last_submission_time'])) {
    $lastSubmission = $_SESSION['last_submission_time'];
    $timeSinceLastSubmission = time() - $lastSubmission;

    // Check if the cooldown has passed
    if ($timeSinceLastSubmission < $cooldown) {
        $waitTime = $cooldown - $timeSinceLastSubmission;
        $minutes = floor($waitTime / 60);
        $seconds = $waitTime % 60;
        echo "You must wait $minutes minutes and $seconds seconds before submitting again.";
        exit();
    }
}

// Process form if the cooldown has passed
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    // Handle image upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Allow only jpg, jpeg, png file types
    $allowed_file_types = ['jpg', 'jpeg', 'png'];
    if (!in_array($imageFileType, $allowed_file_types)) {
        echo "Only JPG, JPEG, and PNG files are allowed.";
        exit();
    }

    // Check if the file is an image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        // Resize image
        $max_width = 800;  
        $max_height = 800;

        list($width, $height) = getimagesize($_FILES["image"]["tmp_name"]);

        // Calculate new dimensions while maintaining aspect ratio
        $ratio = $width / $height;
        if ($max_width / $max_height > $ratio) {
            $new_width = $max_height * $ratio;
            $new_height = $max_height;
        } else {
            $new_height = $max_width / $ratio;
            $new_width = $max_width;
        }

        // Create a new image from the uploaded file
        $src = imagecreatefromstring(file_get_contents($_FILES["image"]["tmp_name"]));
        $dst = imagecreatetruecolor($new_width, $new_height);

        // Resample the image
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

        // Save the resized image in the appropriate format
        if ($imageFileType == 'jpg' || $imageFileType == 'jpeg') {
            imagejpeg($dst, $target_file);
        } elseif ($imageFileType == 'png') {
            imagepng($dst, $target_file);
        }

        // Free up memory
        imagedestroy($src);
        imagedestroy($dst);

        // Append review data to a CSV file
        $file = fopen('php/reviews.csv', 'a');
        fputcsv($file, [$name, $title, $description, $target_file]);
        fclose($file);

        // Set the last submission time
        $_SESSION['last_submission_time'] = time();

        // Redirect to index.php
        header("Location: index.php");
        exit();
    } else {
        echo "File is not an image.";
    }
}
?>
