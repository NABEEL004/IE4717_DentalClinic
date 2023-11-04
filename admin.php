<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');
require_once "db_connection.php";
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tan & Sons Dental Clinic</title>
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/mediaqueries.css">
    <link rel="stylesheet" href="./styles/signin.css">
    <link rel="stylesheet" href="./styles/appointments-overview.css">
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
        <div class="details-container">
            <h2>Dentists Information</h2>
            <table id="doctorTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT doctor_id,username,phone_number,email FROM doctors ORDER BY username";
                    $stmt = $db->prepare($query);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['username'] . "</td>";
                        echo "<td>" . $row['phone_number'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td><button onclick='deleteDoctor(" . $row['doctor_id'] . ", this.parentNode.parentNode)'>Delete</button></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>

            </table>
        </div>
    </div>
    <footer>Copyright Tan & Sons Dental Clinic Pte Ltd 2023</footer>
    <script src="script.js"></script>
    <script>
        function deleteDoctor(doctorId, row) {
            var xhr = new XMLHttpRequest();

            // Define the request
            xhr.open("DELETE", 'delete_doctor.php?id=' + doctorId, true);

            // Set up the callback function
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        var result = xhr.responseText;
                        if (result === 'success') {
                            // If the deletion is successful, remove the row from the table
                            row.remove();
                            alert("1 record deleted!");
                        } else {
                            alert('Deletion failed.');
                        }
                    } else {
                        alert('Request failed with status: ' + xhr.status);
                    }
                }
            };

            // Send the request
            xhr.send();
        }
    </script>
</body>

</html>