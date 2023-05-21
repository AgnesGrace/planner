<?php require APPROOT . '/views/includes/header.php';?>

<div class="jumbotron bg-primary text-white text-center">
    <div class="container">
        <h1 class="display-4"><?php echo $data['title'];?></h1>
        <p class="lead">Developer Learning Planner App </p>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2>Get Organized, Plan Your Learning Journey</h2>
            <p class="text-muted">The Developer Learning Planner App helps you organize and plan your learning journey effectively. With this app, you can set goals, create tasks, and track your progress as you learn new programming languages, frameworks, and technologies.</p>
            <a href="<?php echo URLROOT;?>/plans/add" class="btn btn-primary">Add New Plan</a>
        </div>
        <div class="col-md-6">
            <h2>Track Your Progress</h2>
            <p class="text-muted">Stay on top of your learning progress with the Developer Learning Planner App. Easily track your completed tasks, monitor your achievements, and visualize your progress through intuitive charts and graphs. The app provides valuable insights to help you stay motivated and reach your learning goals.</p>
            <a href="<?php echo URLROOT;?>/progress" class="btn btn-secondary">View Progress</a>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/includes/footer.php';?>
