<?php
    session_start();
    if($_SESSION["stateLog"]!='s'){
        session_unset();
        session_destroy();
        header("location:index.php");
    }//else {echo 'is equal:'.$_SESSION["stateLog"]; exit();}

require_once 'dbCon.php';

class datTemplate{
    public $pstoTitle="";
    public $pstoDate="";
    public $pstoIntval="";
    public $pstoDscp="";
    public $pId=""; }

$GLOBALS['allDatStore']=array();
$GLOBALS['pMsg']="";
$GLOBALS['curPg']="";
$genVal="";

function genDatArry(){
    try{
        $itr=0;
        $conObj=createCon();
        $cmdObj=$conObj->query("SELECT defID  FROM defStore_tbl");
        $cmdObj->execute();
        $dr=$cmdObj->fetch();
        if($dr)$_SESSION['defStoreID']=$dr['defID'];
        else $_SESSION['defStoreID']="";

        $cmdObj=$conObj->query("SELECT *  FROM stores_tbl");
        while($dr=$cmdObj->fetch(PDO::FETCH_ASSOC)){
            $datInstance=new datTemplate();
            $datInstance->pstoTitle=$dr["datTitle"];
            $datInstance->pstoDate=$dr["datDate"];
            $datInstance->pstoDscp=$dr["datDescrip"];
            $datInstance->pId=$dr["datID"];
            $datInstance->pstoIntval=$dr["datIntval"];
            $GLOBALS['allDatStore'][$itr]=$datInstance;
            $itr++;
        }
        $conObj=null;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        $conObj = null;
    }
}



if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST["btnStoCreate"])){
        $GLOBALS['curPg']='S';
        try{
            $sID=uniqid("",true);
            $conObj=createCon();
            $cmdObj=$conObj->prepare("INSERT INTO stores_tbl(datTitle,datID, datDate,datDescrip,datIntval)
                               VALUES(:datTitle,:datID,:datDate,:datDescrip,:datIntval)");
            $cmdObj->bindValue(':datTitle',trim($_POST["tbxStoTitle"]),PDO::PARAM_STR);
            $cmdObj->bindValue(':datID',$sID,PDO::PARAM_STR);
            $cmdObj->bindValue(':datDate',trim($_POST["dtpStoDate"]),PDO::PARAM_STR);
            $cmdObj->bindValue(':datDescrip',trim($_POST["txaStoDescp"]),PDO::PARAM_STR);
            $cmdObj->bindValue(':datIntval',trim($_POST["inpSpinner"]),PDO::PARAM_STR);
            $cmdObj->execute();
            if (isset($_POST["chkboxStoDef"])){
                if($_SESSION['defStoreID']==""){
                    $cmdObj=$conObj->prepare("INSERT INTO defStore_tbl(defID)VALUES(:defID)");
                    $cmdObj->bindValue(':defID',$sID,PDO::PARAM_STR);
                }else{
                    $cmdObj=$conObj->prepare("UPDATE defStore_tbl SET defID='$sID'");
                }
                $cmdObj->execute();
            }
            $conObj = null;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            $conObj = null;
        }
    }elseif (isset($_POST["btnUpwd"])){
        $GLOBALS['curPg']='S';
        if(veriPW(trim($_POST["tbxOldPs"]))) {
            try {
                $conObj=createCon();
                $nPs=trim($_POST["tbxNewPs"]);
                $cmdObj=$conObj->prepare("UPDATE pword_tbl SET pWord = '$nPs'");
                $cmdObj->execute();
                $GLOBALS['pMsg']="Password Updated successfully";
            }catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
                $conObj = null;
            }
        } else $GLOBALS['pMsg']="Invalid Old Password";
    }elseif (isset($_POST["btnSetDef"])){
        $GLOBALS['curPg']='S';
        try {
            $genVal=$_POST["rDefSto"];
            $conObj=createCon();
            if($_SESSION['defStoreID']==""){
                $cmdObj=$conObj->prepare("INSERT INTO defStore_tbl(defID)VALUES(:defID)");
                $cmdObj->bindValue(':defID',$genVal,PDO::PARAM_STR);
            }else{//echo 'was here';exit();
                $cmdObj=$conObj->prepare("UPDATE defStore_tbl SET defID='$genVal'");
            }
            $cmdObj->execute();
            $conObj = null;
        }catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            $conObj = null;
        }
    }elseif (isset($_POST["btnMerge"])){
        $GLOBALS['curPg']='S';
        $mTitle=$_POST["cbxMergeTo"];
        $mDat=$_POST["tbxMerge"];
        $arrAllDat=explode(chr(13).chr(10),$mDat);
        $isSaved=false;
            foreach ($arrAllDat as $tDat){
                $tDat=trim($tDat);

                if(strrpos($tDat,"G")){
                    $tDat= str_ireplace("G",",G",$tDat);
                }

                $rDat=explode(",",$tDat);
                $sqlVal='';
                $sqlCol='';
                foreach ($rDat as $rv){
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
                   /* elseif (strncasecmp("F",$rv,1)==0){
                        $sqlCol=$sqlCol. ',' ."rfCol";
                        $sqlVal=$sqlVal.",'" .ltrim($rv,'F') ."'";
                    }*/
                    elseif (strncasecmp("R",$rv,1)==0){
                        $sqlCol=$sqlCol. ',' ."rdsCol";
                        $sqlVal=$sqlVal.",'" .ltrim($rv,'R') ."'";
                    }
                }
                if($sqlCol!=''){
                    try {
                            $sqlCol=$sqlCol.',storeID';
                            $sqlVal=$sqlVal.','."'".$mTitle."'";
                            $sqlCol=trim($sqlCol,",");
                            $sqlVal=trim($sqlVal,",");
                            // echo $sqlCol.chr(13).chr(10);       echo $sqlVal; exit();
                            //echo 'INSERT INTO wdata_tbl('.$sqlCol.')VALUES('.$sqlVal.')';
                            $conObj=createCon();
                            $cmdObj=$conObj->prepare('INSERT INTO wdata_tbl('.$sqlCol.')VALUES('.$sqlVal.')');
                            $cmdObj->execute(); //echo "don";
                            $conObj = null;  //exit();
                            $isSaved=true;
                    }catch (PDOException $e) {
                        echo "Connection failed: " . $e->getMessage();
                        $conObj = null;
                    }
                }
            }
        if($isSaved==true)$GLOBALS['pMsg']="Data Merged successfully";
        else $GLOBALS['pMsg']="Can not merge the data, Please do a re-check.";
    }
}elseif ($_SERVER["REQUEST_METHOD"] == "GET"){
        if(isset($_GET["datId"])) {
            try {
                $genVal=$_GET['datId'];
                $temVar=$_GET['toStat'];
                $conStr="SELECT pressCol AS p,tempCol AS t,humidCol AS h,lightCol AS l,rdsCol AS d,rfCol AS f,rguageCol AS g,datNumbCol AS n 
                                        FROM wdata_tbl WHERE storeID='$genVal'  ORDER BY datNumbCol ASC";
                if($temVar>0) $conStr=$conStr." LIMIT $temVar ";
                $conObj=createCon();
                $cmdObj=$conObj->query($conStr);
                $dr=$cmdObj->fetchAll(PDO::FETCH_ASSOC);
                if($dr && ($temVar<=count($dr))){
                   if($temVar>0) $dr= end($dr);
                    echo json_encode($dr);
                }else echo "non";
                $conObj = null;
                exit();
            }catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
                $conObj = null;
            }
        }elseif ($_SERVER["REQUEST_METHOD"] == "GET"){//echo 'kkkkk'; exit();
            if (isset($_GET["l"]) && ($_GET["l"])=='o') {
                $_SESSION['stateLog']='o';
                session_unset();
                session_destroy();
                header("location:index.php");
            }
        }
}

genDatArry();