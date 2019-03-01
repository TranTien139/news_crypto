<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';
    protected $fillable = ['title', 'slug','description','content','thumbnail','related','status','published_at', 'meta_seo', 'auth'];
    public $timestamps = true;
}
