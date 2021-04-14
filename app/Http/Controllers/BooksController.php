<?php

declare (strict_types=1);

namespace App\Http\Controllers;

use App\Book;
use App\BookAuthor;
use App\BookReview;
use App\Http\Requests\PostBookRequest;
use App\Http\Requests\PostBookReviewRequest;
use App\Http\Resources\BookResource;
use App\Http\Resources\BookReviewResource;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function getCollection(Request $request)
    {

        // @TODO implement
        $authors = explode(',', $request->authors);

        $books = Book::query()->with(['authors' => function ($query) use ($authors) {
            $query->whereIn('id', $authors)->get(['id', 'name', 'surname']);
        }]);
        if (isset($request->title)) {
            $books = $books->where('title', $request->title);
        };
        if (isset($request->sortColumn)) {
            $books = $books->orderBy($request->sortColumn, $request->sortDirection);
        }
        $books = $books->paginate(15);

        return response()->json(BookResource::collection($books));

    }

    public function post(PostBookRequest $request)
    {
        // @TODO implement
        $book = Book::create($request->except('authors'));
        foreach ($request->authors as $author) {
            BookAuthor::create(['book_id' => $book->id, 'author_id' => $author]);
        }
        return response()->json(new BookResource($book));

    }

    public function postReview(Book $book, PostBookReviewRequest $request)
    {
        // @TODO implement
        $user = auth()->user();
        $bookReview = $book->reviews()->create([
            'user_id' => $user->id,
            'review' => $request->review,
            'comment' => $request->comment
        ]);

        return response()->json([
            'data' => [
                'id' => $bookReview->id,
                'review' => $bookReview->review,
                'comment' => $bookReview->comment,
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name
                ]
            ]
        ]);
    }
}
