<?php require_once('../admin area/initialize.php'); ?>
<?php 
$preview = false;
if(isset($_GET['preview'])) {
  // previewing should require admin to be logged in
  $preview = $_GET['preview'] == 'true' && is_logged_in() ? true : false;// must be exist when when you logged in before we use the user on public area see the content that doesn't belong to him by simply clicking the preview link
}
$visible = !$preview;

if(isset($_GET['id'])){
	$page_id=$_GET['id'];
	$page=find_page_by_ID($page_id,['visible'=>$visible]);
	if(!$page){
		redirect_to(url_for('/index.php'));
	}
	$subject_id=$page['subject_id'];////this one is for a page that is visible but are not subjects
	$subject=find_subjects_by_ID($subject_id,['visible'=>$visible]);
if(!$subject){
	redirect_to(url_for('/index.php'));
}
}
	elseif(isset($_GET['subject_id'])){
$subject_id=$_GET['subject_id'];
$subject=find_subjects_by_ID($subject_id,['visible'=>$visible]);
if(!$subject){
	redirect_to(url_for('/index.php'));
}
$page_set=find_pages_by_subject_id($subject_id,['visible'=>$visible]);
$page=mysqli_fetch_assoc($page_set);
mysqli_free_result($page_set);
if(!$page){
	redirect_to(url_for('/index.php'));
}
$page_id=$page['id'];
	}else{
		///if nothing show homepage
	} 

?>
<?php include(SHARED_PATH . '/public_header.php'); ?>

<div id="main">
<?php include(SHARED_PATH . '/public_navigation.php'); ?>
  <div id="page">
  <?php
  if(isset($page)){
  	$allow_tags='<img><div><h1><h2><p><br><strong><em><ul><li>';
   echo  strip_tags($page['content'],$allow_tags);
   }
   else{

   
   include(SHARED_PATH . '/static_homepage.php');
}
?>
  </div>

</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
