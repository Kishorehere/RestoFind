<?php 
 
 if(isset($_POST['resname'])){
	$resname = $_POST['resname'];
} 
	
require('server.php');
?>
<?php if(isset($_SESSION['userName'])) : ?>
<?php	
$userName = $_SESSION['userName'];

if(isset($_GET['resname'])){
$resname = $_GET['resname'];

$query_2 ="SELECT * FROM comments WHERE resname ='$resname' ORDER BY ctime DESC;";
$result_2 =mysqli_query($conn, $query_2);
$comments = mysqli_fetch_all($result_2, MYSQLI_ASSOC);
mysqli_free_result($result_2);  
}

if(isset($_POST['resname'])){
$resname = $_POST['resname'];
$query_3 ="SELECT * FROM comments WHERE resname ='$resname' ORDER BY ctime DESC;";
$result_3 =mysqli_query($conn, $query_3);
$comments = mysqli_fetch_all($result_3, MYSQLI_ASSOC);
mysqli_free_result($result_3);  
}


  
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">

</head>
<body style="background-color: #000;">
<div style = "background-image:url('images/image17.jpg'); min-height:100%;position:relative;opacity:1;background-position:center;background-size:cover;background-repeat:no-repeat;background-attachment:fixed;min-height:100%;">
	 <nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top">
	      <a href="#" class="navbar-brand">Resto-Find</a>
	      <button class = "navbar-toggler" data-toggle = "collapse" data-target="#menu">
	        <span class="navbar-toggler-icon"></span>
	      </button>
	      <div class ="collapse navbar-collapse" id = "menu">
	          <ul class="navbar-nav ml-auto" >
	          <li class="nav-item"><a href="booking.php" class = "nav-link">Back</a></li>
	          </ul>
	      </div>
	  </nav>
  
  

 <div class = "container" style ="padding-top: 10%;padding-right: 0px;padding-left: 0px;padding-bottom: 5%;border: solid;border-color: #000;border-width: 1px; margin: auto;align-self: center;margin-top:0;"> 

	  <div style="margin-top:0;margin-left:3%;margin-bottom: 2%;">
	      <h1 style ="color:black;"><strong>Your comment :</strong></h1> 
	  </div>

      

	  	<div class="card" style="width:80%;margin:auto;">
		  <div class="card-header">
		    <?php echo $userName; ?>
		  </div>
		  <div class="card-body">
		    <h5 class="card-title"><?php echo $resname; ?></h5>
		     <form method = "POST" action = "write.php?resname=<?php echo $resname; ?>" class="card-text" style="margin-bottom: 3%;" >   
				  <div class="row justify-content-start" style ="margin-left:0;margin-top: 30px;">
				        <strong style="margin-top:5px;margin-left:0;">Comment :</strong>
				        <div class="col-md-4">
				              <textarea name="com" rows="1" class ="<?php echo $comClass;?>"  placeholder="Enter comment" ></textarea>
				              <div class = "invalid-feedback"><?php echo $comComment; ?></div>
				        </div>
				        <strong style="margin-top:5px;">Rating :</strong>
				        <div class="col-md-3"> 
				            <select class="custom-select mr-sm-2" name="rating">
				              <option value="1">1</option>
				              <option value="2">2</option>
				              <option value="3">3</option>
				              <option value="4">4</option>
				              <option value="5">5</option>  
				            </select>
				        </div>
				        <div class="col-md-2">
				        	<button  style="width:100px;" type = "submit" class = "btn btn-primary" name ="rescom">Post</button>
				        </div>
				   </div> 	
				   <input type="hidden" name="resname" value="<?php echo $resname; ?>" />	       
			 </form>
		  </div>
		</div>

	</div>


  
 <div class = "container" style ="padding-top: 5%;padding-right: 0px;padding-left: 0px;padding-bottom: 5%;border: solid;border-color: #000;border-width: 1px; margin: auto; align-self: center;margin-top: 5%;">

          <div style="margin-left:5%;margin-top:1%;">
            <h1 style ="color:black;"><strong>Comments :</strong></h1> 
          </div>
          <div style = "width: 80%; margin:auto;margin-top:5%;" >
             <?php foreach($comments as $comment) : ?>
              <div class="card">
                  <div class="card-header" style="color:#000;">
                   By : <?php echo $comment['username']; ?>
                  </div>
                  <div class="card-body">
                    <h4 class="card-title" style="color:#000;">Comment : <?php echo $comment['comment']; ?></h4>
                    <h6 class="card-title" style="color:#000;">Rating : <?php echo $comment['rating']; ?></h6>
                    <p class="card-text">Posted On : <?php echo $comment['ctime']; ?></p>  
                  </div>
              </div>
              <br>              
            <?php endforeach ; ?>
          </div> 

  </div>

 

</div> 
 

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
   
</body>
</html>
<?php endif; ?>