<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tan & Sons Dental Clinic</title>
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/mediaqueries.css">
</head>

<body>
    <nav id="desktop-nav">
        <div class="logo">Tan & Sons<br><span class="logo-bottomrow">Dental Clinic</span></div>
        <div class="menu-container">
            <ul>
                <li><a href="./admin.php">Doctor Account Overview</a></li>
                <li><a href="./doctor_creation.php">Doctor Account Creation</a></li>
            </ul>
        </div>
    </nav>
    <nav id="hamburger-nav">
        <div class="logo">Tan & Sons<br><span class="logo-bottomrow">Dental Clinic</span></div>
        <div class="hamburger-menu">
            <div class="hamburger-icon" onclick="toggleMenu()">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="menu-links">
                <ul>
                    <li><a href="./admin.php" onclick="toggleMenu()">Doctor Account Overview</a></li>
                    <li><a href="./doctor_creation.php" onclick="toggleMenu()">Doctor Account Creation</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="content-container">
        <div class="image-container">
            <img src="./assets/dental.jpg" alt="a boy getting a dental check-up">
        </div>
        <div class="about-container">
            <h2>About Us</h2>
            <div class="about-us">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Temporibus sed tempore minus
                inventore veniam officia excepturi quaerat iste debitis, fugit quam nihil molestias distinctio
                laudantium, tempora assumenda delectus officiis fugiat!</div>
            <h2>Why Choose Us?</h2>
            <div class="why-choose-us">
                <ul>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</li>
                    <li>Dolor aliquid, dolore hic laborum sapiente, beatae maxime quaerat unde sunt quo culpa,</li>
                    <li>odit corporis quisquam mollitia est laboriosam repudiandae! Assumenda, perferendis.</li>
                </ul>
            </div>
        </div>
    </div>
    <footer>Copyright Tan & Sons Dental Clinic Pte Ltd 2023</footer>
    <script src="script.js"></script>
</body>

</html>