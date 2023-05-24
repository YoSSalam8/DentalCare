<?php


$conn=new mysqli('localhost','root','','dentalcare');
if($conn->connect_error){
    die('Connection Failed : '.$conn->connect_error);
}

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the email and password entered by the user
    $email = $_POST['UserEmail'];
    $password = $_POST['UserPass'];



    $_SESSION['UserEmail'] = $email;
    $sql_users = "SELECT * FROM doctors WHERE doctoremail = '$email' AND doctorpass = '$password'";
    $result_users = mysqli_query($conn, $sql_users);


    $sql_admins = "SELECT * FROM admin WHERE adminemail = '$email' AND adminpass = '$password'";
    $result_admins = mysqli_query($conn, $sql_admins);

    // Check if the query returned any rows for users
    if (mysqli_num_rows($result_users) > 0) {
        // Retrieve the user's information
        $user = mysqli_fetch_assoc($result_users);

        // Redirect to the page that displays the user's information
        header("Location:DocPagePHP.php");
        exit;
    }
    // Check if the query returned any rows for admins
    else if (mysqli_num_rows($result_admins) > 0) {
        // Redirect to the admin page
        header("Location: test.php");
        exit;
    }
    else {
        // Invalid email or password
        echo
        "
                            <script>
                            alert('Incorrect Email Or Password');
                            document.location.href='LoginPageAdminDoc.html';
                            </script>";
    }
}

mysqli_close($conn);
?>
