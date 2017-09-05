<template id="">



<div>
  <div class="col-md-9">
    <!-- Website Overview -->
    <div class="panel panel-default">
      <div class="panel-heading main-color-bg">
        <h3 class="panel-title">Welcome!</h3>
      </div>
      <div class="panel-body">
        <div class  = "row">
                <div class="col-md-4">

                  <input type="text" class="form-control" list="searchitem" v-model ="filterSearch" placeholder="Search for...">

                </div>
                <div class="form-group row add">
                <button type="button" name="button" class = "btn btn-primary" @click = "$router.push('/getitems/create/')">Create Item</button>

                <button type="button"  id = "sale" name="button" class = "btn btn-danger " @click = "$router.push('/items-sale')">Sale Item</button>
                 <button class="btn btn-default btn-sm" @click="showFilter = !showFilter">Filter</button>
      </div>

              </div>
              <br>

              <div class="filter" v-if="showFilter">
               <div class="filter-column">
                   <select class="form-control" v-model="params.search_column">
                       <option v-for="column in filter" :value="column">{{column}}</option>
                   </select>
               </div>
               <div class="filter-operator">
                   <select class="form-control" v-model="params.search_operator">
                       <option v-for="(value, key) in operators" :value="key">{{value}}</option>
                   </select>
               </div>
               <div class="filter-input">
                   <input type="text" class="form-control" v-model="params.search_query_1"
                       @keyup.enter="fetchItems" placeholder="Search">
               </div>





               <div class="filter-btn">
                   <button class="btn btn-primary btn-sm btn-block" @click="fetchItems">Filter</button>
               </div>
           </div>



          <table class="table table-striped table-bordered">
            <thead>
            <tr>

              <th v-for = "item in thead">

                <div class="dataviewer-th" @click="sort(item.key)" v-if="item.sort">

                   <span>{{item.title}}</span>
                   <span v-if = "params.column == item.key">
                     <span v-if = "params.direction == 'desc'">&#x25BC;</span>

                     <span v-else>
                       &#x25B2;
                     </span>

                   </span>


                </div>
              <div v-else>
  <span>{{item.title}}</span>
              </div>

              </th>


            </tr>
</thead>

<tbody>
            <tr v-for = "item in filterItems">

              <td>{{item.id}}</td>
              <td>{{item.itemName}}</td>
              <td>₱{{item.itemSrp}}</td>
              <td>₱{{item.itemOriginalPrice}}</td>

              <td>{{item.itemDiscount * 100}}%</td>

              <td>₱{{item.itemTotalDiscount}}</td>

              <td>{{item.itemQuantity}}</td>

              <td v-if = "item.itemOnSale">

                <center><span class="label label-danger">Sale</span></center>
              </td>

              <td v-else>


              </td>

              <td>{{item.created_at}}</td>
              <td>{{item.updated_at}}</td>

              <td>

                <router-link :to="'/getitems/' + item.id + '/view'" class = "btn btn-warning btn-xs">Edit
                  <span class = "glyphicon glyphicon-edit"></span></router-link>



              </td>

            </tr>
            </tbody>



          </table>
          <div class="panel-footer pagination-footer">
               <div class="pagination-item">
                   <span>Per page: </span>
                   <select v-model="params.per_page" @change="fetchItems">
                       <option>10</option>
                       <option>25</option>
                       <option>50</option>
                   </select>
               </div>
               <div class="pagination-item">
                   <small>Showing {{model.from}} - {{model.to}} of {{model.total}}</small>
               </div>
               <div class="pagination-item">
                   <small>Current page: </small>
                   <input type="text" class="pagination-input" v-model="params.page"
                       @keyup.enter="fetchItems">
                   <small> of {{model.last_page}}</small>
               </div>
               <div class="pagination-item">
                   <button @click="prev" class="btn btn-default btn-sm">Prev</button>
                   <button @click="next" class="btn btn-default btn-sm">Next</button>
               </div>
           </div>
       </div>
      </div>




    </div>

  </div>

</div>
</template>


<script>

import Vue from 'vue'
import axios from 'axios'

  export default{


    data(){
      return{

        model:[],
        testModel: [],

        filterSearch: '',
        showFilter: false,
        source: '/riv-admin/TestData',
        thead:[

          {title: 'ID', key: 'id', sort:true},
          {title: 'Item Name', key: 'itemName', sort:true},
          {title: 'SRP', key: 'itemSrp', sort: true},
          {title: 'Original Price', key: 'itemOriginalPrice', sort: true},
          {title: 'Discount', key: 'itemDiscount', sort:true},
          {title: 'Total Discount', key: 'itemTotalDiscount', sort:true},
          {title: 'Items Left', key: 'itemQuantity', sort:true},
          {title: 'Sale', key: 'itemOnSale', sort:true},
          {title: 'Date Registered', key: 'created_at', sort:true},
          {title: 'Date Updated', key: 'updated_at', sort:true},
          {title: 'Action', key: 'action', sort:false},

        ],

        params:{

          column: 'id',
          direction: 'asc',
          per_page: 10,
          page: 1,
          search_column: 'id',
          search_operator: 'equal_to',
          search_query_1: ''


        },

        operators:{

          equal_to: '=',
          not_equal: '<>',
          greater_than: '>',
          less_than: '<',
          greater_than_or_equal_to: '>=',
          less_than_or_equal_to: '<=',
          like: 'LIKE',
          in: 'IN',
          not_in: 'NOT IN'


        },

        filter:[

          'id', 'created_at', 'updated_at','itemName', 'itemSrp', 'itemQuantity', 'totalPrice', 'totalQuantity', 'totalItems', 'itemDiscount', 'itemTotalDiscount', 'itemOriginalPrice', 'itemClientPrice', 'itemImagePath', 'itemCategory', 'itemDealerPrice', 'itemAgentPrice', 'action', 'itemClientName', 'itemSaleStatus', 'itemStatus', 'active', 'itemOnSale'

        ]


      }
    },

    beforeMount(){

        this.fetchItems()



    },

    watch:{

      '$route': 'fetchItems'
    },

    computed:{

      filterItems: function(){
          var vm = this
        return vm.testModel.filter(function(item){
          return item.itemName.toLowerCase().match(vm.filterSearch.toLowerCase());

        })
      }
    },

    methods: {

      fetchItems(){
var vm = this

  var zodiac = vm? "test" : "test2";


        axios.get(vm.dynamicDataUpdates()).then(function(response){

            Vue.set(vm.$data, 'model', response.data.model)
            Vue.set(vm.$data, 'testModel', response.data.model.data)
            console.log(response.data.model)
              console.log(response.data.model.data)
              console.log(vm.params.search_query_1)




        }).catch(function(error){

          console.log(error)
        })
      },

      dynamicDataUpdates(){



        var p = this.params

        if(p.search_query_1){

            return `${this.source}?column=${p.column}&direction=${p.direction}&per_page=${p.per_page}&page=${p.page}&search_column=${p.search_column}&search_operator=${p.search_operator}&search_query_1=${p.search_query_1}`
        }

  else{

            return `${this.source}?column=${p.column}&direction=${p.direction}&per_page=${p.per_page}&page=${p.page}&search_column=${p.search_column}&search_operator=${p.search_operator}`

  }









      },

sort(column){
var vm = this
  if(column == vm.params.column){

    if(vm.params.direction == 'desc'){

      vm.params.direction = 'asc'
    }
    else{

        vm.params.direction = 'desc'
    }
  }
  else{

    vm.params.column = column
    vm.params.direction = 'desc'
  }
  this.fetchItems()
},

next() {
  var vm  = this
               if(vm.model.next_page_url) {
                   vm.params.page++

                   vm.fetchItems()

               }
           },
           prev() {
               var vm  = this
               if(vm.model.prev_page_url) {
                   vm.params.page--
                   vm.fetchItems()
               }
           }
    }

  }
</script>


<style>



</style>
