<?php
namespace App\Models;

use App\Traits\GlobalStatus;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Kirschbaum\PowerJoins\PowerJoins;

class Archivage extends Model
{
    use Searchable, GlobalStatus, PowerJoins;

    public function cooperative()
    {
        return $this->belongsTo(Cooperative::class, 'cooperative_id');
    }
     
    public function typeArchive()
    {
        return $this->belongsTo(TypeArchive::class, 'type_archive_id','id');
    }
}
