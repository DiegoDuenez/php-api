<?php

namespace App\Controllers;

use App\Models\User;

class UserController{


    function index()
    {

        $User = new User;

        return $User->all();



    }

}