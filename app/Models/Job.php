<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'title',
        'user_id',
        'description',
        'location',
        'employment_type',
        'salary',
        'is_remote',
        'end_date',
    ];

    
    protected $casts = [
        'description' => 'array',
        'is_remote' => 'boolean',
        'end_date' => 'datetime',
    ];

    
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    
    public function savedByUsers()
    {
        return $this->belongsToMany(User::class, 'saved_jobs')->withTimestamps();
    }
}
