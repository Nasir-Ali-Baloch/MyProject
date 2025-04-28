<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;
    // protected $fillable = ['title', 'company', 'location', 'website', 'email', 'tags', 'description'];
    // protected $guarded = []; 
    
    public function scopeFilter($query,array $filters)
    {
        if($filters['tag'] ?? false){
            $query->where('tags','like','%' .request('tag') . '% ');
        }
        if($filters['search'] ?? false){    
            $query->where('title','like', '%' .request('search') . '%' )
            ->orWhere('description','like','%' .request('search') . '%')
            ->orWhere('tags','like','%' .request('search') . '%'); 
        }
    } 
    protected $fillable = ['title', 'description', 'user_id'];


    //Relationship to user
    public function User()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
