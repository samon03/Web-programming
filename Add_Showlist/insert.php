<?php
 $con = new PDO("mysql:host=localhost;dbname=pdb", "root", "");
 $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
    try {
        $pdostat = $con->prepare("SELECT name, designation, age FROM `userlist`");
        $pdostat->execute();
        $res = $pdostat->fetchAll(PDO::FETCH_NUM);
        $tablegenerate = "";
        foreach ($res as $innarr) 
        {
            $tablegenerate = $tablegenerate . "<tr>";
            foreach ($innarr as $val) 
            {
                $tablegenerate = $tablegenerate . "<td style='border:1px solid black; text-align: center;'>" . $val . "</td>";
            }
            $tablegenerate = $tablegenerate . "</tr>";
        }
        echo $tablegenerate;
    } 
    catch (PDOException $ex) 
    {
        echo "Can\'t read data from database table";
    }
?>
