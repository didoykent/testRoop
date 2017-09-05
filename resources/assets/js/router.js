import Vue from 'vue'

import VueRouter from 'vue-router'
import axios from 'axios'

Vue.use(VueRouter)

const Foo = { template: '<div>foo</div>' }

const router = new VueRouter({


  routes:[



    {path: '/', component:require('./App.vue')},
    {path: '/getclients/create/', component:require('./views/ClientsCrud.vue')},
    {path: '/getclients/:id/edit', component:require('./views/ClientsCrud.vue'), meta: {mode: 'edit'}},
    {path: '/getclients/:id/view', component:require('./views/ClientsView.vue')},
    {path: '/test/', component:require('./views/test.vue')},
    {path: '/foo', component:Foo},
    {path: '/admin-lists/', component:require('./views/Adminlists.vue'), name: 'adminlists'},
    {path: '/client-lists/', component:require('./views/Clientlists.vue'), name:'client-lists', meta: {auth:true}},
    {path: '/client-management/', component:require('./views/ClientManagement.vue'), name: 'client-management'},
    {path: '/item-lists/', component:require('./views/Itemlists.vue'), name: 'itemlists'},
    {path: '/item-management/', component:require('./views/ItemManagement.vue'), name: 'item-management'},
    {path: '/getitems/create', component:require('./views/ItemsCrud.vue')},
    {path: '/getitems/:id/view', component:require('./views/ItemsView.vue')},
    {path: '/getitems/:id/edit', component:require('./views/ItemsCrud.vue'), meta: {mode: 'edit'}},
    {path: '/items-crudlogs', component:require('./views/logs/ItemsCrudLogs.vue')},
    {path: '/items-sale', component:require('./views/SaleItems.vue')},
    {path: '/store-transaction', component:require('./views/transaction/StoreTransaction.vue')}





  ]
})


router.beforeEach((to, from, next) => {




if(to.meta.auth){

  axios.get('/riv-admin/handleApi').then(function(response){


      if(response.data == 'positionrivadmin'){


          next()
      }

      else{

      next({
        name: 'admin-lists'
      })
      }
        })



}


else{
next()

}

})



export default router
