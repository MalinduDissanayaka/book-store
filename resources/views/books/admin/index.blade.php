@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Book Management</h1>
        <a href="{{ route('books.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Add New Book
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cover</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                    <tr>
                        <td>{{ $book->id }}</td>
                        <td>
                            @if($book->cover_image)
                                <img src="{{ asset('images/books/' . $book->cover_image) }}" width="50" class="rounded">
                            @else
                                <img src="{{ asset('images/books/default.jpg') }}" width="50" class="rounded">
                            @endif
                        </td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->category }}</td>
                        <td>${{ number_format($book->price, 2) }}</td>
                        <td>{{ $book->quantity }}</td>
                        <td>
                            <a href="{{ route('books.show', $book->id) }}" class="btn btn-sm btn-info" title="View">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('books.edit', $book->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection