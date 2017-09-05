<template id="">


<div>
  <div class="col-md-8">
  <div class="panel panel-default">

        <div class="panel-heading">



            <span class="panel-title"><center v-if = "title == 'edit'">Edit: {{model.itemName}}</center><center v-else>Create Item</center></span>
            </div>
          </div>
</div>


            <div class="panel-body">
            <div class="row">

                <form class = "form" @submit.prevent = "save">
                <div class="col-sm-4">

                  <div class="form-group">



                    <label for="itemName">Item Name</label>

                    <input type="text" name="itemName"  class ="form-control" v-model = "model.itemName">
                     <small class="text-danger" v-if="errors.itemName">{{errors.itemName[0]}}</small>


                </div>

              </div>


              <div class="col-sm-4">

                <div class="form-group">



                  <label for="itemSrp">Item Srp</label>

                  <input type="text" name="itemSrp"  class ="form-control" v-model = "model.itemSrp">
                   <small class="text-danger" v-if="errors.itemSrp">{{errors.itemSrp[0]}}</small>


              </div>

            </div>


            <div class="col-sm-4">

              <div class="form-group">



                <label for="itemQuantity">Item Quantity</label>

                <input type="text" name="itemQuantity"  class ="form-control" v-model = "model.itemQuantity">
                 <small class="text-danger" v-if="errors.itemQuantity">{{errors.itemQuantity[0]}}</small>


            </div>

          </div>


          <div class="col-sm-4">

            <div class="form-group">



              <label for="itemImage">Item Image</label>

              <input type="text" name="itemImagePath"  class ="form-control" v-model = "model.itemImagePath">
               <small class="text-danger" v-if="errors.itemImagePath">{{errors.itemImagePath[0]}}</small>


          </div>

        </div>
        <div class="col-sm-4">

          <div class="form-group">


        <button type="button" name="button" class = "btn btn-success" @click = "save">Save</button>
        <button type="button" name="button" class = "btn btn-danger" @click = "destroy">Delete</button>



</div>
</div>
      </form>
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
    model: {

      items: []
    },

    errors: {},




    apiUrl: '/riv-admin/getitems/',
    method: 'post',
    initialize: '/riv-admin/getitems/create',
    redirect: '/',

    title : 'create'



  }
},

beforeMount(){

var vm = this
if(vm.$route.meta.mode === 'edit'){

  this.apiUrl = '/riv-admin/getitems/' + this.$route.params.id
  this.method = 'put'
  this.initialize = '/riv-admin/getitems/' + this.$route.params.id
  this.title = "edit"
}
  this.fetchData()
},

watch:{

  '$route' : 'fetchData'
},

methods:{

fetchData(){

  var vm = this
  axios.get(vm.initialize).then(function(response){

    Vue.set(vm.$data, 'model', response.data.model)
    console.log(response.data.model)
  }).catch(function(error){

    console.log(error)

  })


},

save(){

var vm = this

axios[vm.method](vm.apiUrl,vm.model).then(function(response){

  if(response.data.saved){

    vm.$router.push(vm.redirect)
  }
}).catch(function(error){

  console.log(error)
})
},




destroy(){
var vm = this
var isconfirmDelete = confirm('are you sure you want to delete this item?');

if(isconfirmDelete){
  axios.delete('/riv-admin/getitems/' +  vm.$route.params.id).then(function(response){

        vm.$router.push(vm.redirect)

  }).catch(function(error){

    console.log(error)
  })
}
}
}
  }
</script>
