<?php

 session_start();

 $mysqli = new mysqli('localhost', 'root', '', 'curddb') or die(mysqli_error($mysqli));
 
 $update = false;
 $id = 0;
 $name = '';
 $email = '';
 $location = '';
 
 if(isset($_POST['add']))
 {
	 $name = $_POST['name'];
	 $email = $_POST['email'];
	 $location = $_POST['location'];

	 $mysqli->query("INSERT INTO dataTable VALUES('', '$name', '$email', '$location')") or die($mysqli_error);
	 
	 $_SESSION['msg'] = "Saved in records!";
	 $_SESSION['msg_type'] = "success";

     header("location: index.php");	 
 }
 if(isset($_GET['delete']))
 {
	 $id = $_GET['delete'];
	 
	 $mysqli->query("DELETE FROM dataTable WHERE ID=$id") or die($mysqli_error);
	 
	 $_SESSION['msg'] = "Deleted from records!";
	 $_SESSION['msg_type'] = "danger";

     header("location: index.php"); 
	 
 }	
 if(isset($_GET['edit'])){
	$id = $_GET['edit'];
	$update = true;
	$result = $mysqli->query("SELECT * FROM dataTable WHERE ID=$id") or die($mysqli->error());
	
	$row = $result->fetch_array();
    $name = $row['Name'];
	$email = $row['Email'];
	$location = $row['Location'];
    
 }
 if(isset($_POST['update']))
 {
	 $id = $_POST['id'];
	 $name = $_POST['name'];
	 $email = $_POST['email'];
	 $location = $_POST['location'];
	 
	 $mysqli->query("UPDATE dataTable SET Name='$name', Email='$email', Location='$location' WHERE ID=$id")
	          or die($mysqli->error);
			  
	 $_SESSION['msg'] = "Value has been update!";
	 $_SESSION['msg_type'] = "info";

     header("location: index.php");		  
 }
  

?>