<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Add & Show List in a single page</title>
        
        <script>
           function goAjax()
           {
               var req=new XMLHttpRequest();
               req.onreadystatechange= function()
               {
                   if(this.readyState==4 && this.status==200)
                   {
                       document.getElementById('show').innerHTML = req.responseText;
                   }
               }
               req.open("GET", "phpFile.php", true);
               req.send();
               
           }
        </script>   
    </head>
    
    <body style="background-color: #e6ccb3;">
        <div>
             <div id="createBox" >
             	<br>
                <h4>Add New Employees</h4>
                <form method="GET" action="index.php">
                    Name : <input type="text" id="name" name="name">    
                    Age : <input type="text" id="age" name="age">
                    <input type="submit" id="submit" name="submit" value="Submit" style="font-size: 14px;">
                </form>
            </div>
            <br><br>
            <div id="showdatasection" style="width:99%;height:400px;overflow:auto;">
                 <h4>Show Employee List</h4> 
                 <table style='width:100%;border-collapse:collapse;border:1px solid black;background-color: white;'>
                     <thead>
                         <tr>
                             <th>ID</th>
                             <th>Name</th>
                             <th>Age</th>
                         </tr>
                     </thead>
                     <tbody id="show">
                         
                     
                     </tbody>
                 </table>                
            </div>
        </div>
        <?php
           $con = new PDO("mysql:host=localhost; dbname=test", "root", "");
           $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           try
           {
               if(isset($_GET['name']) && isset($_GET['age']))
               {
                   try
                   {
                       $stmt = $con->prepare("SELECT MAX(Id) FROM sos");
                       $stmt->execute();
                       $res = $stmt->fetchAll(PDO::FETCH_NUM);
                       $len = $res[0][0];

                       if(isset($_GET['name']) && isset($_GET['age']))
                       {
                           $insertStmt = $con->prepare("INSERT INTO `sos` VALUES(".($len+1).", '".$_GET['name']."', '".$_GET['age']."')");
                           $insertStmt->execute();
                       }

                   } 
                   catch (PDOException $ex) 
                   {
                       echo "<script>window.alert('Error');</script>";
                   }
                }
                echo "<script>goAjax();</script>";
           } 
           catch (Exception $ex) 
           {
                  echo "<script>window.alert('Error');</script>";
           }
           
        ?>
    </body>
</html>
