<?php
        $con = new PDO("mysql:host=localhost; dbname=test", "root", "");
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    try
    {
       $showStmt = $con->prepare("SELECT * FROM sos");
       $showStmt->execute();
       $res = $showStmt->fetchAll(PDO::FETCH_NUM);
       $tablegenarate = "";

       foreach($res as $inner)
       {
           $tablegenarate = $tablegenarate . "<tr>";
           foreach ($inner as $val)
           {
               $tablegenarate = $tablegenarate ."<td style='border:1px solid black; text-align: center;'>" . $val . "</td>";
           }
           $tablegenarate = $tablegenarate . "</tr>";
       }
       echo $tablegenarate;
       
    } 
    catch (PDOException $ex) 
    {
         echo "<script>window.alert('Error');</script>";
    }       
      
?>

