<!DOCTYPE html>


<html>
    <head>
	    <title> CRUD </title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css"> 
        <script src="https://code.jquery.com/jquery-2.1.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5"></script> 
	</head>
	
	<script>
		function closeFunc()
		{
             document.getElementById("alertMsg").style.display = "none"; 
		}
	</script>
	
	<body>
	   <?php require_once 'process.php'; ?>
	   
	   <?php if(isset($_SESSION['msg'])): ?>
	   
	   <div class="alert alert-<?=$_SESSION['msg_type']?>" id="alertMsg">
	   	<input type="submit" value="X" style="float: right;" onclick="closeFunc();">
	   <!-- 	<button onclick="self.close()" style="float: right;">X</button> -->
	       <?php
	          echo $_SESSION['msg'];
			  unset($_SESSION['msg']);
	   
	        ?>
	   </div>
	   <?php endif ?>
	   
	   <div class="container" >
	   <?php
	     $mysqli = new mysqli('localhost', 'root', '', 'curddb') or die(mysqli_error($mysqli));
		 $result = $mysqli->query("SELECT * FROM dataTable") or die(mysqli_error);
		 
		 ?>
		 
		 <div class="row justify-content-center col-md-12" style="margin-top: 2em;">
		 <div class="col-md-8" style="background: #e6ffe6; border: 2px solid #555;">
		 	<table class="table">
			   <thead>
			      <tr>
			          <th>Name</th>
					  <th>Email</th>
					  <th>Location</th>
					  <th colspan="2">Action</th>
			      </tr>
			   </thead>
			   
			   <?php while($row = $result->fetch_assoc()): ?>
			  <tr> 
			   <td><?php echo $row['Name']; ?></td>
			   <td><?php echo $row['Email']; ?></td>
			   <td><?php echo $row['Location']; ?></td>
			   <td>
			      <a href="index.php?edit=<?php echo $row['ID']; ?>" class="btn btn-info">Edit</a>
				  <a href="index.php?delete=<?php echo $row['ID']; ?>" class="btn btn-danger">Delete</a>
			   </td>
			  </tr>
			  <?php endwhile; ?>
			</table>
		 	</div>

		 	<?php
		 function pre_r($array)
		 {
		    echo '<pre>';
			print_r($array);
			echo '</pre>';
		 }
		?>  
		<div class="col-md-4" style="background: #b3e6cc; border: 2px solid #555;">
			 <form action="process.php" method="POST">
           <input type="hidden" name="id" value="<?php echo $id; ?>"></input>
		   <div class="form-group" style="margin-top: 2em;">
		      <label><b>Name</b></label>
		      <input type="text" name="name" value="<?php echo $name; ?>" class="form-control" placeholder="Enter your name"></input>
		   </div> 
		   <div class="form-group">
		     <label><b>Email</b></label>
		     <input type="email" name="email" value="<?php echo $email; ?>" class="form-control" placeholder="Enter your email"></input>
		   </div>	 
		   <div class="form-group center">
		       <label><b>Location</b></label>
		       <input type="text" name="location" value="<?php echo $location; ?>" class="form-control" placeholder="Enter your location"></input>
		   </div> 
           <div class="form-group" style="margin-top: 2em;">	
              <?php if($update == true): ?>	
                   <button type="submit" class="btn btn-info" name="update" style="width: 100%;">Update</button>	
              <?php else: ?>				   
		          <button type="submit" class="btn btn-primary" name="add" style="width: 100%;">Add</button>
			  <?php endif; ?>	  
		   </div>
		   
        </form>

		</div>
		    
		 </div>
      </div>	   
    </body>
</html>