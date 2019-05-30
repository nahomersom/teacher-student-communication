
<?php
function validate_subject($subject) {
    $errors = [];

    // menu_name
    if(is_blank($subject['menu'])) {
      $errors[] = "Name cannot be blank.";
    } elseif(!has_length($subject['menu'], ['min' => 2, 'max' => 255])) {
      $errors[] = "Name must be between 2 and 255 characters.";
    }

    // position
    // Make sure we are working with an integer
    $postion_int = (int) $subject['position'];
    if($postion_int <= 0) {
      $errors[] = "Position must be greater than zero.";
    }
    if($postion_int > 999) {
      $errors[] = "Position must be less than 999.";
    }

    // visible
    // Make sure we are working with a string
    $visible_str = (string) $subject['visible'];
    if(!has_inclusion_of($visible_str, ["0","1"])) {
      $errors[] = "Visible must be true or false.";
    }

    return $errors;
  }


function validate_page($page) {
    $errors = [];

    // subject_id
    if(is_blank($page['subject_id'])) {
      $errors[] = "Subject cannot be blank.";
    }

    // menu_name
    if(is_blank($page['menu_name'])) {
      $errors[] = "Name cannot be blank.";
    } elseif(!has_length($page['menu_name'], ['min' => 2, 'max' => 255])) {
      $errors[] = "Name must be between 2 and 255 characters.";
    }
    $current_id = $page['id'] ?? '0';
    if(!has_unique_page_menu_name($page['menu_name'], $current_id)) {
      $errors[] = "Menu name must be unique.";
    }
    


    // position
    // Make sure we are working with an integer
    $postion_int = (int) $page['position'];
    if($postion_int <= 0) {
      $errors[] = "Position must be greater than zero.";
    }
    if($postion_int > 999) {
      $errors[] = "Position must be less than 999.";
    }

    // visible
    // Make sure we are working with a string
    $visible_str = (string) $page['visible'];
    if(!has_inclusion_of($visible_str, ["0","1"])) {
      $errors[] = "Visible must be true or false.";
    }

    // content
    if(is_blank($page['content'])) {
      $errors[] = "Content cannot be blank.";
    }


    return $errors;
  }
  
function find_all_subjects($options=[]){
  $visible=$options['visible'] ?? false;
	global $db;
$sql="SELECT * FROM subjects ";
if($visible){
  $sql.="Where visible=true ";
}
$sql .= "ORDER BY position ASC";
	$result=mysqli_query($db, $sql);
	return $result;
}
function find_subjects_by_Id($id,$options=[]){
 
	global $db;
   $visible=$options['visible'] ?? false;
	$sql="SELECT * FROM subjects ";
	$sql.="WHERE id='".db_escape($db,$id)."' ";
  if($visible){
    $sql.="AND visible=true"; 
  }
	
	$result=mysqli_query($db, $sql);
	$subject=mysqli_fetch_assoc($result);
	return $subject;

}
function insert_into_subjects($subject){
global $db;
$errors=validate_subject($subject);
if(!empty($errors)){
return $errors;
}

$insert="INSERT INTO subjects ";
$insert.="(Menu_name, position, visible) "; 
$insert.="values (";
$insert.="'" . db_escape($db,$subject['menu']). "',"; 
$insert.="'" .  db_escape($db,$subject['position']) . "',";
$insert.="'" .db_escape($db,$subject['visible']) . "'";
$insert.=")";
$result=mysqli_query($db,$insert);
if($result){

return true;

}
else{
	echo mysqli_error($db);
	 db_disconnect($db);
      exit;
}

}
function update_subjects($subject){

global $db;
$errors=validate_subject($subject);
if(!empty($errors)){
return $errors;
}

$sql="UPDATE subjects SET ";
$sql.="Menu_name='".db_escape($db,$subject['menu'])."',";
$sql.="position='".db_escape($db,$subject['position'])."',";
$sql.="visible='".db_escape($db,$subject['visible'])."' ";
$sql.="Where id='".db_escape($db,$subject['id'])."'";
$sql.="Limit 1";
$result=mysqli_query($db,$sql);
if($result){
  return true;
}
else{
  echo mysqli_error($db);
   db_disconnect($db);
      exit;
}
}
function delete_subjects($id){
	global $db;
	 $sql="Delete from subjects ";
  $sql.="where id='".db_escape($db,$id)."' ";
  $sql.="Limit 1";
$result=mysqli_query($db,$sql);
if($result){
return true;
}
else{
  echo mysqli_error($result);
}
}
function find_all_pages(){
	global $db;
	$sql="SELECT * FROM page ";
$sql .= "ORDER BY id ASC";
$result=mysqli_query($db, $sql);
return $result;
}
function find_page_by_ID($id,$option=[]){
  $visible=$option['visible'] ?? "";

	global $db;
	$sql="SELECT * FROM page ";
	$sql.="Where id=' ".db_escape($db,$id)."' ";
  if($visible){
    $sql.="AND visible=true";
  }
	$result=mysqli_query($db,$sql);
	$page=mysqli_fetch_assoc($result);
	return $page;
}


function insert_into_page($page){
	global $db;
	$errors=validate_page($page);
	if(!empty($errors)){
return $errors;
}
	$sql="INSERT INTO page ";
	$sql.="(menu_name,position,visible,subject_id,content) ";
	$sql.="Values (";
	$sql.="'".db_escape($db,$page['menu_name'])."',";	
	$sql.="'".db_escape($db,$page['position'])."',";
	$sql.="'".db_escape($db,$page['visible'])."',";
	$sql.="'".db_escape($db,$page['subject_id'])."',";
	$sql.="'".db_escape($db,$page['content'])."'";
	$sql.=")";
    $result=mysqli_query($db,$sql);
    if($result){
    	return true;
    }
    else {
    	echo mysqli_error($db);
    }
}
function update_pages($page){
	global $db;
	$errors=validate_page($page);
		if(!empty($errors)){
return $errors;
}
	$sql="UPDATE page SET ";
	$sql.="menu_name='".db_escape($db,$page['menu_name'])." ',";
	$sql.="position=' ".db_escape($db,$page['position'])." ',";
	$sql.="visible=' ".db_escape($db,$page['visible'])." ' ,";
	$sql.="subject_id=' ".db_escape($db,$page['subject_id'])." ',";
	$sql.="content= ' ".db_escape($db,$page['content'])." ' ";
	$sql.="WHERE id=' ".db_escape($db,$page['id'])." ' ";
	$sql.="Limit 1";
	$result=mysqli_query($db,$sql);
	if($result){
		return true;
	}
	else{
		mysqli_error($db);
	}



}
function delete_pages($id){
	global $db;
	 $sql="Delete from page ";
  $sql.="where id='".db_escape($db,$id)."' ";
  $sql.="Limit 1";
$result=mysqli_query($db,$sql);
	if($result){
		return true;
	}
	else{
		mysqli_error($db);
	}
}
 function find_pages_by_subject_id($subject_id,$options=[]) {
    global $db;
$visible=$options['visible'] ?? false;
    $sql = "SELECT * FROM page ";
    
    $sql .= "WHERE subject_id='" . db_escape($db, $subject_id) . "' ";
    if($visible){
      $sql .="AND visible=true ";
  }
    $sql .= "ORDER BY position ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }
  function find_all_admins() {
    global $db;

    $sql = "SELECT * FROM admins ";
    $sql .= "ORDER BY last_name ASC, first_name ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_admin_by_id($id) {
    global $db;

    $sql = "SELECT * FROM admins ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $admin = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $admin; // returns an assoc. array
  }
    function find_admin_by_username($username) {
    global $db;

    $sql = "SELECT * FROM admins ";
    $sql .= "WHERE username='" . db_escape($db, $username) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $admin = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $admin; // returns an assoc. array
  }

  function validate_admin($admin,$options=[]) {///empty array by default may or may not exist
$password_required=$options['password_required'] ?? true;
    if(is_blank($admin['first_name'])) {
      $errors[] = "First name cannot be blank.";
    } elseif (!has_length($admin['first_name'], array('min' => 2, 'max' => 255))) {
      $errors[] = "First name must be between 2 and 255 characters.";
    }

    if(is_blank($admin['last_name'])) {
      $errors[] = "Last name cannot be blank.";
    } elseif (!has_length($admin['last_name'], array('min' => 2, 'max' => 255))) {
      $errors[] = "Last name must be between 2 and 255 characters.";
    }

    if(is_blank($admin['email'])) {
      $errors[] = "Email cannot be blank.";
    } elseif (!has_length($admin['email'], array('max' => 255))) {
      $errors[] = "Last name must be less than 255 characters.";
    } elseif (!has_valid_email_format($admin['email'])) {
      $errors[] = "Email must be a valid format.";
    }

    if(is_blank($admin['username'])) {
      $errors[] = "Username cannot be blank.";
    } elseif (!has_length($admin['username'], array('min' => 8, 'max' => 255))) {
      $errors[] = "Username must be between 8 and 255 characters.";
    } elseif (!has_unique_username($admin['username'], $admin['id'] ?? 0)) {
      $errors[] = "Username not allowed. Try another.";
    }
if($password_required){
      if(is_blank($admin['password'])) {
      $errors[] = "Password cannot be blank.";
    } elseif (!has_length($admin['password'], array('min' => 12))) {
      $errors[] = "Password must contain 12 or more characters";
    } elseif (!preg_match('/[A-Z]/', $admin['password'])) {///this is not from our validation function it's just string function to check 2 strings and return true or false
      $errors[] = "Password must contain at least 1 uppercase letter";
    } elseif (!preg_match('/[a-z]/', $admin['password'])) {
      $errors[] = "Password must contain at least 1 lowercase letter";
    } elseif (!preg_match('/[0-9]/', $admin['password'])) {
      $errors[] = "Password must contain at least 1 number";
    } elseif (!preg_match('/[^A-Za-z0-9\s]/', $admin['password'])) {
      $errors[] = "Password must contain at least 1 symbol";
    }

    if(is_blank($admin['confirm_password'])) {
      $errors[] = "Confirm password cannot be blank.";
    } elseif ($admin['password'] !== $admin['confirm_password']) {
      $errors[] = "Password and confirm password must match.";
    }
}
    return $errors;
  }




  function insert_admin($admin) {
    global $db;

    $errors = validate_admin($admin);
    if (!empty($errors)) {
      return $errors;
    }

    $hashed_password = password_hash($admin['password'],PASSWORD_BCRYPT);

    $sql = "INSERT INTO admins ";
    $sql .= "(first_name, last_name, email, username, hashed_password) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $admin['first_name']) . "',";
    $sql .= "'" . db_escape($db, $admin['last_name']) . "',";
    $sql .= "'" . db_escape($db, $admin['email']) . "',";
    $sql .= "'" . db_escape($db, $admin['username']) . "',";
    $sql .= "'" . db_escape($db, $hashed_password) . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);

    // For INSERT statements, $result is true/false
    if($result) {
      return true;
    } else {
      // INSERT failed
      echo mysqli_error($db);
      ///db_disconnect($db);
      exit;
    }
  }

  function update_admin($admin) {
    global $db;
$password_sent=!is_blank($admin['password']);//to check whether the admin wanna to updated his/her password or not
    $errors = validate_admin($admin,['password_required'=>$password_sent]);//this will gonna send $password sent as associative array to '[assword_required' variable to validat_admin
    if (!empty($errors)) {
      return $errors;
    }

        $hashed_password = password_hash($admin['password'],PASSWORD_BCRYPT);

    $sql = "UPDATE admins SET ";
    $sql .= "first_name='" . db_escape($db, $admin['first_name']) . "', ";
    $sql .= "last_name='" . db_escape($db, $admin['last_name']) . "', ";
    $sql .= "email='" . db_escape($db, $admin['email']) . "', ";
    if($password_sent){
    $sql .= "hashed_password='" . db_escape($db, $hashed_password) . "',";
    }
    $sql .= "username='" . db_escape($db, $admin['username']) . "' ";
    $sql .= "WHERE id='" . db_escape($db, $admin['id']) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    // For UPDATE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // UPDATE failed
      echo mysqli_error($db);
      ///db_disconnect($db);
      exit;
    }
  }

  function delete_admin($admin) {
    global $db;

    $sql = "DELETE FROM admins ";
    $sql .= "WHERE id='" . db_escape($db, $admin['id']) . "' ";
    $sql .= "LIMIT 1;";
    $result = mysqli_query($db, $sql);

    // For DELETE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // DELETE failed
      echo mysqli_error($db);
      ///db_disconnect($db);
      exit;
    }
  }

?>
