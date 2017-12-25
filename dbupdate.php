<?php
$conn=new mysqli("localhost","root","","accounts");
if($conn->connect_error){
  die("conn failed:".$conn->connect_error);
}
$sql = "SELECT id,name,content FROM upload;";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>update/Home</title>
    <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
  <link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">

  </head>
  <body>
    <div class="container">
      <h2>CLASS 5 database</h2>
      <h3>Students</h3>
      <div class="row">
        <div class="col-md-3 ">
          <?php
          if($result->num_rows>0){
            echo "<table><tr><th>ID</th><th>Name</th></tr>";
            while ($row=$result->fetch_assoc()) {
              echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."".$row["content"]."</td></tr>";}
              echo "</table>";
            }else {
              echo "0 results";
            }
          $conn->close();


          ?>
        </div>
        <div class="col-md-3 ">
          Name:
        </div>
        <div class="col-md-3 ">
          Result:
        </div>
        <div class="col-md-3 ">
          Fee:
        </div>
      </div>
    </div>

  </body>
</html>
