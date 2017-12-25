<?php
require 'db.php';
session_start();
if ( $_SESSION['logged_in'] !== 1 && $_SESSION['first_name'] !== 'vps-admin') {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location: error.php");
}
else {
    // Makes it easier to read
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $username = $_SESSION['username'];
    $active = $_SESSION['active'];
}

$query = "SELECT ID,FIRST_NAME,LAST_NAME,username FROM users;";
$result = mysqli_query($mysqli,$query) or die("Error in connection with db");
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Admin/Home</title>
    <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
  <link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- include jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <!-- include bootstrap files -->
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <style media="screen">
  p{
    text-align: center;
    font-size: 28px;
    font-weight: bold;
    color:#1ab188;
  }
  td{
    color: red;
    font-weight: bold;
  }
  th{
    font-weight: bold;
  }
  </style>
  <script>
      $(function () {
          $('#btn').click(function () {
              $('.myprogress').css('width', '0');
              $('.msg').text('');
              var filename = $('#filename').val();
              var myfile = $('#myfile').val();
              var roll = $('#roll').val();
              
              if (filename == '' || myfile == '' || roll== '') {
                  alert('Please enter ID, file name and select file');
                  return;
              }

              var formData = new FormData();
              formData.append('myfile', $('#myfile')[0].files[0]);
              formData.append('filename', filename);
              formData.append('roll',roll);
              $('#btn').attr('disabled', 'disabled');
               $('.msg').text('Uploading in progress...');

              $.ajax({
                  url: 'uploadscript.php',
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
  <style media="screen">

  </style>
  </head>
  <body style="background:#f1f1f1;">
    <div class="container" style="background:#ffffff;">
      <nav class="navbar navbar-default ">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html">VPS BIHIYA</span></a>
          </div>
          <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
            <li><a href="forgotpass.php">Forgot-Password</a></li>
             <li><a href="logout.php">Logout</a></li>
            </ul>
          </div>
        </div>
      </nav>
      <h3>Welcome to Admin Page</h3><br>
      <h5>Select Class and Submit to proceed</h5><br>
      <form class="nav navbar" action="" method="post">
        <div class="row" style="border-bottom:10px solid #ffffff;">
      <div class="form-group">

        <div class="col-md-6">
          <select class="form-control" name="class" id="class">
            <option value="v">Class V</option>
            <option value="vi">Class VI</option>
            <option value="vii">Class VII</option>
            <option value="viii">Class VIII</option>
            <option value="ix">Class IX</option>
            <option value="x">Class X</option>
          </select><br>
        </div>
        <div class="col-md-6">
          <input type="submit" name="submit" id="submit" value="submit" class="form-control">
        </div>
        </div>
      </div><br><br>



      <?php
      if (isset($_POST['class'])) {

        echo ' <div class="container">

                    <div class="row" style="color:#35424a; ">
          <div class="col-md-12">

                <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">Help </button><br><br>


                <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">


               <div class="modal-content">
                   <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title">Important Notice</h4>
              </div>
               <div class="modal-body">
                <h3>We are fetching data from database.So need to be carefull for each entry.</h3><br>
                <h4>*   ID/Roll should be according to table below.</h4><br>
                <h4>*   File name should be same for each student for one term. e.g. Annual Result-2017</h4><br>
                <h4>*   selected file should be in any doc form like .pdf .docx</h4><br>
                <h4>*   If you have uploaded the wrong doc then you need to upload again. It will overwrite.</h4><br>
                <h4>*   Make sure your doc size should not be large. Use a healthy internet connection.</h4><br>
                <h4>*   If there is still any problem then mail me at <strong>abhi.vik.0542@gmail.com</strong> with screenshot. </h4><br>
                </div>
             <div class="modal-footer">
             <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
        </div>
      </div>
                        <form id="myform" method="post">
                        <div class="col-md-6">
                        <div class="form-group">

                            <label for="roll">Enter the ID/Roll of student: </label>
                            <input class="form-control" type="number" id="roll" >
                        </div>
                       </div>
                            <div class="form-group">
                            <div class="col-md-6">
                                <label for="filename">Enter the file name: </label>
                                <input class="form-control" type="text" id="filename" />
                            </div>
                            </div>
                            <div class="form-group">
                            <div class="col-md-12">
                                <label for="myfile">Select file: </label>
                                <input class="form-control" type="file" id="myfile" /><br>
                            </div>
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
                            <input type="button" id="btn" class="btn-success" value="Upload" />
                           </div>
                        </form>
                    </div>
                </div>';

      $class = $_POST['class'];
      $query1 = "SELECT ID,FIRST_NAME,LAST_NAME,username FROM users WHERE class='$class';";
      $result = mysqli_query($mysqli,$query1) or die("Error in connection with db");
        if (mysqli_num_rows($result)==0) {
          echo "<h3>database is empty</h3><br>";
        }else {
          echo "<div class='col-md-12'>";
          echo "<table class='table table-bordered'><thead><tr><th>Roll No</th><th>Name</th><th>username</th></tr></thead>";
          // echo "<form id='myCheck' action='' method='post'>";

          while (list($id,$first_name,$last_name,$username)=mysqli_fetch_array($result)) {

            echo "<tbody><tr><td>".htmlspecialchars($id);
            echo "</td><td>".htmlspecialchars($first_name);
            echo  htmlspecialchars($last_name);
            echo "</td><td>".htmlspecialchars($username);
            echo "</td></tr></tbody>";

          }
          echo "</div>";
          echo "<div class='col-md-12'>";

            echo "<p>Class-".htmlspecialchars($class)." </p>";
            echo "</div>";
            echo "</form><br>";
            echo "</table>";
        }

      }
      // else {
      //   echo "u haven't select anything";
      // }
mysqli_close($mysqli);
      ?>

<footer style="padding:40px;">
<p>Note: Keep your password safe.</p>

</footer>
    </div>
  </body>
</html>
