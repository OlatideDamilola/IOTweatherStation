<?php
/**
 * Created by PhpStorm.
 * User: OLORUNDAMILOLAH
 * Date: 01/05/2017
 * Time: 10:13 AM
 */


function createCon(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname="iotweatherstationdb";
    try{
        $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4;port=3307", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }
    catch(PDOException $e)
    {
        echo "ERROR : ".$e->getMessage();
    }
}


 function veriPW($dVal){
     try {
         $conObj=createCon();
         $cmdObj=$conObj->query("SELECT *  FROM pword_tbl WHERE pWord='$dVal' ");
         $cmdObj->execute();
         $dr=$cmdObj->fetch();
         if($dr){$conObj=null; return(true);}
         else {$conObj=null; return(false);}
     } catch (PDOException $e) {
         echo "Connection failed: " . $e->getMessage();
         $conObj = null;
     }
 }

?>