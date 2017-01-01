<html>

<head>

   <title>RFC/BAPI: Get List of Users in SAP-System</title>

</head>

<body>

<h1>RFC/BAPI: Get List of Users in SAP-System</h1>

<?php
    include_once("../sap.php");
    $sap = new SAPConnection();
    $sap->Connect("logon_data.conf");
    if ($sap->GetStatus() == SAPRFC_OK ) $sap->Open ();
    if ($sap->GetStatus() != SAPRFC_OK ) {
       $sap->PrintStatus();
       exit;
    }else{
          echo "Login succeed.";
    }
    $fce = &$sap->NewFunction("ZPD_GETDATA");
    if ($fce == false ) {
       $sap->PrintStatus();
       exit;
    }
    $fce->GD_ID = "0"; // "0" => Get All User
    $fce->GD_NAME = "0";
    $fce->GD_COMP = "0";
    $fce->GD_PERF = "0";

    $fce->Call();

       

    if ($fce->GetStatus() == SAPRFC_OK) {

               //Get Data

               

               //Export

               // echo "Total Rows : ", $fce->ROWS,"<br/>";

               

        //Tables
  ?>
        <table width="100%" border="0" cellpadding="0" cellspacing="1">
                               <tr bgcolor='#666666'>
                                       <td>ID</td>
                                       <td>NAME</td>
                                       <td>COMPETENCY</td>
                                       <td>PERFROMANCE</td>
                               </tr>
    <?php
        $fce->GD_TP->Reset();
               //Display Tables
        while ( $fce->GD_TP->Next() ){
	?> 							<tr bgcolor="#CCCCCC">
                                       <td><?php echo $fce->GD_TP->row["ID"] ?></td>
                                       <td><?php echo $fce->GD_TP->row["NAME"] ?></td>
                                       <td><?php echo $fce->GD_TP->row["COMPETENCY"] ?></td>
                                       <td><?php echo $fce->GD_TP->row["PERFORMANCE"] ?></td>
                                </tr>
   <?php }?>

    	</table>                         

    <?php } else

        $fce->PrintStatus();

 

       $sap->Close();

	?>

</body>

</html>
