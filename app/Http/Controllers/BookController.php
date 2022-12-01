<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * すべてのbookを取得
     *
     * @return object $result
     */
    public function getAll()
    {
        $books = Book::get()->toJson(JSON_PRETTY_PRINT);
        return response($books, 200);
    }

    /**
     * IDを指定して1件取得
     *
     * @param integer $id
     * @return Bool $result
     */
    public function getById(int $id)
    {
        $books = Book::find($id)->toJson(JSON_PRETTY_PRINT);
        return response($books, 200);
    }

    /**
     * Bookを追加
     *
     * @param Request $request
     * @return void
     */
    public function create(Request $request)
    {
        $book = new Book();
        $book->title = $request->title;
        $book->author = $request->author;
        $book->memo = $request->memo;
        $book->save();

        return response()->json([
            'message' => 'created book'
        ], 201);
    }

    /**
     * Bookを更新
     *
     * @param Request $request
     * @param integer $id
     * @return void
     */
    public function updateById(Request $request, int $id)
    {
        if (Book::where('id', $id)->exists())
        {
            $book = Book::find($id);
            if (!empty($request->title)) {
                $book->title = $request->title;
            }
            if (!empty($request->author)) {
                $book->author = $request->author;
            }
            if (isset($request->memo)) {
                $book->memo = $request->memo;
            }
            $book->save();

            return response()->json([
                'message' => 'updated book'
            ], 201);
        } else {
            return response()->json([
                'message' => 'book not found'
            ], 404);
        }
    }

    /**
     * Bookを削除
     *
     * @param integer $id
     * @return void
     */
    public function deleteById(int $id)
    {
        if (Book::where('id', $id)->exists())
        {
            $book = Book::find($id);
            $book->delete();

            return response()->json([
                'message' => 'deleted book'
            ], 202);
        } else {
            return response()->json([
                'message' => 'book not found'
            ], 404);
        }
    }
}
