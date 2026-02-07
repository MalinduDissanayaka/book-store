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

                    <h4>Welcome to BookStore!</h4>
                    <p>You are logged in as 
                        <strong>{{ auth()->user()->role == 'admin' ? 'Administrator' : 'Regular User' }}</strong>
                    </p>
                    
                    <div class="mt-4">
                        @if(auth()->user()->role == 'admin')
                            <a href="{{ route('books.admin.index') }}" class="btn btn-primary">Go to Admin Panel</a>
                        @endif
                        <a href="{{ route('books.index') }}" class="btn btn-success">Browse Books</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection