<?php

namespace App\Models;

use App\Enums\ExpenseType;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'type',
        'description',
        'amount',
        'date',
    ];

    protected $casts = [
        'type' => ExpenseType::class,

    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

}