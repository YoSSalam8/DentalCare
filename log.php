
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Dental Care Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="shortcut icon" type="image" href="Img/teethlogo.jpg">
    <link href="Log-in.css" rel="Stylesheet" type="text/css">





</head>
<body>
<form action="Login22.php" method="post">

    <header class="header fixed-top">



        <a href="Home.html#Homee" class="logo">Dental<span>Care.</span></a>

        <nav class="nav">
            <ul class="nav_links">
                <li><a href="Home.html#Homee">Home</a></li>
                <li><a href="Home.html#Aboutt">About</a></li>
                <li><a href="Home.html#Serv">Services</a></li>
                <li><a href="Home.html#proc">Our Process</a></li>
                <li><a href="Home.html#rev">Reviews</a></li>
                <li><a href="Home.html#Cont">Contact Us</a></li>
            </ul>
        </nav>

        <a href="SIgnUp.html" class="appointment" >Make Appointment</a>




    </header>





    <div class="Login">
        <h1>Make An Appointment</h1>

        <p style="text-align: left">Email:</p>
        <input type="email" name="UserEmail" class="input-box" placeholder="Enter Email">
        <p style="text-align: left">Password:</p>
        <input type="password" name="UserPass" class="input-box" placeholder="Enter Password">
        <p style="text-align: left">Phone Number:</p>
        <input type="tel" name="UserPhone" class="input-box" placeholder="Enter Your Phone Number">
        <p style="text-align: left">Appointment Date:</p>
        <input type="datetime-local" name="UserDate" id="UserDate" class="input-box" placeholder="MM/DD/YYYY">
        <p style="text-align: left">Doctor:</p>

        <input type="text" id="menu" name="UserDoc" class="input-box" list="menu-list" placeholder="Choose Your Doctor" oninput="checkMenuItem()" onchange="checkOption()">
        <datalist id="menu-list">

            <?php


            $conn =new mysqli('localhost','root','','dentalcare');
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Execute the SQL statement and retrieve the doctor names
            $sql = "SELECT `doctorname` FROM doctors";
            $result = mysqli_query($conn, $sql);

            // Output the doctor names as options in the datalist
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row["doctorname"] . "'>";
            }

            // Close the database connection
            mysqli_close($conn);
            ?>


        </datalist>
        <script>
            function checkOption() {
                var input = document.getElementById("menu").value;
                var datalist = document.getElementById("menu-list");
                var options = datalist.options;
                for (var i = 0; i < options.length; i++) {
                    if (input == options[i].value) {
                        return;
                    }
                }
                alert("Invalid menu item!");
                document.getElementById("menu").value = "";
            }
        </script>

        <input type="submit"  class="signup-button" value="Make An Appointment"></input>
        <hr>
        <p>You Don't Have An Account?<a href="SIgnUp.html">SignUp</a> </p>







    </div>


    <section class="Contact-Us">

        <div class="box-container">
            <div class="box">
                <i style="font-size:24px" class="fa">&#xf095;</i>
                <h2>Phone Number</h2>
                <h3>+970-598666558</h3>
                <h3>+972-597728233</h3>
            </div>
            <div class="box">
                <i style="font-size:24px" class="fa">&#xf041;</i>
                <h2>Our Address</h2>
                <h3>Nablus,Sufyian Street</h3>

            </div>

            <div class="box">
                <i style="font-size:24px" class="fa">&#xf017;</i>
                <h2>Openning Hours</h2>
                <h3>8:00am to 6:00pm</h3>

            </div>

            <div class="box">
                <i style="font-size:24px" class="fa">&#xf0e0;</i>
                <h2>Email Address</h2>
                <h3>Yossalam261@gmail.com</h3>
                <h3>s12027851@stu.najah.edu</h3>
            </div>





        </div>




    </section>
</form>
</body>
</html>