



 <header id="header">
  <div class="container">
    <div class="row">
      <div class="col-md-10">
        <h1> Sales Management  </h1>
  </div>
</div>
</header>





<section id="main">


    <div class="col-md-3" >
      <div class="list-group">
        <div class="dropdown">
                <a href="#" role = "button" class="list-group-item dropdown-toggle main-color-bg" data-toggle="dropdown" >
                     <span class="fa fa-user fa"> {{Session::get('user')}}</span></a>
                     <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">

                   <li><a  href="{{route('user.logout')}}">Log Out</a></li>
                 <li class="divider"></li>


                 <li class="dropdown-submenu">
                   <a tabindex="-1" href="#">Account Settings</a>
                   <ul class="dropdown-menu">
                     <li><a tabindex="-1" href="#">Profile</a></li>


                     <li><a href="#">Message</a></li>

                     <li class="dropdown-submenu">
                       <a href="#">Change Details</a>
                       <ul class="dropdown-menu">
                           <li><a href="{{route('admin.manage')}}">Change Password</a></li>

                       </ul>
                     </li>
                   </ul>
                 </li>
                 @if(Auth::user()->thisUserRole == "positionrivadmin")
                    <li><a  href="{{route('user.signup')}}">Create Account</a></li>
                 <li><a  href="{{route('admin.manageusers')}}">Manage Users</a></li>
                 @endif
               </ul>
        </div>
        </a>
        <a href="{{route('admin.profile')}}" class="list-group-item " ><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home <span class="badge"></span></a>
        <router-link to = "/admin-lists" role = "button" class = "list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Admin Lists <span class="badge ">@{{getuserscount}}</span></router-link>
        <router-link to = "/client-lists" class="list-group-item"><i class="fa fa-users" aria-hidden="true"></i> Client Lists <span class="badge">@{{getclientscount}}</span></router-link>
        <router-link to = "/client-management" class="list-group-item"><i class="fa fa-tasks" aria-hidden="true"></i> Client Management <span v-if = "getclientscount"class="badge">@{{getclientscount}}</span></router-link>
        <router-link to = "/item-lists" class="list-group-item"><i class="fa fa-product-hunt" aria-hidden="true"></i> Inventory Lists <span class="badge">@{{getitemscount}}</span></router-link>
        <router-link to = "/item-management" class="list-group-item"><i class="fa fa-bars" aria-hidden="true"></i> Inventory Management <span class="badge">@{{getitemscount}}</span></router-link>
        <a href="{{route('client.transaction')}}" class="list-group-item"><i class="fa fa-shopping-basket" aria-hidden="true"></i> Client Transaction <span class="badge">@{{getitemscount}}</span></a>
        <a href="{{route('new.transaction')}}" class="list-group-item"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Store Transaction <span class="badge">@{{getitemscount}}</span></a>
        <a href="{{route('cart.items')}}" role = "button"class="list-group-item"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart Items <span class="badge">@{{getCartTotalItems}}</span></a>
        <router-link to = "/store-transaction" role = "button" class = "list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Test <span class="badge "></span></a></router-link>
<div class="dropdown">
        <a href="#" role = "button" class="list-group-item dropdown-toggle " data-toggle="dropdown"><span class="glyphicon glyphicon-list-alt " aria-hidden="true"></span> Summary of Reports <span class="badge ">@{{getSumReports}}</span></a>
        <ul class="dropdown-menu">
            <li><a href="{{route('view.getusersReport')}}">Users Report</a></li>
            <li><router-link to = "/items-crudlogs/">Items Report</router-link></li>
            <li><a href="{{route('admin.SaleReportsRec')}}">Sales Report</a></li>
          </ul>

        </div>

      </div>

    </div>
