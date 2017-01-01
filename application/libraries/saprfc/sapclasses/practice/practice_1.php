<html>

<head>

   <title>RFC/BAPI : Test Connection</title>

</head>

<body>

<h1>RFC/BAPI : Test Connection</h1>

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

       

       $sap->Close();

?>

</body>

</html>

