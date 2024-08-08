<?php

namespace App\Models;

use App\Traits\GlobalStatus;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Kirschbaum\PowerJoins\PowerJoins;

class Agrodistribution extends Model
{
    use Searchable, GlobalStatus, PowerJoins;

    
    public function producteur()
    {
        return $this->belongsTo(Producteur::class,'producteur_id');
    }

    public function cooperative()
    {
        return $this->belongsTo(Cooperative::class,'cooperative_id');
    }
 
    public function especes()
    {
        return $this->hasMany(AgrodistributionEspece::class, 'agrodistribution_id', 'id');
    }

}