<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'image_path',
        'name',
        'description',
        'amount',
        'price',
        'category_id'
    ];
    public function category(): BelongsTo
    {
        return $this->belongsTo(productCategory::class);
    }
    public function isSelectedCategory(int $category_id) :bool {
        return isset($this -> category) && $this->category->id === $category_id;
    }


}
