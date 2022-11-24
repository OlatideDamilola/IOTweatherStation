<?php
    require_once 'inc/dbBack.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>IOT Weather Station</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="asset/css/appstyle.css" rel="stylesheet" type="text/css">

</head>
<body class="bg-brandColor2">
    <div class="container ">
        <div class=" bg-darkCyan bg-brandColor2s">
            <div class=" pt-5-md">
                <div class=" divBanner w-50-lg text-bold pl-5-md fg-white text-left-md text-center-fs">IOTweatherStation</div>
                <ul data-role="tabs" class="flex-justify-end text-bold bg-darkCyan " data-expand-point="md">
                    <li class="fg-white"><a class="bg-darkCyan bg-white-focus fg-red-focus" id="D" href="#_DT"><span class="mif-table"></span> Data Table</a></li>
                    <li class=" fg-white "><a class="bg-darkCyan bg-white-focus fg-red-focus" id="R" href="#_RTG"><span class="mif-chart-line"></span> Real Time Graph</a></li>
                    <li  class="fg-white "><a class="bg-darkCyan bg-white-focus fg-red-focus" id="S" href="#_S"><span class="mif-cog"></span>Settings</a></li>
                </ul>
            </div>

        </div>
                <div class="">
                    <div id="_DT" class="h-vh-100" >
                        <div class="container bg-white pt-5">
                            <div class="row border border-3 py-4 px-2 mb-4">
                                <div class="cell-md-2 order-fs-4 order-md-1">
                                    <div class=" text-bold fg-teal">Date:</div>
                                    <div id="dispDate"></div>
                                </div>
                                <div class="cell-md-2 order-fs-4 order-md-1">
                                    <div class=" text-bold fg-teal  ">Time:</div>
                                    <div id="dispTime"></div>
                                </div>
                                <div class="cell-md-2 order-fs-3 order-md-2">
                                    <div class=" text-bold fg-teal">Sampling Interval:</div>
                                    <div id="dispIntava"></div>
                                </div>
                                <div class="cell-md-3 order-fs-2 order-md-3">
                                    <div class=" text-bold fg-teal">Description:</div>
                                    <div id="dispDescrip"></div>
                                </div>
                                <div id="frmTblSto" class="cell-md-3 order-fs-1 order-md-4" >
                                    <select class="" id="dbxStoSel" data-role="select" data-on-item-select="onItemSelect" >
                                        <option value="" SELECTED></option>
                                        <?php
                                            foreach ($GLOBALS['allDatStore'] as $v){?>
                                            <OPTION value = "<?php echo($v->pId);?>"  data-descrip="<?php echo($v->pstoDscp);?>" data-dDate="<?php echo($v->pstoDate);?>" data-dTime="<?php echo($v->pstoIntval);?>"> <?php echo ($v->pstoTitle);?> </OPTION>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>

                            <table class="table striped table-border mt-4"
                                   data-role="table"
                                   data-rows="10"
                                   data-rows-steps="5, 10"
                                   data-show-activity="true"
                                   data-rownum="false"
                                   data-check="true"
                                   data-source=""
                                   data-check-style="2"
                                   data-horizontal-scroll="true"
                                   data-show-inspector-button=true,
                                   id="tblMain">
                                <thead>
                                <tr>
                                    <th data-sortable="true" >Pressure(Pa)</th>
                                    <th data-sortable="true">Temperature(&degC)</th>
                                    <th data-sortable="true" data-format="number">Humidity(%)</th>
                                    <th data-sortable="true" data-format="number">Light(lux)</th>
                                    <th data-sortable="true" data-format="number">RDS(mm)</th>
                                    <th data-sortable="true" data-format="number">Rain Rate</th>
                                    <th data-sortable="true" data-format="number">Rain Gauge(mil)</th>
                                </tr>
                                </thead>
                            </table>

                            <div class="pos-fixed pos-bottom-right pr-5">
                                <div class="multi-action">
                                    <button class="action-button rotate bg-red fg-white"
                                            onclick="$(this).toggleClass('active')">
                                        <span class="icon"><span class="mif-plus"></span></span>
                                    </button>
                                    <ul class="actions drop-top">
                                        <li class="bg-blue"><a href="#" id="btnXpot" onclick="doXpot()"><span class="mif-cloud-download"></span></a></li>
                                        <li class="bg-teal"><a href="#" id="btnSnT" onclick="PSref()"><span class="mif-stop"></span></a></li>
                                        <li class="bg-pink"><a href="dashboard.php?l=o" id="btnSnT" ><span class="mif-replay"></span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="_S">
                        <div class="containers bg-white">
                            <span class="badge inside bg-pink fg-white" id="ddt">
                                <span class="mif-key fg-white" ></span>
                            </span>
                            <div data-role="collapse" data-toggle-element="#ddt" class="mb-8">
                                    <form method="post" action="dashboard.php" class="container bg-grayWhite border-dotted bd-gray border pb-2">
                                        <div class="fg-teal text-bold">Password Update</div>
                                        <div class="row ">
                                            <div class="cell-md-5">
                                                <input type="password" name="tbxOldPs" id="tbxOldPs" data-role="input"  placeholder="Old Password">
                                            </div>
                                            <div class="cell-md-5">
                                                <input type="password" name="tbxNewPs" id="tbxNewPs" data-role="input" placeholder="New password">
                                            </div>
                                            <div class="cell-md-2 ">
                                                <input type="submit" name="btnUpwd" class="button float-right-fs bg-red fg-white"  onclick="doPr()" value="Update">
                                            </div>
                                        </div>
                                    </form>
                            </div>

                            <form action="dashboard.php" method="POST" class="container bg-grayWhite border-dotted bd-gray border ">
                                <div class="fg-teal text-bold">Create Storage</div>
                                <div class="row">
                                    <div class="cell-md-6">
                                        <input type="text" name="tbxStoTitle" id="tbxStoTitle" data-role="input" data-label="Title">
                                    </div>
                                    <div class="cell-md-2">
                                        <input type="text" id="inpIntval" data-role="spinner" value="2" data-min-value="1" name="inpSpinner" data-label="Sampling Interval">
                                    </div>
                                    <div class="cell-md-4">
                                        <input id="dtpStoDate" name="dtpStoDate" data-role="calendarpicker" data-format="%d %b %Y"  data-show-time="true" data-label="Date\Time" data-initial-time="16:21">
                                    </div>
                                </div>
                                <textarea name="txaStoDescp" data-role="textarea" data-max-height="300" class="scrollbar-type-1" data-label="Description" data-cls-label="mt-4"></textarea>
                               <div class="m-2">
                                   <input type="checkbox" name="chkboxStoDef" data-role="checkbox" data-caption="Default" >
                                   <input class="button float-right bg-red fg-white" value="Create" onclick="doStore()" type="submit" name="btnStoCreate">
                               </div>

                            </form>

                            <div class="container border-dotted bd-gray border bg-grayWhite mt-8 pb-2">
                                <div class="fg-teal text-bold">Default Storage</div>
                                <form method="post">
                                    <?php
                                     foreach ($GLOBALS['allDatStore'] as $v){?>
                                         <input name="rDefSto" type="radio" data-role="radio" data-caption="<?php echo ($v->pstoTitle);?>" value="<?php echo($v->pId);?>" <?php if($v->pId==$_SESSION['defStoreID'])echo "checked";?> >
                                     <?php }?>
                                    <input type="submit" value="Update" name="btnSetDef" class="float-right bg-red fg-white striped" >
                                </form>
                            </div>
                            <div class="container bg-grayWhite border-dotted bd-gray border pb-2 mb-4 mt-8">
                                <div class="fg-teal text-bold">Merge Data</div>
                                <form method="post">
                                    <select data-role="select" name="cbxMergeTo">
                                        <?php
                                            foreach ($GLOBALS['allDatStore'] as $v){?>
                                                <OPTION value = "<?php echo($v->pId);?>" > <?php echo ($v->pstoTitle);?></OPTION>
                                        <?php }?>
                                    </select>
                                    <textarea name="tbxMerge" id="tbxMerge" data-role="textarea" data-max-height="300" class="scrollbar-type-1" data-label="Local Data" data-cls-label="mt-4"></textarea>
                                    <input type="submit" value="Merge" name="btnMerge" onclick="doMerge()" class="button float-right bg-red fg-white mt-2" >
                                </form>
                            </div>
                    </div>

                </div>
                    <div id="_RTG">
                        <figure class="containers h-vh-100">
                            <div id="chtCanvas"></div>
                        </figure>
                    </div>
            </div>


        <input type="hidden" id="ps" value="<?php echo $GLOBALS['pMsg']?>">
        <input type="hidden" id="curPg" value="<?php echo $GLOBALS['curPg']?>">
        <input type="hidden" id="defSto" value="<?php echo $_SESSION['defStoreID']?>">
        <div class="info-box" data-role="info-box" id="msgBox" data-type="alert" data-auto-hide="4000" data-overlay-click-close="true">
            <span class="button square closer"></span>
            <div class="info-box-content">
                <h4><span class="mif-info"></span> ATTENTION </h4>
                <p id="infoMsg"></p>
            </div>
        </div>


        <script src="asset/js/highcharts.js" type="text/javascript"></script>
        <script src="asset/js/dChart.js" type="text/javascript"></script>
        <script src="asset/js/metro.min.js" type="text/javascript"></script>
        <script src="asset/js/site.js" type="text/javascript"></script>
    </div>
</body>
</html>