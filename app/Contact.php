<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //
      //table Contact
      protected $table='contacts';
      //input data
      protected $fillable = [
        'name', 'email','message','phone'
      ];
}
