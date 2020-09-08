<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
   public function ticket(){
       return $this->hasOne(Ticket::class); //relation to ticket
   }
}


