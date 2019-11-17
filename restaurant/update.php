<?php 
include_once('conf.php');
$query = "select * from menu";
$items = (mysqli_query($conn, $query));

if(isset($_POST['change'])){
	$ID = $_POST['id'];
	session_start();
	$_SESSION['id'] = $ID;
	header("Location: /restaurant/updating.php");
}
?>

<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport", content="width=device-width, initial-scale=1">
	<title>Restaurant Menu</title>
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
		#qty{
			background-color:transparent;width:50px;color:white;border-width:1px;border-color:white;border-radius:5px;margin-top:15px;text-align:center;
		}
		.box
	    {
	        float: left;
	        margin: 1em;
	        width:170px;
	        height:240px;
	        background-color:#f5371d;
	        position:relative;
	        left:20px;
	        top:20px;
	        border-radius:15px;
	    }
	</style>
</head>
<body style="font-family:palatino-linotype;background-color:coral">
	<div id="home" class="bg-img bg-img1 center" style="display:block;">
		<nav>
			<a class="active" href="#">Menu</a>
			<div class="search-container">
				<input type="text" placeholder="Search..">
				<button type="button"><i class="fa fa-search"></i></button>
			</div>

		</nav>
		<div class="container">
			<h2 style="color:white;margin-top:30px;"> Select items to mek changes </h2>
		</div>
	<div class="container" id="items">
			<?php 
				if(mysqli_num_rows($items) > 0){
				while($row = mysqli_fetch_array($items)){ ?>
				<div class="box">
					<form method="post" enctype="multipart/form-data">
					<div style="height:45px;">
						<tr> <td> <label style="color:white;margin-right:40px;margin-top:10px;"> <?php echo$row['NAME']; ?> </label> </td> <td> <label style="color:white;"> <?php echo "$ ".$row['PRICE'].".00"; ?> </label> </td> </tr>
						<input type="text" id="<?php $row['NAME'] ?>" name="name" style="display:none;" value="<?php echo$row['NAME']; ?>" />
						<input type="text" name="price" style="display:none;" value="<?php echo$row['PRICE']; ?>" />
						<input type="text" name="id" style="display:none;" value="<?php echo$row['ID']; ?>" />
					</div>
					<img src="<?php echo"images/".$row['IMG'] ?>" height="140" width="170">
					<tr style="padding-top:15px;"> <td> <input type="number" name="qty" id="qty" placeholder="Qty." /> </td> <td> <input class="btn btn-success" name="change" type="submit" value="Change" style="margin-left:5px;" /> </td> </tr>
					</form>	
				</div>
			<?php }} else{echo "<script> Menu is empty, tell admin to add items. </script>";}; ?>
	</div>
	<!-- <div> 
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
	</div> -->
	</div>
</body>
</html>
</html>