

<?php
if (preg_match("/.connect.php/i", $_SERVER['PHP_SELF'])){
echo "<script language='javascript'>alert('ERROR'); history.back();</script>"; 
exit;
}  
?>
<?php
include_once ("sapclasses/sap.php");
$LOGIN = array ("ASHOST"=>'192.168.2.11', //Hostname
                "SYSNR"=>'00',  //System Number
                "CLIENT"=>'800',  
                "USER"=>'adit',  //Username
                "PASSWD"=>'123456', //Password
                "CODEPAGE"=>"1404");
$Table1 = 'ZTALENTPOOL';
$function = 'ZREPORT_ASCENDINGDATE';

//Try to connect to SAP using our Login array
   $rfc1 = saprfc_open ($LOGIN);
   IF (! $rfc1 )
   {
       ECHO "The RFC connection has failed with the following error:".saprfc_error();
       EXIT;
   }

//We must know if the function really exists
   $fce1 = saprfc_function_discover($rfc1, $function);
   IF (! $fce1 )
   {
       ECHO "The function module has failed.";
       ECHO $rfc1;
       EXIT;
   }

//Convert to uppercase the name of the table to show
   

//Pass import parameters
   saprfc_import ($fce1,"QUERY_TABLE",$Table1);
   saprfc_import ($fce1,"DELIMITER","/");
//Pass table parameters
   saprfc_table_init ($fce1,"OPTIONS");
   saprfc_table_init ($fce1,"FIELDS");
   saprfc_table_init ($fce1,"DATA");

//Call and execute the function
   $rc = saprfc_call_and_receive ($fce1);
   if ($rfc_rc != SAPRFC_OK)
   {
       if ($rfc == SAPRFC_EXCEPTION )
           echo ("Exception raised: ".saprfc_exception($fce1));
       else
           echo ("Call error: ".saprfc_error($fce1));
       exit;
   }

//Fetch the data from the internal tables
   $data_row = saprfc_table_rows ($fce1,"DATA");
   $field_row = saprfc_table_rows ($fce1,"FIELDS");
	?>