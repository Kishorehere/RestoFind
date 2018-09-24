

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

?>


<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style1.css">
	<title>Gallery</title>


</head>
<body>


	<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
		    <a href="#" class="navbar-brand">Resto-Find</a>
		    <a href="#" class="navbar-brand" style ="padding-left: 2%;"><small>Hello <?php echo $value['firstName']; ?> !</small></a>
		    <button class = "navbar-toggler" data-toggle = "collapse" data-target="#menu">
		    <span class="navbar-toggler-icon"></span>
		    </button>
		    <div class ="collapse navbar-collapse" id = "menu">
		      	<ul class="navbar-nav ml-auto" >
		      	<li class="nav-item"><a href="main.php" class = "nav-link" style="color:#fff;">Home</a></li>
		      	<li class="nav-item"><a href="booking.php" class = "nav-link" style="color:#fff;">Booking</a></li>
		      	<li class="nav-item"><a href="reservation.php" class = "nav-link" style="color:#fff;">Reservations</a></li>
		        <li class="nav-item"><a href="#" data-toggle="modal" data-target ="#demo" class = "nav-link" style="color:#fff;" >Profile</a></li>
		        <li class="nav-item"><a href="server.php?exit='1';" class = "nav-link" style="color:#fff;">Logout</a></li>
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




	<main>
		<div id="landing">
			<div id ="landingText">
				<div id="landingTeatInner">
					<h1>From the Finest Chefs</h1>
					<h2>Photos from the onsite outlets</h2>
					<a href="#" class= "btn" id="view">
						View-Photos
					</a>
				</div>
			</div>
			<div id="landingImage"></div>

		</div>

		<div id="images">
			<div id ="header">
				<h2>OUR PLACE</h2>
				
			</div>
			<img src="https://source.unsplash.com/1600x900/?restaurant,coffee" alt="">
			<div class="caption">
				<h3>IN-HOUSE CAFE</h3>
				<p> Have a whole lot of fun over steaming cups of great coffe</p>
			</div>

			
			<img src="https://source.unsplash.com/1600x900/?restaurant,brunch" alt="">
			<div class="caption">
				<h3>BRUNCH</h3>
				<p>Find a decadent twists on the regulars…like the stuffed french toast, blueberry bliss cakes and berry explosion waffle.</p>
			</div>

			
			<img src="https://source.unsplash.com/1600x900/?restaurant,food" alt="">
			<div class="caption">
				<h3>MULTI-CUISINE</h3>
				<p>Feel home outside, or the vice-versa.</p>
			</div>

			<img src="https://source.unsplash.com/1600x900/?restaurant,dining" alt="">
			<div class="caption">
				<h3>CLASS</h3>
				<p>Good ambiance balances aesthetics with customer comfort.</p>
			</div>

			<img src="https://source.unsplash.com/1600x900/?restaurant,music" alt="">
			<div class="caption">
				<h3>EXPERIENCE</h3>
				<p>While you releash the spread, let the soft music playing in the back ground takeover your senses</p>
			</div>
			
		</div>
	</main>
	<footer>
		<h3>Get in Touch</h3>
		<p>To book a reservation or just to connect with us:</p>
		<p>Email: <strong>restofind@gmail.com</strong></p>
		<p>Phone: <strong>(044) 12345678 </strong></p>
	</footer>


	

  
  	<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  <script type="text/javascript" src="script.js"></script>
  
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>
</html>
<?php endif; ?>