<?php echo render_cell ('frame_cell', 'header', array ()); ?>

<div id='container'>

<?php 
  if ($message) { ?>
    <div class='message'><?php echo $message;?></div>
<?php 
  } ?>

<?php echo render_cell ('frame_cell', 'conditions', $qs); ?>

<?php 
  if ($error) { ?>
    <div class='error'><?php echo $error;?></div>
<?php 
  } ?>
  
<?php echo render_cell ('frame_cell', 'hosts', $hosts); ?>
<?php echo render_cell ('frame_cell', 'pagination', $pagination); ?>

</div>  

<?php echo render_cell ('frame_cell', 'footer', array ()); ?>
