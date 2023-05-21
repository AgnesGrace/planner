<?php
class Plans extends Controller{
    public $planModel;
    public $userModel;
    public function __construct()
    {
        if(!isLoggedIn()){
            redirectHelper('users/login');
        }
        $this->planModel = $this->model('Plan');
        $this->userModel = $this->model('User');
    }
    public function index(){
        // Get all plans
        $plans = $this->planModel->getPlans();
        $data = [
            'plans'=>$plans,
        ];
        $this->view('plans/index', $data);
    }
    public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
       
            // sanitization
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

            $data = [
                'title'=>trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'title_error'=>'',
                'body_error'=>''
            ];
            // title validation
            if(empty($data['title'])){
                $data['title_error']='Please enter the title';
            }
            if(empty($data['body'])){
                $data['body_error']='Please enter the body of your plan';
            }

            // Make sure there is no error
            if(empty($data['title_error']) && empty($data['body_error'])){
              // plans validated
              if($this->planModel->addPlan($data)){
                flash('plan_message','Learning added successfully');
                redirectHelper('plans');
              }else{
                die('Plan not added');
              }
            }else{
                $this->view('plans/add', $data);
            }
        }else{
            $data = [
            'title' => '',
            'body' => '',
           
        ];
        $this->view('plans/add', $data); 
        }
       
    }

    public function edit($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
       
            // sanitization
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

            $data = [
                'id'=>$id,
                'title'=>trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'title_error'=>'',
                'body_error'=>''
            ];
            // title validation
            if(empty($data['title'])){
                $data['title_error']='Please enter the title';
            }
            if(empty($data['body'])){
                $data['body_error']='Please enter the body of your plan';
            }

            // Make sure there is no error
            if(empty($data['title_error']) && empty($data['body_error'])){
              // plans validated
              if($this->planModel->updatePlan($data)){
                flash('plan_message','Plan updated successfully');
                redirectHelper('plans');
              }else{
                die('Plan not added');
              }
            }else{
                $this->view('plans/edit', $data);
            }
        }else{
            // Check for plan owner
            $plan = $this->planModel->getPlansById($id);
            if($plan->user_id != $_SESSION['user_id']){
                redirectHelper('plans');
            }
            $data = [
            'id'=>$id,
            'title' => $plan->title,
            'body' => $plan->body,
           
        ];
        $this->view('plans/edit', $data); 
        }
       
    }
    public function show($id){
        $plan = $this->planModel->getPlansById($id);
        $user = $this->userModel->getUserById($plan->user_id);
        $data = [
            'plan'=>$plan,
            'user'=>$user

        ];
        $this->view('plans/show', $data);
    }
    public function delete($id){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $plan = $this->planModel->getPlansById($id);
            if($plan->user_id != $_SESSION['user_id']){
                redirectHelper('plans');
            }
            if($this->planModel->deletePlan($id)){
                flash('plan_message', 'Plan deleted successfully');
                redirectHelper('plans');
            }else{
                die('Something went wrong');
            }
        }else{
            redirectHelper('post');
        }
    }
}
