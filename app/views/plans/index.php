<?php require APPROOT . '/views/includes/header.php';?>
<?php flash('plan_message')?>
<div class="row mb-3">
   <div class="col-md-6">
     <h1><span class="text-body-secondary"><?php echo $_SESSION['user_name']?></span> Plans</h1>
    </div>
    <div class="col-md-6">
        <a href="<?php echo URLROOT;?>/plans/add" class="btn btn-primary float-end">
            <i class="fa fa-pencil"></i>
            Add Plans
        </a>     
    </div>
</div>
<?php foreach($data['plans'] as $plans):?>
    <div class="card card-body mb-3">
        <h4 class="card-title"><?php echo $plans->title;?></h4>
        <div class="bg-light p-2 mb-3">
            By: <?php echo $plans->name;?> on <?php echo $plans->plansCreated;?>
        </div>
        <p class="card-text"><?php echo $plans->body;?></p>
        <a href="<?php echo URLROOT?>/plans/show/<?php echo $plans->planId;?>" class="btn btn-dark">View More</a>
    </div>
<?php endforeach;?>
<?php require APPROOT . '/views/includes/footer.php';?>
