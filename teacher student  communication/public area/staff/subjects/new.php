
<?php require_once('../../../admin area/initialize.php');
require_login();
if(request_is_post()){
  $subject=[];
$subject['menu']=$_POST['menu_name'];
$subject['position']=$_POST['position'];
$subject['visible']=$_POST['visible'];

$result=insert_into_subjects($subject);
if($result===true){
 $_SESSION['message']=" new subject sucesfully added";
  $show_id=mysqli_insert_id($db);
  redirect_to(Url_for("/staff/subjects/show.php?id=" . $show_id));
}
else{
  $errors=$result;
}
}

else{
 /// redirect_to(Url_for("/staff/subjects/new.php"));instead of redirect we're gonna to redisplay
}



$subject_set=find_all_subjects();
$subject_count=mysqli_num_rows($subject_set) + 1;
$subject=[];
$subject['position']=$subject_count;

?>
<?php $page_title = 'Create Subject'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo WWW_ROOT.('/staff/subjects/index.php'); ?>">&laquo; Back to List</a>

  <div class="subject new">
    <h1>Create Subject</h1>
<?php echo display_errors($errors);?>
    <form action="<?php echo WWW_ROOT.('/staff/subjects/new.php');?>" method="post">
      <dl>
        <dt>Menu Name</dt>
        <dd><input type="text" name="menu_name" value="" /></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd>
          <select name="position">
            <?php for($i=1;$i<=$subject_count;$i++){
            echo "<option value=\"{$i}\"";
            if(subject['position']==$i){
              echo "selected";
            }
            echo ">{$i}</option>";
                      }
 ?>
          </select>
        </dd>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd>
          <input type="hidden" name="visible" value="0" />
          <input type="checkbox" name="visible" value="1" />
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Create Subject" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
