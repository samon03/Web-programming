<?php
$mysqli = new mysqli('localhost','root','','chatdb') or die(mysqli_error());
if(isset($_POST['search']))
{
	$srchkey = $_POST['search'];
	$sql = "SELECT * FROM `chatting` WHERE Name Like '%$srchkey%'";
}
else
{
	$sql = "SELECT * FROM `chatting`";
	$srchkey = "";
}
?>       			
<!DOCTYPE html>
<html>
<head>
	<title>Search now</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <style type="text/css">
 
    	.container
        {
        	background-color: #ffb3cc;   
        	width: 100%;
        	height: 60%;
        }
        .nav-bar
        {
        	background-color: rgb(255, 126, 156);
        	padding: 1em;
        	width: 100%;
        }
        #search
        {
           margin-left: 12em;
           width: 60%;
           height: 2.5em;
           text-align: center;
        }
    	table
    	{
    		width: 100%;
    		padding: 2em;
    	}
    	table, th, td 
    	{
            border: 1px solid black;
            border-collapse: collapse;
            text-align: center;
            background-color: #ffccdc;
        }
        th
        {
        	background-color: #ff99b9;
        }
        tr
        {
        	max-height: 400px;
        	overflow-y: auto;
        }

    </style>
</head>
<body class="container">
    <div class="nav-bar">
     <form action="" method="POST">	
    	<input class="search" class="search" name="search" id="search" placeholder="Search Here..." value="<?php echo $srchkey;?>">
		 <button type="submit" class="btn btn-default" name="searchBtn" id="searchBtn" style="background-color: rgb(255, 126, 156)">
          <span class="glyphicon glyphicon-search"></span> Search
        </button>
     </form>
    </div>
     <div style="margin-top: 3em;  margin-bottom: 2em;">
       <h4>Data Entries:</h4>	
       	<table>
       		<thead>
       			<tr>
       				<th>ID</th>
       			    <th>Name</th>
                    <th>Message</th>
       			</tr>
       		</thead>
       		<tbody>
       			<?php
                $res = $mysqli->query($sql);
       			while ($row = $res->fetch_assoc()) 
       			{
       				$id = $row["Id"];
       				$user = $row["Name"];
       				$msg = $row["Message"];

       				?>	
       			<tr>
       				<td><?php echo $id; ?></td>
       			    <td><?php echo $user; ?></td>
                    <td><?php echo $msg; ?></td>
       			</tr>
            <?php
       		   }
       		?>
       		</tbody>
       	</table>
       </div> 
</body>
</html>