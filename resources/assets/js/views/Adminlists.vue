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
              <th>Admin Name</th>
              <th>Position</th>
              <th>Date Registered</th>
              <th>Last Login</th>
              <th>Last Logout</th>
            </tr>
</tbody>

<tbody>
            <tr v-for = "user in filterUsers">

              <td>{{user.id}}</td>
              <td>{{user.username}}</td>
              <td>{{user.position}}</td>
              <td>{{user.created_at}}</td>
              <td>{{user.login_time}}</td>
              <td>{{user.logout_time}}</td>
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

        this.fetchUsers()
    },

    watch:{

      '$route': 'fetchUsers'
    },

    computed:{

      filterUsers: function(){
          var vm = this
        return vm.model.filter(function(user){
          return user.username.toLowerCase().match(vm.filterSearch.toLowerCase());

        })
      }
    },

    methods: {

      fetchUsers(){
var vm = this
        axios.get('/riv-admin/getusers').then(function(response){

            Vue.set(vm.$data, 'model', response.data)
        }).catch(function(error){

          console.log(error)
        })
      }
    }
  }
</script>
