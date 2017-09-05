<?php



 namespace App\Support;

use Validator;
use Schema;

 trait FilterPaginateOrder{


   protected $operators = [

     'equal_to' => '=',
     'not_equal' => '<>',
     'less_than' => '<',
     'greater_than' => '>',
     'less_than_or_equal_to' => '<=',
     'greater_than_or_equal_to' => '>=',
     'in' => 'IN',
     'not_in' => 'NOT IN',
     'like' => 'LIKE'


   ];



   public function scopeFilterPaginateOrder($query){

     $request = request();

     $v = Validator::make($request->all(),[

       'column' => 'required|in:'.implode(',', $this->filter),
       'direction' => 'required|in:asc,desc',
       'per_page' => 'required|integer|min:1',
       'search_operator' => 'required|in:'.implode(',', array_keys($this->operators)),
       'search_column' => 'required|in:'.implode(',', $this->filter),
       'search_query_1' => 'max:255',
       'select_hide_column' => 'max:255',
     ]);

       if($v->fails()){

         dd($v->messages());
       }




       return $query->orderBy($request->search_column, $request->direction)->where(function($query) use ($request){

         if($request->has('search_query_1')){




           return $this->buildQuery($request->search_column, $request->search_operator,$request, $query);
         }






       })->paginate($request->per_page);

   }

   public function scopeExclude($query)
{

  $request = request();

  $v = Validator::make($request->all(),[

    'column' => 'required|in:'.implode(',', $this->filter),
    'direction' => 'required|in:asc,desc',
    'per_page' => 'required|integer|min:1',
    'search_operator' => 'required|in:'.implode(',', array_keys($this->operators)),
    'search_column' => 'required|in:'.implode(',', $this->filter),
    'search_query_1' => 'max:255'

  ]);

    if($v->fails()){

      dd($v->messages());
    }




  return $query->orderBy($request->search_column, $request->direction)->where(function($query) use ($request){

    if($request->has('search_query_1')){




      return $this->buildQuery($request->search_column, $request->search_operator,$request, $query);
    }






  })->paginate($request->per_page);

}


   private function getTableColumns() {
       return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
   }



protected function buildQuery($column, $operator, $request, $query){

  switch($operator){

case 'equal_to':
case 'not_equal':
case 'greater_than':
case 'less_than':
case 'less_than_or_equal_to':
case 'greater_than_or_equal_to':


$query->where($column, $this->operators[$operator], $request->search_query_1);

break;

case 'in':

$query->whereIn($column, explode(',', $request->search_query_1));

break;

case 'not_in':

$query->whereNotIn($column, explode(',', $request->search_query_1));

break;

case 'like':

$query->where($column, 'like', '%'.$request->search_query_1.'%');
break;



default:

throw new Exception('Invalid Search Opeartor', 1);
break;
  }

  return $query;
}

 }
