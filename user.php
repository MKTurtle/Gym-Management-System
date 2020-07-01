<?php

$title = 'Users';
$currentPage = 'Users';
$pageFile = 'user';

require "./app/database.php";
require "./app/UserController.php";

$user = new User();

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
                <tr>
                    <th>Username</th>
                    <th>Account</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($user->selectAll() as $users) {
                    echo "<tr>";
                        echo "<td hidden >" . $users['id'] . "</td>";
                        echo "<td>" . $users['username'] . "</td>";
                        echo "<td hidden>" . $users['name'] . "</td>";
                        echo "<td>" . $users['account'] . "</td>";
                        echo "<td hidden>" . $users['position_name'] . "</td>";
                        echo "<td hidden>" . $users['staff_id'] . "</td>";
                    echo "</tr>";
                }
                ?>

            </tbody>
        </table>

    </div>



    <div id="user-modal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-close-btn">&times;</span>
                <img src="" onerror="this.src='uniflex.jpg'" alt="" id="user-photo">
                <input type="text" id="staff" name="staff" disabled>
            </div>
            <div class="modal-description">
                <form class="modal-form" name="user-description" action="./crud/userCRUD.php" method="POST">
                    <p class="modal-editable">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" disabled>
                    </p>
                    <p class="modal-editable">
                        <label for="account">Account</label>
                        <select name="account" id="account" disabled>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </p>
                    <p class="modal-editable">
                        <label for="position">Position</label>
                        <select name="position" id="position" disabled>
                            <option value="owner">Owner</option>
                            <option value="staff">Staff</option>
                        </select>
                    </p>
                    
                    <input type="hidden" id="userId" name="userId">
                    <input type="hidden" id="staff-id" name="staff-id">

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
                <p> Add User </p>
            </div>
            <div class="modal-description">
                <form class="modal-form" name="add-user-form" action="./crud/userCRUD.php" method="POST">
                    <p class="modal-editable">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" >
                    </p>
                    <p class="modal-editable">
                        <label for="password">Password</label>
                        <input type="password" id="asa" name="password">
                    </p>
                    <p class="modal-editable">
                        <label for="account">Account</label>
                        <select name="account">
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </p>
                    <p class="modal-editable">
                        <label for="full-name">Full Name</label>
                        <input type="text" id="full-name" name="full-name" >
                    </p> 
                    <p class="modal-editable">
                        <label for="position">Position</label>
                        <select name="position">
                            <option value="owner">Owner</option>
                            <option value="staff">Staff</option>
                        </select>
                    </p>

                    <input type="submit" name="add-user" value="Save" />
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
                        <input type="hidden" name="user-id" id="hidden-id">
                    </form>
                    <video id="vid-show" autoplay></video>
                    <input id="vid-take" type="button" value="Take Photo" />
                    <div id="vid-canvas"></div>
                </div>
            </div>
        </div>
    </div>


    <?php include('./template/footer.php'); ?>