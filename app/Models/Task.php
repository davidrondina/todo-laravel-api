<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'is_done',
        'priority',
        'due_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeByKeyword($query, $keyword)
    {
        $query->whereLike('name', $keyword);
    }
}
