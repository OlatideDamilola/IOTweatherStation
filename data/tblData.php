<?php
    require_once '../inc/dbCon.php';

        $datOpen='{
                      "header": [
                        {
                          "name": "id", "title": "ID", "size": 50, "sortable": true, "sortDir": "asc", "format": "number"
                        },
                        {
                          "name": "pressure",
                          "title": "Pressure(KPa)",
                          "sortable": true,
                          "format": "number"
                        },
                        {
                          "name": "temperature",
                          "title": "Temperature(&degC)",
                          "sortable": true,
                          "format": "number"
                        },
                        {
                          "name": "humidity",
                          "title": "Humidity(%)",
                          "sortable": true,
                          "format": "number"
                        },
                        {
                          "name": "light",
                          "title": "Light(lux)",
                          "sortable": true,
                          "format": "number"
                        },
                        {
                          "name": "rds",
                          "title": "RDS(mm)",
                          "sortable": true,
                          "format": "number"
                        },
                        {
                          "name": "rainRate",
                          "title": "Rain Rate",
                          "sortable": true,
                          "format": "number"
                        },
                        {
                          "name": "rainGauge",
                          "title": "Rain Gauge(mil)",
                          "sortable": true,
                          "format": "number"
                        }
                      ],
                      "data": [';

$datBody='  [
                      1,545,68,63,7843,63,7843,545                      
                    ],
                    [
                      2,545,68,63,7843,63,7843,545  
                    ],
                    [
                      3,545,68,63,7843,63,7843,545  
                    ],
                    [
                      4,545,68,63,7843,63,7843,545  
                    ]';

$datClose=']
                    }';
$genVal='';

if ($_SERVER["REQUEST_METHOD"] == "GET"){
    if (isset($_GET["td"])){
        try {
            $datBody='';
            $genVal=trim($_GET["td"]);
            $dIntava=pipeDat('t');
            $conObj=createCon();
            $cmdObj=$conObj->query("SELECT pressCol,tempCol,humidCol,lightCol,rdsCol,rfCol,rguageCol,datNumbCol 
                                            FROM wdata_tbl WHERE storeID='$genVal'");
            //$cmdObj->bindValue(':storeID',trim($_GET["td"]),PDO::PARAM_STR);
            $cmdObj->execute();
            while($dr=$cmdObj->fetch(PDO::FETCH_ASSOC)){
                $rRate=$dr["rguageCol"]/$dIntava;
                $datBody=$datBody.'['.$dr["datNumbCol"]. ','.$dr["pressCol"].','.$dr["tempCol"].','.$dr["humidCol"]
                        .','.$dr["lightCol"].','.$dr["rdsCol"].','.$rRate.','.$dr["rguageCol"].'],';
            }
            $datBody=rtrim($datBody,',');
            $conObj = null;
            echo ($datOpen.$datBody.$datClose);

        }catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            $conObj = null;
        }

    }
}
