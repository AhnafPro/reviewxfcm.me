<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews</title>
    <link rel="icon" href="assets/X-logo.png">
    <link rel="stylesheet" href="css/styles.css">
<link rel="preconnect" href="https://fonts.googleapis.com">

<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">

    <style>

        @import url('https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap');

        </style>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

        <link rel="preconnect" href="https://fonts.googleapis.com">

        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

<link rel="stylesheet" href="style.css">
<style>
/* Custom scrollbar for the scrollable area */
::-webkit-scrollbar {
    width: 8px; /* Width of the scrollbar */
}

::-webkit-scrollbar-track {
    background-color: #222222; /* Lighter than page background */
    border-radius: 10px; /* Rounded corners for the scrollbar track */
}

::-webkit-scrollbar-thumb {
    background-color: #36f387; /* Same color as box shadow */
    border-radius: 10px; /* Rounded corners for the scrollbar thumb */
    box-shadow: 0 0 10px #36f387; /* Shadow effect */
}

/* For Firefox */
.scrollable-content {
    scrollbar-width: thin; /* Makes scrollbar thinner */
    scrollbar-color: #36f387 #222222; /* Thumb and track colors */
}
</style>
</head>
<body style="background-color:#111111; margin: 0 auto; padding:0;">

<div id="top" class="header">

        <nav>

            <div class="logo">

                <img src="assets/favicon.png" alt="Logo" >

            </div>

            <ul class="nav-items" style="font-family: Nunito, sans-serif;">

                

                <li><a href="index.html" ><b>Home</b></a></li>

                <li><a href="index.php" style="background-color: #00d188; color: #333;"><b>Review</b></a></li>

                <li><a href="submit_review.php"><b>Post</b></a></li>

                <li><a href="archives.html"><b>Archives</b></a></li>

                <li><a href="partner.html"><b>Partners</b></a></li>

            </ul>

            <div class="nav-button">

                <button style="font-family: Nunito, sans-serif; display: flex; text-align: center;">🛈 Help</button>

            </div>

        </nav>

    </div>
<div style="background-image:url(assets/post.png); background-size: cover; border-radius: 0 0 8px 8px;">
<br>  <h1 style="font-family: 'Horizon', sans-serif; color: #ffffff;">Latest Reviews</h1>

    <!-- Search Form -->
    <form method="GET" action="index.php" style="font-family: Montserrat, sans-serif;">
        <input type="text" name="search" placeholder="Search by title..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
        <button style="background-color:#00D188;" type="submit">Search</button>
    </form>
</div>
<center>


<div style="height:1400px; width:1200px;overflow: scroll;">

    <div class="reviews" style="padding:70px;">
        <?php
        $filename = 'php/reviews.csv';

        if (file_exists($filename)) {
            $file = fopen($filename, 'r');
            $reviews = [];

            if ($file !== FALSE) {
                // Read all data into an array
                while (($data = fgetcsv($file)) !== FALSE) {
                    if (count($data) == 4) {
                        $reviews[] = $data; // Store the row in the array
                    }
                }
                fclose($file);

                // Reverse the array to display latest reviews first
                $reviews = array_reverse($reviews);

                // Check if a search query is set
                $search_query = isset($_GET['search']) ? strtolower(trim($_GET['search'])) : '';

                // Filter reviews based on the search query
                $filtered_reviews = [];
                if (!empty($search_query)) {
                    foreach ($reviews as $data) {
                        if (strpos(strtolower($data[1]), $search_query) !== FALSE) {
                            $filtered_reviews[] = $data;
                        }
                    }
                } else {
                    $filtered_reviews = $reviews;
                }

                // Output the reviews
                if (count($filtered_reviews) > 0) {
                    foreach ($filtered_reviews as $data) {
                        echo '<div class="review" style="border: 4px solid #36f388; box-shadow: 0 0 20px #36f387; background-color: rgba(0, 0, 0, 0.7);">';
                        echo '<h2 style="color:white; text-align:left;">' . htmlspecialchars($data[1]) . '</h2>';
                        echo '<p style="color:#36F387;text-align:left;"><strong>' . htmlspecialchars($data[0]) . '</strong></p>';
                        echo '<p style="color:white;text-align:left;">' . nl2br(htmlspecialchars($data[2])) . '</p>';
                        echo '<img src="' . htmlspecialchars($data[3]) . '" alt="Card Image" style="height:300px; overflow: hidden;">';
                        echo '</div>';
                    }
                } else {
                    echo '<p>No reviews found matching your search.</p>';
                }
            } else {
                echo '<p>Error: Unable to open CSV file.</p>';
            }
        } else {
            echo '<p>No reviews yet. Be the first to submit one!</p>';
        }
        ?>
    </div>
</div>
</center>
<br>
<br>
    <br><canter><p style="font-family: Montserrat, sans-serif;
        font-size: 10px; color: #ffffff; color: #36f387; text-align: center;">© 2024 ReviewXFCM. All Rights Reserved</p></canter>
    <hr style="box-shadow: 0 4px 8px #000000;
            border: 4px solid #36f388; box-shadow: 0 0 20px #36f388;">

</body>
</html>
