<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RemoveSaleR extends Model
{
    protected $table = 'removedDiscountRep';
    public $fillable = ['adminName', 'action', 'itemName', 'originalPrice', 'previousQuantity', 'currentQuantity', 'currentPrice', 'previousPrice', 'currentName', 'previousName', 'currentSale', 'previousSale', 'currentImagePath', 'previousImagePath', 'previousTotalDiscount', 'currentTotalDiscount','itemId'];



  }
