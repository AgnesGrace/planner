<?php
/*
* Our application core Class
* Creates URL and loads the core controller
* URL format - /controller/method/params
*/

class Core{
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct()
    {
       //print_r($this->getUrl()); 
       $url = $this->getUrl();

        //1: Check if $url exists and has at least one element
        if($url && count($url)>0){
            // check the controllers for the first value
            if(file_exists('../app/controllers/' . ucwords($url[0]). '.php')){
                $this->currentController = ucwords($url[0]);
                // then unset the zero index
                unset($url[0]);
            } 
        }

      
        //2: now we require the controller
        require_once '../app/controllers/'. $this->currentController . '.php';
        // Instantiate the controller class
        $this->currentController = new $this->currentController;

        // next we check the second part of the URL
        if(isset($url[1])){
            if(method_exists($this->currentController, $url[1])){
                $this->currentMethod = $url[1]; // note that this is a method is the Pages controller

                unset($url[1]);
            }
        }
        // this shows if it exist in pages as method
        //echo $this->currentMethod;

        //3: Get our params
        $this->params = $url ? array_values($url) : [];
        //print_r($this->params) ;
        // call a callback with array of params:
        // the function is used to call a user defined function or a method of an object
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);


    }

    public function getUrl(){
       if(isset( $_GET['url'])){
        $url = rtrim($_GET['url'], '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url_array = explode('/', $url);
        return $url_array;
       }
    }
}


