<?php
include "db-connect.php";

if (isset($_POST['logout'])) {
    //session_destroy();
    setcookie("user", "", time() - 60 * 60 * 24, "/");
    header("location:index.php");
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Website Kita Donor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/mystyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>

<body>
    <div class="topnav">
        <div class="nav">
        <li><a href="index.php" class="navlogo">KitaDonor</a></li>
        <li><a href="#home" style="margin-left: 190px;">Home</a></li>
        <li><a href="#AboutUs">About Us</a></li>
        <li><a href="#SearchDonors">Search Donors</a></li>
        <!-- <li><a href="emergency.php">Life Saving Contacts</a></li> -->

        <?php if (!isset($_COOKIE['user'])) {
            echo " <li><a href=\"login.php\">Login</a></li>";
        } else {

            echo "
                <li><div class=\"dropdown\">
            <button class=\"dropbtn\">Update
            <i class=\"nav-arrow fa fa-angle-down\"></i>
            </button>
            <div class=\"dropdown-content\">
            <a href=\"panel/home.php\">Dashboard</a>
            <form action=\"\" method=\"post\"> <button type=\"submit\" name=\"logout\" class=\"navbutton\">Logout</button>
            </form></a>
            </div>
        </div> </li>";
        }
        ?>
        </div>
    </div>
    <div class="section2" id="home">
        <h1>Platform untuk Menghubungkan Pencari dan Pendonor Darah</h1>
        <h3>KitaDonor adalah aplikasi berbasis website yang memudahkan pencarian pendonor darah sekaligus pendaftaran sukarelawan pendonor secara real-time dan gratis.</h3>
        <button class="btn1" onclick="window.location.href='register.php'">Daftar sebagai Pendonor</button>
        <button class="btn2" onclick="window.location.href='#SearchDonors'">Cari Pendonor Darah</button><br />
    </div>
    <div id="SearchDonors" class="section3">
        <h1>Search Donors</h1>
        <div class="row">
            <form action="search-donors.php" method="post">
                <div class="column">
                    <label for="blood_group">Blood Group</label><br />
                    <select id="blood_group" name="blood_group" required>
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
                <div class="column">
                    <label for="district">District</label><br />
                    <select id="district" name="district" required>
                        <option value="0">Select</option>
                        <option value="Dhaka">Surabaya</option>
                        <option value="Chittagong">Sidoarjo</option>
                        <option value="Sylhet">Malang</option>
                        <option value="Barishal">Kediri</option>
                        <option value="Bogra">Blitar</option>
                        <option value="Comilla">Madiun</option>
                        <option value="Shariatpur">Gresik</option>
                        <option value="Madaripur">Trenggalek</option>
                    </select>
                </div>
                <div class="column">
                    <label for="donortype">Donor Type</label><br />
                    <select id="donortype" name="donortype">
                        <option value="0">All</option>
                        <option value="Eligible">Eligible</option>
                    </select>
                </div>
                <button type="search" class="search" name="search">SEARCH</button>
            </form>
        </div>
    </div>
    <div class="section4">
        <h1 style="text-align: center;">We're a network of</h1>
        <div class="row">
            <div class="column">
                <center>
                    <i aria-hidden="true" class="fa fa-user fa-3x"></i><br />
                    <h2>100 Donors</h2>
                </center>
            </div>
            <div class="column">
                <i aria-hidden="true" class="fa fa-map-marker fa-3x" size></i><br />
                <h2>64 Districts</h2>
            </div>
            <div class="column">
                <i aria-hidden="true" class="fa fa-users fa-3x"></i><br />
                <h2>100 Blood Groups</h2>
            </div>
        </div>
    </div>
    <div class="section5" id="AboutUs">
        <center>
            <h1>About Us</h1>
            <p>KitaDonor adalah platform berbasis website yang menghubungkan pencari darah dengan pendonor darah sukarela secara real-time. Kami hadir untuk mempermudah akses kebutuhan darah dan mendorong lebih banyak orang untuk menjadi sukarelawan pendonor darah. KitaDonor adalah inisiatif non-profit yang bertujuan meningkatkan kesadaran akan pentingnya donor darah sukarela di Indonesia.</p>
            <button onclick="window.location.href='about-us.php'">Learn More</button>
        </center>
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
            <a href="contact-us.php">Contact Us</a>
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
