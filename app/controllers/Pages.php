<?php
class Pages extends Controller{
    public $planModel;
    public function __construct(){
        // Loading the Post model from models/Plan
        //$this->postModel = $this->model();
        
    }
    public function index(){
        if(isLoggedIn()){
            redirectHelper('plans');
        }
        //$post = $this->postModel->getPosts();
        $data = [
            'title'=>'Planner App',
            
        ];
       $this->view('pages/index', $data);
    }

    public function about(){
        $data = ['title'=>'About Us'];
        $this->view('/pages/about', $data);
       
    }
    public function me(){
        echo 'me';
    }
    
}