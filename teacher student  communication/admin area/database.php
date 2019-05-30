<?php
require_once("db_credintial.php");
?>
<?php
function db_connect(){
$connection=mysqli_connect(SERVER,USERNAME,Password,DB_name);
db_confirm_connection();

return $connection;
}
function db_close(){
	if(isset($connection)){
	mysqli_close($connection);
}
}
function db_confirm_connection(){
	if(mysqli_connect_errno()){
		$msg="SOME problems occured";
		$msg.=mysqli_connect_error();
		$msg.=mysqli_connect_errno();
		exit($msg);

	}
}
function result_set_problem($result_set){
	if(!$result_set){
		exit("invalid");
	}
}

  function db_escape($connection, $string) {
    return mysqli_real_escape_string($connection, $string);
  }
 function confirm_result_set($result_set) {
    if (!$result_set) {
    	exit("Database query failed.");
    }
  }

?>
