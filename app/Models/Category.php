<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'tb_categories';

    protected $fillable = [
        'name'
    ];

    public function subcategories()
    {
        return $this->hasMany(SubCategory::class, 'category_id');
    }
}