<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';


    public $fillable = ['clientName', 'clientType', 'clientAge', 'clientBday', 'clientCN', 'clientSpouse', 'clientJob', 'clientAdmin'];





public static function initialize(){

  return[

'clientName' => '', 'clientType' => '', 'clientAge' => '', 'clientBday' => '', 'clientCN' => '', 'clientSpouse' => '', 'clientJob' => '', 'clientAdmin' => ''

  ];
}


}
