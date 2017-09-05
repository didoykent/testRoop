<template lang="html">


  <div>
    <div class="col-md-9">
      <!-- Website Overview -->
      <div class="panel panel-default">
        <div class="panel-heading main-color-bg">
          <h3 class="panel-title">Welcome!</h3>
        </div>
        <div class="panel-body">


                <center>
                <h2>ITEM REPORTS</h2>
                </center>
                <h2>Created Items</h2>

                <div class  = "row">
                        <div class="col-md-4">

                          <input type="text" class="form-control" list="searchitem" v-model ="createdItemsSearch" placeholder="Search for...">

                        </div>
                      </div>
                      <br>
            <table class="table table-striped table-bordered">
              <tbody>
              <tr>



                <th>Admin Name</th>
                <th>Action</th>
                <th>Item Name</th>
                <th>Item ID</th>
                <th>Item Price</th>
                <th>Item Quantity</th>
                <th>Date Registered</th>

              </tr>
  </tbody>

  <tbody>
              <tr v-for = "item in filterCreatedItems">

                <td>{{item.itemClientName}}</td>
                  <td>CREATED</td>
                  <td>{{item.itemName}}</td>
                  <td>{{item.id}}</td>
                  <td>{{item.itemSrp}}</td>
                  <td>{{item.itemQuantity}}</td>
                  <td>{{item.created_at}}</td>

              </tr>
              </tbody>

            </table>

            <h2>Updated Items</h2>
            <div class  = "row">
                    <div class="col-md-4">

                      <input type="text" class="form-control" list="searchitem" v-model ="updatedItemsSearch" placeholder="Search for...">

                    </div>
                  </div>
                  <br>
          <table class="table table-striped table-bordered">
          <tbody>
          <tr>



            <th>Admin Name</th>
            <th>Action</th>
            <th>ItemName</th>
            <th>Item ID</th>
            <th>Item Price</th>
            <th>Current Price</th>
            <th>Previous Quantity</th>
            <th>Current Quantity</th>
            <th>Previous Name</th>
            <th>Current Name</th>

            <th>Date Updated</th>

          </tr>
          </tbody>

          <tbody>
          <tr v-for = "item in filterUpdatedItems">

            <td>{{item.adminName}}</td>
            <td>{{item.action}}</td>
            <td>{{item.itemName}}</td>
            <td>{{item.itemID}}</td>
            <td>₱{{item.previousPrice}}</td>
            <td>₱{{item.currentPrice}}</td>
            <td>{{item.previousQuantity}}</td>
            <td>{{item.currentQuantity}}</td>
            <td>{{item.previousName}}</td>
            <td>{{item.currentName}}</td>

            <td>{{item.created_at}}</td>


          </tr>
          </tbody>

          </table>



          <h2>Removed Items</h2>
          <div class  = "row">
                  <div class="col-md-4">

                    <input type="text" class="form-control" list="searchitem" v-model ="removedItemsSearch" placeholder="Search for...">

                  </div>
                </div>
                <br>
        <table class="table table-striped table-bordered">
        <tbody>
        <tr>



          <th>Admin Name</th>
          <th>Action</th>
          <th>Item Name</th>
          <th>Item ID</th>
          <th>Item Price</th>
          <th>Item Quantity</th>
          <th>Date Removed</th>


        </tr>
        </tbody>

        <tbody>
        <tr v-for = "item in filterRemovedItems">

          <td>{{item.adminName}}</td>
          <td>{{item.action}}</td>
          <td>{{item.itemName}}</td>
          <td>{{item.itemID}}</td>
          <td>₱{{item.itemSrp}}</td>
          <td>{{item.itemQuantity}}</td>
          <td>{{item.created_at}}</td>


        </tr>
        </tbody>

        </table>



        <h2>Discounted Items</h2>
        <div class  = "row">
                <div class="col-md-4">

                  <input type="text" class="form-control" list="searchitem" v-model ="discountedItemsSearch" placeholder="Search for...">

                </div>
              </div>
              <br>
      <table class="table table-striped table-bordered">
      <tbody>
      <tr>



        <th>Admin Name</th>
        <th>Action</th>
        <th>Item Name</th>
        <th>Item ID</th>
        <th>Item Original Price</th>
        <th>Current Discounted Price</th>
        <th>Current Sale</th>
        <th>Current TotalDiscounted Price</th>
        <th>Previous Discounted Price</th>
        <th>Previous Sale</th>
        <th>Previous TotalDiscounted Price</th>




      </tr>
      </tbody>

      <tbody>
      <tr v-for = "item in filterDiscountItems">

        <td>{{item.adminName}}</td>
        <td>{{item.action}}</td>
        <td>{{item.itemName}}</td>
        <td>{{item.itemId}}</td>
        <td>{{item.originalPrice}}</td>
        <td>{{item.currentPrice}}</td>
        <td>{{item.currentSale}}</td>
        <td>{{item.currentTotalDiscount}}</td>
        <td>{{item.previousPrice}}</td>
        <td>{{item.previousSale}}</td>
        <td>{{item.previousTotalDiscount}}</td>



      </tr>
      </tbody>

      </table>




      <h2>Removed Sale</h2>
      <div class  = "row">
              <div class="col-md-4">

                <input type="text" class="form-control" list="searchitem" v-model ="removedItemDiscountsSearch" placeholder="Search for...">

              </div>
            </div>
            <br>
    <table class="table table-striped table-bordered">
    <tbody>
    <tr>



      <th>Admin Name</th>
      <th>Action</th>
      <th>Item Name</th>
      <th>Item ID</th>
      <th>Item Original Price</th>
      <th>Current Discounted Price</th>
      <th>Current Sale</th>
      <th>Current TotalDiscounted Price</th>
      <th>Previous Discounted Price</th>
      <th>Previous Sale</th>
      <th>Previous TotalDiscounted Price</th>




    </tr>
    </tbody>

    <tbody>
    <tr v-for = "item in filterRemovedItemDiscounts">

      <td>{{item.adminName}}</td>
      <td>{{item.action}}</td>
      <td>{{item.itemName}}</td>
      <td>{{item.itemId}}</td>
      <td>{{item.originalPrice}}</td>
      <td>{{item.currentPrice}}</td>
      <td>{{item.currentSale}}</td>
      <td>{{item.currentTotalDiscount}}</td>
      <td>{{item.previousPrice}}</td>
      <td>{{item.previousSale}}</td>
      <td>{{item.previousTotalDiscount}}</td>



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
export default {


data(){

  return{

    createdItems:[],


    updatedItems:[],


    removedItems:[],

    discountedItems: [],

    removedItemDiscounts: [],

    createdItemsSearch: '',
    updatedItemsSearch: '',
    removedItemsSearch: '',
    discountedItemsSearch: '',
    removedItemDiscountsSearch: ''



  }
},

beforeMount(){

  this.fetchItemsCrudLogs()
  this.fetchDiscountedItems()
},

watch:{

  '$route': 'fectItemsCrudLogs'
},

computed:{

filterCreatedItems(){

  var vm = this

  return vm.createdItems.filter(function(item){

  return item.itemName.toLowerCase().match(vm.createdItemsSearch.toLowerCase())
  })
},

filterUpdatedItems(){

  var vm = this
  return vm.updatedItems.filter(function(item){

  return item.itemName.toLowerCase().match(vm.updatedItemsSearch.toLowerCase())
  })
},

filterRemovedItems(){

  var vm = this
  return vm.removedItems.filter(function(item){

    return item.itemName.toLowerCase().match(vm.removedItemsSearch.toLowerCase())
  })
},

filterDiscountItems(){

  var vm = this

  return vm.discountedItems.filter(function(item){

    return item.itemName.toLowerCase().match(vm.discountedItemsSearch.toLowerCase())
  })
},

filterRemovedItemDiscounts(){


  var vm = this

  return vm.removedItemDiscounts.filter(function(item){

    return item.itemName.toLowerCase().match(vm.removedItemDiscountsSearch.toLowerCase())
  })
}


},

methods:{

  fetchItemsCrudLogs(){
var vm = this
        axios.get('/riv-admin/getItemCrudlogs').then(function(response){

            Vue.set(vm.$data, 'createdItems', response.data.itemsCreated)
            Vue.set(vm.$data, 'updatedItems', response.data.itemsUpdated)
            Vue.set(vm.$data, 'removedItems', response.data.removedItems)
            console.log(response.data.itemsUpdated)
        }).catch(function(error){
          console.log(error)
        })
  },


  fetchDiscountedItems(){

    var vm = this
    axios.get('/riv-admin/SaleReports').then(function(response){

          Vue.set(vm.$data, 'discountedItems', response.data.discountedItems)
          Vue.set(vm.$data, 'removedItemDiscounts', response.data.removedItemDiscounts)
          console.log(response.data.discountedItems)
    }).catch(function(error){

      console.log(error)
    })
  }


}


}
</script>

<style lang="css">
</style>
