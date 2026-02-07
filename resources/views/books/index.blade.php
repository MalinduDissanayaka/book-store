@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Available Books</h1>
    
    <div class="row">
        @foreach($books as $book)
            <div class="col-md-4 mb-4">
                <div class="card book-card h-100">
                    @if($book->cover_image)
                        <img src="{{ asset('images/books/' . $book->cover_image) }}" class="card-img-top" alt="{{ $book->title }}">
                    @else
                        <img src="{{ asset('images/books/default.jpg') }}" class="card-img-top" alt="Default Book Cover">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $book->title }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">by {{ $book->author }}</h6>
                        <p class="card-text">{{ Str::limit($book->description, 100) }}</p>
                        <p><strong>Category:</strong> {{ $book->category }}</p>
                        <p><strong>Price:</strong> ${{ number_format($book->price, 2) }}</p>
                        <p><strong>Available:</strong> {{ $book->quantity }} copies</p>
                        <a href="{{ route('books.show', $book->id) }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection