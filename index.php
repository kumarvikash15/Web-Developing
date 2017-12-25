<?php
/* Main page with two forms: sign up and log in */
require 'db.php';
session_start();

?>
<!DOCTYPE html>
<html>
<head>
  <title>Sign-Up/Login Form</title>
    <?php include 'css/css.html'; ?>
  <link rel="stylesheet" href="/css/style1.css">
  <style media="screen">
   .logo{border-radius: 5px;}
 </style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (isset($_POST['login'])) { //user logging in

        require 'login.php';

    }

    elseif (isset($_POST['register'])) { //user registering

        // require 'register.php';
        echo "USERNAME & PASSWORD ALREADY DISTRIBUTED.";

    }
}
?>
<body>
    <div class="form">
  <h1><a href="index.html"><img src="image/logo.png" class="logo" width="100" height="70"></a></h1>
    <h2>WELCOME TO STUDENT PORTAL</h2><br>
      <ul class="tab-group">
        <li class="tab"><a href="#signup">Sign Up</a></li>
        <li class="tab active"><a href="#login">Log In</a></li>
      </ul>

      <div class="tab-content">

         <div id="login">
          <h1>Welcome Back!</h1>

          <form action="index.php" method="post" autocomplete="off">

            <div class="field-wrap">
            <label>
              Username<span class="req">*</span>
            </label>
            <input type="text" required autocomplete="off" name="username"/>
          </div>

          <div class="field-wrap">
            <label>
              Password<span class="req">*</span>
            </label>
            <input type="password" required autocomplete="off" name="password"/>
          </div>

          <p class="forgot"><a href="forgot.php">Forgot Password?</a></p>

          <button class="button button-block" name="login" />Log In</button>

          </form>

        </div>

        <div id="signup">
          <h1>Not Available !!!</h1>

          <form action="index.php" method="post" autocomplete="off">
            <!-- <div class="field-wrap">
              <label>
                Id Code<span class="req">*</span>
              </label>
              <input type="number"required autocomplete="off" name='id' />
            </div> -->
          <div class="top-row">
            <div class="field-wrap">
              <label>
                First Name<span class="req">*</span>
              </label>
              <input type="text" required autocomplete="off" name='firstname' disabled />
            </div>

            <div class="field-wrap">
              <label>
                Last Name<span class="req">*</span>
              </label>
              <input type="text" required autocomplete="off" name='lastname' disabled/>
            </div>
          </div>
          <!-- <div class="field-wrap">
            <label>
              Father's Name<span class="req">*</span>
            </label>
            <input type="text" required autocomplete="off" name='fathername' />
          </div>
          <div class="field-wrap">
            <label>
              contact<span class="req">*</span>
            </label>
            <input type="number" required autocomplete="off" maxlength="10" name='contact'/>
          </div>
          <div class="field-wrap">
            <label>
              Address<span class="req">*</span>
            </label>
            <input type="text" required autocomplete="off" name='address'/>
          </div> -->

          <div class="field-wrap">
            <label>
              Username<span class="req">*</span>
            </label>
            <input type="text" required autocomplete="off" name='username' disabled/>
          </div>

          <div class="field-wrap">
            <label>
              Set A Password<span class="req">*</span>
            </label>
            <input type="password"required autocomplete="off" name='password' disabled/>
          </div>

          <button type="submit" class="button button-block" name="register" disabled />Register</button>

          </form>

        </div>

      </div><!-- tab-content -->

</div> <!-- /form -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
   <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script src="js/index.js"></script>

</body>
</html>
