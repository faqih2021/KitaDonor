<?php
include "../db-connect.php";

// Handle logout
if (isset($_POST['logout'])) {
    setcookie("user", "", time() - 60 * 60 * 24, "/");
    header("location: ../index.php");
    exit();
}

// Check if user is logged in
if (!isset($_COOKIE['user'])) {
    header("location: login.php");
    exit();
}

$email = $_COOKIE['user'];
$sql = "SELECT * FROM admin WHERE email='$email'";
$select = mysqli_query($conn, $sql);
$num_rows = mysqli_num_rows($select);
$rows = mysqli_fetch_array($select, MYSQLI_ASSOC);

// Redirect if user is not valid
if ($num_rows != 1) {
    header("location: login.php");
    exit();
}

// Fetch users
$sql_users = "SELECT * FROM users";
$result_users = mysqli_query($conn, $sql_users);

// Handle Edit and Delete actions
if (isset($_POST['edit_user'])) {
    $user_id = $_POST['user_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $blood_group = $_POST['blood_group'];
    $district = $_POST['district'];
    $next_donation_date = $_POST['next_donation_date'];
    
    // Update query
    $update_sql = "UPDATE users SET first_name='$first_name', last_name='$last_name', age='$age', gender='$gender', blood_group='$blood_group', district='$district', next_donation_date='$next_donation_date' WHERE id='$user_id'";
    mysqli_query($conn, $update_sql);
}

if (isset($_POST['delete_user'])) {
    $user_id = $_POST['user_id'];
    // Delete query
    $delete_sql = "DELETE FROM users WHERE id='$user_id'";
    mysqli_query($conn, $delete_sql);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | KitaDonor</title>
    <link rel="stylesheet" type="text/css" href="../css/mystyle.css">
    <link rel="stylesheet" type="text/css" href="../css/oth.css">
    <link rel="stylesheet" type="text/css" href="../css/panelstyle.css">
    <link rel="stylesheet" type="text/css" href="../css/adminstyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* CSS untuk mengubah warna teks tabel menjadi hitam */
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            color: black; /* Mengatur warna teks menjadi hitam */
        }
        td a {
            color: black; /* Mengatur warna teks link dalam tabel menjadi hitam */
        }
    </style>
</head>

<body>
    <!-- Top Navigation -->
    <div class="topnav">
        <li><a href="../index.php" class="navlogo">KitaDonor</a></li>
        <li>
            <a href="login.php" style="margin-left: 500px;">
                <?php
                if (isset($_COOKIE['user'])) {
                    echo '<form action="" method="post">
                            <button type="submit" name="logout" class="navbutton">Logout</button>
                          </form>';
                } else {
                    echo "Login";
                }
                ?>
            </a>
        </li>
    </div>

    <!-- Sidebar and Main Content -->
    <div class="panelhome">
        <div class="sidebar">
            <ul>
                <li><a href="index.php" class="active">Home</a></li>
                <li><a href="editinfo.php">Update User Information</a></li>
                <li><a href="requests.php">Blood Requests</a></li>
            </ul>
        </div>

        <h3>Admin Dashboard | Welcome <?php echo htmlspecialchars($rows['uname']); ?></h3>

        <div class="blood_request">
            <h4>User List</h4>
            <table border="1" cellspacing="0" cellpadding="5">
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Blood Group</th>
                    <th>District</th>
                    <th>Next Donation Date</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Verified</th>
                    <th>Actions</th> <!-- Column for Actions -->
                </tr>
                <?php
                if (mysqli_num_rows($result_users) > 0) {
                    while ($user = mysqli_fetch_assoc($result_users)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($user['id']) . "</td>";
                        echo "<td>" . htmlspecialchars($user['first_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($user['last_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($user['age']) . "</td>";
                        echo "<td>" . htmlspecialchars($user['gender']) . "</td>";
                        echo "<td>" . htmlspecialchars($user['blood_group']) . "</td>";
                        echo "<td>" . htmlspecialchars($user['district']) . "</td>";
                        echo "<td>" . htmlspecialchars($user['next_donation_date']) . "</td>";
                        echo "<td><a href='mailto:" . htmlspecialchars($user['email']) . "'>" . htmlspecialchars($user['email']) . "</a></td>";
                        echo "<td>" . htmlspecialchars($user['phone']) . "</td>";
                        echo "<td>" . ($user['verified'] == 1 ? 'Yes' : 'No') . "</td>";
                        // Add Edit and Delete buttons with SweetAlert
                        echo "<td>
                                <button class='edit-btn' data-id='" . $user['id'] . "'>Edit</button>
                                <button class='delete-btn' data-id='" . $user['id'] . "'>Delete</button>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='12'>No users found.</td></tr>";
                }
                ?>
            </table>
        </div>
        <div class="footer">
        <div class="elementor-shape" data-negative="false">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1800 5.8" preserveAspectRatio="none">
                <path class="elementor-shape-fill" d="M5.4.4l5.4 5.3L16.5.4l5.4 5.3L27.5.4 33 5.7 38.6.4l5.5 5.4h.1L49.9.4l5.4 5.3L60.9.4l5.5 5.3L72 .4l5.5 5.3L83.1.4l5.4 5.3L94.1.4l5.5 5.4h.2l5.6-5.4 5.5 5.3 5.6-5.3 5.4 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.4h.2l5.6-5.4 5.4 5.3L161 .4l5.4 5.3L172 .4l5.5 5.3 5.6-5.3 5.4 5.3 5.7-5.3 5.4 5.4h.2l5.6-5.4 5.5 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.4 5.3 5.6-5.3 5.5 5.4h.2l5.6-5.4 5.5 5.3L261 .4l5.4 5.3L272 .4l5.5 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.4h.1l5.7-5.4 5.4 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.4 5.3 5.7-5.3 5.4 5.4h.2l5.6-5.4 5.5 5.3L361 .4l5.5 5.3 5.6-5.3 5.4 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.4h.1l5.7-5.4 5.4 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.4h.1l5.6-5.4 5.5 5.3L461 .4l5.5 5.3 5.6-5.3 5.4 5.3 5.7-5.3 5.4 5.3 5.6-5.3 5.5 5.4h.2l5.6-5.4 5.5 5.3 5.6-5.3 5.4 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.4h.1L550 .4l5.4 5.3L561 .4l5.5 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.4 5.3 5.6-5.3 5.5 5.4h.2l5.6-5.4 5.5 5.3 5.6-5.3 5.4 5.3 5.7-5.3 5.4 5.3 5.6-5.3 5.5 5.4h.2L650 .4l5.5 5.3 5.6-5.3 5.4 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.4 5.4h.2l5.6-5.4 5.5 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.4 5.3 5.6-5.3 5.5 5.4h.2L750 .4l5.5 5.3 5.6-5.3 5.4 5.3 5.7-5.3 5.4 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.4h.1l5.7-5.4 5.4 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.4 5.4h.2L850 .4l5.5 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.4 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.4h.2l5.6-5.4 5.4 5.3 5.7-5.3 5.4 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.4h.1l5.7-5.4 5.4 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.4 5.3 5.6-5.3 5.5 5.4h.2l5.6-5.4 5.5 5.3 5.6-5.3 5.4 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.4h.2l5.6-5.4 5.4 5.3 5.7-5.3 5.4 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.4 5.4h.2l5.6-5.4 5.5 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.4 5.3 5.6-5.3 5.5 5.4h.2l5.6-5.4 5.5 5.3 5.6-5.3 5.4 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.4h.1l5.7-5.4 5.4 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.4 5.4h.2l5.6-5.4 5.5 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.4 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.4h.2l5.6-5.4 5.4 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.4h.1l5.7-5.4 5.4 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.4 5.3 5.6-5.3 5.5 5.4h.2l5.6-5.4 5.5 5.3 5.6-5.3 5.4 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.4h.2l5.6-5.4 5.4 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.4 5.3 5.7-5.3 5.4 5.4h.2l5.6-5.4 5.5 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.4 5.3 5.6-5.3 5.5 5.4h.2l5.6-5.4 5.5 5.3 5.6-5.3 5.4 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.4h.1l5.6-5.4 5.5 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.4 5.3 5.7-5.3 5.4 5.4h.2l5.6-5.4 5.5 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.4 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.4h.1l5.7-5.4 5.4 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.4h.1l5.6-5.4 5.5 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.4 5.3 5.7-5.3 5.4 5.3 5.6-5.3 5.5 5.4V0H-.2v5.8z"></path>
            </svg>
        </div>
        <div class="column left">
            <h1>KitaDonor</h1>
            <p>KitaDonor is an automated blood service that connects blood searchers with voluntary blood donors in a moment through SMS and website.</p>
            <a href="#"><i aria-hidden="true" class="fa fa-facebook fa-2x"></i></a>
            <a href="#"><i aria-hidden="true" class="fa fa-twitter fa-2x"></i></a>
            <a href="#"><i aria-hidden="true" class="fa fa-linkedin fa-2x"></i></a><br />
            <div class="xyz">
                <a href="/terms">Terms & Conditions</a> | <a href="/policy">Privacy Policy</a>
            </div>
        </div>
        <div class="column right">
            <h1 style="color: #333333;">Quick Links</h1>
            <a href="#">Contact Us</a>
            <br />
            <a href="">Different Blood Groups</a>
            <br />
            <a href="#">Who can donate blood?</a>
            <br />
            <a href="#">Different Blood Terms</a>
            <br />
        </div>
    </div>
    </div>
    <script>
        // SweetAlert for Delete Confirmation
        document.querySelectorAll('.delete-btn').forEach((button) => {
            button.addEventListener('click', (e) => {
                const userId = e.target.getAttribute('data-id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Send delete request via AJAX or form
                        var formData = new FormData();
                        formData.append('delete_user', true);
                        formData.append('user_id', userId);

                        fetch('', {
                            method: 'POST',
                            body: formData
                        }).then(response => response.text())
                          .then(data => {
                              location.reload(); // Reload the page after deleting
                          });
                    }
                });
            });
        });

        // SweetAlert for Edit User
        document.querySelectorAll('.edit-btn').forEach((button) => {
            button.addEventListener('click', (e) => {
                const userId = e.target.getAttribute('data-id');
                // Get current data for the user
                const currentRow = e.target.closest('tr');
                const firstName = currentRow.cells[1].textContent;
                const lastName = currentRow.cells[2].textContent;
                const age = currentRow.cells[3].textContent;
                const gender = currentRow.cells[4].textContent;
                const bloodGroup = currentRow.cells[5].textContent;
                const district = currentRow.cells[6].textContent;
                const nextDonationDate = currentRow.cells[7].textContent;

                Swal.fire({
                    title: 'Edit User',
                    html: `
                        <input id="first_name" class="swal2-input" value="${firstName}" placeholder="First Name">
                        <input id="last_name" class="swal2-input" value="${lastName}" placeholder="Last Name">
                        <input id="age" class="swal2-input" value="${age}" placeholder="Age">
                        <input id="gender" class="swal2-input" value="${gender}" placeholder="Gender">
                        <input id="blood_group" class="swal2-input" value="${bloodGroup}" placeholder="Blood Group">
                        <input id="district" class="swal2-input" value="${district}" placeholder="District">
                        <input id="next_donation_date" class="swal2-input" value="${nextDonationDate}" placeholder="Next Donation Date">
                    `,
                    preConfirm: () => {
                        const firstName = document.getElementById('first_name').value;
                        const lastName = document.getElementById('last_name').value;
                        const age = document.getElementById('age').value;
                        const gender = document.getElementById('gender').value;
                        const bloodGroup = document.getElementById('blood_group').value;
                        const district = document.getElementById('district').value;
                        const nextDonationDate = document.getElementById('next_donation_date').value;

                        var formData = new FormData();
                        formData.append('edit_user', true);
                        formData.append('user_id', userId);
                        formData.append('first_name', firstName);
                        formData.append('last_name', lastName);
                        formData.append('age', age);
                        formData.append('gender', gender);
                        formData.append('blood_group', bloodGroup);
                        formData.append('district', district);
                        formData.append('next_donation_date', nextDonationDate);

                        fetch('', {
                            method: 'POST',
                            body: formData
                        }).then(response => response.text())
                          .then(data => {
                              location.reload(); // Reload the page after editing
                          });
                    }
                });
            });
        });
    </script>
</body>

</html>
