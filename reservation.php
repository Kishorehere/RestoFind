
<?php
  
  require('server.php');

?>
<?php if(isset($_SESSION['userName'])) : ?> 
<?php

    $userName = $_SESSION['userName'];
    $query_1= "SELECT * FROM users WHERE username ='$userName';";
    $result_1 =mysqli_query($conn, $query_1);
    $value = mysqli_fetch_assoc($result_1);
    mysqli_free_result($result_1);  


    $query_2= "SELECT * FROM reservation WHERE username='$userName' ORDER BY ontime DESC;";
    $result_2 =mysqli_query($conn, $query_2);
    $reservations = mysqli_fetch_all($result_2, MYSQLI_ASSOC);
    mysqli_free_result($result_2);

    if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query_3 ="DELETE FROM reservation WHERE id = '$id';";
    $result_3 =mysqli_query($conn, $query_3);
    }  


    $idd="";
 

    date_default_timezone_set('Asia/Kolkata');

  
  
?>
<!DOCTYPE html>
<html>
<head>
  <title>User Registeration</title>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
<div style = "background-image:url('images/image32.jpg'); min-height:100%;position:relative;background-position:center;background-size:cover;background-repeat:no-repeat;background-attachment:fixed;height:1050px;"> 
  
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a href="#" class="navbar-brand">Resto-Find</a>
        <?php if(isset($_SESSION['userName'])) : ?>
        <a href="#" class="navbar-brand" style ="padding-left: 2%;"><small>Hello <?php echo $value['firstName']; ?> !</small></a>
        <?php endif; ?>
        <button class = "navbar-toggler" data-toggle = "collapse" data-target="#menu">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class ="collapse navbar-collapse" id = "menu">
            <ul class="navbar-nav ml-auto" >
            <li class="nav-item"><a href="main.php" class = "nav-link" >Home</a></li>
            <li class="nav-item"><a href="booking.php" class = "nav-link" >Book</a></li>
            <li class="nav-item"><a href="gallery.php" class = "nav-link">Gallery</a></li>
            <li class="nav-item"><a href="#" data-toggle="modal" data-target ="#demo" class = "nav-link">Profile</a></li>
            <li class="nav-item"><a href="server.php?exit='1';" class = "nav-link">Logout</a></li>
            </ul>
        </div>
    </nav>
    

    <div class="modal fade" id = "demo">
        <div class ="modal-dialog">
          <div class = "modal-content">
            
            <div class = "modal-header">
              <h2 class = "modal-title">Profile</h2>
              <span type ='button' class = "close" data-dismiss = "modal">&times;</span>
            </div>
            <div class = "modal-body">
              
              <table class="table table-dark">
          <tbody>
            <tr >
              <th scope="row">Name: </th>
              <td ><?php echo $value['name']; ?></td>
              
            </tr>
            <tr class="bg-primary">
              <th scope="row">E-mail: </th>
              <td><?php echo $value['email']; ?></td>
             
            </tr>
            <tr class="bg-danger">
              <th scope="row">Username: </th>
              <td><?php echo $userName; ?></td>
              
            </tr>
          </tbody>
        </table>
           
            </div>
            <div class = "row" style ="padding-top: 0;padding-bottom: 1.5rem;padding-left: 1rem;">
            <div class = "col-md-6 col-sm-6 col-xs-6">
               <a href="editProfile.php"><button type = "button" class = "btn btn-success" >Edit Profile</button></a>
            </div>
            <div class = "col-md-6 col-sm-6 col-xs-6">
                 <a href="changePass.php"><button type = "button" class = "btn btn-success" >Change Password</button></a>
              </div>
            </div>

          </div>
        </div>
      </div>

<!--        <div class="modal fade" id = "confirm"> 
        <div class ="modal-dialog">
          <div class = "modal-content">
            
            <div class = "modal-header">
              <h2 class = "modal-title" style="color:red;">Cancel Reservation?</h2>
              <span type ='button' class = "close" data-dismiss = "modal">&times;</span>
            </div>
            <div class = "modal-body" id = "mod">
              
            </div>
            <div class = "modal-footer">

              <a class = "btn btn-danger" href="reservation.php">Confirm</a> 
            </div>

          </div>
        </div>
      </div> -->

  



 <div class = "container" style ="padding-top: 5%;padding-right: 0px;padding-left: 0px;padding-bottom: 3%; margin: auto; align-self: center;margin-top: 5%;">
   <h1 style="color:#fff;"><strong>Your Reservations :</strong></h1>
    <table class="table table-dark" style="margin-top:3%;">   
       <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Restaurant</th>
            <th scope="col">Reserved for</th>
            <th scope="col">Reserved at</th>
            <th scope="col">Number of People</th>
          </tr>
        </thead>
      <tbody>
        <?php $w = 0;?>
        <?php foreach($reservations as $reservation) : ?>
          <?php if($reservation['rtime']>date("Y-m-d H:i:s")){
            $resClass = "bg-success";
          }else{
            $resClass="bg-danger";
          }
         $w =$w +1;
         ?> 
        <tr class="<?php echo $resClass; ?>">
          <th scope="row"><?php echo $w; ?></th>
          <td ><?php echo $reservation['name']; ?></td>
          <td><?php echo $reservation['resname']; ?></td>
          <td><?php echo $reservation['rtime']; ?></td>
          <td><?php echo $reservation['ontime']; ?></td>
          <td><?php echo $reservation['rnumber']; ?></td>
          <?php if($reservation['rtime']<date("Y-m-d H:i:s")) : ?>
          <td><a class = "btn btn-outline-dark" href="reservation.php?id=<?php echo $reservation['id']; ?>">Remove reservation</a></td>
          <?php endif; ?>
          <?php if($reservation['rtime']>date("Y-m-d H:i:s")) : ?>
            <td><a class = "btn btn-outline-dark" href="reservation.php?id=<?php echo $reservation['id']; ?>">Cancel reservation</a></td>
          <?php endif; ?>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
      
  </div>
</div>
  


  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
   
</body>
</html>
<?php endif;?>