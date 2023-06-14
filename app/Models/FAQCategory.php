<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQCategory extends Model
{
    use HasFactory;

    public function questions()
    {
        return $this->hasMany('App\Models\FAQQuestion', 'category_id');
    }
}
