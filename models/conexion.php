<?php 

    class Conexion{


        static public function contectar(){
            
            $link = new PDO("mysql:host=localhost;dbname=SDF","root","1234");
            $link -> exec("set names utf8");
            return $link;



        }



    }








?>