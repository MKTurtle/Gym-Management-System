<?php

$title = 'Members';
$currentPage = 'Members';
$pageFile = 'member';

require "./app/database.php";
require "./app/MemberController.php";

$member = new Member();

$date_now = date("Y-m-d");

?>

<?php include('./template/head.php'); ?>

<body>
    <?php include('./template/navbar.php'); ?>

    <div class="content">

        <button type="button" onclick="addUser()">
            <img src="./web/images/add.png">
        </button>
        <input type="text" id="myInput" onkeyup="search()" placeholder="Search for names..">

        <table id="table">
            <thead>
                <th>Name</th>
                <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($member->selectAll() as $members) {
                    echo "<tr>";
                    echo "<td hidden>" . $members['id'] . "</td>";
                    echo "<td hidden>" . $members['rfid'] . "</td>";
                    echo "<td hidden>" . $members['membership'] . "</td>";

                    echo "<td>" . $members['name'] . "</td>";
                    echo "<td>" . $members['status'] . "</td>";
                    echo "</tr>";
                }
                ?>

                <!--
                <tr>
                    <td>admin</td>
                    <td><?php // echo ('2017-06-01' >= $date_now) ? "Active" : "Inactive" 
                        ?></td>
                </tr>
                -->

            </tbody>
        </table>
    </div>



    <div id="edit-modal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-close-btn">&times;</span>
                <img src="" onerror="this.src='uniflex.jpg'" alt="" id="member-photo">
                <input type="text" id="name" name="name" readonly>
            </div>
            <div class="modal-description">
                <form class="modal-form" name="member-description" action="./crud/memberCRUD.php" method="POST">

                    <input type="text" id="namee" name="namee" disabled hidden>

                    <p class="modal-editable">
                        <label for="rfid">RFID Code</label>
                        <input type="text" id="rfid" name="rfid" disabled>
                    </p>

                    <p class="modal-editable">
                        <label for="membership">Membership</label>
                        <input type="date" id="membership-date" name="membership-date" disabled>
                    </p>

                    <p class="modal-editable">
                        <label for="promo">Promo</label>
                        <select id="promo" name="promo" onchange="addMembership()">
                            <option value="none">None &#8369;1800</option>
                            <option value="student">Student &#8369;1100</option>
                        </select>
                    </p>

                    <p class="modal-editable">
                        <label for="extend">Extend</label>
                        <select id="extend" name="extend" onchange="addMembership()">
                            <option value="0">None</option>
                            <option value="1">1 month</option>
                            <option value="2">2 months</option>
                            <option value="3">3 months</option>
                            <option value="4">4 months</option>
                            <option value="5">5 months</option>
                            <option value="6">6 months</option>
                            <option value="7">7 months</option>
                            <option value="8">8 months</option>
                            <option value="9">9 months</option>
                            <option value="10">10 months</option>
                            <option value="11">11 months</option>
                            <option value="12">12 months</option>
                        </select>
                    </p>

                    <p class="modal-editable">
                        <label for="price">Total Price</label>
                        <input type="text" id="total-price" name="totalprice" disabled>
                    </p>

                    <input type="hidden" id="member-id" name="member-id">

                    <input type="button" onclick="edit()" value="Edit" />
                    <input type="submit" name="save" id="save" value="Save" disabled />
                    <input type="submit" name="remove" id="remove" value="Remove" disabled />
                    <input type="button" onclick="picture()" value="Take Photo" id="takephoto" />
                </form>
            </div>
        </div>
    </div>

    



    <div id="add-modal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-close-btn">&times;</span>
                <p> Add Member </p>
            </div>
            <div class="modal-description">
                <form class="modal-form" name="add-user-form" action="./crud/memberCRUD.php" method="POST">

                    <p class="modal-editable">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" name="name">
                    </p>

                    <p class="modal-editable">
                        <label for="membership">Membership</label>
                        <input type="date" id="membership" name="membership" onchange="newMembership()">
                    </p>

                    <p class="modal-editable">
                        <label for="promo">Promo</label>
                        <select id="member-promo" name="promo" onchange="newMembership()">
                            <option value="none">None &#8369;1800</option>
                            <option value="student">Student &#8369;1100</option>
                        </select>
                    </p>

                    <p class="modal-editable">
                        <label for="price">Total Price</label>
                        <input type="text" id="total" name="total" readonly>
                    </p>

                    <p class="modal-editable">
                        <label for="rfid">RFID Code</label>
                        <input type="text" id="rfid" name="rfid">
                    </p>

                    <input type="submit" name="add-member" id="save" value="Save" />
                </form>
            </div>
        </div>
    </div>
    
    <div id="picture-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-close-btn">&times;</span>
                <p> Take Photo </p>
            </div>
            <div class="modal-description"> 
                <div id="vid-controls">
                    <form id="myForm" name="myForm">
                        <input type="hidden" name="memberId" id="hidden-id">
                    </form>
                    <video id="vid-show" autoplay></video>
                    <input id="vid-take" type="button" value="Take Photo" />
                    <div id="vid-canvas"></div>
                </div>
            </div>
        </div>
        
    </div>

    <?php if ($member->checker() > 0) { ?>
        <div id="expired-modal" class="modal">
            <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-close-btn">&times;</span>
                    <p> Expired Members </p>
                </div>
                <div class="modal-description">
                    <?php
                    foreach ($member->expired() as $expiredMembers) {
                        echo "<p>";
                        echo $expiredMembers['name'];
                        echo "</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    <?php } else {
    }
    ?>


    <?php include('./template/footer.php'); ?>