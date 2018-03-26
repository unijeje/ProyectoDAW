<?php

if(isset($_POST["enviar"]))
{
	$tmnMax=500000; //5mb
	$valid_extensions = array('jpeg', 'jpg', 'png');
	echo "<pre>";
	print_r($_FILES['image']);
	echo "</pre>";
	$name = basename($_FILES["image"]["name"]);
	$target="../img/";
	//echo $name."<br>";
	//echo $target;
	$ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
	echo $ext;
	if($_FILES["image"]["size"]<$tmnMax)
	{
		if(in_array($ext, $valid_extensions))
		{
		
			echo "<br>";
			if (is_dir($target) && is_writable($target)) 
			{
				if(move_uploaded_file($_FILES["image"]["tmp_name"], $target.$name))
				{
					echo "exito";
				}
				else
				{
					echo "Not uploaded because of error #".$_FILES["image"]["error"];
				}
			}
			else
				echo 'Upload directory is not writable, or does not exist.';
		}
		else 
		echo "extensión no valida";
	}
	else
		echo "mas de 10MB";

}



	/*
	if(move_uploaded_file($name, $target))
		echo "subido";
	else
		echo "error";
	*/

?>
<br><br>
<form method="post" action="#" enctype="multipart/form-data">
	<input type="file" name="image">
	<br><br>
	<input type="submit" name="enviar"/>

</form>