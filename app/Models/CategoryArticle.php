<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoryArticle extends Model
{
    use HasFactory;

    protected $guarded=[
        'id'
    ];

    /**
     * Get all of the produk for the JenisProduk
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function article(): HasMany
    {
        return $this->hasMany(Produk::class, 'category_article_id', 'id');
    }
}
