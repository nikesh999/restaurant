<?php 
include_once('conf.php');
session_start();
ini_set('upload_max_filesize', '10M');
ini_set('post_max_size', '10M');
$target_path = "images/";
$id = $_SESSION['id'];

$query = "select * from menu where ID=$id";
$res = (mysqli_query($conn, $query));

if(mysqli_num_rows($res) > 0){
	while($row = mysqli_fetch_array($res)){
		$Name = $row[1];
		$Price = $row[2];
	}
}

if(isset($_POST['update'])){
	$name = $_POST['name'];
	$price = $_POST['price'];
	$img = $_FILES['image']['name'];
	$target_path = $target_path.$img;
	echo $target_path;
	$insert = "update menu set NAME='$name', PRICE='$price', IMG='$img' where ID=$id";
	if(mysqli_query($conn, $insert)){
		move_uploaded_file($_FILES['image']['tmp_name'], $target_path);
		echo "<script> alert('Menu item has been updated.') </script>";
		header("Location: /restaurant/update.php");
	}
	else{
		echo "<script> alert('Image cannot be stored.') </script>";
	}
}	
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8" />
	<meta name="viewport", content="width=device-width, initial-scale=1">
	<title>Restaurant Menu</title>
	<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="static/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="static/css/custom.css">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body style="font-family:palatino-linotype">
<div id="addItems" class="bg-img bg-img1 center"> 
			<div class="container">
		        <div class="row justify-content-center align-items-center" style="height:100vh">
		            <div class="col-4">
		                <div class="card" style="background-color: transparent;border-width: 0px;">
		                    <div class="card-body">
		                    	<h4 style="color:white;"> Update Selected Item To your Menu </h4>
		                        <form autocomplete="off" method="post" enctype="multipart/form-data">
		                            <div class="form-group">
		                                <input type="text" id="name" class="form-control" name="name" placeholder="Enter Item Name" value="<?php echo $Name ?>">
		                            </div>
		                            <div class="form-group">
		                                <input type="number" id="price" class="form-control" name="price" placeholder="Enter Item Price" value="<?php echo $Price ?>">
		                            </div>
		                            <div class="form-group" style="background-color:white;">
		                                <input type="file" name="image" />
		                            </div>
		                            <button type="submit" id="saveItem" name="update" class="btn btn-primary" style="width:100%;">Make Changes</button>
		                        </form>
		                    </div>
		                </div>
		            </div>
		        </div>
			</div>
		</div>
</body>
</html>