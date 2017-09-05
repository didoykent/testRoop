<template id="">









    <div>
      <div class="col-md-9">
        <!-- Website Overview -->
        <div class="panel panel-default">
          <div class="panel-heading main-color-bg">
            <h3 class="panel-title">Welcome!</h3>
          </div>
          <div class="panel-body">


            <form class = form  >


              <div class="col-sm-4">

                <div class="form-group">



                  <label for="ItemName">Item Name</label>

                  <input type="text" name="itemName"  class ="form-control" v-model = "model.itemName">
                   <small class="text-danger" v-if="errors.itemName">{{errors.itemName[0]}}</small>


              </div>

            </div>


            <div class="col-sm-4">

              <div class="form-group">



                <label for="ItemSrp">SRP</label>

                <input type="number" name="itemSrp"  class ="form-control" v-model = "model.itemSrp">
                 <small class="text-danger" v-if="errors.itemSrp">{{errors.itemSrp[0]}}</small>


            </div>

          </div>










    <div class="col-sm-4">

      <div class="form-group">



        <label for="Item Quantity">Item's Left</label>

        <input type="number" name="itemQuantity"  class ="form-control" v-model = "model.itemQuantity">
         <small class="text-danger" v-if="errors.itemQuantity">{{errors.itemQuantity[0]}}</small>


    </div>

  </div>


  <div class="col-sm-4">

    <div class="form-group">



      <label for="itemImagePath">Item Image</label>

      <input type="text" name="itemImagePath"  class ="form-control" v-model = "model.itemImagePath">
       <small class="text-danger" v-if="errors.itemImagePath">{{errors.itemImagePath[0]}}</small>


  </div>

  </div>


  <div class="col-sm-4-md-offset-8">




  <button type="button"  name="button" class = "btn btn-success form-control"   @click = "Save()">Save</button>






  </div>
            </form>

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

          model:{

            items:[]
          },

          errors: {},
          method: 'post',
          apiUrl: '/riv-admin/getitems',
          redirect: '/item-management/',
          initialize: '/riv-admin/getitems/create',
          testApi: '/riv-admin/test/' + this.$route.params.id,



        }
      },

      beforeMount(){

        if(this.$route.meta.mode == 'edit'){

          this.initialize = '/riv-admin/getitems/' + this.$route.params.id,
          this.apiUrl = '/riv-admin/getitems/' + this.$route.params.id
          this.method = 'put'

        }

        this.fetchItems()


      },

      watch:{




        '$route': 'fetchItems'

      },

      methods:{

        fetchItems(){
  var vm = this
          axios.get(vm.initialize).then(function(response){

            Vue.set(vm.$data, 'model', response.data.model)


          }).catch(function(error){

            console.log(error)
          })
        },

        Save(){
  var vm = this
            axios[vm.method](vm.apiUrl, vm.model).then(function(response){




                  vm.$router.push(vm.redirect)

              console.log(response.data)



            }).catch(function(error){

            vm.errors = error.response.data
            })




        },





      }








    }
  </script>
