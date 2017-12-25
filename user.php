<?php
require 'dbconfig.php';
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
// if ( !$active ){
//     echo
//     '<div class="info">
//     Account is unverified, please confirm your email by clicking
//     on the email link!
//     </div>';
//     $_SESSION['message']="ACCOUNT IS UNVERIFIED. CONTACT TO SCHOOL";
//     header("location:error.php");
// }

$query="SELECT active,class,tuition,transport,hostel,fine,contact,roll,father,address,email,hash FROM users WHERE username='$username';";
$result = mysqli_query($conn,$query) or die("Error in connection with db");
if (mysqli_num_rows($result)==0) {
  echo "database is empty<br>";
}else {
   list($active,$class,$tuition,$transport,$hostel,$fine,$contact,$roll,$father,$address,$email,$hash)=mysqli_fetch_array($result);}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>User/Home</title>
    <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
   <link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <script type="text/javascript">
    function myFee() {
      alert("This service is not started yet.");
    }
  </script>
  <style media="screen">
    h5{ color: #1ab188;
    font-weight: 600;}
    span {
        text-align: center;
        color: #1ab188;
        font-weight: 1000;
        margin: 0;
    }
    .unverified{
      color: red;
      font-weight: bold;
    }
    .verified{
      color: green;
      font-weight: bold;
    }
    .update{
      color: blue;
    }
    img{
      border-radius: 8px;

    }
    .dp{
      padding: 10px;
      width:200px;
      text-align: center;
      background: #1ab188;
      color: white;
      font-weight: bold;
      border-radius: 4px;
    }
    .dp:hover{
      background: green;
    }
    .link{
      background: #e6f2f7;
      text-align: center;
    }
    .name{
      padding: 10px;
      text-align: center;
      width: 200px;
    }
    .profile{
      width:200px;
      height:200px;
      background-image: url("p.png");
      background-repeat: no-repeat;
      border-radius:8px;
    }
    .name1{
      color: #47043d;
      font-weight: bold;
    }
    .hell{
      background: #ffffff;
      padding-bottom: 25px;
      margin-left: 1.5px;
      margin-right: 1.5px;
      margin-bottom: 5px;
      border: 2px solid #f1f1f1;
      box-shadow: 4px;
      padding-top: 10px;
    }


    @media only screen and (max-width: 420px){
    .col {display:none ;
              }

            }

  </style>
  </head>
  <body style="background:#ffffff;">
    <div class="container" style="background:#f4f4f4;">
      <nav class="navbar navbar-default">
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
            <li><a href="https://goo.gl/forms/nWNDO0KdiAg4cbiF3">feedback</a></li>
             <li><a href="logout.php">Logout</a></li>
            </ul>
          </div>
        </div>
      </nav>
      <div class="row" style="border-bottom:13px solid #c8ff55">
        <div class="col-md-12" style="color:green;">

      </div>
        <div class="col-md-6">
            <h3>Welcome to Student Portal</h3>
        </div>
        <div class="col-md-6">
          <br>
  <button type="button" class="btn btn-danger " data-toggle="modal" data-target="#myModal">Help-Notice </button><br><br>

          <div class="modal fade" id="myModal" role="dialog">
          <div class="modal-dialog">


         <div class="modal-content">
             <div class="modal-header bg-primary">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
           <h4 class="modal-title">Important Notice</h4>
        </div>
         <div class="modal-body bg-danger">

           <h4>* Due to flash player incompetence with many browser, Results are in downloadable form and you can print it out later.</h4><br>
           <h4>* Online Payment will be available as per school guidance.</h4><br>
           <h4>* Self password recovery will be added in few months. Till then Y'all have to contact school for forgot-password case.</h4><br>
           <h4>* Keep your credentials safe and secure.</h4><br>
           <h4>* These information is authenticated by school authorities itself.</h4><br>
           <h4>* If there Any problem in these information, Please Contact to school.</h4><br>
           <h5>* <strong>Stay tuned for more upcoming updates.</strong></h5>
          </div>
       <div class="modal-footer bg-primary">
       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
         </div>
        </div>
       </div>
  </div>
    <!-- </div> -->
      </div><br>
<div class="row">

        <div class="col-md-6 " >
        <div class="row hell">
          <div class="col-xs-6">
            <div class="profile"><img src="http://vpsbihiya.byethost7.com/download.php?file=your_profile_picture.jpg" alt="upload" width="200" height="200" style="border:2px solid #f1f1f1; background:#ffffff; "></div>
            <a href="edit.php" target="_blank"><div class="dp">UPLOAD</div></a>
            <div class="name"><h3><?php echo "<span>Hello $first_name </span>"; ?></h3></div>
          </div>
          <div class="col-xs-6 col">

             <div class="name"><h3><?php echo "<div class='name1'>Welcome<br><br>To<br><br>PORTAL<br><br>&#8595 &#8595 &#8595</div>"; ?></h3></div>

          </div>
        </div>

        </div>
        <div class="col-md-6">
          <div class="panel panel-default " style="background:#ffffff; padding:10px;">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Students Details</th>
                <th><a href="edit.php" target="_blank">Edit <img src="image/edit.svg" alt="" style="width:12px; height:12px;"></a></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Name</td>
                <td><?php echo   htmlspecialchars($first_name); echo htmlspecialchars($last_name);?></td>
              </tr>
              <tr>
                <td>Father's Name:</td>
                <td><?php echo htmlspecialchars($father); ?></td>
              </tr>
              <tr>
                <td>UserName</td>
                <td><?php echo htmlspecialchars($username); ?></td>
              </tr>
              <tr>
                <td>Email</td>
                <td><?php if ($email) {
                  echo htmlspecialchars($email);
                }else {
                  echo "<a href='edit.php' target='_blank'><span class='update'>UPDATE YOUR EMAIL ASAP-</span></a>";
                }
                echo " "." ";
                  if ($active==0) {
                    echo "<span class='unverified'>UNVERIFIED</span>";
                  }else {
                    echo "<span class='verified'>VERIFIED</span>";
                  } ?></td>
              </tr>
              <tr>
                <td>Roll No:</td>
                <td><?php if ($roll) {
                    echo htmlspecialchars($roll);
                }else {
                  echo "<a href='edit.php' target='_blank'><span class='update'>UPDATE</span></a>";
                }
               ?></h5></td>
              </tr>
              <tr>
                <td>Class:</td>
                <td><?php echo htmlspecialchars($class); ?></td>
              </tr>
            <tr>
              <td>Contact:</td>
              <td><?php echo htmlspecialchars($contact); ?></td>
            </tr>
            <tr>
              <td>Address:</td>
              <td><?php echo htmlspecialchars($address); ?></td>
            </tr>

            </tbody>
          </table>
          </div>
        </div>
  </div>
      <div class="row">
        <div class="col-md-12">
          <h4>NOTICE</h4>
          <div class="panel panel-default" style="background:#ffffff; padding:10px;">
            <!-- <marquee width="70%" style="color:red;" >
              </marquee> -->
              <?php
                $notice_query="SELECT notice FROM fee WHERE id=1;";
                $notice_result=mysqli_query($conn,$notice_query);
                list($notice)=mysqli_fetch_array($notice_result);
                echo "<h5>".htmlspecialchars($notice)."</h5>";
              ?>

          </div>
        </div>
        <div class="col-md-12">
          <h3>Fee Report</h3>
          <div class="panel panel-default" style="background:#ffffff; padding:10px;">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Fee Details</th>
                  <th>In Rupees</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Tuition Fee</td>
                  <td><?php echo htmlspecialchars($tuition); ?></td>
                </tr>
                <tr>
                  <td>Hostel Fee</td>
                  <td><?php echo htmlspecialchars($hostel); ?></td>
                </tr>
                <tr>
                  <td>Transport Fee</td>
                  <td><?php echo htmlspecialchars($transport); ?></td>
                </tr>
                <tr>
                  <td>Fine</td>
                  <td><?php echo htmlspecialchars($fine); ?></td>
                </tr>
                <tr>
                  <td>Total Fee</td>
                  <td><?php $total= $tuition + $hostel + $transport +$fine;  echo htmlspecialchars($total);?> -- <a href="#" onclick="myFee();">click-to-pay-Online</a></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-md-12">
          <h2>Performance Letter</h2>
         <div class="panel panel-default" style="background:#ffffff; padding:10px;">
           <h4>Results</h4>
           <?php //For Download link
           $path ="uploads/$username";
           if ($handle = opendir($path)) {
               while (false !== ($entry = readdir($handle))) {
                   if ($entry != "." && $entry != "..") {
                     ?>
                       <!-- echo "<a href='download.php?file=".$entry."'>".$entry."</a>\n"; -->
                       <table class="table table-striped">
                         <thead>
                           <tr>
                             <th></th>
                           </tr>
                         </thead>
                         <tbody>
                           <tr >
                             <td class="link"> <a  href="download.php?file=<?php echo htmlspecialchars($entry);?>"><?php echo htmlspecialchars($entry); ?>&nbsp<img src="../image/download.png" alt="download" width="20" height="20"></a></td>
                           </tr>
                         </tbody>
                       </table>

                   <?php
                   }
               }
               closedir($handle);
           }
           ?>
         </div>
          </div>

      </div>
      <footer style="padding:20px; background:">
         VPS Bihiya Copyright &copy; 2017
      </footer>
    </div>

  </body>
</html>
