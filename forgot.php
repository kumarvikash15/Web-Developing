<?php
/* Reset your password form, sends reset.php password link */
require 'db.php';
session_start();

// Check if form submitted with method="post"
if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
{
    $user_check = $mysqli->escape_string($_POST['user']);
    $result = $mysqli->query("SELECT active,email,hash FROM users WHERE username='$user_check'");
    list($active,$email,$hash)=mysqli_fetch_array($result);
    if ( $result->num_rows == 0 || $active==0) // User doesn't exist
    {
        $_SESSION['message'] = "<strong>Error Occured!!!<br><br> REASONS:-</strong><br><br>->YOUR EMAIL MAY NOT BE VERIFIED.<br><br>->USERNAME DOESNOT EXIST.";
        header("location: error.php");
    }

    else { // User exists (num_rows != 0)

        // $user = $result->fetch_assoc(); // $user becomes array with user data
        //
        // $email = $user['email'];
        // $hash = $user['hash'];
        // $first_name = $user['first_name'];

        // Session message to display on success.php
        $_SESSION['message'] = "<p>Please check your email <span>$email</span>"
        . " for a confirmation link to complete your password reset!</p>";

        // Send registration confirmation link (reset.php)
        $to      = $email;
        $subject = 'Password Reset Link ( clevertechie.com )';
        $message_body = '
        Hello '.$first_name.',

        You have requested password reset!

        Please click this link to reset your password:

        http://vpsbihiya.byethost7.com/reset.php?email='.$email.'&hash='.$hash;

        mail($to, $subject, $message_body);

        header("location: success.php");
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Reset Your Password</title>
  <?php include 'css/css.html'; ?>
</head>

<body>

  <div class="form">

    <h1>Reset Your Password</h1>

    <form action="forgot.php" method="post">
     <div class="field-wrap">
      <label>
        username<span class="req">*</span>
      </label>
      <input type="text"required autocomplete="off" name="user"/>
    </div>
    <button class="button button-block"/>Reset</button>
    </form>
  </div>

<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>
</body>

</html>
