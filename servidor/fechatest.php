<?php
error_reporting(0);
include("bbdd2.php");
$antigua="juan111";
$sql = "SELECT 1 from cuentas where password=?";
$antiguaEnc=crypt($antigua);
$stmt=DB::run($sql, [$antiguaEnc]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);
echo "<pre>";
print_r($usuario["1"]);
echo "</pre>";
?>
<!--
<div class="row">
	<div class="col-8 offset-2">
		<div class="card bg-white post panel-shadow">
			<div class="post-heading row">
				<div class="pull-left image col-2">
					<img src="http://bootdey.com/img/Content/user_1.jpg" class="img-circle avatar" alt="user profile image">
				</div>
				<div class="pull-left meta col-7 mt-2">
					<div class="title h5">
						<a href="#"><b>Ryan Haywood</b></a>
					</div>
				</div>
				<div class="fechaPub col-3 mt-2">
					<h6 class="text-muted time">1 minute ago</h6>
				</div>
			</div> 
			<div class="post-description"> 
				<p>Bootdey is a gallery of free snippets resources templates and utilities for bootstrap css hmtl js framework. Codes for developers and web designers</p>
			</div>
		</div>
	</div>
</div>   -->