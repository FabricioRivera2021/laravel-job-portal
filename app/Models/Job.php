<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder as QueryBuilder;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'location', 'salary', 'description', 'experience', 'category'
    ];

    public static array $experience = [
        'entry', 
        'intermediate', 
        'senior'
    ];
    
    public static array $category = [
        'IT', 
        'Finance', 
        'Sales', 
        'Marketing'
    ];

    public function employer(): BelongsTo
    {
        return $this->belongsTo(Employer::class);
    }

    public function jobApplications(): HasMany
    {
        return $this->hasMany(JobApplication::class);
    }

    public function hasUserApplied(Authenticatable|User|int $user)
    {
        return $this->where('id', $this->id)
                ->whereHas('jobApplications', fn($query) => $query->where('user_id', '=', $user->id ?? $user))
                ->exists();
    }

    public function scopeFilter(Builder|QueryBuilder $query, array $filters): Builder|QueryBuilder
    {
        return $query->when($filters['search'] ?? null, function($query, $search) {
            $query->where(function ($query) use ($search){
                $query->where('title','LIKE','%'. $search .'%') //con el orWhere busca en uno o en el otro
                ->orWhere('description', 'LIKE', '%'. $search . '%')
                ->orWhereHas('employer', function ($query) use ($search) { //whereHas se usa porque el empleado es de otra tabla
                    $query->where('company_name', 'LIKE' , '%'. $search .'%' );
                });
            });
        })->when($filters['min_salary'] ?? null, function ($query, $minSalary) {
            $query ->where('salary', '>=' ,$minSalary);//si se pasa el salario minimo lo busca, sino no
        })->when($filters['max_salary'] ?? null, function ($query, $maxSalary) {
            $query ->where('salary', '<=' ,$maxSalary);//ideam al anterior pero con el maximo
        })->when($filters['experience'] ?? null, function ($query, $experience) {
            $query ->where('experience', $experience);
        })->when($filters['category'] ?? null, function ($query, $category) {
            $query ->where('category', $category);
        });
    }
}
