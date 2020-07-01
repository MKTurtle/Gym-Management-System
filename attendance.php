<?php

$title = 'Attendance';
$currentPage = 'Attendance';
$pageFile = 'attendance';

require "./app/database.php";
require "./app/AttendanceController.php";

$attendance = new Attendance();

?>

<?php include('./template/head.php'); ?>

<body>
    <?php include('./template/navbar.php'); ?>

    <div class="content">

        <input type="text" id="myInput" onkeyup="search()" placeholder="Search for names..">

        <table id="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Date and Time of Check-In</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($attendance->selectAll() as $attendances) {
                    echo "<tr>";
                    echo "<td>" . $attendances['name'] . "</td>";
                    echo "<td>" . $attendances['member'] . "</td>";
                    echo "<td>" . $attendances['date'] . "</td>";
                    echo "</tr>";
                }
                ?>

            </tbody>
        </table>

    </div>
    
    <?php include('./template/footer.php'); ?>