<?php require APPROOT . '/views/includes/header.php';?>

<div class="jumbotron bg-primary text-white text-center">
    <div class="container">
        <h1 class="display-4"><?php echo $data['title'];?></h1>
        <p class="lead">Welcome to the Developer Learning Planner App</p>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h2 class="text-center">About the App</h2>
            <p class="text-muted">The Developer Learning Planner App is a platform designed to bring developers together to share their learning plans, ideas, and insights. It's a place where developers can collaborate, inspire each other, and enhance their learning journeys.</p>
            <p class="text-muted">Whether you're a beginner starting your programming journey or an experienced developer looking to expand your skill set, this app provides a supportive community and valuable resources to help you achieve your learning goals.</p>
            <p class="text-muted">Join us today and start planning your learning journey, connect with like-minded developers, and unlock your full potential as a software developer!</p>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/includes/footer.php';?>
