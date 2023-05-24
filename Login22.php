<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';




if(isset($_POST['UserEmail']) && isset($_POST['UserPass']) && isset($_POST['UserPhone']) && isset($_POST['UserDate']) && isset($_POST['UserDoc'])) {
    $Uemail = $_POST['UserEmail'];
    $Upass = $_POST['UserPass'];
    $Uphone = $_POST['UserPhone'];
    $Udate = $_POST['UserDate'];
    $Udoc = $_POST['UserDoc'];
    $appointment_timestamp = strtotime($Udate);
    $one_hour_before = date("Y-m-d H:i:s", $appointment_timestamp - 3600);
    $one_hour_after = date("Y-m-d H:i:s", $appointment_timestamp + 3600);

    $start_time = date("Y-m-d 08:00:00", strtotime($Udate));
    $end_time = date("Y-m-d 18:00:00", strtotime($Udate));








            $db=new mysqli('localhost','root','','dentalcare');

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'dentalcarepal@gmail.com';
    $mail->Password = 'kfuygdzrjkboytxg';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('dentalcarepal@gmail.com');
    $mail->addAddress($Uemail);
    $mail->isHTML(true);
    $mail->Subject = 'Dental Care Confirmation';
    $mail->Body = 'Your Appointment At Dental Care Center Is Confirmed Successfully. See You Soon';

    $sqll = "SELECT `doctorname` FROM doctors";
    $results = mysqli_query($db, $sqll);

// Output the doctor names as options in the select element
    echo "<select name='doctor'>";
    while ($row = mysqli_fetch_assoc($results)) {
        echo "<option value='" . $row["doctorname"] . "'>";
    }
    echo "</select>";



                if($db->connect_error){
                    die('Connection Failed : '.$db->connect_error);
                }

                else {


// Scenario 1: Email and password are empty
                    if (empty($Uemail) && empty($Upass)) {
                        echo "Please enter your email and password.";
                    }

// Scenario 2: Email is empty
                    if (empty($Uemail) && !empty($Upass)) {
                        echo "Please enter your email.";
                    }

// Scenario 3: Password is empty
                    if (!empty($Uemail) && empty($Upass)) {
                        echo "Please enter your password.";
                    }

// Scenario 4: Email and password are not empty
                    if (!empty($Uemail) && !empty($Upass)) {


                        // Scenario 5: Phone, date, and doctor name are empty
                        if (empty($Uphone) && empty($Udate) && empty($Udoc)) {
                            echo "Please enter your phone number, appointment date, and doctor's name.";
                        }

                        // Scenario 6: Phone is empty
                        if (empty($Uphone) && !empty($Udate) && !empty($Udoc)) {
                            echo "Please enter your phone number.";
                        }

                        // Scenario 7: Date is empty
                        if (!empty($Uphone) && empty($Udate) && !empty($Udoc)) {
                            echo "Please enter your appointment date.";
                        }

                        // Scenario 8: Doctor name is empty
                        if (!empty($Uphone) && !empty($Udate) && empty($Udoc)) {
                            echo "Please enter your doctor's name.";
                        }

                        // Scenario 9: All fields are filled
                        if (!empty($Uphone) && !empty($Udate) && !empty($Udoc)) {


                            $sqlll = "SELECT * FROM patients WHERE patientemail='$Uemail' AND patientpass='$Upass'";
                            $result5 = mysqli_query($db, $sqlll);
                            if (mysqli_num_rows($result5) > 0) {

                                $sql = "SELECT * FROM patients
                            WHERE pdate BETWEEN ? AND ?";


                                $stmt = $db->prepare($sql);
                                $stmt->bind_param('ss', $one_hour_before, $one_hour_after);


                                $stmt->execute();
                                $result = $stmt->get_result();


                                if ($result->num_rows > 0) {


                                    echo
                                    "
                            <script>
                            alert('The appointment cannot be booked. Please choose a different time.');
                            document.location.href='log.php';
                            </script>";



                                    $db->close();
                                    exit;

                                }
                                else {

                                    $qryStr = "Update patients SET patientphone='$Uphone'
                            ,pdate='$Udate'
                            ,pdoc='$Udoc'
                            where patientemail='$Uemail' And patientpass='$Upass'";
                                    $res = $db->query($qryStr);


                                    $mail->send();

                                    echo
                                    "
                            <script>
                            alert('Sent Successfully');
                            document.location.href='log.php';
                            </script>
                            
                             $db->close();
                            ";


                                    $db->close();

                                }

                            }
                            else{

                                echo
                                "
                            <script>
                            alert('Password Or Email Incorrect');
                            document.location.href='log.php';
                            </script>
                            
                            
                            ";
                                $db->close();
                            }
                            $db->close();







                        }
                    }


                }













}


?>