<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="icon" href="assets/X-logo.png">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Montserrat, sans-serif;
            background-color: #111111; /* Site background black */
            color: #fff;
        }

        .review-form {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.1); /* Form background with opacity */
            border-radius: 10px;
            box-shadow: 0 0 20px #36f387; /* Green glowing box shadow */
        }

        .review-form input[type="text"], .review-form textarea, .review-form input[type="file"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.1); /* Slightly transparent background for fields */
            color: #fff;
            transition: 0.3s;
        }

        .review-form input[type="text"]:focus, .review-form textarea:focus, .review-form input[type="file"]:focus {
            border: 1px solid #36f387;
            box-shadow: 0 0 15px #36f387; /* Green glowing border */
        }

        .review-form label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        .review-form button {
            background-color: #36f387;
            color: black;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }

        .review-form button:hover {
            background-color: #2ecf6d;
            transform: scale(1.05);
        }

        .char-limit {
            font-size: 12px;
            color: #ccc;
            text-align: right;
        }
    </style>
</head>
<body>
    <div id="top" class="header">
        <nav>
            <div class="logo">
                <img src="assets/favicon.png" alt="Logo" >
            </div>
            <ul class="nav-items" style="font-family: Nunito, sans-serif;">
                <li><a href="index.html"><b>Home</b></a></li>
                <li><a href="index.php"><b>Review</b></a></li>
                <li><a href="submit_review.php" style="background-color: #00d188; color: #333;"><b>Post</b></a></li>
                <li><a href="archives.html"><b>Archives</b></a></li>
                <li><a href="partner.html"><b>Partners</b></a></li>
            </ul>
            <div class="nav-button">
                <button style="font-family: Nunito, sans-serif; display: flex; text-align: center;">ðŸ›ˆ Help</button>
            </div>
        </nav>
    </div>
<div style="background-image:url(assets/post.png); background-size: cover; border-radius: 0 0 8px 8px; height:100px;">
<br>  
<h1 style="font-family: 'Horizon', sans-serif; color: #ffffff; text-align:center;">POST REVIEWS</h1>

</div>

    <div class="review-form">
        <h2 style="font-family: 'Horizon', sans-serif;">Submit a Review</h2>
        <form action="submit_reviews.php" method="POST" enctype="multipart/form-data">
            <label for="name" style="font-family: Montserrat, sans-serif;">User ID</label>
<input type="text" id="name" name="name" value="" readonly required>

            <label for="title" style="font-family: Montserrat, sans-serif;">Title</label>
            <input value="You may include tags like #st #new etc." type="text" id="title" name="title" required>

            <label for="description" style="font-family: Montserrat, sans-serif;">Description</label>
            <textarea id="description" name="description" rows="4" maxlength="900" required>Include every detail and only use media posts links realted to your post if any (unicodes allowed).</textarea>
            <div class="char-limit" id="char-count">0 / 900 characters</div>

            <label for="image" style="font-family: Montserrat, sans-serif;">Upload Card Image</label>
            <input type="file" id="image" name="image" accept="image/*" required>

            <button type="submit" style="font-family: 'Horizon', sans-serif; color: #fff;">Submit</button>
        </form>
    </div>

    <script>
        // Function to map numbers to random letters
        function randomizeIP(ip) {
            const mapping = {
                '0': 'a', '1': 'l', '2': 'p', '3': 'r',
                '4': 'x', '5': 'b', '6': 'z', '7': 'h',
                '8': 't', '9': 'd'
            };
            return ip.split('.').join('').replace(/\d/g, (match) => mapping[match]);
        }

        // Get IP address and set the username field
        fetch('https://api.ipify.org?format=json')
            .then(response => response.json())
            .then(data => {
                const ip = data.ip;
                const randomizedUsername = randomizeIP(ip);
                document.getElementById('name').value = randomizedUsername;
            })
            .catch(error => console.error('Error fetching IP address:', error));

        // Script to update character count
        const descriptionField = document.getElementById('description');
        const charCount = document.getElementById('char-count');

        descriptionField.addEventListener('input', () => {
            charCount.textContent = `${descriptionField.value.length} / 900 characters`;
        });
    </script>

    <br><br>
    <center>
        <p style="font-family: Montserrat, sans-serif; font-size: 10px; color: #36f387; text-align: center;">© 2024 ReviewXFCM. All Rights Reserved</p>
    </center>
    <hr style="box-shadow: 0 4px 8px #000000; border: 4px solid #36f388; box-shadow: 0 0 20px #36f388;">
</body>
</html>
