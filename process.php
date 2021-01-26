<?php
session_start();
$mysqli = new mysqli('localhost','root','','abc_test') or die(mysqli_error($mysqli));

$id =0;
$update = false;
$category ='';
$product ='';


if (isset($_POST['save'])) 
{
	$category = $_POST['category'];
	$product = $_POST['product'];

	$mysqli->query("INSERT INTO data (category,product) VALUES('$category','$product')") or
	      die($mysqli->error);

	      $_SESSION['message'] = "Record has been saved!!";
	      $_SESSION['msg_type'] = "success";

	      header("location : index.php");
}


if (isset($_GET['Delete'])) 
{
	$id = $_GET['Delete'];
	$mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error());

	$_SESSION['message'] = "Record has been successfully deleted!!";
	$_SESSION['msg_type'] = "danger";

	 header("location : index.php");

}

if (isset($_GET['edit'])) 
{
	$id = $_GET['edit'];
	$update = true;
	//$mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error());
     $result =$mysqli->query("SELECT *  FROM data WHERE id=$id") or  die($mysqli->error());
	//$_SESSION['message'] = "Record has been successfully deleted!!";
	//$_SESSION['msg_type'] = "danger";
     if (count($result)==1) 
     {
      $row = $result->fetch_array();
      $category = $row['category'];
      $product = $row['product'];
     }
	 header("location : index.php");

}

if(isset($_POST['update']))
{
	$id = $_POST['id'];
	$category =$_POST['category'];
	$product=$_POST['product'];

$mysqli->query("UPDATE data SET category='$category', product='$product' WHERE id=$id ") or die($mysqli->error);

	$_SESSION['message']="record has been updated!";
	$_SESSION['msg_type'] ="warning";


	header("location : index.php");

}
