<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'faqs';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'question',
        'answer',
        'status',
    ];
}
