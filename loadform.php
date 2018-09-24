<?php
  
  require('server.php');

  if($_GET['hotel']){
    $restaurant = $_GET['hotel'];
  }
  
?>
<?php if(isset($_SESSION['userName'])) : ?> 
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
<div style = "background-image:url('images/image24.jpg'); min-height:100%;position:relative;background-position:center;background-size:cover;background-repeat:no-repeat;background-attachment:fixed;height:1050px;"> 
  
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
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
  
 <div class = "container" style ="padding-top: 5%;padding-right: 0px;padding-left: 0px;padding-bottom: 3%;border: solid;border-color: #000;border-width: 1px; margin: auto; align-self: center;margin-top: 5%;">
      <form method = "POST" style = "width: 60%; margin:auto;" action ="loadform.php?hotel=<?php echo $restaurant; ?>">
        <div class = "form-group" style = "color:#000;text-align: center;margin-bottom:10%;">
          <h2><strong>Book a table</strong></h2>
        
        </div>

         
       <div class = "form-group">
          <label style="color:#000;">Restaurant : </label>
          <input class="form-control" type="text" name="resname" value="<?php echo $restaurant;?>" readonly="readonly">
        </div>

        <div class = "form-group">
          <label style="color:#000;">Name : </label>
          <input type="text" name = "name" class ="<?php echo $nameClass;?>" placeholder="Table will be reserved in this name" value="<?php echo isset($_POST['name']) ? $name : "";?>">
          <div class = "invalid-feedback"><?php echo $nameComment; ?></div>
          <div class = "valid-feedback">Looks Good!</div>
        </div>
          
        
        <div class = "form-group">
          <label style="color:#000;">Date & Time:</label>
          <input type="datetime-local" name="time" class="<?php echo $timeClass ; ?>" value="<?php echo isset($_POST['time']) ? $time : "";?>">
          <div class = "invalid-feedback"><?php echo $timeComment; ?></div>
          <div class = "valid-feedback">Looks Good!</div>  
        </div> 

        <div class = "form-group">
          <label style="color:#000;">Table for:</label>
          <input type="number" name="number" min="1" max="25" class ="<?php echo $numberClass; ?>" value="<?php echo isset($_POST['number']) ? $number : "";?>" placeholder = "Number of people">
          <div class = "invalid-feedback"><?php echo $numberComment; ?></div>
          <div class = "valid-feedback">Looks Good!</div>  
        </div> 

        <div class = "form-group">
          <label style="color:#000;">Password: </label>
          <input type="password" name = "password" class = "<?php echo $passClass;?>" placeholder="Password">
          <div class = "invalid-feedback"><?php echo $passComment; ?></div>
         
        </div>

        <div class="row">
          <div class = "col">
            <div style = "margin-left: 34%;margin-top: 30px;">
              <button type = "submit" class = "btn btn-dark" style="width:200px;"  data-toggle="modal" data-target ="#confirm"  name ="reserve" >Reserve</button>
            </div>
          </div>
        </div>
        
      </form>
  </div>
</div>
  


  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
   
</body>
</html>
<?php endif; ?>