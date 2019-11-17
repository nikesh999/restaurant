<?php
include_once('conf.php');
ini_set('upload_max_filesize', '10M');
ini_set('post_max_size', '10M');
$target_path = "images/";
if(isset($_POST['saveItem'])){
	$name = $_POST['name'];
	$price = $_POST['price'];
	$img = $_FILES['image']['name'];
	$target_path = $target_path.$img;
	$insert = "insert into menu(NAME,PRICE,IMG) values('$name','$price', '$img')";
	if(mysqli_query($conn, $insert)){
		move_uploaded_file($_FILES['image']['name'], $target_path);
		echo "<script> alert('Menu item has been added.') </script>";
	}
	else{
		echo "<script> alert('Image cannot be stored.') </script>";
	}
}

?>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport", content="width=device-width, initial-scale=1">
	<title>Log In</title>
	<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="static/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="static/css/custom.css">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<style type="text/css">
		a:hover{
			text-decoration: none;
			color: white;
		}
	</style>
</head>
<body style="font-family:palatino-linotype">
	<div class="bg-img bg-img1 center" id="login" style="display:none;">
		<div class="container">
	        <div class="row justify-content-center align-items-center" style="height:100vh">
	            <div class="col-4">
	                <div class="card" style="background-color: transparent;border-width: 0px;">
	                    <div class="card-body">
	                    	<h4> Please make sure you are admin, Add your credentials. </h4>
	                        <form action="" autocomplete="off">
	                            <div class="form-group">
	                                <input type="text" id="username" class="form-control" name="username" placeholder="Enter Username">
	                            </div>
	                            <div class="form-group">
	                                <input type="password" id="pwd" class="form-control" name="password" placeholder="Enter password">
	                            </div>
	                            <button type="button" id="sendlogin" class="btn btn-primary" style="width:100%;">Login</button>
	                        </form>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
	<div id="home" class="bg-img bg-img1 center" style="display:block;">
		<nav>
		<a class="active" href="#">Home</a>
		<div class="search-container">
			<input type="text" placeholder="Search..">
			<button type="button"><i class="fa fa-search"></i></button>
		</div>
	</nav>
	<div class="center">
		<div class="container-title center" style="margin-top:100px;">
			<div class="trapezoid bottom left white-font">
				<a class="white-font" href="#" onclick="addItems()">
					<div class="center main-menu">Add New Items</div>
				</a>
			</div>
			<div class="trapezoid top left vflip white-font">
				<a class="white-font" href="update.php">
					<div class="center main-menu vflip">Update Items</div>
				</a>
			</div>
			<div class="circle all-upper">
				<i class="fa fa-lock" aria-hidden="true"></i>
				Admin 
			</div>
			<div class="trapezoid top right hvflip">
				<a class="white-font" href="security_camera.html">
					<div class="center main-menu hvflip">Update user Order</div>
				</a>
			</div>
			<div class="trapezoid bottom right hflip white-font">
				<a class="white-font" href="security_community.html">
					<div class="center main-menu hflip">Delete Orders</div>
				</a>
			</div>
		</div>


		<div class="btn-menu bottom-left-btn white-font">
			<i class="fa fa-cog"></i>
			settings
		</div>
		<div class="btn-menu bottom-right-btn white-font">
			<i class="fa fa-question"></i>
			help
		</div>
		<div class="btn-menu bottom-middle1-btn white-font">
			<i class="fa fa-history"></i>
			history
		</div>
		<div class="btn-menu bottom-middle2-btn">
			<a class="white-font" href="security.html">
				<i class="fa fa-door-open"></i>exit
			</a>
		</div>
	</div>
	</div>
	<div id="addItems" class="bg-img bg-img1 center" style="display:none;"> 
			<div class="container">
		        <div class="row justify-content-center align-items-center" style="height:100vh">
		            <div class="col-4">
		                <div class="card" style="background-color: transparent;border-width: 0px;">
		                    <div class="card-body">
		                    	<h4 style="color:white;"> Add Items To your Menu </h4>
		                        <form autocomplete="off" method="post" enctype="multipart/form-data">
		                            <div class="form-group">
		                                <input type="text" id="name" class="form-control" name="name" placeholder="Enter Item Name">
		                            </div>
		                            <div class="form-group">
		                                <input type="number" id="price" class="form-control" name="price" placeholder="Enter Item Price">
		                            </div>
		                            <div class="form-group" style="background-color:white;">
		                                <input type="file" name="image" />
		                            </div>
		                            <button type="submit" id="saveItem" name="saveItem" class="btn btn-primary" style="width:100%;">Save Item</button>
		                        </form>
		                    </div>
		                </div>
		            </div>
		        </div>
			</div>
		</div>	
</body>
	<script type="text/javascript">
		$("#sendlogin").click(function(){
			$uname = $("#username").val();
			$pwd = $("#pwd").val();
			if($uname == 'admin' && $pwd == 'admin'){
				document.getElementById('login').style="display:none;";
				document.getElementById('home').style="display:block;";
			}
			else{
				alert('Username or password is wrong');
			}
		});
	</script>
	<script type="text/javascript">
		function addItems(){
			document.getElementById('home').style="display:none;";
			document.getElementById('addItems').style="display:block;";
		}
	</script>
</html>