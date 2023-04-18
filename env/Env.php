<?php

namespace Env;

use Exception;


class Env{


    public static function get($variable){

        $variables = require 'Variables.php';

        try{

            if(array_key_exists($variable, $variables)){
                return $variables[$variable];
            }else{
                throw new Exception("Env variable '$variable' not exists");
            }

        }catch(Exception $e){



            return $e->getMessage();

        }
       

    }

}

