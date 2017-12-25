<?php
/* Registration process, inserts user info into the database
   and sends account confirmation email message
 */

// Set session variables to be used on profile.php page
$_SESSION['id'] = $_POST['id'];
$_SESSION['username'] = $_POST['username'];
$_SESSION['first_name'] = $_POST['firstname'];
$_SESSION['last_name'] = $_POST['lastname'];

// Escape all $_POST variables to protect against SQL injections
$username = $mysqli->escape_string($_POST['username']);
$father = $mysqli->escape_string($_POST['fathername']);
$id = $mysqli->escape_string($_POST['id']);
$contact = $mysqli->escape_string($_POST['contact']);
$first_name = $mysqli->escape_string($_POST['firstname']);
$last_name = $mysqli->escape_string($_POST['lastname']);
$address = $mysqli->escape_string($_POST['address']);
$password = $mysqli->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));
$hash = $mysqli->escape_string( md5( rand(0,1000) ) );

// Check if user with that email/username already exists
$result = $mysqli->query("SELECT * FROM users WHERE username='$username'") or die($mysqli->error());

// We know user email exists if the rows returned are more than 0
if ( $result->num_rows > 0 ) {

    $_SESSION['message'] = 'User with this Username already exists!';
    header("location: error.php");

}
else { // Email doesn't already exist in a database, proceed...

    // active is 0 by DEFAULT (no need to include it here)
    $sql = "INSERT INTO users (id,first_name, last_name,username,father,address,contact, password, hash) "
            . "VALUES ('$id','$first_name','$last_name','$username','$father','$address','$contact','$password', '$hash')";

    // Add user to the database
    if ( $mysqli->query($sql) ){

        $_SESSION['active'] = 0; //0 until user activates their account with verify.php
        $_SESSION['logged_in'] = true; // So we know the user has logged in
        $_SESSION['message'] =

                 "Confirmation link has been sent to $username, please verify
                 your account by clicking on the link in the message!";

        //Send registration confirmation link (verify.php)
        // $to      = $email;
        // $subject = 'Account Verification ( vpsbihiya.com )';
        //  $header = "From:abhi.vik.0542@gmail.com \r\n";
        // $message_body = '
        // Hello '.$first_name.',
        //
        // Thank you for signing up!
        //
        // Please click this link to activate your account:
        //
        // http://localhost/login-system/verify.php?email='.$email.'&hash='.$hash;
        //
        //
        // mail( $to, $subject, $message_body,$header );

        echo "success";



    }

    else {
        $_SESSION['message'] = 'Registration failed!';
        header("location: error.php");
    }

}
