<?php

namespace App\Models;

use App\Traits\GlobalStatus;
use App\Traits\HasCooperative;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Kirschbaum\PowerJoins\PowerJoins;

class FinancementDelegue extends Model
{
    use Searchable, GlobalStatus, PowerJoins; 

     
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
 
}