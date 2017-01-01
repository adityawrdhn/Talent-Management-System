<?php
require_once('saprfc.php');
$submitted = $_GET['submitted'];
/**
 * Login to SAP system
 * @param String $user
 * @param String $pwd
 */
function login($user, $pwd) {
    //Create SAPRFC instance
    $sap = new saprfc(array(
            "logindata" => array(
                  "ASHOST"  => "HOSTNAME",
                  "SYSNR"   => "SYSTEM NUMBER",
                  "CLIENT"  => "CLIENT NUMBEr",
                      "USER"    => "USERNAME",
                  "PASSWD"  => "PASSWORD"
                    ),
            "show_errors"=>true,
            "debug"      =>false));
 
    return $sap;
}
function logoff($sap) {
    $sap->logoff();
}
/**
 * Function to call SAP RFC
 * @param saprfc $sap
 */
function callRFC($sap, $params) {
    $cust_params = $params['cust_params'];
    $task_params = $params['task_params'];
    $proj_params = $params['proj_params'];
    $result = $sap->callFunction("ZGRAPH_TOTALDAYS_RFC",
             array(
                   array("IMPORT","CUST_PARAMS",$cust_params),
                   array("IMPORT","TASK_PARAMS",$task_params),
                   array("IMPORT","PROJ_PARAMS",$proj_params),
                   array("EXPORT","CATEGORIES",array()),
                   array("EXPORT","DATA_ACTUAL",array()),
                   array("EXPORT","DATA_ESTIMATE",array())
                       )
                    );
    return $result;
}
?>