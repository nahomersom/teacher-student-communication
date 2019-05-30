<?php require_once('../../../admin area/initialize.php'); ?>


<?php
require_login();
$subject_set=find_all_pages();
result_set_problem($subject_set);
?>




<?php $page_title='pages'?>

<?php include(SHARED_PATH.'/staff_header.php');?>

<div id="content">
  <div class="subjects listing">
    <h1>Pages</h1>

    <div class="actions">
      <a class="action" href="<?php echo WWW_ROOT.('/staff/pages/new.php');?>">Create New Pages</a>
    </div>

  	<table class="list">
  	  <tr>
        <th>ID</th>
        <th>subjects</th>
        <th>position</th>
  	    <th>visible</th>
        <th>page</th>
        
  	    <th>&nbsp;</th>
  	    <th>&nbsp;</th>
        <th>&nbsp;</th>
         <th>&nbsp;</th>
           <th>&nbsp;</th>
  	  </tr>

<?php while($page=mysqli_fetch_assoc($subject_set)) { ?>
<?php $subject=find_subjects_by_ID($page['subject_id']);?>
        <tr>
      
          <td><?php echo $page['id']; ?></td>
     <td><?php echo $subject['Menu_name']; ?></td>
          <td><?php echo $page['position']; ?></td>
          <td><?php echo $page['visible'] == 1 ? 'true' : 'false'; ?></td>
          <td><?php echo $page['menu_name']; ?></td>
        
       
     <td><a class="action" href="<?php echo WWW_ROOT.('/staff/pages/show.php?id='.$page['id'])?>">View</a></td>
          <td><a class="action" href="<?php echo WWW_ROOT.('/staff/pages/edit.php?id='.$page['id'])?>">Edit</a></td>
          <td><a class="action" href="<?php echo WWW_ROOT.('/staff/pages/delete.php?id='.$page['id'])?>">Delete</a></td>
    	  </tr>
      <?php } ?>
  	</table>

  </div>

</div>
<?php include(SHARED_PATH.'/footer.php');?>