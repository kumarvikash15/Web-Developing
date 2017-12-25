<?php
require 'db.php';
session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>forgot-password</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    <style media="screen">
      h4{
        color: green;
      }
      td{
        color: blue;
      }
      body{
        background: #f1f1f1;
      }
      p{
        text-align: center;
        font-size: 24px;
        font-weight: bold;
        color:#1ab188;
        display: inline;
      }
      .std{
        text-align: center;
        font-size: 28px;
        font-weight: bold;
        color:#1ab188;

      }
    </style>
  </head>
  <body>
  <div class="container" style="background:#ffffff;">

<?php

$sum=0;
if ( $_SESSION['logged_in'] !== 1 && $_SESSION['first_name'] !== 'vps-admin') {
  $_SESSION['message'] = "You must have to be Admin to see this!<br>Get OFF";
  header("location: error.php");
}
if (isset($_GET['submit'])) {
  $username =$mysqli->escape_string($_GET['username']);
  $newpass =$mysqli->escape_string(password_hash($_GET['newpass'],PASSWORD_BCRYPT));
  $hash=  $mysqli->escape_string( md5( rand(0,1000) ) );
  $query="UPDATE users SET password='$newpass', hash='$hash' WHERE username='$username';";
    if ( mysqli_query($mysqli,$query) ) {echo "success";}
    else {echo "<h2>ERROR</h2>";}
}
if (isset($_POST['submit'])) {
      $tuition = $mysqli->escape_string($_POST['tuition']);
      $transport = $mysqli->escape_string($_POST['transport']);
      $hostel = $mysqli->escape_string($_POST['hostel']);
      $fine = $mysqli->escape_string($_POST['fine']);
      $notice =$mysqli->escape_string($_POST['notice']);

      //for notice
      if ($notice!=null) {
        $notice_query="UPDATE fee SET notice='$notice' WHERE id=1;";
        if (mysqli_query($mysqli,$notice_query)) {
          echo "<h3>NOTICE UPDATED as <br></h3><h4>".htmlspecialchars($notice)."</h4>";
        }
      }


          if(!empty($_POST['list'])) {
            $checked_count = count($_POST['list']);
          echo "You have selected ".$checked_count." option(s): <br/>";
          foreach($_POST['list'] as $selected) {
            $sum=$sum.$selected.","."0";   } //Taking checkbox as value

            //for tuition fee
            if ($tuition!=null) {
              $query2= "UPDATE users SET tuition='$tuition' WHERE id IN($sum);"; //Query with IN clause
              $sql=mysqli_query($mysqli,$query2);
              if(!$sql){echo "failed";}
              else { echo "<p>tuition fee-> Success ..</p>";}
            }

           //for transport fee
           if ($transport!=null) {
             $query3= "UPDATE users SET transport='$transport' WHERE id IN($sum);"; //Query with IN clause
             $sql3=mysqli_query($mysqli,$query3);
             if(!$sql3){echo "failed";}
             else { echo "<p>Transport fee -> success..</p>";}
           }

           //for hostel fee
          if ($hostel!=null) {
            $query4= "UPDATE users SET hostel='$hostel' WHERE id IN($sum);"; //Query with IN clause
            $sql4=mysqli_query($mysqli,$query4);
            if(!$sql4){echo "failed";}
            else { echo "<p>hostel fee ->success..</p>";}

          }

           //for fine fee
          if ($fine!=null) {
            $query5= "UPDATE users SET fine='$fine' WHERE id IN($sum);"; //Query with IN clause
            $sql5=mysqli_query($mysqli,$query5);
            if(!$sql5){echo "failed";}
            else { echo "<p>Fine -> success..</p>";}
          }
          }
        }


?>
<!-- NAVBAR -->
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
      <li><a href="admin.php">Result-Update</a></li>
       <li><a href="logout.php">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>


  <div class="panel-group" id="accordion">
<div class="panel panel-success">
  <div class="panel-heading">
    <h4 class="panel-title">
      <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">For Password</a>
    </h4>
  </div>
  <div id="collapse1" class="panel-collapse collapse ">
  <div class="panel-body">
  <div class="row">
  <form action="" method="GET">
    <div class="col-md-4">
      <div class="form-group">

        <input class="form-control" type="text" name="username" placeholder="Enter Email" required>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">

        <input class="form-control" type="password" name="newpass" placeholder="Enter new Password" required>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">

        <input class="form-control" type="submit" name="submit" value="submit" id="submit">
      </div>
    </div>
    </form>
  </div>
</div>
</div>
</div><br>

<form id="myform" action="" method="post">
<div class="panel panel-success">
  <div class="panel-heading">
    <h4 class="panel-title">
      <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Notice Update</a>
    </h4>
  </div>
  <div id="collapse2" class="panel-collapse collapse">
    <div class="panel-body">

      <div class="form-group">
        <div class="row">
          <div class="col-md-10">

            <textarea name="notice" class="form-control" rows="1" cols="60" id="notice" maxlength="280" placeholder="Must be less than 280 words."></textarea>
          </div>
          <div class="col-md-2">
            <input class="form-control" type="submit" name="submit" value="GO">
          </div>
        </div>
      </div>
   </div>
  </div>
</div><br>

<div class="panel panel-success">
  <div class="panel-heading">
    <h4 class="panel-title">
      <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Select Class</a>
    </h4>
  </div>
  <div id="collapse3" class="panel-collapse collapse in">
    <div class="panel-body">

      <div class="row">
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
        <div class="row">

            <div class="col-md-3">
              <div class="form-group">
               <lable for="tuition">Tuition Fee</label>
               <input class="form-control" type="number" name="tuition" id="tuition">
            </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
              <lable for="transport">Transport Fee</label>
              <input class="form-control" type="number" name="transport" id="transport">
            </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
               <lable for="hostel">Hostel Fee</label>
              <input class="form-control" type="number" name="hostel" id="hostel">
             </div>
           </div>

            <div class="col-md-3">
              <div class="form-group">
                <lable for="fine">Fine</label>
                <input class="form-control" type="number" name="fine" id="fine">
            </div>
            </div>
          </div>
   </div>
  </div>
</div>
</div>


<!-- </form> -->

<?php
 @$class = $mysqli->escape_string($_POST['class']);
  $query1 = "SELECT ID,FIRST_NAME,LAST_NAME,username FROM users WHERE class='$class';";
  $result = mysqli_query($mysqli,$query1) or die("Error in connection with db");
    if (mysqli_num_rows($result)==0) {
      echo "<h3>database is empty</h3><br>";
    }else {
      echo "<div class='col-md-12'>";
      echo "<table class='table table-bordered table-default'><thead><tr><th>Roll No</th><th>Name</th><th>Email</th><th>Select-All<input class='checkbox' type='checkbox' id='select_all'></th></tr></thead>";
      // echo "<form id='myCheck' action='' method='post'>";

      while (list($id,$first_name,$last_name,$username)=mysqli_fetch_array($result)) {

        // echo "<tbody><tr><td>$id </td><td> $first_name  $last_name </td><td> $username </td><td><input class='checkbox' type='checkbox' name='list[]' value='$id'  ></td></tr></tbody>";

        echo "<tbody><tr><td>".htmlspecialchars($id);
        echo "</td><td>".htmlspecialchars($first_name);
        echo  htmlspecialchars($last_name);
        echo "</td><td>".htmlspecialchars($username);
        echo "</td><td><input class='checkbox' type='checkbox' name='list[]' value='$id'  ></td></tr></tbody>";
      }
      echo "</div>";
      echo "<div class='col-md-12'>";
        echo "<input class='btn btn-info' type='submit' name='submit'>";
        echo "<div class='std'>Class-".htmlspecialchars($class)." </div>";
        echo "</div>";
        echo "</form><br>";
        echo "</table>";
    }
    mysqli_close($mysqli);
?>

<footer style="padding:30px;"></footer>
</div>


<script type="text/javascript">
//select all checkboxes
var select_all = document.getElementById("select_all"); //select all checkbox
var checkboxes = document.getElementsByClassName("checkbox"); //checkbox items

//select all checkboxes
select_all.addEventListener("change", function(e){
    for (i = 0; i < checkboxes.length; i++) {
        checkboxes[i].checked = select_all.checked;
    }
});


for (var i = 0; i < checkboxes.length; i++) {
    checkboxes[i].addEventListener('change', function(e){ //".checkbox" change
        //uncheck "select all", if one of the listed checkbox item is unchecked
        if(this.checked == false){
            select_all.checked = false;
        }
        //check "select all" if all checkbox items are checked
        if(document.querySelectorAll('.checkbox:checked').length == checkboxes.length){
            select_all.checked = true;
        }
    });
}
</script>
  </body>
</html>
