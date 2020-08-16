<?php
require 'connect.php';
session_start();

$vid = $_GET['vid'];



if (isset($_POST['submit'])) {


	$title = $_POST['title'];
	$url = $_POST['url'];

	$query = "UPDATE video SET title =:title,url =:url WHERE v_id=:vid";
	$stmt = $pdo->prepare($query);
	$stmt->execute(array(':title'=>$title,':url'=>$url,':vid'=>$vid));
	

	$_SESSION['mess'] = "edited successfully";

	header("Location:index.php");

}
else
{

	$sql = "SELECT * FROM video WHERE v_id=:vid";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array(':vid'=>$vid));
	$result = $stmt->fetch();
		

?>
<!DOCTYPE html>
<html>
<head>
	<title>video</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <style type="text/css">
  	.class1{
  		height: 50%;
  		width: 100%;
  		position: absolute;
  		z-index: 1;
  		top: 0;
  		padding-top: 20px;
  		background-color: skyblue;
  	}
  </style>
</head>
<body>
	 <div class="class1">
       <div class="class1">
      <div><?php if (isset($_SESSION['message'])) {
        echo '<p class="alert alert-success">'.$_SESSION['message'].'</p>';
        unset($_SESSION['message']);
    } ?></div>
	 	<h2 style="text-align: center;color:white;">&nbsp&nbsp---videos---</h2>
	<div class="container" style="padding-left: 400px;padding-top:80px">
  <div class="card" style="width:400px;padding-top:40px;padding-left:30px;">
    <!--<img class="card-img-top" src="img_avatar1.png" alt="Card image" style="width:100%">-->
    <div class="card-body">
     <form action="edit.php?vid=<?php echo $vid; ?>" method="post" onsubmit="return dovalidate();">
     	<div class="form-group">
     		<label>Title:</label>
     		<input type="text" name="title" class="form-control" id="title" placeholder="enter the title" autocomplete="off" value="<?php echo $result['title']; ?>">
     		<span style="color: red" id="f1"></span>
     	</div>
     	<div class="form-group">
     		<label>Url:</label>
     		<input type="text" name="url" class="form-control" id="url" placeholder="enter the url" autocomplete="off" value="<?php echo $result['url']; ?>">
     		<span style="color: red" id="f2"></span>
     	</div>
     <input type="submit" name="submit" class="btn btn-primary" value="update">
     <input type="reset" name="reset" class="btn btn-primary" value="cancel">
       </form><br>
     
    </div>
  </div>
</div>
</div>
</div>
<?php } ?>
</body>
</html>