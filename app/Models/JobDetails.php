<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobDetails extends Model
{
    use HasFactory;

    public function show(Job $job){
        
        $job->load('company');
        return view('jobs.show', compact('job'));
    }
}
