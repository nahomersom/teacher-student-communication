<?php require_once('../../../admin area/initialize.php');?>
<?php
require_login();
$id=$_GET['id'] ?? 'unexpected page';


$page=find_page_by_ID($id);
?>
<?php $page_title="show page";?>
 <?php include(SHARED_PATH.'/staff_header.php');?>
<div id='content'>
<a class='back-link' href="<?php echo WWW_ROOT.('/staff/pages/index.php');?>">back to list</a>
	<div id='show subject'>
<h1>Page: <?php echo h($page['menu_name']); ?></h1>
 <div class="actions">
      <a class="action" href="<?php echo url_for('/index.php?id=' . h(u($page['id'])) . '&preview=true'); ?>" target="_blank">Preview</a>
    </div>
<div class="attributes">
<?php $subject=find_subjects_by_ID($page['subject_id']);?>
  <dl>
    <dt>Page Name</dt>
    <dd><?php echo h($page['menu_name']); ?></dd>
  </dl>
  <dl>
    <dt>Position</dt>
    <dd><?php echo h($page['position']); ?></dd>
  </dl>
  <dl>
    <dt>Visible</dt>
    <dd><?php echo h($page['visible']) == '1' ? 'true' : 'false'; ?></dd>
     </dl>
     <dl>
    <dt>content</dt>
    <dd><?php echo h($page['content']); ?></dd>
  </dl>
   <dl>
    <dt>subject</dt>
    <dd><?php echo h($subject['Menu_name']); ?></dd>
  </dl>
  
</div>

	</div>
</div>
