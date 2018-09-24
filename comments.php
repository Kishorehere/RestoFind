<?php
  
  require('server.php');
  if(isset($_GET['resname'])){
    $resname = $_GET['resname'];
    $query_2 ="SELECT * FROM comments WHERE resname ='$resname' ORDER BY ctime DESC;";
    $result_2 =mysqli_query($conn, $query_2);
    $comments = mysqli_fetch_all($result_2, MYSQLI_ASSOC);
    mysqli_free_result($result_2);  
  }
?>
<?php if(isset($_SESSION['userName'])) : ?> 
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
      

  
 <div class = "container" style ="padding-top: 5%;padding-right: 0px;padding-left: 0px;padding-bottom: 5%;border: solid;border-color: #000;border-width: 1px; margin: auto; align-self: center;margin-top: 5%;">

          <div style="margin-left:5%;margin-top:3%;">
            <h1 style ="color:black;"><strong>Comments :</strong></h1> 
          </div>
          <div style = "width: 80%; margin:auto;margin-top:5%;" >
             <?php foreach($comments as $comment) : ?>
              <div class="card">
                  <div class="card-header">
                   By : <?php echo $comment['username']; ?>
                  </div>
                  <div class="card-body">
                    <h4 class="card-title">Comment : <?php echo $comment['comment']; ?></h4>
                    <h6 class="card-title">Rating : <?php echo $comment['rating']; ?></h6>
                    <p class="card-text">Posted On : <?php echo $comment['ctime']; ?></p>  
                  </div>
              </div>
              <br>              
            <?php endforeach ; ?>
          </div>     
  </div>

  
 
 <!--   function write(){
       var comment = document.getElementById('line').value;
       var rating = document.getElementById('rating').value;
       var resname = "<?php echo $resname; ?>";
       console.log("comment");

       var form = new XMLHttpRequest();
       form.open("GET", "write.php?comment="+comment+"&rating="+rating+"&resname="+resname, false);
       form.send();

     } -->

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
   
</body>
</html>
<?php endif; ?>