


<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Dental Care Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link rel="shortcut icon" type="image" href="Img/teethlogo.jpg">
    <link rel="stylesheet" type="text/css" href="DoctorsPageCSS.css">

</head>
<body>
<section id="Ho">
    <header class="header fixed-top">



        <a href="Home.html#Homee" class="logo">Dental<span>Care.</span></a>

        <nav class="nav">
            <ul class="nav_links">
                <li><a href="#Ho">Home</a></li>
                <li><a href="#App">Appointments</a></li>

            </ul>
        </nav>

        <a href="LoginPageAdminDoc.html" class="appointment" >Sign Out</a>




    </header>



    <div class="bg-image1">
        <img src="Img/home-bg.jpg">
        <div class="text-on-bg">
            <h2>Welcome, Doctor</h2>

        </div>
    </div>

</section>
<section id="App">
    <div class="main">
        <h1>Appointments</h1></br>


        <table class="table table-hover">
            <thead class="thead-dark">
            <tr class="first-row">
                <th>Doctor's Name</th>
                <th>Patient Email</th>
                <th>Patient Phone Number</th>
                <th>Appointment Date</th>
            </tr>
            </thead>


            <tbody id="bbody">


            <?php

            include 'DoctablePHP.php';



            ?>



            </tbody>





        </table>

    </div>
</section>




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

</body>
</html>