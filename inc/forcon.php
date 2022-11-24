<?php
require_once 'dbCon.php';



if ($_SERVER["REQUEST_METHOD"] == "GET"){
    if(isset($_GET["tc"])) {
        if($_GET["tc"]=="iws") echo 'tt';
    }elseif(isset($_GET["dat"])) {
        $defId=pipeDat('id');
	if($defId==null) exit();
        $rcvDat=$_GET["dat"];

        if(strrpos($rcvDat,"G")){
            $rcvDat= str_ireplace("G",",G",$rcvDat);
        }
        $arrAllDat=explode(",",$rcvDat,);
        // print_r($arrAllDat);
        
        try {
            $sqlCol= "";
            $sqlVal="";
            $conObj=createCon();
            foreach ($arrAllDat as $rv){
                if(strncasecmp("H",$rv,1)==0){
                    $sqlCol=$sqlCol. ',' ."humidCol";
                    $sqlVal=$sqlVal.",'" .ltrim($rv,'H') ."'";
                }elseif (strncasecmp("P",$rv,1)==0){
                    $sqlCol=$sqlCol. ',' ."pressCol";
                    $sqlVal=$sqlVal.",'" .ltrim($rv,'P') ."'";
                }elseif (strncasecmp("T",$rv,1)==0){
                    $sqlCol=$sqlCol. ',' ."tempCol";
                    $sqlVal=$sqlVal.",'" .ltrim($rv,'T') ."'";
                }elseif (strncasecmp("L",$rv,1)==0){
                    $sqlCol=$sqlCol. ',' ."lightCol";
                    $sqlVal=$sqlVal.",'" .ltrim($rv,'L') ."'";

                }elseif (strncasecmp("N",$rv,1)==0){
                    $sqlCol=$sqlCol. ',' ."datNumbCol";
                    $sqlVal=$sqlVal.",'" .ltrim($rv,'N') ."'";
                }elseif (strncasecmp("G",$rv,1)==0){
                    $sqlCol=$sqlCol. ',' ."rguageCol";
                    $sqlVal=$sqlVal.",'" .ltrim($rv,'G') ."'";
                }
                /*elseif (strncasecmp("F",$rv,1)==0){
                    $sqlCol=$sqlCol. ',' ."rfCol";
                    $sqlVal=$sqlVal.",'" .ltrim($rv,'F') ."'";
                }*/
                elseif (strncasecmp("R",$rv,1)==0){
                    $sqlCol=$sqlCol. ',' ."rdsCol";
                    $sqlVal=$sqlVal.",'" .ltrim($rv,'R') ."'";
                }
            }
            $sqlCol=$sqlCol.',storeID';
            $sqlVal=$sqlVal.','."'".$defId."'";
            $sqlCol=trim($sqlCol,",");
            $sqlVal=trim($sqlVal,",");
               //      echo $sqlCol; echo $sqlVal;
            // echo '"INSERT INTO wdata_tbl('.$sqlCol.')VALUES('.$sqlVal.')"';
            $cmdObj=$conObj->prepare('INSERT INTO wdata_tbl('.$sqlCol.')VALUES('.$sqlVal.')');
            $cmdObj->execute(); //echo "don";
            $conObj = null;
        }catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            $conObj = null;
        }
    }
}