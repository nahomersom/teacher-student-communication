<?php require_once('../../../admin area/initialize.php');?>
<?php
require_login();
$id=$_GET['id'] ?? 'unexpected page';


$subject=find_subjects_by_Id($id);
?>
<?php $page_title="show subject";?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>
<div id='content'>
<a class='back-link' href="<?php echo WWW_ROOT.('/staff/subjects/index.php');?>">back to list</a>
	<div id='show subject'>
<h1>Subject: <?php echo h($subject['Menu_name']); ?></h1>

<div class="attributes">
  <dl>
    <dt>Menu Name</dt>
    <dd><?php echo h($subject['Menu_name']); ?></dd>
  </dl>
  <dl>
    <dt>Position</dt>
    <dd><?php echo h($subject['position']); ?></dd>
  </dl>
  <dl>
    <dt>Visible</dt>
    <dd><?php echo $subject['visible'] == '1' ? 'true' : 'false'; ?></dd>
  </dl>
</div>

	</div>
</div>
