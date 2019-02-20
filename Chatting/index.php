<?php
  $mysqli = new mysqli('localhost', 'root', '', 'chatdb') or die("Error connection");

  if (isset($_POST['submit'])) 
  {
  	 $uname = $_POST['name'];
  	 $umsg = $_POST['msg'];
  	 $res = $mysqli->query("INSERT INTO  `chatting` VALUES('', '$uname', '$umsg')");
  }
  echo "<script>goAjax();</script>";
 

?>

<!DOCTYPE html>
<html>
<head>
	<title>Chat Box</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
    .sets
    {
      border: 1px solid #555;
      background-color: #f1f1f1;
      border-radius: 5px;
      padding: 10px;
      margin: 5px 0;
    }
  </style>
</head>
<body>
  
    <div class="col-md-12">
    	<div class="col-md-8">
            <div id="caret" class="caret" style="width: 40%; height: 400px; background-color: #a1d5fc; border: 2px black solid;  padding: 5px;">
               <h3>Chat Box</h3><hr>
               <div style="height: 300px; overflow-y: auto;">
            	 <?php
                   $show = "SELECT Name, Message FROM `chatting`";
                   $res = $mysqli->query($show);
                   ?>
                   <br>
                   <?php 

                   while ($row = $res->fetch_assoc()) 
                   {
                       $sname = $row['Name'];
                       $smsg = $row['Message'];

                       ?>
                       <div class="sets">
                         <label><b><?php echo $sname;?> : </b></label>
            	           <span><?php echo $smsg;?></span>
                       </div>  
                         
            	           
                       <?php
                   }
                   
            	?>
            </div>
         </div>
    	</div>
      <div class="col-md-8"> 
        <form method="POST" action="index.php">
          <br> 
              <div class="col-md-4">
                  <input type="text" name="name" id="name" placeholder="Enter you name here .. " style="width: 40%; background-color: #d2e0e0;">
              </div>
              <br>
              <div class="col-md-4">
              <textarea name="msg" id="msg" style="width: 40%; background-color: #d2e0e0;" placeholder="Enter your message here .."></textarea>
              </div>
               <button class="btn" type="submit" name="submit" id="submit" style="width: 40%; height: 5%; background-color: #4dffa6; margin-top: 0.5em;" ><b>Send</b></button>
        </form> 	
    	</div> 
    </div>
<script type="text/javascript">
	 function goAjax()
	 {
	 	var user = document.getElementById('name').value;
	 	var chat = document.getElementById('msg').value;

	 	var req = new XMLHttpRequest();

	 	req.onreadystatechange= function()
	 	{
	 		if(this.readyState==4 && this.status==200)
	 		{
              document.getElementById('caret').innerHTML = req.responseText;
	 		}
	 	}
	 	req.open('POST','index.php?name=' + user + '&msg' + chat , true);
	 	req.send();
	 }
</script>
</body>


</html>