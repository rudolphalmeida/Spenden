<!DOCTYPE html>
<html>
	<head>
        <?php

            if(isset($_POST) && isset($_POST["fullname"])) {

                $fullname = $_POST["fullname"];
                $mobileno = $_POST["mobileno"];
                $email = $_POST["email"];
                $bloodgroup = $_POST["bloodgroup"];
                $city = $_POST["city"];

                mysql_connect("localhost", "root") or die(mysql_error());
                mysql_select_db("bloodbank") or die(mysql_error());

                $maxid = mysql_query("select max(requestid) from requests") or die(mysql_error());
                $maxid = mysql_fetch_array($maxid);
                $maxid = $maxid[0] + 1;

                $query = "insert into requests(requestid,name,email,mobileno,bloodgroup,city) values(".$maxid.",'".$fullname."','".$email."','".$mobileno."',".$bloodgroup.",".$city.")";

                mysql_query($query) or die(mysql_error());

                $flag = 1;

                mysql_close();

            } else {

                $flag = 0;

            }



        ?>
	    <title>Spenden - Request Blood</title>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device.width, initial-scale=1">

		<script type="text/javascript" src="jquery3.1.1.js"></script>
		<script type="text/javascript" src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

		<script type="text/javascript">
      
        window.onload = successdiv;

        function successdiv() {
            var flag = <?php if(isset($_POST)) { echo $flag; } else { echo 0;} ?>;
            if(flag == 1) {
                $("#success").show();
            } else {
                $("#success").hide();
            }
        }

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
            	<h2 id="header-name" style="font-size: 46px; font-family: Algerian">Spenden - Request Blood</h2>
            </div>
        	<div class="col-md-4"></div>
    	</div>
	</div>
	<div class="container-fluid" style="padding-bottom: 55px;">
        <div class="row" id="success">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="alert alert-success">
                    Request Submitted!
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4 well" style="background-color: white">
				<form id="requestForm" method="post" action="requestblood.php">
					<div class="form-group">
                        <label for="name">Name:</label>
                    	<input type="text" class="form-control" id="name" name="fullname" placeholder="Enter Full Name">
                    </div>
                    <div class="form-group">
                    	<label for="mobileno">Mobile Number:</label>
                        <input type="text" name="mobileno" id="mobileno" class="form-control" placeholder="Enter Mobile Number">
                    </div>
                    <div class="form-group">
                    	<label for="email">Email:</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email Id">
                    </div>
                    <div class="form-group">
                        <label for="bloodgroup">Select Blood Group:</label>
                        <select class="form-control" id="bloodgroup" name="bloodgroup">
                            <option value="1">A+</option>
                            <option value="2">A-</option>
                            <option value="3">B+</option>
                            <option value="4">B-</option>
                            <option value="5">O+</option>
                            <option value="6">O-</option>
                            <option value="7">AB+</option>
                            <option value="8">AB-</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="city">Select City:</label>
                        <select class="form-control" id="city" name="city">
                        	<option value="1">Allahabad</option>
                            <option value="2">Aurangabad</option>
                            <option value="3">Bangalore</option>
                            <option value="4">Baroda</option>
                            <option value="5">Chandigarh</option>
                            <option value="6">Chennai</option>
                            <option value="7">Delhi</option>
                            <option value="8">Guwahati</option>
                            <option value="9">Hyderabad</option>
                            <option value="10">Indore</option>
                            <option value="11">Jaipur</option>
                            <option value="12">Kolkata</option>
                            <option value="13">Lucknow</option>
                            <option value="14">Mumbai</option>
                            <option value="15">Mysore</option>
                            <option value="16">Nasik</option>
                    	    <option value="17">Pune</option>
                            <option value="18">Ranchi</option>
                            <option value="19">Surat</option>
                            <option value="20">Udaipur</option>
                            <option value="21">Varanasi</option>
                            <option value="22">Vishakhapatnam</option>
                        </select>
                	</div>
                	<div class="form-group">
                    	<div class="alert alert-info">
                            <input type="checkbox" onchange="document.getElementById('requestbutton').disabled = !this.checked;"/>
                                I accept the term's that my contact details will be broadcast on this site
                        </div>
                    </div>
                	<div class="form-group">
                    	<input type="submit" value="Request" class="btn btn-primary" id="requestbutton" disabled>
                   	</div>
				</form>
			</div>
			<div class="col-md-4"></div>
		</div>
	</div>
    <!--Navigation Bar-->
    <nav class="navbar navbar-inverse navbar-fixed-bottom">
    	<div class="container-fluid">
        	<div class="navbar-header">
            	<a class="navbar-brand" href="index.html">Spenden</a>
            </div>
            <ul class="nav navbar-nav">
            	<li><a href="index.html">Search Blood</a></li>
            	<li class="active"><a href="requestblood.php">Request Blood</a></li>
            	<li><a href="register.php">Registration</a></li>
            	<li><a href="donorlist.php">Donor Directory</a></li>
            	<li><a href="banklist.php">Bank Directory</a></li>
            	<li><a href="bloodtips.php">Blood Tips</a></li>
               	<li><a href="aboutus.php">About Us</a></li>
            </ul>
    	</div>
	</nav>
</body>
</html>