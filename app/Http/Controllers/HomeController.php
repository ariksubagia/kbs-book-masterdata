<?php

namespace App\Http\Controllers;

use App\Contracts\IBookService;
use App\Http\Requests\CreateBookValidationRequest;
use App\Http\Requests\UpdateBookValidationRequest;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(
        public IBookService $bookService
    ){}

    public function index(Request $request){
        return view("home", [
            'books' => $this->bookService->getList($request),
            'sort' => $request->query('sort'),
            'order' => $request->query('order')
        ]);
    }

    public function store(CreateBookValidationRequest $request){
        $this->bookService->create(
            title: $request->validated('title'),
            year: $request->validated('year'),
            author: $this->bookService->getAuthor($request->validated('author_id')),
            category: $this->bookService->getCategory(($request->validated('category_id')))
        );

        return redirect()
            ->route('home')
            ->with('success', 'Data baru berhasil ditambahkan');
    }

    public function edit(int $id){
        return view("edit", [
            'data' => $this->bookService->get($id),
            'categories' => $this->bookService->getCategoryList(),
            'authors' => $this->bookService->getAuthorList()
        ]);
    }

    public function update(UpdateBookValidationRequest $request, int $id){
        $this->bookService->update(
            $this->bookService->get($id),
            $request->validated()
        );

        return redirect()
            ->route('home')
            ->with('success', 'Data berhasil diubah');
    }

    public function destroy(int $id){
        $this->bookService->delete($id);

        return redirect()
            ->route('home')
            ->with('success', 'Data telah dihapus');
    }

    public function create(){
        return view("create", [
            'categories' => $this->bookService->getCategoryList(),
            'authors' => $this->bookService->getAuthorList()
        ]);
    }
}
