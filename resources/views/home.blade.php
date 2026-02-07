@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @auth
                        <h4>Welcome to BookStore!</h4>
                        <p>You are logged in as
                            <strong>
                                @if(auth()->user()->role == 'admin')
                                    Administrator
                                @elseif(auth()->user()->role == 'user')
                                    Regular User
                                @else
                                    User (Role not set)
                                @endif
                            </strong>
                        </p>
                        
                        <div class="mt-4">
                            @if(auth()->user()->role == 'admin')
                                <a href="{{ route('books.admin.index') }}" class="btn btn-primary">Go to Admin Panel</a>
                            @endif
                            <a href="{{ route('books.index') }}" class="btn btn-success">Browse Books</a>
                        </div>
                    @else
                        <h4>Welcome to BookStore!</h4>
                        <p>Please <a href="{{ route('login') }}">login</a> or <a href="{{ route('register') }}">register</a> to continue.</p>
                        <div class="mt-4">
                            <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                            <a href="{{ route('register') }}" class="btn btn-success">Register</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection