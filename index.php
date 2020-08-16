<?php 
require 'connect.php';
session_start();

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $url = $_POST['url'];
    

     $sql = "INSERT INTO video (title,url,cat_id) VALUES (:title,:url,:cat_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':title'=>$title,':url'=>$url,':cat_id'=>1));


    $_SESSION['message'] = "INSERTED !";

    if ($sql) {
        echo "<script>alert('insert title=".$title." url=".$url."')</script>";
    }


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
        echo '<p class="alert alert-danger">'.$_SESSION['me'].'</p>';
        unset($_SESSION['me']);
    } ?></div>
	 	<h2 style="text-align: center;color:white;">&nbsp&nbsp---videos---</h2>
	<div class="container" style="padding-left: 400px;padding-top:80px">
  <div class="card" style="width:400px;padding-top:40px;padding-left:30px;">
    <!--<img class="card-img-top" src="img_avatar1.png" alt="Card image" style="width:100%">-->
    <div class="card-body">
     <form action="index.php" method="post" onsubmit="return dovalidate();">
     	<div class="form-group">
     		<label>Title:</label>
     		<input type="text" name="title" class="form-control" id="title" placeholder="enter the title" autocomplete="off">
     		<span style="color: red" id="f1"></span>
     	</div>
     	<div class="form-group">
     		<label>Url:</label>
     		<input type="text" name="url" class="form-control" id="url" placeholder="enter the url" autocomplete="off">
     		<span style="color: red" id="f2"></span>
     	</div>
     <input type="submit" name="submit" class="btn btn-primary" value="add">
     <input type="reset" name="reset" class="btn btn-primary" value="cancel">
       </form><br>
     <a href="un.php">see categorized</a>
    </div>
  </div>
</div>
<div class="table-responsive col-sm-12" style="padding-left: 250px;">
  <table class="table">
    <tr>
     
      <th>TITLE</th>
      <th>URL</th>
      
      <th>MOVE TO </th>
      <th>ACTION</th>
    </tr>
      <?php
 $query = "SELECT * FROM video JOIN category ON video.cat_id=category.cat_id";
 $exe = $pdo->prepare($query);
 $exe->execute();
 while ($result = $exe->fetch()) {
      $vid = $result['v_id'];
      if ($result['cat_id'] == 1) {

      ?>
    <tr>
     
      <td><?php echo $result['title']; ?></td>
      <td><?php echo $result['url']; ?></td>
      <td>categories
        <select>
          <option selected disabled>select</option>
         <?php
          $query = "SELECT * FROM category";
          $stmt = $pdo->prepare($query);
          $stmt->execute();
          while ($res = $stmt->fetch()) {
            $cat_id = $res['cat_id'];

             $arrayName = array($vid,$cat_id );
             $string=implode(",",$arrayName);
          ?>

          <option value="<?php echo $string; ?>" id="op1">
            <?php echo $res['category']; 
           }
          ?></option>
        </select>
      </td>
      <td><a href="edit.php?vid=<?php echo $vid; ?>" class="btn btn-primary">edit</a>&nbsp<a href="delete.php?vid=<?php echo $vid; ?>" class="btn btn-danger">delete</a><?php }} ?></td>
    </tr>
    
  </table>
</div>
</div>
<script type="text/javascript">
  $("select").change(function() {
    //get the selected value
    var selectedValue = this.value;
   // alert(selectedValue); 
    //make the ajax call
    $.ajax({
        url: 'function.php',
        type: 'POST',
        data: {option:selectedValue},
        success: function(response) {
            alert("move confirm? ");
        }
    });
});
</script>
</body>
</html>