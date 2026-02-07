<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    public function run()
    {
        $books = [
            [
                'title' => 'The Great Gatsby',
                'author' => 'F. Scott Fitzgerald',
                'description' => 'A classic novel of the Jazz Age',
                'price' => 12.99,
                'quantity' => 15,
                'category' => 'Classic'
            ],
            [
                'title' => 'To Kill a Mockingbird',
                'author' => 'Harper Lee',
                'description' => 'A novel about racial injustice in the American South',
                'price' => 14.99,
                'quantity' => 10,
                'category' => 'Classic'
            ],
            [
                'title' => '1984',
                'author' => 'George Orwell',
                'description' => 'A dystopian social science fiction novel',
                'price' => 10.99,
                'quantity' => 20,
                'category' => 'Science Fiction'
            ],
            [
                'title' => 'The Hobbit',
                'author' => 'J.R.R. Tolkien',
                'description' => 'A fantasy novel and children\'s book',
                'price' => 16.99,
                'quantity' => 12,
                'category' => 'Fantasy'
            ],
            [
                'title' => 'Harry Potter and the Philosopher\'s Stone',
                'author' => 'J.K. Rowling',
                'description' => 'The first novel in the Harry Potter series',
                'price' => 18.99,
                'quantity' => 25,
                'category' => 'Fantasy'
            ]
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}