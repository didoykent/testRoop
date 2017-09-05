<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use App\Item;
use App\ItemR;
use Cache;
use Auth;
use Carbon;
use App\IRemove;

class CustomCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete Item by id';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

$currentUser =  Cache::get('currentUser', 'default');
$previousItems = Cache::get('previousItems', 'default');
$updatedItems = Cache::get('updatedItems', 'default');
$isUpdated = Cache::get('isUpdated', 'default');
$removedItem = Cache::get('itemRemoved', 'default');
$isRemoved = Cache::get('isRemoved', 'default');
$dateRemoved = Cache::get('dateRemoved', 'default');



if($isUpdated == 'true'){
  $itemR = new ItemR;

  $itemR->adminName = $currentUser;
  $itemR->action = "UPDATED";
  $itemR->itemName = $previousItems->itemName;
  $itemR->previousQuantity = $previousItems->itemQuantity;
  $itemR->previousPrice = $previousItems->itemSrp;
  $itemR->previousName = $previousItems->itemName;
  $itemR->previousSale = $previousItems->itemDiscount;
  $itemR->previousImagePath = $previousItems->itemImagePath;

$itemR->currentQuantity = $updatedItems->itemQuantity;
$itemR->currentPrice  = $updatedItems->itemSrp;
$itemR->currentName = $updatedItems->itemName;
$itemR->currentImagePath = $updatedItems->itemImagePath;
$itemR->currentSale = $updatedItems->itemDiscount;
$itemR->itemID = $updatedItems->id;

  Cache::put('isUpdated', 'false', 10);
  $itemR->save();

}

if($isRemoved == 'true'){


        $rm = new IRemove;
        $date = $dateRemoved;
        $rm->adminName = $currentUser;
        $rm->itemName = $removedItem->itemName;
        $rm->itemSrp = $removedItem->itemSrp;
        $rm->itemQuantity = $removedItem->itemQuantity;
        $rm->itemDiscount = $removedItem->itemDiscount;
        $rm->itemTotalDiscount = $removedItem->itemTotalDiscount;
        $rm->itemImagePath = $removedItem->itemImagePath;
        $rm->action = "REMOVED";
        $rm->created_at = $dateRemoved;


  Cache::put('isRemoved', 'false', 10);

    $rm->save();
}





}
}
