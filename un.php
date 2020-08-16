<?php
require 'connect.php';
session_start();

if (isset($_POST['submit'])) {
	$cat = $_POST['cat'];

	$query = "INSERT INTO category(category) VALUES (:cat)";
	$stmt = $pdo->prepare($query);
	$stmt->execute(array(':cat'=>$cat));

	if ($query) {
		echo "<script>alert('confirm insert ".$cat.")</script>";
	}

	$_SESSION['message'] = "Inserted!";


}

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
      <div><?php if (isset($_SESSION['message'])) {
        echo '<p class="alert alert-success">'.$_SESSION['message'].'</p>';
        unset($_SESSION['message']);
    } ?></div>
     <div><?php if (isset($_SESSION['mess'])) {
        echo '<p class="alert alert-success">'.$_SESSION['mess'].'</p>';
        unset($_SESSION['mess']);
    } ?></div>
     <div><?php if (isset($_SESSION['me'])) {
        echo '<p class="alert alert-success">'.$_SESSION['me'].'</p>';
        unset($_SESSION['me']);
    } ?></div>
	 	<h2 style="text-align: center;color:white;">&nbsp&nbsp---videos---</h2>
	<div class="container" style="padding-left: 400px;padding-top:80px">
  <div class="card" style="width:400px;padding-top:40px;padding-left:30px;">
    <!--<img class="card-img-top" src="img_avatar1.png" alt="Card image" style="width:100%">-->
    <div class="card-body">
     <form action="un.php" method="post" onsubmit="return dovalidate();">
     	<div class="form-group">
     		<label>Add a category:</label>
     		<input type="text" name="cat" class="form-control" id="cat" placeholder="enter a category" autocomplete="off">
     		<span style="color: red" id="f1"></span>
     	</div>
     <input type="submit" name="submit" class="btn btn-primary" value="add">
     <input type="reset" name="reset" class="btn btn-primary" value="cancel">
       </form><br>
     <a href="index.php">see uncategorized</a>
    </div>
  </div>
</div>
<div class="table-responsive col-sm-12" style="padding-left: 250px;">
 <?php
  		$sql = "SELECT * FROM category";
  		$stmt = $pdo->prepare($sql);
  		$stmt->execute();
  		while($result=$stmt->fetch()){
  			$categoryId=$result['cat_id'];
  			// echo $categoryId.'    ';
  			$fetchVideoDetails="SELECT * from video where cat_id=$categoryId";
  			// echo $fetchVideoDetails;
  			$fetchVideoResult=$pdo->prepare($fetchVideoDetails);
  			$fetchVideoResult->execute();
  			if($result['cat_id']!=1){
  				?><table  border=2  class='table' id='<?php echo $categoryId;?>'>
  					<tr>
  						<th>Category</th>
  						<th>Serial Number</th>
  						<th>Title</th>
  						<th>URL</th>
  						<th>Move to Uncategory</th>
  						<th>Action</th>
  					</tr>
  			
  			<?php 
  			$i=1;
  			while($videoResult=$fetchVideoResult->fetch()){
  				// var_dump($videoResult);

  				?>
  					<tr>
  						<td><?php echo $result['category'];?></td>
  						<td><?php echo $i; ?></td>
  						<td><?php echo $videoResult['title'];?></td>
  						<td><?php echo $videoResult['url'];?></td>
  						<td><a href="move.php?vid=<?php echo $videoResult['v_id']; ?>&cat_id=<?php echo $result['cat_id']; ?>">Move to Uncategorised</a></td>
  						<td><a href="edit_cat.php?categoryId=<?php echo $categoryId; ?>" class="btn btn-primary">edit</a>&nbsp<a href="delete_cat.php?vid=<?php echo $videoResult['v_id']; ?>" class="btn btn-danger" >delete</a></td>
  					</tr>
  					

  		<?php		
  		$i++;
  		}?>
  				</table>
  		<?php 
  		}}

  		?>

</div>
</div>
</div>
</body>
</html>