<?php
require('action.php');
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Easy Face Detection </title>
      <link rel="stylesheet" href="lib/css/style.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<body>

<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
		<p class="text text-center">UPload Your Photo Then Click Try Now Button</p>
			<div class="picture-upload">
			<?php
	$d = new Database();
	if(isset($_POST['submit'])){
		if($_FILES['picture']['name'] != ""){
			$ext = pathinfo($_FILES['picture']['name']);
			$ext = strtolower($ext['extension']);
			if($ext!="jpg"&&$ext!="jpeg"&&$ext!="png"&&$ext!="gif"){
				$ext = "";
			}
		}else{
			$ext = "";
		}
		$data = array(
			"picture" => $ext
		);

		$d->Insert("data", $data);
		if($ext != ""){
			$des="lib\img\photo-".$d->Id.".{$ext}";
			copy($_FILES['picture']['tmp_name'], $des);
		}
	}
?>
			<form  action="index.php" method="post" enctype="multipart/form-data">
				<input type="file" name="picture">
				<input type="submit" name="submit" value="Upload">
			</form>
			</div>
		</div>
	</div>
</div>

<?php
$dt = $d->Edit($d->Id);
//print_r($dt);

echo '
<div class="picture-container">
<img id="picture" class="picture" src="'.$dt['path'].'">
</div>
<a id="try-it-donwload" href="'.$dt['path'].'" download>
  <p class="b">Download</p>
</a>
';
?>
  


<a id="try-it" href="#">
  <p class="button-try">Try It Now</p>
</a>

  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
  
<script src='https://jaysalvat.github.io/jquery.facedetection/releases/latest/jquery.facedetection.min.js'></script>

    <script src="lib/js/main.js"></script>

</body>
</html>
