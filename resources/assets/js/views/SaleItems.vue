<template lang="html">

  <div>
    <div class="col-md-9">
      <!-- Website Overview -->
      <div class="panel panel-default">
        <div class="panel-heading main-color-bg">
          <h3 class="panel-title">Welcome!</h3>
        </div>
        <div class="panel-body">

          <div class = "row">
            <div class="col-md-12">
                    <div class="col-md-6">
                    <input type="text" class="form-control" list="searchitem" v-model ="modelSearchValue" placeholder="Search for...">
                  </div>

                    <div class="col-md-6">
                        <input type="text" class="form-control" list="searchitem" v-model ="selectItemsSearchValue" placeholder="Search for...">

                      </select>

                 </div>
                  </div>

                </div>

                    <br>




                      <div class = "row">
                        <div class="col-md-12">

                          <div class="col-md-6">
                            <div class="list-group">
                  <button type="button" class="list-group-item list-group-item-action active" disabled>
                    Choose Item
                  </button>

                  <div v-for = "(item, index) in modelFilter">

                  <button type="button" class="list-group-item list-group-item-action" @click = "addItem(item,index)" :class="{active: item.active}">{{item.itemName}}<span class="badge badge-default badge-pill">{{item.itemSaleStatus}}</span></button>

                </div>


                    </div>
                  </div>

                    <div class="col-md-6">


                      <div class="list-group">
                        <button type="button" class="list-group-item list-group-item-action active"  disabled>
                          Selected Items
                        </button>
                          <div v-for = "item in itemListsFilter">
                        <button type="button"  class="list-group-item list-group-item-action" @click = "removeItem(item)">{{item.itemName}}<span class="badge badge-default badge-pill">{{item.itemSaleStatus}}</span><span class="badge badge-default badge-pill">{{item.itemSrp}}</span></button>

                      </div>
                      </div>
                    </div>

</div>
</div>

<div class="row">

  <div class="col-md-12">


<div class="col-md-6">

<button type="button" class = "btn btn-success" @click  = "selectAll" name="button">Select All</button>
<button type="button" class = "btn btn-danger" @click  = "removeAll" name="button">Remove All</button>


</div>

    <div class="col-md-6">




    <div class="col-md-3">
                    <select class="form-control"   v-model = "saleValue"   @change.prevent = "onSelect"  >

                                 <option selected disabled>Choose Value</option>

                                    <option v-for = "discount in discountValues" :value = "discount">{{discount}}%</option>


                                  </select>

                                </div>
          <button type="button" @click="removeItemsDiscount" id ="remnovedSaleItems" class = "btn btn-success "name="button">Remove Discounts</button>
        <button type="button" @click="getItemsDiscount" id ="saleItems" class = "btn btn-warning "name="button">Sale Items</button>



</div>
  </div>
</div>
              </div>

            </div>
          </div>
        </div>
</template>

<script>
import  Vue from 'vue'
import axios from 'axios'


export default {

  data(){

    return{

      model: [],

      itemLists: [],

      modelSearchValue: '',

      selectItemsSearchValue: '',





      discountValues: [5,10,15,20,25,30,35,40,45,50,55,60,65,70,75,80,85,90,95,100],
      saleValue: '',

      method: 'post',
      discountApiUrl: '/riv-admin/getItemsDiscount',
      redirect: '/'

    }
  },

  beforeMount(){

    this.fetchItems()
  },


  watch:{

    '$route': 'fetchItems'
  },

  computed:{

    modelFilter(){

var vm  = this

return vm.model.filter(function(item){

  return item.itemName.toLowerCase().match(vm.modelSearchValue.toLowerCase())
})
    },

itemListsFilter(){
var vm = this
  return vm.itemLists.filter(function(item){

    return item.itemName.toLowerCase().match(vm.selectItemsSearchValue.toLowerCase())
  })
},



dynamicValues(){
var vm = this

  return vm.itemLists

}
},



  methods:{

    fetchItems(){
var vm = this
      axios.get('/riv-admin/getitems').then(function(response){

          Vue.set(vm.$data, 'model', response.data)
          console.log(response.data)
      }).catch(function(error){

        console.log(error)
      })
    },

    addItem(item,index){

      var vm = this






if(!vm.model[index].active){

vm.model[index].active = !vm.model[index].active
vm.itemLists.push(item)
}

else{
return false;

}



console.log(index)



    },

    selectAll(){
var vm = this
      vm.itemLists = []

      for(var i =0; i<vm.model.length; i++){

        vm.itemLists.push(vm.model[i])
        vm.model[i].active = true
      }
    },

    removeItem(item){

var vm = this
vm.$set(vm, 'itemLists', vm.itemLists.filter(function(items) { return items != item; }));

  for(var i =0; i<vm.model.length; i++){

    if(vm.model[i].id == item.id){

      vm.model[i].active = false
    }
  }
console.log(vm.itemLists)

    },

removeAll(){

var vm = this

vm.itemLists = []

for(var i =0; i<vm.model.length; i++){

  vm.model[i].active = false
}
},

onSelect(){
var vm = this

for(var i =0; i<vm.itemLists.length; i++){

       if(vm.itemLists[i].itemDiscount == null){



         var discount = (vm.saleValue / 100) * vm.itemLists[i].itemSrp
        vm.itemLists[i].itemSrp =  vm.itemLists[i].itemSrp - discount
         vm.itemLists[i].itemDiscount = vm.saleValue / 100
         vm.itemLists[i].itemSaleStatus = true


   }
   else{
         var orignalPrice =  vm.itemLists[i].itemSrp / (1 - vm.itemLists[i].itemDiscount)
         var previousDiscount = vm.itemLists[i].itemDiscount
         var currentDiscount = (vm.saleValue / 100) * orignalPrice
         var previousPrice = vm.itemLists[i].itemSrp
         vm.itemLists[i].itemSrp = orignalPrice - currentDiscount

   vm.itemLists[i].itemDiscount = vm.saleValue / 100

console.log(vm.itemLists[i].itemSrp, vm.itemLists[i].itemDiscount, previousDiscount, orignalPrice, currentDiscount, previousPrice  )



    }


}
},

getItemsDiscount(){

var vm = this

var itemsId = []



for(var i = 0; i<vm.itemLists.length; i++){

  itemsId.push(vm.itemLists[i].id)
}

var result = Object.entries(itemsId).map((value)=>(value));


axios.get('/riv-admin/getItemsDiscount/' + vm.saleValue + '/' + itemsId).then(function(response){

if(response.data.saved){

  vm.$router.push(vm.redirect)
}
console.log(result)
console.log(response.data.saleValue)
console.log(response.data.itemsId)


}).catch(function(error){

  console.log(error)
})
},

removeItemsDiscount(){

  var vm = this
  var itemsId = []



  for(var i = 0; i<vm.itemLists.length; i++){

    itemsId.push(vm.itemLists[i].id)
  }

  axios.get('/riv-admin/removeItemsDiscount/' + itemsId).then(function(response){

    if(response.data.removed){

      vm.$router.push(vm.redirect);
    }

    console.log(response.data.removed)
  }).catch(function(error){

    console.log(error)
  })

}

  }
}
</script>

<style lang="css">





</style>
