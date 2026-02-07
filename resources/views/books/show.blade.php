@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            @if($book->cover_image)
                <img src="{{ asset('images/books/' . $book->cover_image) }}" class="img-fluid rounded" alt="{{ $book->title }}">
            @else
                <img src="{{ asset('images/books/default.jpg') }}" class="img-fluid rounded" alt="Default Book Cover">
            @endif
        </div>
        <div class="col-md-8">
            <h1>{{ $book->title }}</h1>
            <h4 class="text-muted">by {{ $book->author }}</h4>
            <hr>
            <p><strong>Description:</strong></p>
            <p>{{ $book->description }}</p>
            <hr>
            <p><strong>Category:</strong> {{ $book->category }}</p>
            <p><strong>Price:</strong> ${{ number_format($book->price, 2) }}</p>
            <p><strong>Available Quantity:</strong> {{ $book->quantity }}</p>
            <p><strong>Added:</strong> {{ $book->created_at->format('M d, Y') }}</p>
            
            @if(auth()->user() && auth()->user()->isAdmin())
                <div class="mt-4">
                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </div>
            @endif
            
            <a href="{{ route('books.index') }}" class="btn btn-secondary mt-3">Back to Books</a>
        </div>
    </div>
</div>
@endsection