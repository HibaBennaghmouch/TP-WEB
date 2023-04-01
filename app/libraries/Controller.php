<?php
abstract class Controller{
    private $doctor_model;
    public function __construct($model){
        $this->doctor_model = $this->loadModel($model);
    }
    public function loadModel(string $model){
        require_once("../models/doctor.php");
        return new $model;
    }
    public function render(string $view){
        require_once("../views/" .$view);
    }
}

