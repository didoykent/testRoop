@extends('layouts.mainpage')

@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <h1>Sign Up</h1>
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <form action="{{ route('user.signup') }}" method="post">
                <div class="form-group">
                    <label for="username">UserName</label>
                    <input type="text" id="usename" name="username" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control">
                </div>

                <div class="form-group">
                    <label for="verifypassword">Verify New Password</label>
                    <input type="password" id="password" name="verifypassword" class="form-control">
                </div>



                <button type="submit" class="btn btn-primary">Sign Up</button>
                {{ csrf_field() }}
            </form>
        </div>
    </div>

        <link rel="stylesheet" href="/css/bootswap.css">
@endsection
