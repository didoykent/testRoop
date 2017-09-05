<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleR extends Model
{

    protected $table = 'SaleRep';
    public $fillable = ['adminName', 'action', 'itemName', 'originalPrice', 'previousQuantity', 'currentQuantity', 'currentPrice', 'previousPrice', 'currentName', 'previousName', 'currentSale', 'previousSale', 'currentImagePath', 'previousImagePath', 'previousTotalDiscount', 'currentTotalDiscount','itemId'];
}
