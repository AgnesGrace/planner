<?php require APPROOT . '/views/includes/header.php';?>
<a href="<?php echo URLROOT;?>/plans" class="btn btn-light"><i class="fa fa-backward"></i> Go Back</a>
<hr>
<h1><?php echo $data['plan']->title;?></h1>
<p><?php echo $data['plan']->body;?></p>
<div class="bg-secondary text-white p-2 mb-3">
    
    By:<?php echo $data['user']->name;?> On <?php echo $data['plan']->created_at;?>
</div>
<?php if($data['plan']->user_id == $_SESSION['user_id']): ?>
    <a href="<?php echo URLROOT;?>/plans/edit/<?php echo $data['plan']->id;?>" class="btn btn-dark">Edit Plan</a>
    <form action="<?php echo URLROOT;?>/plans/delete/<?php echo $data['plan']->id;?>" method="post" class="float-end">
    <input type="submit" class="btn btn-danger" value="delete">
    </form>
<?php endif?>
<?php require APPROOT . '/views/includes/footer.php';?>
