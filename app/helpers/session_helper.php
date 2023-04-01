<?php
    session_start();
    function islogged_in(){
        if(isset($_SESSION["id"])){
            return true;
        }
        else{
            return False;
        }
    }
?>