<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Add data & show list on table</title>
        
        <style>
            #alertbox
            {
                width: 100%;
                height: 25px;
                background-color: #99ff99;
                border: 1px solid;
                display: none;
            }
            #navBar
            {
                 width: 100%;
                 height: 50px;
                 background-color: #99ff99;
               
                
            }
            #createBox
            {
                width: 100%;
                padding: 10px;
                margin: 10px;
            }
        </style>
        <script>
             function closeFunc()
             {
                 document.getElementById('alertmsg').innerHTML = "";
                 document.getElementById('alertbox').style.display = "None";
             }
             function submitClick()
             {
             	alert("Data added!");
             }
             function showlistFunc()
             {
                document.getElementById('createBox').style.display = "none";
                document.getElementById('showdatasection').style.display = "block";
                  
                var req=new XMLHttpRequest();

                req.onreadystatechange= function()
                {
                    if(this.readyState==4 && this.status==200)
                    {
                        document.getElementById('show').innerHTML=req.responseText;
                    }
                }
                req.open("GET","insert.php", true);
                req.send();
                  
             }
             
        </script>
    </head>
    <body style="background-color: #99ffff;">
        <div id="alertbox">
            <span id="alertmsg"></span>
            <span style="float: right;"><input type="button" value="X" style="background-color: greenyellow" onclick="closeFunc();"></span>
        </div>
        <div id="mainBody">
            <div id="navBar">
            <span style="float: right; margin-top: 20px;">
                <input type="button" value="New Employee" style="background-color: greenyellow; font-size: 16px;" onclick=" window.location.assign('index.php?status=new');">
                <input type="button" value="Employee List" style="background-color: greenyellow; font-size: 16px;" onclick="window.location.assign('index.php?status=show');">
            </span>
           </div>
            <div id="createBox" >
                <h4>Add New Employees</h4>
                <form method="GET" action="index.php">
                    Name : <input type="text" id="name" name="name">
                    Designation : <input type="text" id="des" name="des">
                    Age : <input type="text" id="age" name="age">
                    <input type="submit" id="submit" name="submit" value="Submit" style="background-color: greenyellow; font-size: 14px;" onclick="submitClick();">
                    <input type='hidden' name='status' value='new'>
                </form>
            </div>
            <div id="showdatasection" style="width:99%;height:400px;overflow:auto;display:none;">
                 <h4>Show Employee List</h4> 
                 <table style='width:100%;border-collapse:collapse;border:1px solid black;background-color: white;'>
                     <thead>
                         <tr>
                             <th>Name</th><th>Designation</th><th>Age</th>
                         </tr>
                     </thead>
                     <tbody id="show">
                     </tbody>
                 </table>
            </div>
        </div>
        
        <?php
        $con = new PDO("mysql:host=localhost;dbname=pdb", "root", "");
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        if(isset($_GET['status']))
        {
            $status = $_GET['status'];
            if($status == 'new')
            {
                try
                {
                    $maxStmt = $con->prepare("SELECT MAX(id) as Total FROM userlist"); 
                    $maxStmt->execute();
                    $res = $maxStmt->fetchAll(PDO::FETCH_NUM);
                    $len = $res[0][0];

                    if(isset($_GET['name']) && isset($_GET['des']) && isset($_GET['age']))
                    {
                       $insertStmt = "INSERT INTO `userlist` VALUES (".($len+1).",'".$_GET['name']."', '".$_GET['des']."', '".$_GET['age']."')";
                       $con->exec($insertStmt);
                    }   
                } 
                catch (PDOException $ex) 
                {
                       echo "<script>window.alert('Error');</script>";
                }
            }
            else if($status == 'show')
            {
                echo "<script>showlistFunc();</script>";
            }
            
        }
       
        
        ?>
    </body>
</html>
