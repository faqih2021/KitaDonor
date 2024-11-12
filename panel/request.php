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

    if (isset($_POST['submit'])) {

        $name          = $rows['first_name'] . " " . $rows['last_name'];
        $email         = $rows['email'];
        $phone_primary = $rows['phone'];
        $extra_contact = $_POST['extranum'];
        $blood_group   = $_POST['b_group'];
        $num_bags      = $_POST['num_bags'];
        $message       = $_POST['whyneed'];
        $date          = $_POST['date'];

        if (empty($num_bags) || empty($blood_group) || empty($date)) {
            $error = "Fill out the required fields!<br><br>";
            $color = "red";
        } else {

            $name          = validate_data($name);
            $email         = validate_data($email);
            $phone_primary = validate_data($phone_primary);
            $extra_contact = validate_data($extra_contact);
            $blood_group   = validate_data($blood_group);
            $num_bags      = validate_data($num_bags);
            $message       = validate_data($message);
            $date          = validate_data($date);

            $sql    = "INSERT into blood_requests(Name,email,phone_primary,extra_contact,blood_group,num_bag,message,when_needed) values('$name','$email','$phone_primary','$extra_contact','$blood_group','$num_bags','$message','$date')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $success = "Request Sent Successfully!<br><br>";
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
      <div class="panelhome" >
         <div class="sidebar">
            <ul>
               <li><a href="home.php" >Home</a></li>
               <li><a href="editinfo.php">Update Information</a></li>
               <li><a href="request.php" class="active">Add Blood Request</a></li>
               <li><a href="donation-date.php">Next Donation Date</a></li>
               <li><a href="joiningVerification.php">Join as a Donor</a></li>
               <li><a href="updatepwd.php" >Change Password</a></li>
               <li><a href="delete.php" >Delete Account</a></li>
            </ul>
         </div>

         <div class="blood_request">
          <h3>Add Blood Request</h3>
            <form action="" method="post">
              <span style="text-align:center; color:<?php echo "$color"; ?>; font-size: 15px;">
                    <?php echo "$error$success"; ?></span>
               <div class="b_group">
                  <label for="b_group">Blood Group</label><br />
                  <select  name="b_group" required>
                     <option value="0">Select</option>
                     <option value="A+">A+</option>
                     <option value="A-">A-</option>
                     <option value="B+">B+</option>
                     <option value="B-">B-</option>
                     <option value="AB+">AB+</option>
                     <option value="AB-">AB-</option>
                     <option value="O+">O+</option>
                     <option value="O-">O-</option>
                  </select>
               </div>
               <br>
               <div class="num_bags">
                  <label for="num_bags">Number Of Bags</label><br />
                  <select  name="num_bags" required>
                     <option value="1">1</option>
                     <option value="2">2</option>
                     <option value="3">3</option>
                     <option value="4">4</option>
                     <option value="5">5</option>
                  </select>
               </div>
               <br>

               <label for="date">When Needed?</label><br>
           <input type="date" id="date" name="date" min="<?php echo date("Y-m-d"); ?>"><br>

               <label for="extranum">Extra Contact Number</label><br>
               <input type="text" name="extranum" ><br>

               <label for="whyneed">Why is blood needed and where?</label><br>
                <textarea type="text" name="whyneed"></textarea><br>
               <button type="submit" class="submit" name="submit">SUBMIT</button>
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