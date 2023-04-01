<?php
   require_once("../libraries/Controller.php");
   require_once("../helpers/url_helper.php");
    
    class Doctors extends Controller
    {
        private $doctor_model; 
        public function __construct(){
            $this->doctor_model = $this->loadModel("Doctor");
            //echo("construct en exec");
        }
        public function register(){
            $this->render("/doctors/register.php");
            if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
                //echo("if en exec");

                $data = [
                    "name" => '',
                    "email" => "",
                    "password" => "",
                    "speciality" => "",
                    "email_error" => "",
                    "password_error" => "",
                    "name_error" => "",
                    "confirmation_error" => false,     
                ];
                $data["name"] = $_POST['name'];
                $data["email"] = $_POST['email'];
                $data["password"] = $_POST["password"];
                if (empty($data["email"])){
                    $data["email_error"] = "Veuillez saisir votre adresse e-mail.";
                }
                if(empty($data["password"])){
                    $data["password_error"]= "Veuillez saisir votre mdp";
                }
                if(empty($data["name"])){
                    $data["name_error"]= "Veuillez saisir votre username";
                }
                if (strlen($data["password"] < 6)){
                    $data["password_error"]= "Votre mdp doit contenir minimum 6 caractere";
                }
                if ($this->doctor_model->fetchDoctorbyEmail($data["email"])){
                    $data["confirmation_error"]= "Erreur lors de saisie du mail";
                    $data["email_error"] = "Veuillez saisir votre adresse e-mail.";
                }
            //    if(empty($data["name_error"]) && empty($data["mail_error"]) && empty($data["password_error"]))
            //    {
                //echo("register eb exex");
                $this->doctor_model->register($data);
                redirect("../views/doctors/login.php");
            //    }
            
                
            }
            $this->render("doctors/register.php");

        }
    }
    
    $doc= new Doctors();
    $doc->register();

