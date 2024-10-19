<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use function Pest\Laravel\json;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $books = Book::query()
            ->get();

            return response()->json([
                'status_code' => 200,
                'message' => 'Get all book',
                'data' => $books,
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'status_code' => $th->getStatusCode(),
                'message' => $th->getMessage(),
                'data' => $th->getMessage(),
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        try {
            $book = Book::create($request->validated());

            return response()->json([
                'status_code' => 200,
                'message' => 'Successfully create data!',
                'data' => $book,
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'status_code' => $th->getStatusCode(),
                'message' => $th->getMessage(),
                'data' => $th->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        try {
            return response()->json([
                'status_code' => 200,
                'message' => 'Get book',
                'data' => $book,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status_code' => $th->getStatusCode(),
                'message' => $th->getMessage(),
                'data' => $th->getMessage(),
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        try {
            $book->update($request->validated());

            return response()->json([
                'status_code' => 200,
                'message' => 'Successfully update data!',
                'data' => $book,
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'status_code' => $th->getStatusCode(),
                'message' => $th->getMessage(),
                'data' => $th->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        try {
            $book->delete();
            return response()->json([
                'status_code' => 200,
                'message' => 'Delete book',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status_code' => $th->getStatusCode(),
                'message' => $th->getMessage(),
            ]);
        }
    }
}
