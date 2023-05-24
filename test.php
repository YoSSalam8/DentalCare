

<?php


$conn=new mysqli('localhost','root','','dentalcare');
if($conn->connect_error){
    die('Connection Failed : '.$conn->connect_error);
}




$query="SELECT pdoc, COUNT(*) as num_patients FROM Patients GROUP BY pdoc";
$result=mysqli_query($conn,$query);



?>

<!DOCTYPE html>
<html lang="en">
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
    <link rel="stylesheet" type="text/css" href="AdminPageCSS.css">








    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['students', 'contribution'],
                <?php
                $sql="SELECT doctors.doctorname, COUNT(patients.pdoc) as num_patients
                FROM doctors
                JOIN patients ON doctors.doctorname = patients.pdoc
                GROUP BY doctors.doctorname
";
                $fire=mysqli_query($conn,$sql);

                while ($result = mysqli_fetch_assoc($fire)) {
                    echo"['".$result['doctorname']."',".$result['num_patients']."],";
                }

                ?>
            ]);

            var options = {
                title: 'Doctors Chart'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
    </script>
</head>
<body>


<section id="Ho">
    <header class="header fixed-top">



        <a href="Home.html#Homee" class="logo">Dental<span>Care.</span></a>

        <nav class="nav">
            <ul class="nav_links">
                <li><a href="#Ho">Home</a></li>
                <li><a href="#App">Appointments</a></li>
                <li><a href="#Signlog">Add Accounts</a></li>
                <li><a href="#Signlog1">Delete Accounts</a></li>
                <li><a href="#Char">Doctor's Chart</a></li>



            </ul>
        </nav>

        <a href="LogOutButton.php" class="appointment" >Sign Out</a>




    </header>



    <div class="bg-image1">
        <img src="Img/home-bg.jpg">
        <div class="text-on-bg">
            <h2>Welcome, Admin</h2>

        </div>
    </div>

</section>

<section id="App">
    <div class="main">
        <h1>Appointments</h1></br>
        <input id="myInput" type="text" placeholder="Search..." class="form-control" oninput="searchDoctor()">

        <table class="table table-hover" id="tab">
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

            include 'AdminPagePHP3.php';



            ?>



            </tbody>
        </table>

        <script>
            function searchDoctor() {
                const input = document.getElementById('myInput');
                const filter = input.value.toUpperCase();
                const table = document.getElementById('tab');
                const tbody = table.tBodies[0];
                const rows = tbody.rows;

                for (let i = 0; i < rows.length; i++) {
                    const doctorNameCell = rows[i].cells[0];
                    const doctorName = doctorNameCell.textContent || doctorNameCell.innerText;

                    if (doctorName.toUpperCase().indexOf(filter) > -1) {
                        rows[i].style.display = '';
                    } else {
                        rows[i].style.display = 'none';
                    }
                }
            }


            async function fetchDoctors() {
                const response = await fetch('fetch_doctors.php');
                const data = await response.json();

                const tableBody = document.getElementById('bbody');
                data.forEach(row => {
                    const tr = document.createElement('tr');
                    row.forEach(cell => {
                        const td = document.createElement('td');
                        td.textContent = cell;
                        tr.appendChild(td);
                    });
                    tableBody.appendChild(tr);
                });
            }

            // Call the fetchDoctors function on page load
            fetchDoctors();
        </script>

    </div>
</section>
<section class="Signlog" id="Signlog">
    <h2>Add Accounts</h2>
    <div class="Docs">
        <form action="AdminPagePHP.php" method="post">

            <div class="Doctors">
                <h1>Add Doctors</h1>
                <div class="Doc_input">
                    <input type="email" name="DocEmail" class="input-box" placeholder="Enter Email">
                    <input type="password" name="DocPass" class="input-box" placeholder="Enter Password">
                    <input type="text" name="DocName" class="input-box" placeholder="Enter Doctor's Name">
                    <input type="text" id="menu" name="service" class="input-box" list="menu-list" placeholder="Enter Service Name" oninput="checkMenuItem()" onchange="checkOption()">
                    <datalist id="menu-list">
                    <?php


                    $conn =new mysqli('localhost','root','','dentalcare');
                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }

                    // Execute the SQL statement and retrieve the doctor names
                    $sql = "SELECT `ID` FROM services";
                    $result = mysqli_query($conn, $sql);

                    // Output the doctor names as options in the datalist
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='" . $row["ID"] . "'>";
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


                </div>
                <input type="submit" class="signup-button" value="Sign up"></input>

            </div>


        </form>
        <form action="AdminPagePHP2.php" method="post">

            <div class="Doctors1">
                <h1>Add Admin</h1>

                <input type="email" name="AdminEmail" class="input-box" placeholder="Enter Email">
                <input type="password" name="AdminPass" class="input-box" placeholder="Enter Password">

                <input type="submit" class="signup-button" value="Sign up"></input>



            </div>

        </form>
    </div>
</section>

<section class="Signlog" id="Signlog1">
    <h2>Delete Accounts</h2>
    <div class="Docs">
        <form action="DeleteDoc.php" method="post">

            <div class="Doctors">
                <h1>Delete Doctors</h1>
                <div class="Doc_input">
                    <input type="email" name="DocEmail1" class="input-box" placeholder="Enter Email">
                    <input type="password" name="DocPass1" class="input-box" placeholder="Enter Password">



                </div>

                <input type="submit" class="signup-button" value="Delete Doc"></input>
            </div>


        </form>
        <form action="DeleteAdminPHP.php" method="post">

            <div class="Doctors1">
                <h1>Delete Admin</h1>

                <input type="email" name="AdminEmail1" class="input-box" placeholder="Enter Email">
                <input type="password" name="AdminPass1" class="input-box" placeholder="Enter Password">


                <input type="submit" class="signup-button" value="Delete Admin"></input>


            </div>

        </form>
    </div>
</section>

<section class="Char" id="Char">

    <h1 id="Chartt">Chart</h1>

    <div class="box" id="piechart" style="width: 2000px; height: 500px;"></div>



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