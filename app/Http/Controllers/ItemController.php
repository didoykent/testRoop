<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\ItemR;
use App\SaleR;
use Session;
use Carbon\Carbon;
use App\IRemove;
use Artisan;
use Cache;
use App\RemoveSaleR;

class ItemController extends Controller
{

  public function prototype(){

    return view('layouts/main');
  }

public function itemUpdate(){

  $items = ItemR::all();

  return response()->json($items);
}

public function itemRemoved(){

  $removeditems = IRemove::all();

  return response()->json($removeditems);
}

public function itemManagement(){

  return view('riv-admin/InventoryManagement');
}



    public function index()
    {
        $items  = Item::all();



        return response()->json($items);
    }


    public function show($id){

      $items = Item::find($id);

      return response()->json(['model' => $items]);
    }


    public function create(){


      return response()->json(['model' => Item::initialize()]);
    }


    public function store(Request $request)
    {
        $this->validate($request,[

'itemName' => 'required',
'itemSrp' => 'required',
'itemQuantity' => 'required',
'itemImagePath',
'itemClientPrice',
'itemDealerPrice',
'itemAgentPrice',
'itemClientName',
'action'


        ]);


            $dealer = 40 / 100;
            $agent = 30 / 100;

            $items = Item::create([
              'itemClientName' => Session::get('user'),
              'action' => "CREATED",
              'itemName' => $request->itemName,
              'itemSrp'  => $request->itemSrp,
              'itemClientPrice' => $request->itemSrp,
              'itemQuantity' => $request->itemQuantity,
              'itemImagePath' => $request->itemImagePath,
              'itemDealerPrice' => ($dealer) * $request->itemSrp,
              'itemAgentPrice' =>  ($agent) * $request->itemSrp

            ]);








        return response()->json(['saved' => 'true']);




    }




    public function update(Request $request, $id)
    {

      $previousItems = Item::find($id);
      $expiresAt = Carbon::now()->addMinutes(10);
      Cache::put('currentUser', Session::get('user'), $expiresAt);


      Cache::put('previousItems', $previousItems, $expiresAt);




  $this->validate($request,[

'itemName' => 'required',
'itemSrp' => 'required',
'itemQuantity' => 'required',
'itemImagePath',


      ]);


      $items = Item::find($id);

        $items->update([

          'itemClientName' => Session::get('user'),
          'action' => "UPDATED",
          'itemName' => $request->itemName,
          'itemSrp' => $request->itemSrp,
          'itemQuantity' => $request->itemQuantity,
          'itemImagePath' => $request->itemImagePath


        ]);





        Cache::put('updatedItems', $items, $expiresAt);

        Cache::put('isUpdated', 'true', $expiresAt);




  $value = Cache::get('previousItems', 'default');
Artisan::call('schedule:run');



  return response()->json(['updated' => 'true', 'previousItems' => $value]);

    }


public function destroy($id)
    {






$item = Item::find($id);


$rm = new IRemove;
$rm->adminName = Session::get('user');
$rm->itemName = $item->itemName;
$rm->itemSrp = $item->itemSrp;
$rm->itemQuantity = $item->itemQuantity;
$rm->itemDiscount = $item->itemDiscount;
$rm->itemTotalDiscount = $item->itemTotalDiscount;
$rm->itemImagePath = $item->itemImagePath;
$rm->itemId = $item->id;
$rm->action = "REMOVED";


$rm->save();


  $item->delete();







return response()->json(['deleted' => 'true']);
    }



    public function test($id){



          $zodiac = Item::find($id);

          $items = Session::get('previousItems');


              $itemR = new itemR();
        $itemR->adminName = Session::get('user');
        $itemR->action = "UPDATED";
        $itemR->itemName = $items->itemName;
        $itemR->previousQuantity = $items->itemQuantity;
        $itemR->previousPrice = $items->itemSrp;
        $itemR->previousName = $items->itemName;
        $itemR->previousSale = $items->itemDiscount;
        $itemR->previousImagePath = $items->itemImagePath;





    $itemR->currentQuantity = $zodiac->itemQuantity;
    $itemR->currentPrice  = $zodiac->itemSrp;
    $itemR->currentName = $zodiac->itemName;
    $itemR->currentImagePath = $zodiac->itemImagePath;
    $itemR->currentSale = $zodiac->itemDiscount;

      $itemR->save();


      return response()->json(['saved' => true]);

    }



public function itemCrudLogs(){



$itemsCreated = Item::all();
$itemsUpdated = ItemR::where('action', 'updated')->get();
$removedItems = IRemove::all();


return response()->json(['itemsCreated' => $itemsCreated, 'itemsUpdated' => $itemsUpdated, 'removedItems' => $removedItems]);


}


public function getItemsDiscounts(Request $request, $saleValue, $id ){

  $items = Item::all();




$array=explode(",",$id);


$getItemsCount = count($array);


for($i=0; $i<$getItemsCount; $i++){

$getItems = Item::find($array[$i]);
$saleR = new SaleR;
if($getItems->itemDiscount){

  $originalPrice = $getItems->itemSrp / (1 - $getItems->itemDiscount);
  $currentDiscount = ($saleValue / 100) * $originalPrice;
  $saleR->previousPrice =    $getItems->itemSrp;
  $saleR->previousSale = $getItems->itemDiscount * 100;
  $getItems->itemSrp = $originalPrice - $currentDiscount;
  $getItems->itemDiscount = $saleValue / 100;
  $saleR->previousTotalDiscount = $getItems->itemTotalDiscount;
  $getItems->itemTotalDiscount = $originalPrice - $getItems->itemSrp;
  $getItems->itemOriginalPrice = $getItems->itemSrp + $getItems->itemTotalDiscount;
  $saleR->originalPrice =  $getItems->itemOriginalPrice;
  $getItems->itemOnSale = true;
  $getItems->save();


}

else{
  $originalPrice = $getItems->itemSrp / (1 - $getItems->itemDiscount);
  $discount = ($saleValue / 100 ) * $getItems->itemSrp;
  $getItems->itemSrp = $getItems->itemSrp - $discount;
  $getItems->itemDiscount = $saleValue / 100 ;
  $getItems->itemTotalDiscount = $originalPrice - $getItems->itemSrp;
  $getItems->itemOriginalPrice = $getItems->itemSrp + $getItems->itemTotalDiscount;
  $saleR->previousPrice =  $getItems->itemOriginalPrice;
  $getItems->itemOnSale = true;
  $getItems->save();
}


$saleR->itemName = $getItems->itemName;
$saleR->action = "SALE";
$saleR->currentSale =  $getItems->itemDiscount * 100;
$saleR->currentTotalDiscount = $getItems->itemTotalDiscount;
$saleR->currentPrice = $getItems->itemSrp;
$saleR->currentQuantity = $getItems->currentQuantity;
$saleR->adminName = Session::get('user');
$saleR->itemId = $getItems->id;

$saleR->save();
}



return response()->json(['saleValue' => $saleValue, 'itemsId' => $getItems->itemDiscount, 'saved' => true]);

}

public function removeItemsDiscount($id, Request $request){

  $array=explode(",",$id);


  $getItemsCount = count($array);


  for($i=0; $i<$getItemsCount; $i++){

      $getItems = Item::find($array[$i]);
      $getRemoveSale = new RemoveSaleR;

      if($getItems->itemDiscount){


        $getRemoveSale->adminName = Session::get('user');
        $getRemoveSale->action = "Removed Discount";
        $getRemoveSale->itemName = $getItems->itemName;
        $getRemoveSale->itemID = $getItems->id;
        $getRemoveSale->originalPrice =  $getItems->itemSrp / (1 - $getItems->itemDiscount);
        $getRemoveSale->currentPrice =  0;
        $getRemoveSale->currentQuantity = $getItems->itemQuantity;
        $getRemoveSale->previousQuantity = $getItems->itemQuantity;
        $getRemoveSale->currentSale = 0;
        $getRemoveSale->currentTotalDiscount = 0;
        $getRemoveSale->previousPrice = $getItems->itemSrp;
        $getRemoveSale->previousTotalDiscount = $getItems->itemTotalDiscount;
        $getRemoveSale->previousSale = $getItems->itemDiscount * 100;


        $getRemoveSale->save();

          $getItems->itemSrp =  $getItems->itemSrp / (1 - $getItems->itemDiscount);
          $getItems->itemDiscount = 0;
          $getItems->itemTotalDiscount = 0;
          $getItems->itemOriginalPrice = 0;
          $getItems->itemOnSale = false;
          $getItems->save();

      }
    }
    return response()->json(['removed' => true ]);
  }


public function getSaleReports(){

  $sale = SaleR::all();

 $removeSaleRep = RemoveSaleR::all();


  return response()->json(['discountedItems' => $sale, 'removedItemDiscounts' => $removeSaleRep]);
}

public function getRemoveSaleReports(){





}


public function getTestData(){


  return response()->json(['model' => Item::FilterPaginateOrder()]);
}








}
