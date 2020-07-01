<?php

$title = 'Dashboard';
$currentPage = 'Dashboard';
$pageFile = 'dashboard';

require "./app/database.php";
require "./app/DashboardController.php";

$dashboard = new Dashboard();

?>

<?php include('./template/head.php'); ?>

<body onload="sortByDate();">
    <?php include('./template/navbar.php'); ?>

    <div class="content">
        <form id="myForm">
            <label for="date-select"> Select Date: </label>
            <input type="month" id="date-select" name="date-select"
            min="2018-12" max="2028-12" value="0" id="myInput" onchange="sortByDate();">
        </form>


        <div class="data-summary-container">
            <div class="data-summary">
                <!-- Member Check In -->
                <div class="data">
                    <div class="data-info">
                        <p>Member Check In</p>
                        <h2 id="txt-member"></h2>
                    </div>
                    <div class="view-data">
                        <p>&#10148;</p>
                    </div>

                </div>

            </div>
            <div class="data-summary">
                <!-- Active Member -->
                <div class="data">
                    <div class="data-info">
                        <p>Active Members</p>
                        <h2> <?php echo $dashboard->active(); ?> </h2>

                    </div>
                    <div class="view-data">
                        <p>&#10148;</p>
                    </div>

                </div>

            </div>
            <div class="data-summary">
                <!-- Walk in -->
                <div class="data">
                    <div class="data-info">
                        <p>Walk in</p>
                        <h2 id="txt-walk"></h2>

                    </div>
                    <div class="view-data">
                        <p>&#10148;</p>
                    </div>

                </div>

            </div>

            
        </div>

        <table id="table">
            <thead>
                <th>Year</th>
                <th>Month</th>
                <th>Total Transaction</th>
                <th>Sales Profit</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($dashboard->selectAll() as $sales) {
                    echo "<tr>";
                        echo "<td>" . $sales['year'] . "</td>";
                        echo "<td>" . $sales['month'] . "</td>";
                        echo "<td>" . $sales['total'] . "</td>";
                        echo "<td> &#8369;" . $sales['sales'] . "</td>";
                    echo "</tr>";
                }
                ?>

            </tbody>
        </table>

        <table id="table">
            <thead>
                <th>Name</th>
                <th>Reason</th>
                <th>Promo</th>
                <th>Sales Profit</th>
                <th>Date of Transaction</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($dashboard->selectSale() as $allSales) {
                    echo "<tr>";
                        echo "<td>" . $allSales['name'] . "</td>";
                        echo "<td>" . $allSales['reason'] . "</td>";
                        echo "<td>" . $allSales['promo'] . "</td>";
                        echo "<td> &#8369;" . $allSales['profit'] . "</td>";
                        echo "<td>" . $allSales['date'] . "</td>";
                    echo "</tr>";
                }
                ?>

            </tbody>
        </table>
    </div>


    <?php include('./template/footer.php'); ?>