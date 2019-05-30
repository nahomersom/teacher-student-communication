
<?php
session_start();

define("ADMINAREA_PATH", dirname(__FILE__));

define("PROJECT_PATH", dirname(ADMINAREA_PATH));

define("PUBLICAREA_PATH", PROJECT_PATH . '/public area');

define("SHARED_PATH", ADMINAREA_PATH . '/shared');

define("CSS",PUBLICAREA_PATH . '/stylesheet');

 //$public_end = strpos($_SERVER['SCRIPT_NAME'], '/public area') + 7;
  
//$doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
//define("WWW_ROOT",$doc_root);
  
define("WWW_ROOT",'/my_first php project/public area');

require_once('validation_functions.php');
//require_once('validate_page_functions.php')
require_once('query_function.php');

require_once('functions.php');
require_once('database.php');
 require_once('auth_functions.php');
$db=db_connect();

$errors=[];
?>