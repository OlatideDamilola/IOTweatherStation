<?php
/**
 * Created by PhpStorm.
 * User: OLORUNDAMILOLAH
 * Date: 01/05/2017
 * Time: 10:13 AM
 */


function createCon(){
   //$servername = "MYSQL5043.site4now.net";
    //$username = "a6fde1_weather";
    //$password = "weatherstation1";
    //$dbname="db_a6fde1_weather";

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname="iotweatherstationdb";
    try{
        $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4;port=3307", $username, $password);
       // $conn = new PDO("Server=MYSQL5043.site4now.net;Database=db_a6fde1_weather;Uid=a6fde1_weather;Password=weatherstation1");
       // $conn = new PDO("mysql:Driver={MySQL ODBC 5.1 Driver};host=$servername;dbname=$dbname", $username, $password);
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
         $cmdObj=$conObj->query("SELECT *  FROM pword_tbl WHERE pword='$dVal' ");
         $cmdObj->execute();
         $dr=$cmdObj->fetch();
         if($dr){$conObj=null; return(true);}
         else {$conObj=null; return(false);}
     } catch (PDOException $e) {
         echo "Connection failed: " . $e->getMessage();
         $conObj = null;
     }
 }


/*function getDefId(){
    $dId='';
    try{
        $conObj=createCon();
        $cmdObj=$conObj->query("SELECT *  FROM defstore_tbl");
        $cmdObj->execute();
        $dr=$cmdObj->fetch();
        if($dr) $dId=$dr["defID"];
        else $dId=null;
        $conObj=null;
        return($dId);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        $conObj = null;
    }
}*/

function pipeDat($toPipe){
    $rcvDat='';
    $qDat='';
    try{
        $conObj=createCon();
        if($toPipe=='t')$qDat="SELECT datIntval FROM stores_tbl";
        else $qDat="SELECT defID FROM defstore_tbl";
        $cmdObj=$conObj->query($qDat);
        $cmdObj->execute();
        $dr=$cmdObj->fetch();
        if($dr){
            if($toPipe=='t')$rcvDat=$dr["datIntval"];
            else $rcvDat=$dr["defID"];
        }else $rcvDat=null;
        $conObj=null;
        return($rcvDat);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        $conObj = null;
    }
}

?>