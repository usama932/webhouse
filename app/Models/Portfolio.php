<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    public function portfolio_type()
    {
        return $this->belongsTo(PortfolioTypes::class, 'type');
    }
}
