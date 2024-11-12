<?php
include "../db-connect.php";

if (isset($_POST['logout'])) {
    //session_destroy();
    setcookie("user", "", time() - 60 * 60 * 24, "/");
    header("location:../index.php");
}

function validate_data($val)
{
    $val = trim($val);
    $val = stripslashes($val);
    $val = htmlspecialchars($val);

    return $val;
}

$error   = "";
$success = "";
$color   = "";
$flag    = 0;

if (!isset($_COOKIE['user'])) {
    header("location: ../login.php");
} else {
    $email    = $_COOKIE['user'];
    $sql      = "SELECT * FROM users where email=\"$email\"";
    $select   = mysqli_query($conn, $sql);
    $num_rows = mysqli_num_rows($select);
    $rows     = mysqli_fetch_array($select, MYSQLI_ASSOC);

}
if (isset($_COOKIE['user']) && $num_rows != 1) {
    header("location: ../login.php");
} else {

    if (isset($_POST['update'])) {

        $first_name  = $_POST['first_name'];
        $last_name   = $_POST['last_name'];
        $email       = $_POST['email'];
        $phone       = $_POST['phone'];
        $age         = $_POST['age'];
        $gender      = $_POST['gender'];
        $blood_group = $_POST['blood_group'];
        $district    = $_POST['district'];

        if (empty($first_name) || empty($last_name) || empty($email) || empty($phone) || empty($age) || empty($gender) || empty($blood_group) || empty($district)) {
            $error = "Fill out the required fields!<br>";
            $color = "red";
        } else {

            $first_name  = validate_data($first_name);
            $last_name   = validate_data($last_name);
            $email       = validate_data($email);
            $phone       = validate_data($phone);
            $age         = validate_data($age);
            $gender      = validate_data($gender);
            $blood_group = validate_data($blood_group);

            $sql    = "UPDATE users SET `first_name`='$first_name',`last_name`='$last_name',`age`='$age',`gender`='$gender',`blood_group`='$blood_group',`district`='$district',`email`='$email',`phone`='$phone' where email='$email'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $success = "Information Updated Successfully!<br><br>";
                $color   = "green";
                $flag    = 1;
            } else {
                $error = "Something Wrong! Please Contact With Admin<br>";
                $color = "red";
            }
        }
    }
}

?>
<!DOCTYPE html>
<html>
   <head>
      <title>Account Dashboard | Rokto</title>
      <link rel="stylesheet" type="text/css" href="../css/mystyle.css">
      <link rel="stylesheet" type="text/css" href="../css/oth.css">
      <link rel="stylesheet" type="text/css" href="../css/panelstyle.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
      <?php
if ($flag == 1) {
    echo "<meta http-equiv=\"refresh\" content=\"1\" />";
    $flag = 0;
}?>
   </head>
   <body>
      <div class="topnav">
         <li><a href="../index.php" class="navlogo">Rokto</a></li>
         <li><a href="../index.php">Home</a></li>
                 <li><a href="../about-us.php">About Us</a></li>
         <li><a href="../search-donors.php">Search Donors</a></li>
         <li><a href="../emergency.php">Life Saving Contacts</a></li>
<li><a href="login.php"><?php if (isset($_COOKIE['user'])) {echo "<form action=\"\" method=\"post\"> <button type=\"submit\" name=\"logout\" class=\"navbutton\">Logout</button>
    </form>";} else {echo "Login";}?></a></li>
         <li><a href="" class="site-search"><i class="fa fa-search" aria-hidden="true"></i></a></li>
      </div>
      <div class="panelhome" style="height: 500px;">

         <div class="sidebar">
            <ul>
               <li><a href="home.php" >Home</a></li>
               <li><a href="editinfo.php" class="active">Update Information</a></li>
               <li><a href="request.php">Add Blood Request</a></li>
               <li><a href="donation-date.php">Next Donation Date</a></li>
               <li><a href="joiningVerification.php">Join as a Donor</a></li>
               <li><a href="updatepwd.php" >Change Password</a></li>
               <li><a href="delete.php" >Delete Account</a></li>
            </ul>
         </div>

      <div class="updateinfo">
        <h3>Update Information</h3>
         <form action="" method="POST">
            <span style="text-align:center; color:<?php echo "$color"; ?>; font-size: 15px;">
                    <?php echo "$error$success"; ?></span>
            <div class="fname">
               <input type="text" placeholder="First Name" name="first_name" value="<?php echo $rows['first_name'] ?>"></br>
            </div>
            <div class="lastname">
               <input type="text" placeholder="Last Name" name="last_name" value="<?php echo $rows['last_name'] ?>"></br>
            </div>
            <div class="email">
               <input type="email" placeholder="Email" name="email" value="<?php echo $rows['email'] ?>"></br>
            </div>
            <div class="mobile">
               <input type="text" placeholder="Mobile Number" name="phone" value="<?php echo $rows['phone'] ?>"></br>
            </div>
            <div class="age">
               <input type="text" placeholder="Age" name="age" value="<?php echo $rows['age'] ?>"></br>
            </div>
            <div class="gender">
               <select id="gender" name="gender" >
                  <option value="">Gender</option>
                  <option value="male" <?php if ($rows['gender'] == "male") {echo "selected";}?>>Male</option>
                  <option value="female"  <?php if ($rows['gender'] == "female") {echo "selected";}?>>Female</option>
                  <option value="other"  <?php if ($rows['gender'] == "other") {echo "selected";}?>>Other</option>
               </select>
            </div>
            <div class="blood_group">
               <select id="blood_group" name="blood_group" class="form-select">
                  <option value="">Blood Group</option>
                  <option value="A+" <?php if ($rows['blood_group'] == "A+") {echo "selected";}?>>A+</option>
                  <option value="A-" <?php if ($rows['blood_group'] == "A-") {echo "selected";}?>>A-</option>
                  <option value="B+" <?php if ($rows['blood_group'] == "B+") {echo "selected";}?>>B+</option>
                  <option value="B-" <?php if ($rows['blood_group'] == "B-") {echo "selected";}?>>B-</option>
                  <option value="AB+" <?php if ($rows['blood_group'] == "AB+") {echo "selected";}?>>AB+</option>
                  <option value="AB-" <?php if ($rows['blood_group'] == "AB-") {echo "selected";}?>>AB-</option>
                  <option value="O+" <?php if ($rows['blood_group'] == "O+") {echo "selected";}?>>O+</option>
                  <option value="O-" <?php if ($rows['blood_group'] == "O-") {echo "selected";}?>>O-</option>
               </select>
            </div>
            <div class="district">
               <select id="district" name="district" >


                  <option value="">District</option>
                  <option value="Dhaka" <?php if ($rows['district'] == "Dhaka") {echo "selected";}?>> Dhaka</option>
                  <option value="Chittagong" <?php if ($rows['district'] == "Chittagong") {echo "selected";}?>>Chittagong</option>
                  <option value="Sylhet" <?php if ($rows['district'] == "Sylhet") {echo "selected";}?>>Sylhet</option>
                  <option value="Barishal" <?php if ($rows['district'] == "Barishal") {echo "selected";}?>>Barishal</option>
                  <option value="Bogra" <?php if ($rows['district'] == "Bogra") {echo "selected";}?>>Bogra</option>
                  <option value="Comilla" <?php if ($rows['district'] == "Comilla") {echo "selected";}?>>Comilla</option>
                  <option value="Shariatpur" <?php if ($rows['district'] == "Shariatpur") {echo "selected";}?>>Shariatpur</option>
                  <option value="Madaripur" <?php if ($rows['district'] == "Madaripur") {echo "selected";}?>>Madaripur</option>


               </select>
            </div>
            <button type="submit" name="update">UPDATE</button><br>
         </form>
      </div>

      </div>

      <div class="footer">
         <div class="elementor-shape" data-negative="false">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1800 5.8" preserveAspectRatio="none">
               <path class="elementor-shape-fill" d="M5.4.4l5.4 5.3L16.5.4l5.4 5.3L27.5.4 33 5.7 38.6.4l5.5 5.4h.1L49.9.4l5.4 5.3L60.9.4l5.5 5.3L72 .4l5.5 5.3L83.1.4l5.4 5.3L94.1.4l5.5 5.4h.2l5.6-5.4 5.5 5.3 5.6-5.3 5.4 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.4h.2l5.6-5.4 5.4 5.3L161 .4l5.4 5.3L172 .4l5.5 5.3 5.6-5.3 5.4 5.3 5.7-5.3 5.4 5.4h.2l5.6-5.4 5.5 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.4 5.3 5.6-5.3 5.5 5.4h.2l5.6-5.4 5.5 5.3L261 .4l5.4 5.3L272 .4l5.5 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.4h.1l5.7-5.4 5.4 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.4 5.3 5.7-5.3 5.4 5.4h.2l5.6-5.4 5.5 5.3L361 .4l5.5 5.3 5.6-5.3 5.4 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.4h.1l5.7-5.4 5.4 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.4h.1l5.6-5.4 5.5 5.3L461 .4l5.5 5.3 5.6-5.3 5.4 5.3 5.7-5.3 5.4 5.3 5.6-5.3 5.5 5.4h.2l5.6-5.4 5.5 5.3 5.6-5.3 5.4 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.4h.1L550 .4l5.4 5.3L561 .4l5.5 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.4 5.3 5.6-5.3 5.5 5.4h.2l5.6-5.4 5.5 5.3 5.6-5.3 5.4 5.3 5.7-5.3 5.4 5.3 5.6-5.3 5.5 5.4h.2L650 .4l5.5 5.3 5.6-5.3 5.4 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.4 5.4h.2l5.6-5.4 5.5 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.4 5.3 5.6-5.3 5.5 5.4h.2L750 .4l5.5 5.3 5.6-5.3 5.4 5.3 5.7-5.3 5.4 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.4h.1l5.7-5.4 5.4 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.4 5.4h.2L850 .4l5.5 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.4 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.4h.2l5.6-5.4 5.4 5.3 5.7-5.3 5.4 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.4h.1l5.7-5.4 5.4 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.4 5.3 5.6-5.3 5.5 5.4h.2l5.6-5.4 5.5 5.3 5.6-5.3 5.4 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.4h.2l5.6-5.4 5.4 5.3 5.7-5.3 5.4 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.4 5.4h.2l5.6-5.4 5.5 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.4 5.3 5.6-5.3 5.5 5.4h.2l5.6-5.4 5.5 5.3 5.6-5.3 5.4 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.4h.1l5.7-5.4 5.4 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.4 5.4h.2l5.6-5.4 5.5 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.4 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.4h.2l5.6-5.4 5.4 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.4h.1l5.7-5.4 5.4 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.4 5.3 5.6-5.3 5.5 5.4h.2l5.6-5.4 5.5 5.3 5.6-5.3 5.4 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.4h.2l5.6-5.4 5.4 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.4 5.3 5.7-5.3 5.4 5.4h.2l5.6-5.4 5.5 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.4 5.3 5.6-5.3 5.5 5.4h.2l5.6-5.4 5.5 5.3 5.6-5.3 5.4 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.4h.1l5.6-5.4 5.5 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.4 5.3 5.7-5.3 5.4 5.4h.2l5.6-5.4 5.5 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.4 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.4h.1l5.7-5.4 5.4 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.5 5.4h.1l5.6-5.4 5.5 5.3 5.6-5.3 5.5 5.3 5.6-5.3 5.4 5.3 5.7-5.3 5.4 5.3 5.6-5.3 5.5 5.4V0H-.2v5.8z"></path>
            </svg>
         </div>
         <div class="column left">
            <h1>Rokto</h1>
            <p>Rokto is an automated blood service that connects blood searchers with voluntary blood donors in a moment through SMS and website.</p>
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
   </body>
</html>