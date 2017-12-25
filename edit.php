<?php
require 'db.php';
session_start();
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location: error.php");
}
else {
    // Makes it easier to read
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $username = $_SESSION['username'];

}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><link rel="shortcut icon" href="edit.svg" /></title>
    <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
   <link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
   <style media="screen">
     .newcont{
       width: 90%;
     }
     .form-control{
       border: 1px #1ab188 solid;
       margin-top: 20px;

     }
     body{
       background: #f1f1f1;
     }
     .container{
       background: #ffffff;
     }
     label{
       font-size: 20px;
       font-weight: normal;
       margin-top: 20px;
       color:#1ab188 ;
     }
     h3{
       text-align: center;
       color: #1ab188;
       font-weight: bold;
       background: #f1f1f1;
       padding: 10px;
       border-radius:4px;
     }
     span{
       color: red;
     }
     .btn{
       width: 100%;
     }
     p{
       font-size: 18px;
       color: blue;
       text-align: center;
     }

   </style>
   <script>
       $(function () {
           $('#btn').click(function () {
               $('.myprogress').css('width', '0');
               $('.msg').text('');

               var myfile = $('#myfile').val();


               if (myfile == '') {
                   alert('Please select file');
                   return;
               }

               var formData = new FormData();
               formData.append('myfile', $('#myfile')[0].files[0]);


               $('#btn').attr('disabled', 'disabled');
                $('.msg').text('Uploading in progress...');

               $.ajax({
                   url: 'photo.php',
                   data: formData,
                   processData: false,
                   contentType: false,
                   type: 'POST',
                   // this part is progress bar
                   xhr: function () {
                       var xhr = new window.XMLHttpRequest();
                       xhr.upload.addEventListener("progress", function (evt) {
                           if (evt.lengthComputable) {
                               var percentComplete = evt.loaded / evt.total;
                               percentComplete = parseInt(percentComplete * 100);
                               $('.myprogress').text(percentComplete + '%');
                               $('.myprogress').css('width', percentComplete + '%');
                           }
                       }, false);
                       return xhr;
                   },
                   success: function (data) {
                       $('.msg').text(data);
                       $('#btn').removeAttr('disabled');
                   }
               });
           });
       });
   </script>
  </head>
  <body>

        <div class="container">
          <a href="index.html"><button type="button" class="btn btn-lg" name="button">VPS HOME</button></a>
          <div class="row">
            <div class="col-md-6">
              <a href="user.php"><h3>< GO BACK</h3></a>
            </div>
            <div class="col-md-6">
              <a href="logout.php"><h3>LOGOUT ></h3></a>
            </div>
          </div><br>
          <hr>
          <p>Update only what you want. Every input is not necessary</p><hr>

<!-- FOR PROFILE PICTURE -->


          <form id="myForm" method="post">
      <div class="row">
        <div class="col-md-12">
            <label for="myfile">upload Profile Pic </label>
            <input class="form-control" type="file" id="myfile" /><br>
        </div>

        <div class="form-group">
        <div class="col-md-12" >
            <div class="progress">
                <div class="progress-bar progress-bar-success myprogress" role="progressbar" style="width:0%">0%</div>
            </div>
            </div>
        <div class="col-md-12">
            <div class="msg"></div><br>
            </div>
        </div>
        <div class="col-md-12">
        <input type="button" id="btn" class="btn-success" value="Upload" /><br><br><br>
       </div>
      </div>
         </form>
<hr>

<!-- FOR ANOTHER EDIT -->

<p>EDIT OTHER ENTRIES</p><hr>

          <form action="edit.php" method="POST">

          <div class="form-group row">
              <label for="email" class="col-sm-2 col-form-label">Email</label>
           <div class="col-sm-10">
             <input type="email" class="form-control" id="email" name="email" placeholder="Email">
          </div>
        </div>
      <div class="form-group row">
      <label for="Roll No:" class="col-sm-2 col-form-label">Roll No.</label>
        <div class="col-sm-10">
        <input type="number" class="form-control" id="Roll No:" name="roll" placeholder="Roll Number">
        </div>
      </div>
      <div class="form-group row">
      <label for="address" class="col-sm-2 col-form-label">Address</label>
        <div class="col-sm-10">
        <input type="text" class="form-control" name="address" id="address" placeholder="address"><br>
        </div>
      </div>
      <div class="form-group row">
      <label for="" class="col-sm-2 col-form-label"></label>
        <div class="col-sm-10">
        <input type="submit" class="btn btn-success" name="submit" value="Submit">
        </div>
      </div>
      </form>

      <?php
         $retreive_hash = "SELECT hash FROM users WHERE username='$username'";
         $result=mysqli_query($mysqli,$retreive_hash);
         list($hash)=mysqli_fetch_array($result);

          if (isset($_POST['submit'])) {
            $update_email = $mysqli->escape_string($_POST['email']);
            $roll = $mysqli->escape_string($_POST['roll']);
            $address = $mysqli->escape_string($_POST['address']);
            if ($roll!=null) {
                $sql1= "UPDATE users SET ROll='$roll' WHERE username='$username'";

                if (mysqli_query($mysqli,$sql1)) {echo "<h3>Roll Updated !!<br></h3>";}
            }

            if ($update_email!=null) {
                $sql= "UPDATE users SET email='$update_email' WHERE username='$username'";
                if (mysqli_query($mysqli,$sql)) {
                  $update_active="UPDATE users SET active=0 WHERE username='$username'";
                  mysqli_query($mysqli,$update_active);
                  echo "<h3>Your Email is unverified. Confirmation link has been sent to <span>$update_email</span>.
                        [Check spam/junk mail in other case]</h3>";

                        // Send registration confirmation link (verify.php)
                        $to      = $update_email;
                        $subject = 'Account Verification ( vpsbihiya.com )';
                        $header = "From:abhi.vik.0542@gmail.com \r\n";
                        $message_body = '
                        Hello '.$first_name.',

                        Thank you for signing up!

                        Please click this link to activate your account:

                        http://vpsbihiya.byethost7.com/verify.php?email='.$update_email.'&hash='.$hash;

                        mail( $to, $subject, $message_body,$header );
                      }
                    }
                 if ($address!=null) {
                   $sql2= "UPDATE users SET address='$address' WHERE username='$username'";

                   if (mysqli_query($mysqli,$sql2)) {echo "<h3>Address Updated !!<br></h3>";}
                 }
          }
      ?>
   <footer style="padding:100px;"></footer>
     </div>
  </body>
</html>
