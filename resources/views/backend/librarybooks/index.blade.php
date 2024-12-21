@extends('layouts.app')

@section('content')
    <div class="roles-permissions">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Library & Books</h2>
            </div>
            <div class="flex flex-wrap items-center">
                <a href="/createbook" class="bg-gray-200 text-gray-700 text-sm uppercase py-2 px-4 flex items-center rounded">
                    <svg class="w-3 h-3 fill-current" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="plus" class="svg-inline--fa fa-plus fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"></path></svg>
                    <span class="ml-2 text-xs font-semibold">Book</span>
                </a>
            </div>
        </div>
        <div class="mt-8 bg-white rounded border-b-4 border-gray-300">
            {{-- <div class="flex flex-wrap items-center uppercase text-sm font-semibold bg-gray-300 text-gray-600 rounded-tl rounded-tr">
                <div class="w-2/12 px-4 py-3">Name of Book</div>
                <div class="w-2/12 px-4 py-3">Date of Borrow</div>
                <div class="w-2/12 px-4 py-3">Due Return Date</div>
                <div class="w-2/12 px-4 py-3">Return Date</div>
                <div class="w-2/12 px-4 py-3">Student ID</div>
                <div class="w-2/12 px-4 py-3">Actions</div>
            </div> --}}
            {{-- @foreach ($books as $book)
                <div class="flex flex-wrap items-center text-gray-700 border-t-2 border-l-4 border-r-4 border-gray-300">
                    <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $book->name_of_book }}</div>
                    <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $book->date_of_borrow }}</div>
                    <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $book->due_date }}</div>
                    <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $book->date_returned }}</div>
                    <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $book->student_id }}</div>
                    <div class="w-2/12 px-4 py-3 flex items-center space-x-4">

                        <form action="{{ route('editbook', $book->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to edit this book?');">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded m-2">
                                Edit 
                            </button>
                        </form>
                        <form action="{{ route('deletebook', $book->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this book?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach --}}
            {{-- @foreach ($books as $book)
                <div>
                    <h3>{{ $book->title }}</h3>
                    <p>Author: {{ $book->author ?? 'N/A' }}</p>
                    <a href="{{ asset('storage/' . $book->file_path) }}" download>Download</a>
                </div>
            @endforeach --}}
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">
                            Title
                        </th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">
                            Author
                        </th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($books as $book)
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                {{ $book->title }}
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                {{ $book->author }}
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                <a href="{{ route('books.download', $book) }}" 
                                   class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded">
                                    Download
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
