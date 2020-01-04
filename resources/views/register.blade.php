@extends('index')
@section('title', 'Register')
@section('content')
<div id="login">
    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6 col-lg-4">
                <div id="login-box" class="col-md-12">
                    <form id="login-form" class="form mt-5" action="/register" method="post">
                        <h3 class="text-center text-info">Create Account</h3>
                        @csrf
                        <div class="form-group">
                            <!-- <label for="name" class="text-info">Username:</label><br> -->
                            <input placeholder="Username" type="text" name="name" id="name" class="form-control"
                                value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <!-- <label for="email" class="text-info">Email:</label><br> -->
                            <input placeholder="Email address" type="email" name="email" id="email" class="form-control"
                                value="{{ old('email') }}">
                        </div>
                        <div class="form-group">
                            <!-- <label for="password" class="text-info">Password:</label><br> -->
                            <input placeholder="Password" type="password" name="password" id="password"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-primary btn-block" value="Sign Up">
                            <!-- <a href="/login" class="btn btn-link float-right">Login</a> -->
                        </div>
                        @if ($errors->any())
                        <div class="bg-danger text-white py-2 px-4">
                            @foreach ($errors->all() as $error)
                            <p class="mb-0">{{ $error }}</p>
                            @endforeach
                        </div>
                        @endif
                        @if ($verifyEmail)
                        <div class="bg-danger text-white py-2 px-4">
                            <p class="mb-0">{{ $verifyEmail }}</p>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection