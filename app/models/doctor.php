<?php
    include("../libraries/Database.php");
    Class Doctor {
        private $id;
        private $name;
        private $db;
        public function __construct(){
            $this->db = new Database();
        }
        public function fetchDoctorbyEmail($email){
            $this->db->prepare("SELECT id FROM doctors WHERE email = '$email'");
            $result = $this->db->single();
       
            if ($this->db->rowcount() != 0 ){
                return True;
            }
            return False;
        }
        public function login($email, $password){
            $this->db->prepare("SELECT * FROM doctors WHERE email = '$email'");
            $result = $this->db->single();
            #var_dump($result["password"]);
            
            #if (password_verify($password, $result["password"])){
            if ($password == $result["password"]){
                return $result;
            }
            return False; 
        }
        public function register($data){
            
            $this->db->prepare("INSERT INTO doctors (name,email,password,speciality) VALUES ('" .$data["name"]. "','" .$data["email"]. "','" .$data["password"]. "','" .$data["speciality"]."');" );
            $this->db->execute();
            
        }
        public function getDoctorbyId($doctor_id){
            $this->db->prepare("SELECT * FROM doctors WHERE id = '$doctor_id'");
            return $this->db->single();
        }
    }
    /*$doc = new Doctor();
    var_dump($doc->fetchDoctorbyEmail("hiba@mail.com"));
    var_dump($doc->login("hiba@mail.com", "azerty"));
    $data = [
        "name" => 'test',
        "email" => 'test@mail.com',
        "password" => 'azerty2',
        "speciality" => 'dentist',
    ];
    #var_dump($doc->register($data));

    var_dump($doc->getDoctorbyId(1));*/