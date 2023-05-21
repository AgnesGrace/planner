<?php
/* This is our base controller which loads the 
* models and views
* all other controllers extends this base controller
* just like in other php frameworks like laravel
*/
class Controller{
    // This loads the model
    public function model($model){
        // require the model file
        require_once '../app/models/' . $model . '.php';

        // instantiate the model
        return new $model();
        // for example: if Post is passed in as $model so 
        // we return new Post()
    }

    //This loads our view 
    public function view($view, $data=[]){
        if(file_exists('../app/views/' . $view . '.php')){
            require_once '../app/views/' . $view . '.php';
        }else{
            die('View does not exist');
        }
    }
}

?>