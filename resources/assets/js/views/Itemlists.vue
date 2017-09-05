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
              </div>
              <br>

          <table class="table table-striped table-bordered">
            <tbody>
            <tr>

              <th>ID</th>
    <th>Item Name</th>
    <th>SRP</th>
    <th>Item's Left</th>
    <th>Date Registered</th>
    <th>Date Updated</th>


            </tr>
</tbody>

<tbody>
            <tr v-for = "item in filterItems">

                <td>{{item.id}}</td>
                <td>{{item.itemName}}</td>
                <td>₱{{item.itemSrp}}</td>
                <td>{{item.itemQuantity}}</td>
                <td>{{item.created_at}}</td>
                <td>{{item.updated_at}}</td>
            </tr>
            </tbody>

          </table>
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
        filterSearch: ''
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
        return vm.model.filter(function(item){
          return item.itemName.toLowerCase().match(vm.filterSearch.toLowerCase());

        })
      }
    },

    methods: {

      fetchItems(){
var vm = this
        axios.get('/riv-admin/getitems').then(function(response){

            Vue.set(vm.$data, 'model', response.data)
        }).catch(function(error){

          console.log(error)
        })
      }
    }
  }
</script>
