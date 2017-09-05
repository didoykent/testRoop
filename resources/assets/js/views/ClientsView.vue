<template id="">


  <div class="panel panel-default">
          <div class="panel-heading">
              <span class="panel-title"><center>ClientName: {{model.clientName}}</center></span>
              <div>
                  <router-link :to="'/getclients/' + model.id + '/edit'" class="btn btn-primary btn-sm">Edit</router-link>
                  <button class="btn btn-danger btn-sm" @click="remove">Delete</button>
              </div>
          </div>
          <div class="panel-body">
              <div class="row">
                  <div class="col-sm-4">
                      <label>Client Name</label>
                      <p>{{model.clientName}}</p>
                  </div>
                  <div class="col-sm-4">
                      <label>Client Type</label>
                      <p>{{model.clientType}}</p>
                  </div>
                  <div class="col-sm-4">
                      <label>Client Age</label>
                      <p>{{model.clientAge}}</p>
                  </div>
                  <div class="col-sm-4">
                      <label>Client Birthday</label>
                      <p>{{model.clientBday}}</p>
                  </div>
                  <div class="col-sm-4">
                      <label>Client Contact</label>
                      <p>{{model.clientCN}}</p>
                  </div>
                  <div class="col-sm-4">
                      <label>Client Spouse</label>
                      <p>{{model.clientSpouse}}</p>
                  </div>
                  <div class="col-sm-4">
                      <label>Client Job</label>
                      <p>{{model.clientJob}}</p>
                  </div>
                  <div class="col-sm-4">
                      <label>Date Registerd</label>
                      <p>{{model.created_at}}</p>
                  </div>
                  <div class="col-sm-4">
                      <label>Date Updated</label>
                      <p>{{model.updated_at}}</p>
                  </div>
                  <div class="col-sm-4">
                      <label>Client Admin</label>
                      <p>{{model.clientAdmin}}</p>
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

      redirect: '/client-lists',
      resource: '/riv-admin/getclients/'  + this.$route.params.id
    }
  },

  beforeMount(){

    this.fetchClientData()
  },

  watch:{

    '$route' : 'fetchClientData'
  },

  methods:{

    fetchClientData(){
      var vm = this
      axios.get(vm.resource).then(function(response){

        Vue.set(vm.$data, 'model', response.data.model)
      }).catch(function(error){

        console.log(error)
      })

    },

    remove(){

      var vm = this
      axios.delete(vm.resource).then(function(response){

        vm.$router.push(vm.redirect)
      }).catch(function(error){

        console.log(error)
      })

    }
  }
}

</script>


<style media="screen">



  span.panel-title{

     font-size: 1.5em; /* 40px/16=2.5em */
  }
</style>
