<?php
include "../db-connect.php";

// Logout logic
if (isset($_POST['logout'])) {
    setcookie("user", "", time() - 60 * 60 * 24, "/");
    header("location: ../index.php");
    exit;
}

// Redirect jika user belum login
if (!isset($_COOKIE['user'])) {
    header("location: login.php");
    exit;
} else {
    $email = $_COOKIE['user'];
    $sql = "SELECT * FROM blood_requests";
    $select = mysqli_query($conn, $sql);

    if (!$select) {
        die("Error: " . mysqli_error($conn));
    }
}

// Delete request
if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    $delete_sql = "DELETE FROM blood_requests WHERE id = '$delete_id'";
    if (mysqli_query($conn, $delete_sql)) {
        echo "<script>alert('Blood request deleted successfully');</script>";
        echo "<script>window.location.href='requests.php';</script>";
    } else {
        echo "<script>alert('Error deleting record');</script>";
    }
}

// Edit request
if (isset($_POST['edit_id'])) {
    $edit_id = $_POST['edit_id'];
    $edit_sql = "SELECT * FROM blood_requests WHERE id = '$edit_id'";
    $edit_result = mysqli_query($conn, $edit_sql);
    $edit_row = mysqli_fetch_assoc($edit_result);
}

// Handle save edit action
if (isset($_POST['save_edit'])) {
    // Ambil data dari form
    $edit_id = $_POST['edit_id'];
    $edit_name = mysqli_real_escape_string($conn, $_POST['edit_name']);
    $edit_message = mysqli_real_escape_string($conn, $_POST['edit_message']);
    $edit_blood_group = mysqli_real_escape_string($conn, $_POST['edit_blood_group']);
    $edit_num_bag = mysqli_real_escape_string($conn, $_POST['edit_num_bag']);
    $edit_phone_primary = mysqli_real_escape_string($conn, $_POST['edit_phone_primary']);
    $edit_email = mysqli_real_escape_string($conn, $_POST['edit_email']);
    $edit_when_needed = mysqli_real_escape_string($conn, $_POST['edit_when_needed']);
    
    // Query untuk memperbarui data
    $update_sql = "UPDATE blood_requests SET 
                    Name = '$edit_name', 
                    message = '$edit_message', 
                    blood_group = '$edit_blood_group', 
                    num_bag = '$edit_num_bag', 
                    phone_primary = '$edit_phone_primary', 
                    email = '$edit_email', 
                    when_needed = '$edit_when_needed' 
                    WHERE id = '$edit_id'";
    
    if (mysqli_query($conn, $update_sql)) {
        echo "<script>alert('Blood request updated successfully');</script>";
        echo "<script>window.location.href='requests.php';</script>";
    } else {
        echo "<script>alert('Error updating record: " . mysqli_error($conn) . "');</script>";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard | KitaDonor</title>
    <link rel="stylesheet" type="text/css" href="../css/mystyle.css">
    <link rel="stylesheet" type="text/css" href="../css/oth.css">
    <link rel="stylesheet" type="text/css" href="../css/panelstyle.css">
    <link rel="stylesheet" type="text/css" href="../css/adminstyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <style>
        /* Add your modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 60px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
            padding: 20px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="topnav">
        <li><a href="../index.php" class="navlogo">KitaDonor</a></li>
        <li><a href="login.php" style="margin-left: 500px;">
            <?php if (isset($_COOKIE['user'])) {
                echo "<form action=\"\" method=\"post\"> <button type=\"submit\" name=\"logout\" class=\"navbutton\">Logout</button></form>";
            } else {
                echo "Login";
            } ?>
        </a></li>
    </div>

    <div class="panelhome">
        <div class="sidebar">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="updateuser.php">Update User Information</a></li>
                <li><a href="requests.php" class="active">Blood Requests</a></li>
            </ul>
        </div>

        <h3>Admin Dashboard | Blood Requests</h3>

        <div class="blood_request">
            <table border="1" cellspacing="0" cellpadding="5">
                <tr>
                    <th>Name</th>
                    <th>Message</th>
                    <th>Blood Group</th>
                    <th>Bags</th>
                    <th>Primary Contact</th>
                    <th>Email</th>
                    <th>When Needed</th>
                    <th>Actions</th>
                </tr>
                <?php
                while ($row = mysqli_fetch_assoc($select)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['Name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['message']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['blood_group']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['num_bag']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['phone_primary']) . "</td>";
                    echo "<td><a href='mailto:" . htmlspecialchars($row['email']) . "'>" . htmlspecialchars($row['email']) . "</a></td>";
                    echo "<td>" . htmlspecialchars($row['when_needed']) . "</td>";
                    echo "<td><button onclick=\"openEditModal('" . $row['id'] . "', '" . addslashes($row['Name']) . "', '" . addslashes($row['message']) . "', '" . addslashes($row['blood_group']) . "', '" . $row['num_bag'] . "', '" . $row['phone_primary'] . "', '" . addslashes($row['email']) . "', '" . addslashes($row['when_needed']) . "')\">Edit</button> <button onclick=\"deleteRequest(" . $row['id'] . ")\">Delete</button></td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>

        <!-- Modal for Editing -->
        <div id="editModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeEditModal()">&times;</span>
                <h2>Edit Blood Request</h2>
                <form method="post" action="requests.php">
                    <input type="hidden" name="edit_id" id="edit_id">
                    <label for="edit_name" style="color: black;">Name:</label>
                    <input type="text" name="edit_name" id="edit_name" required style="color: black;"><br><br>

                    <label for="edit_message" style="color: black;">Message:</label>
                    <textarea name="edit_message" id="edit_message" required style="color: black;"></textarea><br><br>

                    <label for="edit_blood_group" style="color: black;">Blood Group:</label>
                    <input type="text" name="edit_blood_group" id="edit_blood_group" required style="color: black;"><br><br>

                    <label for="edit_num_bag" style="color: black;">Bags:</label>
                    <input type="number" name="edit_num_bag" id="edit_num_bag" required style="color: black;"><br><br>

                    <label for="edit_phone_primary" style="color: black;">Primary Contact:</label>
                    <input type="text" name="edit_phone_primary" id="edit_phone_primary" required style="color: black;"><br><br>

                    <label for="edit_email" style="color: black;">Email:</label>
                    <input type="email" name="edit_email" id="edit_email" required style="color: black;"><br><br>

                    <label for="edit_when_needed" style="color: black;">When Needed:</label>
                    <input type="text" name="edit_when_needed" id="edit_when_needed" required style="color: black;"><br><br>

                    <button type="submit" name="save_edit" style="color: black;">Save Changes</button>
                </form>
            </div>
        </div>

        <script>
            function openEditModal(id, Name, message, blood_group, num_bag, phone_primary, email, when_needed) {
                document.getElementById('editModal').style.display = 'block';
                document.getElementById('edit_id').value = id;
                document.getElementById('edit_name').value = Name;
                document.getElementById('edit_message').value = message;
                document.getElementById('edit_blood_group').value = blood_group;
                document.getElementById('edit_num_bag').value = num_bag;
                document.getElementById('edit_phone_primary').value = phone_primary;
                document.getElementById('edit_email').value = email;
                document.getElementById('edit_when_needed').value = when_needed;
            }

            function closeEditModal() {
                document.getElementById('editModal').style.display = 'none';
            }

            function deleteRequest(id) {
                if (confirm('Are you sure you want to delete this request?')) {
                    var form = document.createElement('form');
                    form.method = 'POST';
                    var input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'delete_id';
                    input.value = id;
                    form.appendChild(input);
                    document.body.appendChild(form);
                    form.submit();
                }
            }
        </script>

    </div>

    <div class="footer">
        <div class="elementor-shape" data-negative="false">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1800 5.8" preserveAspectRatio="none">
                <path class="elementor-shape-fill" d="M5.4.4l5.4 5.3L16.5.4l5.4 5.3L27.5.4 33 5.7 38.6.4l5.5 5.4h.1L49.9.4l5.4 5.3L60.9.4l5.5 5.3L72 .4l5.5 5.3L83.1.4l5.4 5.3L94.1.4l5.5 5.4h.2l5.6-5.4 5.5 5.3 5.6-5.3 5.4 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.4h.2l5.6-5.4 5.4 5.3L161 .4l5.4 5.3L172 .4l5.5 5.3 5.6-5.3 5.4 5.3 5.7-5.3 5.4 5.4h.2l5.6-5.4 5.5 5.3 5.6-5.3 5.4 5.3 5.5 5.3 5.6-5.3 5.5 5.3z"></path>
            </svg>
        </div>
        <div class="column left">
            <h1>KitaDonor</h1>
            <p>KitaDonor is an automated blood service...</p>
        </div>
    </div>

</body>

</html>
