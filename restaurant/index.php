<?php 
include_once('conf.php');
$query = "select * from menu";
$items = (mysqli_query($conn, $query));
if(isset($_COOKIE["total"])){
		$amt = $_COOKIE['total'];
	}
	else{
		$amt = "00";
	}

if(isset($_POST['addtocart'])){
	$name=$_POST['name'];
	$qty = $_POST['qty'];
	$price = $_POST['price'];
	if($qty == '' || $qty == 1){
		$qty = 1;
	}
	else{
		$price = $price*$qty;
	}

	if(isset($_COOKIE["total"])){
		setcookie("total",$_COOKIE["total"]+$price, time()+60*60);
		header("Location: /restaurant/");
	}
	else{
		setcookie("total", $price, time()+60*60);
		header("Location: /restaurant/");
	}
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
			<a href="#" id="show_cart"> <i class="fa fa-cart-plus" style="font-size:30px;position:absolute;top:10px;left:90px;"></i></a>
			<div class="search-container">
				<input type="text" placeholder="Search..">
				<button type="button"><i class="fa fa-search"></i></button>
			</div>

		</nav>
		<div class="container">
			<h2 style="color:white;margin-top:30px;"> Best Meals we provide </h2>
		</div>
	<div class="container">
			<?php 
				if(mysqli_num_rows($items) > 0){
				while($row = mysqli_fetch_array($items)){ ?>
				<div class="box">
					<form method="post" enctype="multipart/form-data" action="">
					<div style="height:45px;">
						<tr> <td> <label style="color:white;margin-right:40px;margin-top:10px;"> <?php echo$row['NAME']; ?> </label> </td> <td> <label style="color:white;"> <?php echo "$ ".$row['PRICE'].".00"; ?> </label> </td> </tr>
						<input type="text" id="<?php $row['NAME'].$row['ID'] ?>" name="name" style="display:none;" value="<?php echo$row['NAME']; ?>" />
						<input type="text" name="price" style="display:none;" value="<?php echo$row['PRICE']; ?>" />
					</div>
					<img src="<?php echo"images/".$row['IMG'] ?>" height="140" width="170">
					<tr style="padding-top:15px;"> <td> <input type="number" name="qty" id="qty" placeholder="Qty." /> </td> <td> <input class="btn btn-success" name="addtocart" type="submit" value="Add Item" style="margin-left:5px;" /> </td> </tr>
					</form>	
				</div>
			<?php }} else{echo "<script> Menu is empty, tell admin to add items. </script>";} ?>
	</div>
	<div id="cart" style="height:350px;width:300px;background-color:white;border-radius:15px;border-top-left-radius:1px; ;position:absolute;top:45px;left:110px;display:none;text-align:center">

		<h4 style="background:#f5371d;color:white;border-top-right-radius:15px;"> Restaurant Name </h4>
		<h4 style="margin-top:25px;"> Your Order </h4>
		<h4 style="margin-top:40px;"> Total Amount : $<?php echo $amt; ?>.00 </h4>

		<a href="#" class="btn btn-success" style="width:80%;margin:2em;margin-bottom:1em;"> CheckOut </a>
		<a href="#" class="btn btn-danger" style="width:80%;"> View Cart </a>

		<h4 style="background:#f5371d;color:#f5371d;border-bottom-left-radius:15px;border-bottom-right-radius:15px;margin-top:1.75em;">d </h4>

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
<script type="text/javascript">
	$('#show_cart').click(function(){
		$("#cart").toggle();
	});
</script>>
</html>
