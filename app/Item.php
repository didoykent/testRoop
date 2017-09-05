<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Support\FilterPaginateOrder;
class Item extends Model
{


use FilterPaginateOrder;

    protected $table = "items";

    protected $fillable = ['itemName', 'itemSrp', 'itemQuantity', 'totalPrice', 'totalQuantity', 'totalItems', 'itemDiscount', 'itemTotalDiscount', 'itemOriginalPrice', 'itemClientPrice', 'itemImagePath', 'itemCategory', 'itemDealerPrice', 'itemAgentPrice', 'action', 'itemClientName', 'itemSaleStatus', 'itemStatus', 'active', 'itemOnSale'];




public static function initialize(){

  return[

'itemName' => '', 'itemSrp' => '', 'itemQuantity' => '', 'totalPrice' => '', 'totalQuantity' => '', 'totalItems' => '', 'itemDiscount' => '', 'itemTotalDiscount' => '', 'itemOriginalPrice' => '', 'itemClientPrice' => '', 'itemImagePath' => '',
'itemCategory' => '', 'itemDealerPrice' => '', 'itemAgentPrice' => '', 'action' => '', 'itemClientName' => '', 'itemSaleStatus' => '', 'itemStatus' => '', 'active' => '', 'itemOnSale' => ''

  ];



}

protected $filter = [
  'id', 'created_at', 'updated_at','itemName', 'itemSrp', 'itemQuantity', 'totalPrice', 'totalQuantity', 'totalItems', 'itemDiscount', 'itemTotalDiscount', 'itemOriginalPrice', 'itemClientPrice', 'itemImagePath', 'itemCategory', 'itemDealerPrice', 'itemAgentPrice', 'action', 'itemClientName', 'itemSaleStatus', 'itemStatus', 'active', 'itemOnSale', 'default'
];

}
