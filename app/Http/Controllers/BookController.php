<?php

namespace App\Http\Controllers;

use App\Book;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function sumOfBooks() {
        $books = DB::table('books')->count();

        return view('dashboard.admin', ['books' => $books]);
    }

    public function uploadBook(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx',
        ]);

        $filePath = $request->file('file')->store('books', 'public');

        Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'file_path' => $filePath,
        ]);

        return redirect()->back()->with('success', 'Book uploaded successfully!');
    }

    public function displayBooks() {
        $books = Book::all();

        return view('backend.librarybooks.index', ['books'=> $books]);
    }

    public function download(Book $book)
    {
        return Storage::disk('public')->download($book->file_path);
    }

    public function edit($id) {
        $book = Book::findOrFail($id);

        $students = Student::all();

        return view('backend.librarybooks.edit', compact('book', 'students'));
    }

    // public function updateBook(Request $request, Book $book) {
    // $validatedData = $request->validate([
    //     'name_of_book'=>'required|string|max:255',
    //     'date_of_borrow'=>'nullable|date',
    //     'due_date' => 'nullable|date',
    //     'date_returned' => 'nullable|date',
    //     'student_id' => 'nullable|integer|exists:students,id',
    // ]);

    // $book->update($validatedData);

    // return redirect()->route('librarybooks')->with('success', 'Book updated successfully.');
    // }

    public function deleteBook(Book $book) {
        $book->delete();

        return redirect()->route('librarybooks')->with('success', 'Book deleted successfully.');
    }

    // public function createBook(Request $request) {
    //     $validatedData = $request->validate([
    //         'name_of_book'=>'required|string|max:255',
    //         'date_of_borrow'=>'nullable|date',
    //         'due_date' => 'nullable|date',
    //         'date_returned' => 'nullable|date',
    //         'student_id' => 'nullable|integer|exists:students,id',
    //     ]);

    //     Book::create($validatedData);

    //     return redirect()->route('librarybooks')->with('success', 'Book created successfully.');
    // }

    public function showCreateBook() {
        return view('backend.librarybooks.create');
    }
}
