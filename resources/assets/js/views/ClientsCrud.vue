<template id="">







  <div>
    <div class="col-md-9">
      <!-- Website Overview -->
      <div class="panel panel-default">
        <div class="panel-heading main-color-bg">
          <h3 class="panel-title">Welcome!</h3>
        </div>
        <div class="panel-body">


          <form class = form @submit.prevent = "Save">


            <div class="col-sm-4">

              <div class="form-group">



                <label for="ClientName">Client Name</label>

                <input type="text" name="clientName"  class ="form-control" v-model = "model.clientName">
                 <small class="text-danger" v-if="errors.clientName">{{errors.clientName[0]}}</small>


            </div>

          </div>


          <div class="col-sm-4">

            <div class="form-group">



              <label for="ClientName">Client Type</label>

              <select class="form-control" v-model="model.clientType">

                                <option v-for="client in clientType" >
                                    {{client}}
                                </option>
</select>
               <small class="text-danger" v-if="errors.clientType">{{errors.clientType[0]}}</small>


          </div>

        </div>


        <div class="col-sm-4">

          <div class="form-group">



            <label for="ClientAge">Client Age</label>

            <input type="text" name="clientAge"  class ="form-control" v-model = "model.clientAge">
             <small class="text-danger" v-if="errors.clientAge">{{errors.clientAge[0]}}</small>


        </div>

      </div>


      <div class="col-sm-4">

        <div class="form-group">



          <label for="ClientBirthday">Client Birthday</label>

          <input type="date" name="clientBirthday"  class ="form-control" v-model = "model.clientBday">
           <small class="text-danger" v-if="errors.clientBday">{{errors.clientBday[0]}}</small>


      </div>

    </div>


    <div class="col-sm-4">

      <div class="form-group">



        <label for="ClientContact">Client Contact</label>

        <input type="number" min="0" name="clientContact"  class ="form-control" v-model = "model.clientCN">
         <small class="text-danger" v-if="errors.clientCN">{{errors.clientCN[0]}}</small>


    </div>

  </div>

  <div class="col-sm-4">

    <div class="form-group">



      <label for="ClientSpouse">Client Spouse</label>

      <input type="text" name="clientSpouse"  class ="form-control" v-model = "model.clientSpouse">
       <small class="text-danger" v-if="errors.clientSpouse">{{errors.clientSpouse[0]}}</small>


  </div>

</div>


<div class="col-sm-4">

  <div class="form-group">



    <label for="ClientJob">Client Job</label>

    <input type="text" name="clientJob"  class ="form-control" v-model = "model.clientJob">
     <small class="text-danger" v-if="errors.clientJob">{{errors.clientJob[0]}}</small>


</div>

</div>


<div class="col-sm-4-md-offset-8">




<button type="submit"  name="button" class = "btn btn-success form-control">Save</button>





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

          clients:[]
        },

        errors: {},
        method: 'post',
        apiUrl: '/riv-admin/getclients',
        redirect: '/client-management/',
        initialize: '/riv-admin/getclients/create',

        clientType:{

          'DEALER': 'DEALER',
          'STORE': 'STORE',
          'AGENT': 'AGENT'

        }
      }
    },

    beforeMount(){

      if(this.$route.meta.mode == 'edit'){

        this.initialize = '/riv-admin/getclients/' + this.$route.params.id,
        this.apiUrl = '/riv-admin/getclients/' + this.$route.params.id
        this.method = 'put'

      }

      this.fetchClients()
    },

    watch:{


    },

    methods:{

      fetchClients(){
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

          }).catch(function(error){

          vm.errors = error.response.data
          })



          this.$nextTick(function () {

              axios.post(vm.testApi).then(function(response){

                console.log(response.data)

              }).catch(function(error){

              console.log(error)
              })




        })
      }
    }
  }
</script>
