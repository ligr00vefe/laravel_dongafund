<?php

include_once dirname(__FILE__, 2) .'/common/sso_common.php';
include_once dirname(__FILE__, 2). '/common/sp_const.php';



$eXSignOnUserId = null;

session_start();

echo "세션<br>";

if(isset($_SESSION[SSO_SESSION_NAME]) && $_SESSION[SSO_SESSION_NAME] != null) {
  $eXSignOnUserId = $_SESSION[SSO_SESSION_NAME];
}


echo "세션22<br>";

if($eXSignOnUserId == null || (strcmp(SSO_SESSION_ANONYMOUSE, $eXSignOnUserId) == 0)) {
  if(strcmp(SSO_SESSION_ANONYMOUSE, $eXSignOnUserId) == 0) {
    unset($_SESSION[SSO_SESSION_NAME]);
  }

  $paramMap[ID_NAME] = SP_ID;
  $paramMap[AC_NAME] = "N";
  $paramMap[IFA_NAME] = "N";
  $paramMap[RELAY_STATE_NAME] = $_SERVER['REQUEST_URI'];

  $redirectUrl = generateUrlWithParam(IDP_URL, AUTH_URL, $paramMap);

  header("Location:" . $redirectUrl);

  return;
} else if(strcmp(SSO_SESSION_ANONYMOUSE_IDENTIFY, $eXSignOnUserId) == 0) {
  $_SESSION[SSO_SESSION_NAME] = SSO_SESSION_ANONYMOUSE;
  $eXSignOnUserId = $_SESSION[SSO_SESSION_NAME];
}

echo "세션33<br>";
exit

?>
