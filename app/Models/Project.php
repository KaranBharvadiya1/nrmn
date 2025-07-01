<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class project extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'type', 'location', 'start_date',
        'end_date', 'budget', 'description', 
        'blueprint', 'contact_details'
        // owner_id not needed here
    ];

    // Project.php
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function contractors()

    {
        return $this->belongsToMany(User::class, 'project_contractor', 'project_id', 'contractor_id');



    }
        
    public function appliedContractors()
    {
        return $this->contractors()->get(); // Get all contractors who applied for this project
    }

}