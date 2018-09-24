

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
	<title>Booking</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">


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
		      <!-- 	<li class="nav-item"><a href="activity.php" class = "nav-link">Activity</a></li> -->
		      	<li class="nav-item"><a href="main.php" class = "nav-link" style="color:#fff;">Home</a></li>
		      	<li class="nav-item"><a href="reservation.php" class = "nav-link" >Reservations</a></li>
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


	   
<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
		 

<div style = "background-image:url('images/image5.jpeg'); min-height:100%;position:relative;opacity:1;background-position:center;background-size:cover;background-repeat:no-repeat;background-attachment:fixed;">

<div class = "container" style="padding-top:5%;">
	
	<div class="row">
		<div class="col-sm-6">
			<h1 id="demo" style="color:#fff;padding-top:3%;padding-left:3%;">Find restaurants Nearby</h1>
		</div>
		<div class="col-sm-6">
			<button class="btn btn-outline-light" style = "margin:10px;width:20%;margin-top:4%;" onclick="getSearchLocation()">Find</button>
		</div>
	</div>
	

	<div id="mapholder" style ="padding-top: 5%;padding-right: 0px;padding-left: 0px;padding-bottom: 5%;border-radius: 10px;border-width: 5px; margin: auto;margin-top: 5%;margin-bottom: 5%; align-self: center; height :500px;"></div>


	
	<div class="container" id = "box">
		<div class="card">
		  <div id="body" class="card-header"></div>
		  <div id = "content" class="card-body"></div>
		</div>
	</div>
	

</div>
</div>

<script src="https://maps.google.com/maps/api/js?key=AIzaSyDSZgBUR2iVElAJ7uYHwHkb_BVPQODdmUk"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDSZgBUR2iVElAJ7uYHwHkb_BVPQODdmUk&libraries=places"></script>

<script>
    var x = document.getElementById("demo");
    var map;
    var infowindow;
    


    function getSearchLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showSearchPosition, showError);
        } else { 
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }
    
    function showError(error) {
        switch(error.code) {
            case error.PERMISSION_DENIED:
                x.innerHTML = "User denied the request for Geolocation."
                break;
            case error.POSITION_UNAVAILABLE:
                x.innerHTML = "Location information is unavailable."
                break;
            case error.TIMEOUT:
                x.innerHTML = "The request to get user location timed out."
                break;
            case error.UNKNOWN_ERROR:
                x.innerHTML = "An unknown error occurred."
                break;
        }
    }
 

    function showSearchPosition(position) {
        
        var service;
        
        var lat = position.coords.latitude;
        var lon = position.coords.longitude;
        var latlon = new google.maps.LatLng(lat, lon)
        var mapholder = document.getElementById('mapholder')
        mapholder.style.height = '500px';
        mapholder.style.width = '100%';

        infowindow = new google.maps.InfoWindow();
        map = new google.maps.Map(document.getElementById('mapholder'), {
          center: latlon,
          zoom: 16
        });

        var request = {
            location: latlon,
            radius: '500',
            query: 'restaurant'
          };

          service = new google.maps.places.PlacesService(map);
          var marker = new google.maps.Marker({position:latlon,map:map,animation: google.maps.Animation.DROP,title:"You are here!"});
          service.textSearch(request, callback);
    }
    var i;

    function callback(results, status) {
      if (status == google.maps.places.PlacesServiceStatus.OK) {
        for (var i = 0; i < results.length; i++) {
          var place = results[i];
          console.log(results[i]);
          createMarker(results[i], i);
          
        }
      }
    }

    function createMarker(place, i) {
        var placeLoc = place.geometry.location;
        var marker = new google.maps.Marker({
          map: map,
          position: place.geometry.location,
          icon: "https://maps.gstatic.com/mapfiles/place_api/icons/restaurant-71.png"

        });

            google.maps.event.addListener(marker, 'click', function() {
                // infowindow = new google.maps.InfoWindow({
                //     content:'<h1>Place:</h1>'+place.name
                // });
                var status;
                if(place.opening_hours ){
                    var status = "Open";
                }else{
                    var status = "Closed";
                }

               infowindow.setContent('<h4><u>Place:</u></h4><h6>'+place.name+'</h6><h4><u>Status:</u></h4><h6>'+status+'<h6><br><br><button class="btn btn-primary" id = "rest'+i+'">View Details</button>');
               infowindow.open(map, this);
               console.log(i);
               var res = "rest"+i;
               $('#'+res).on('click',function(){
					const box=$('#box').position().top;

					$('html,body').animate({
						scrollTop:box
					},
					900
					);
				});
               document.getElementById(res).addEventListener('click', function reserve(){
               			
                        console.log(place.name);
                        body.innerHTML ="<h5 style='color:#000;'>Restaurant</h5>"
                        content.innerHTML = '<h5 style="color:#000;" class="card-title">'+place.name+'</h5><hr>'
                        content.innerHTML +='<p style="color:#000;" class="card-text">Address: '+place.formatted_address+'</p>'
                        content.innerHTML += '<h6 style="color:#000;" class="card-text">Rating: '+place.rating+'</h6><br>'
                        content.innerHTML += '<a href="loadform.php?hotel='+place.name+'" class = "btn btn-primary">Book a table</a>'
                        content.innerHTML += '<button class="btn btn-primary" id = "'+place.name+'" style = "margin-left:10%;">View reviews</button><a href="write.php?resname='+place.name+'" class="btn btn-primary" style = "margin-left:10%;">Write Review</a><br><br><div id ="res"></div>'
                        // content.innerHTML += '<a href="#" class="btn btn-primary">Reserve a table</a>'
                        // body.innerHTML +="<a href='https://maps.googleapis.com/maps/api/place/photo?maxwidth=400&photoreference="+place.reference+"&key=AIzaSyDSZgBUR2iVElAJ7uYHwHkb_BVPQODdmUk'>Photo</a>"
                
                        document.getElementById(place.name).addEventListener('click',function comments(){
                        // com.innerHTML = '<a href="#content" class="btn btn-primary" id="some'+place.formatted_address+'">Back</a> ';

		                	var form = new XMLHttpRequest();
								  form.onreadystatechange = function() {
								    if (this.readyState == 4 && this.status == 200) {
								      document.getElementById("res").innerHTML = this.responseText;
								      console.log("success");
								    }
								  };
								  form.open("GET", "comments.php?resname="+place.name, true);
								  form.send();
						
						// var rest = "some"+place.formatted_address;
						// document.getElementById(rest).addEventListener('click',function back(){

						// 	com.innerHTML = '<a href="#content"class="btn btn-primary" id = "'+place.name+'">Book</a>';
						// 	res.innerHTML = '';

						// });

						});

                       
						
						                       
				});




         });


      }

     
   

</script>
	

  	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>
</html>
<?php endif; ?>