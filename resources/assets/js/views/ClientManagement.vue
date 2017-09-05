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
                <button type="button" name="button" class = "btn btn-primary" @click = "$router.push('/getclients/create/')">Create Client</button>
      </div>

              </div>
              <br>

          <table class="table table-striped table-bordered">
            <tbody>
            <tr>

              <th>ID</th>
              <th>Client Name</th>
              <th>Client Type</th>
              <th>Age</th>
              <th>Birthday</th>
              <th>Contact Number</th>
              <th>Spouse</th>
              <th>Job</th>
              <th>Date Registered</th>
              <th>Date Updated</th>
              <th>Admin</th>
              <th>Action</th>

            </tr>
</tbody>

<tbody>
            <tr v-for = "client in filterClients">

              <td>{{client.id}}</td>
              <td>{{client.clientName}}</td>
              <td>{{client.clientType}}</td>
              <td>{{client.clientAge}}</td>
              <td>{{client.clientBday}}</td>
              <td>{{client.clientCN}}</td>
              <td>{{client.clientSpouse}}</td>
              <td>{{client.clientJob}}</td>
              <td>{{client.created_at}}</td>
              <td>{{client.updated_at}}</td>
              <td>{{client.clientAdmin}}</td>

              <td>

                <router-link :to="'/getclients/' + client.id + '/view'" class = "btn btn-warning btn-xs">Edit
                  <span class = "glyphicon glyphicon-edit"></span></router-link>
              </td>

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

        this.fetchClients()
    },

    watch:{

      '$route': 'fetchClients'
    },

    computed:{

      filterClients: function(){
          var vm = this
        return vm.model.filter(function(client){
          return client.clientName.toLowerCase().match(vm.filterSearch.toLowerCase());

        })
      }
    },

    methods: {

      fetchClients(){
var vm = this
        axios.get('/riv-admin/getclients').then(function(response){

            Vue.set(vm.$data, 'model', response.data)
        }).catch(function(error){

          console.log(error)
        })
      }
    }
  }
</script>
