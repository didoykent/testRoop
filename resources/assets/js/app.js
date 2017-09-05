import Vue from 'vue'


import App from './App.vue'
import router from './router'
import axios from 'axios'

Vue.component('example', require('./App.vue'));
Vue.component('what', require('./views/test.vue'));
Vue.component('itemscrud', require('./views/ItemsCrud.vue'));

const vue = new Vue({


  el: '#app',
  components: {App},
  router,
  data(){

    return{
      getuserscount:{
        userscount:[]
      },

      getclientscount:{

        clientscount: []
      },

      getitemscount:{

        itemscount: []
      },

      getCartTotalItems:{

        cartTotalItems:[]
      },

      getSumReports:{

        sumReports:[]
      },

      url: '/riv-admin/getcount',
      cartTotalItemsUrl: '/riv-admin/fetchCart',
      sumReportsUrl: '/riv-admin/SaleReportsCount',





    }
  },

  beforeMount(){

    this.handleApi()
    this.fetchData()
    this.fetchCartTotal()
    this.fetchSummRepData()
    this.handleApi()




  },

  watch:{

    '$route': 'fetchData'
  },

  methods:{





    handleApi(){

      axios.get('/riv-admin/handleApi').then(function(response){


      }).catch(function(error){

        console.log(error)
      })
    },

    fetchData(){

var vm = this;
      axios.get(vm.url).then(function(response){

        Vue.set(vm.$data, 'getuserscount', response.data.users)
        Vue.set(vm.$data, 'getclientscount', response.data.clients)
        Vue.set(vm.$data, 'getitemscount', response.data.items)



      }).catch(function(error){

        console.log(error)
      })
    },

    fetchCartTotal(){

      var vm = this;
      axios.get(vm.cartTotalItemsUrl).then(function(response){

        Vue.set(vm.$data, 'getCartTotalItems', response.data)

      }).catch(function(error){

        console.log(error)
      })
    },

    fetchSummRepData(){

      var vm = this

      axios.get(vm.sumReportsUrl).then(function(response){


        Vue.set(vm.$data, 'getSumReports',response.data)


      }).catch(function(error){

        console.log(error)
      })
    }

}
})
