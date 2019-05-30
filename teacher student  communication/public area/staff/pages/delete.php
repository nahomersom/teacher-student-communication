<?php

require_once('../../../admin area/initialize.php');
require_login();
if(!isset($_GET['id'])) {
  redirect_to(url_for('/staff/pages/index.php'));
}
$id = $_GET['id'];



if(request_is_post()) {
 $result=delete_pages($id);
 $_SESSION['message']='The subject sucessfully deleted';
 redirect_to(Url_for("/staff/pages/index.php"));
}else{
  $page = find_page_by_Id($id);
}

?>

<?php $page_title = 'Delete page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo WWW_ROOT.('/staff/pages/index.php'); ?>">&laquo; Back to List</a>

  <div class="page delete">
    <h1>Delete Subject</h1>
    <p>Are you sure you want to delete this subject?</p>
    <p class="item"><?php echo $page['menu_name']; ?></p>

    <form action="<?php echo WWW_ROOT.('/staff/pages/delete.php?id='. $page['id']); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete page" />
      </div>
    </form>
  </div>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?> 
