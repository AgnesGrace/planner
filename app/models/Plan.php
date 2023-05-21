<?php
    class Plan{
        private $db;
        public function __construct()
        {
           $this->db = new Database; 
        }
        public function getPlans(){
            $this->db->query('SELECT *,
                            plans.id as planId,
                            users.id as userId,
                            plans.created_at as plansCreated
                            FROM plans
                            INNER JOIN users
                            ON plans.user_id = user_id
                            ORDER BY plans.created_at DESC
                        ');

            $results = $this->db->resultArray();
            return $results;
        }
        public function addPlan($data){
            $this->db->query('INSERT INTO plans(title, user_id, body) VALUES(:title, :user_id, :body)');
            $this->db->bind(':title', $data['title'] );
            $this->db->bind(':user_id', $data['user_id']);
            $this->db->bind(':body', $data['body']);
            // next we execute
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }
        public function updatePlan($data){
            $this->db->query('UPDATE plans SET title=:title, body=:body WHERE id=:id');
            $this->db->bind(':id', $data['id']);
            $this->db->bind(':title', $data['title'] );
            $this->db->bind(':body', $data['body']);
            // next we execute
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function getPlansById($id){
            $this->db->query('SELECT * FROM plans WHERE id = :id');
            $this->db->bind(':id', $id);
            $row = $this->db->singleRow();
            return $row;
        }
        public function deletePlan($id){
            $this->db->query('DELETE FROM plans WHERE id = :id');
            $this->db->bind(':id', $id);
            // next we execute
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

    }
?>