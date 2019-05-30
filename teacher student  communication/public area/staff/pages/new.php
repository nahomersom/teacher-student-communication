
<?php require_once('../../../admin area/initialize.php');

if(request_is_post()){
  $page=[];
$page['menu_name']=$_POST['menu_name'];
$page['position']=$_POST['position'];
$page['visible']=$_POST['visible'];
$page['subject_id']=$_POST['subject_id'];
$page['content']=$_POST['content'];
$result=insert_into_page($page);

  
if($result===true){
 
  $show_id=mysqli_insert_id($db);
   $_SESSION['message']='The subject sucessfully inserted';
  redirect_to(Url_for("/staff/pages/show.php?id=" . $show_id));
}

else{
  $errors=$result;
}
}
else{
  
}

$page_set=find_all_pages();
$page_count=mysqli_num_rows($page_set)+1;
$page=[];
$page['position']=$page_count;


?>
<?php $page_title = 'Create Pages'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo WWW_ROOT.('/staff/pages/index.php'); ?>">&laquo; Back to List</a>

  <div class="subject new">
    <h1>Create Pages</h1>
    <?php echo display_errors($errors);?>

    <form action="<?php echo WWW_ROOT.('/staff/pages/new.php');?>" method="post">
      <dl>
        <dt>Menu Name</dt>
        <dd><input type="text" name="menu_name" value="<?php echo h($menu_name); ?>" /></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd>
          <select name="position">
            <?php for($i=1;$i<=$page_count;$i++){
            echo "<option value=\"{$i}\"";
            if(page['position']==$i){
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
          <input type="checkbox" name="visible" value="1"<?php if($visible="1"){echo "selected";}?> />
        </dd>
      </dl>
     <dl>
        <dt>Subject</dt>
        <dd>
          <select name="subject_id">
          <?php
            $subject_set = find_all_subjects();
            while($subject = mysqli_fetch_assoc($subject_set)) {
              echo "<option value=\"" . h($subject['id']) . "\"";
              if($page["subject_id"] == $subject['id']) {
                echo " selected";
              }
              echo ">" . h($subject['Menu_name']) . "</option>";
            }
            mysqli_free_result($subject_set);
          ?>
          </select>
        </dd>
      </dl>
       <dl>
      <dt>Content</dt>
      <dd>
      <input type="text"  name="content">
      </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Create Pages" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
