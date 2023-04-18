<?php

namespace App\Models;

use Utilities\Model;

class User extends Model{

    protected $table = "users";

    protected $columns = [
        "nombre"
    ];


}