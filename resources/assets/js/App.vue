<template>



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

          <input type="text" class="form-control" list="searchitem" v-model ="filtersearch" placeholder="Search for...">

        </div>

                <div class="form-group row add">
                <button type="button" name="button" class = "btn btn-primary" @click = "$router.push('/getitems/create/')">Create Item</button>
      </div>

    </div>


        <br>
<table class="table table-striped table-bordered">

<tbody>
<tr>

  <th>ID</th>
  <th>Item Name</th>
  <th>SRP</th>
  <th>Original Price</th>
  <th>Discount</th>
  <th>Total Discount</th>
  <th>Item's Left</th>
  <th>Sale</th>
  <th>Date Registered</th>
  <th>Date Updated</th>

  <th>Action</th>
</tr>
</tbody>
<tbody>
<tr v-for = "item in filterItems"  >

  <td>{{item.id}}</td>
  <td>{{item.itemName}}</td>
  <td>₱{{item.itemSrp}}</td>
  <td>₱{{item.itemOriginalPrice}}</td>
  <td>{{item.itemDiscount}}%</td>
  <td>₱{{item.itemTotalDiscount}}</td>
  <td>{{item.itemQuantity}}</td>
  <td>Sale</td>
  <td>{{item.created_at}}</td>
  <td>{{item.updated_at}}</td>
  <td>
    <button type = "button" class = "btn btn-warning btn-xs" @click="$router.push('/getitems/' + item.id + '/edit')">


      <router-link to= "'/getitems/' + item.id + '/edit'" class = "button"></router-link>
      <span class = "glyphicon glyphicon-edit"></span></button>

  </td>



</tr>
</tbody>

</table>



  </div>
  </div>
</div>

  </section>








<router-view></router-view>



</div>














</template>

<script>

import Vue from 'vue'
import axios from 'axios'




export default {

data(){

return{

  filtersearch: '',
  model:[],




  getItemsApi:'/riv-admin/getitems'



}

},

beforeMount(){

  this.fetchItems()
},

watch:{

  '$route' : 'fetchItems'
},

computed:{

filterItems: function(){

var vm = this;

return vm.model.filter(function(item){

  return item.itemName.toLowerCase().match(vm.filtersearch.toLowerCase());
})
}
},

methods:{

  fetchItems(){
var vm = this
    axios.get(this.getItemsApi).then(function(response){

      Vue.set(vm.$data, 'model', response.data)
      console.log(response.data)
    }).catch(function(error){

      console.log(error)
    })
  },
  
}


}

</script>

<style lang="css">
</style>
