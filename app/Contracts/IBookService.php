<?php
namespace App\Contracts;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

interface IBookService{
    public function create(
        string $title, 
        Category $category,
        Author $author,
        int|null $year = NULL
    ): Book;

    public function delete(int $id): Book;

    public function update(Book $book, array $payload = []): Book;

    public function get(int $id): Book;

    public function getList(Request $request): Collection|CursorPaginator|Paginator;

    public function getCategory(int $id): Category;

    public function getCategoryList(Request|null $request = NULL): Collection|Paginator;

    public function getAuthor(int $id): Author;

    public function getAuthorList(Request|null $request = NULL): Collection|Paginator;
}