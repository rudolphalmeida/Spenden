<!DOCTYPE html>
<html>
	<head>
		<title>Spenden - Donor List</title>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device.width, initial-scale=1">

		<script type="text/javascript" src="jquery3.1.1.js"></script>
		<script type="text/javascript" src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

		<script type="text/javascript" src="bloodbankscript.js"></script>
        <script type="text/javascript">
        	$(document).ready(function() {
        	    $('#navbuttons li:nth-child(4)').addClass('active');
        	});
    	</script>

		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" type="text/css" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
	</head>
	<body background="background/az_subtle_@2X.png">
		<div class="jumbotron" style="background-color: #d6351e; margin-bottom: 25px;">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-1">
                    <img src="blood_donation-512.png" height="100px" width="100px" class="img-rounded img-responsive">
                </div>
                <div class="col-md-6">
                    <h2 id="header-name" style="font-size: 46px; font-family: Algerian">Spenden - Donor List</h2>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
        <div class="container">
            <div class="row" style="padding-bottom: 50px;">
            <div class="col-md-3"></div>
            <div class="col-md-6">
        	<?php
                $bloodgroup = ['A+','A-','B+','B-','O+','O-','AB+','AB-'];
                $cities = ['Allahabad','Aurangabad','Bangalore','Baroda','Chandigarh','Chennai','Delhi','Guwahati','Hyderabad','Indore','Jaipur','Kolkata','Lucknow','Mumbai','Mysore','Nasik','Pune','Ranchi','Surat','Udaipur','Varanasi','Vishakhapatnam'];
        		mysql_connect("localhost","root") or die(mysql_error());
				mysql_select_db("bloodbank") or die(mysql_error());
				$query = "select * from donors order by name";
				$result = mysql_query($query) or die(mysql_error());
				if(mysql_num_rows($result) > 0 ) {
					while ($row = mysql_fetch_array($result)) {
						if($row["donorid"] == 0) {
							continue;
						}
						$name = $row["name"];
						$mobile = $row["mobileno"];
						$email = $row["email"];
						$blood = $bloodgroup[$row["bloodgroup"] - 1];
						$city = $cities[$row["city"] - 1];
						echo "<div class='well' style='background-color: white'>";
						echo "<div class='media'>";
						echo "<div class='media-left'>";
						echo "<img src='default-".$row['gender'].".png' class='media-object' style='width: 75px; height: 75px'>";
						echo "</div>";
						echo "<div class='media-body'>";
						echo "<h4 class='media-heading'>".$name."</h4>";
						echo "<div style='padding-bottom: 5px'><span class='glyphicon glyphicon-phone'></span> ".$mobile."<br></div>";
						echo "<div style='padding-bottom: 5px'><span class='glyphicon glyphicon-envelope'></span> ".$email."<br></div>";
						echo "<div style='padding-bottom: 5px'><span class='glyphicon glyphicon-heart'></span> ".$blood."<br></div>";
						echo "<div style='padding-bottom: 5px'><span class='glyphicon glyphicon-map-marker'></span> ".$city."<br></div>";
						echo "</div>";
						echo "</div>";
						echo "</div>";
					}
				} else {
					echo "No Registered Donors";
				}
				mysql_close();
        	?>    
            </div>
            <div class="col-md-3"></div>
            </div>
        </div>
        <?php
            session_start();
        
            if(isset($_SESSION["loggedas"])) {
                if($_SESSION["loggedas"] == "donor") {
                    include 'loggeddonor.php';
                } else {
                    include 'loggedbank.php';
                }
            } else {
            	session_destroy();
                include 'defaultnav.php';
            }
        ?>
	</body>
</html>