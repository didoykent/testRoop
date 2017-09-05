<template id="">


  <div class="panel panel-default">
          <div class="panel-heading">
              <span class="panel-title"><center>itemName: {{model.itemName}}</center></span>
              <div>
                  <router-link :to="'/getitems/' + model.id + '/edit'" class="btn btn-primary btn-sm">Edit</router-link>
                  <button class="btn btn-danger btn-sm" @click="remove">Delete</button>
              </div>
          </div>
          <div class="panel-body">
              <div class="row">
                  <div class="col-sm-4">
                      <label>Item Name</label>
                      <p>{{model.itemName}}</p>
                  </div>
                  <div class="col-sm-4">
                      <label>Srp</label>
                      <p>{{model.itemSrp}}</p>
                  </div>
                  <div class="col-sm-4">
                      <label>Item Quantity</label>
                      <p>{{model.itemQuantity}}</p>
                  </div>
                  <div class="col-sm-4">
                      <label>Item Image</label>
                      <p>{{model.itemImagePath}}</p>
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

      redirect: '/item-lists',
      resource: '/riv-admin/getitems/'  + this.$route.params.id
    }
  },

  beforeMount(){

    this.fetchitemData()
  },

  watch:{

    '$route' : 'fetchitemData'
  },

  methods:{

    fetchitemData(){
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
        console.log(response.data)
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
