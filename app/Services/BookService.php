<?php
namespace App\Services;

use App\Contracts\IBookService;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class BookService implements IBookService{
    public function create(
        string $title, 
        Category $category,
        Author $author,
        int|null $year = NULL
    ): Book{
        $book = new Book();
        $book->title = $title;
        $book->category_id = $category->id;
        $book->author_id = $author->id;
        $book->year = $year;
        $book->save();

        return $book;
    }

    public function update(Book $book, array $payload = []): Book{
        $collectionPayload = collect($payload);

        if( !is_null($collectionPayload->get('title', NULL)) ){
            $book->title = $collectionPayload->get('title');
        }

        if( !is_null($collectionPayload->get('year', NULL)) ){
            $book->year = $collectionPayload->get('year');
        }

        if( !is_null($collectionPayload->get('author_id', NULL)) ){
            $book->author_id = $collectionPayload->get('author_id');
        }

        $book->save();

        return $book;
    }

    public function delete(int $id): Book{
        $book = $this->get($id);
        $book->delete();
        return $book;
    }

    public function get( int $id ): Book{
        return Book::findOrFail($id);
    }

    public function getList(Request $request): Collection|CursorPaginator|Paginator{
        $query = Book::query();

        $search = $request->query('search', NULL);
        if( !is_null($search) ){
            $query->whereLike('title', '%'. $search .'%');
        }

        $sort = $request->query('sort');
        $order = $request->query('order');
        if( !is_null($sort) ){
            if( !is_null($order) ){
                $query->orderBy($sort, $order);
            }
        }else{
            $query->orderBy("id", "DESC");
        }

        return $query->paginate(10);
    }

    public function getCategory(int $id): Category{
        return Category::findOrFail($id);
    }

    public function getCategoryList(?Request $request = NULL): Collection|Paginator
    {
        return Category::query()->orderBy('id', 'DESC')->get();
    }

    public function getAuthor(int $id): Author
    {
        return Author::findOrFail($id);
    }

    public function getAuthorList(?Request $request = NULL): Collection|Paginator
    {
        return Author::query()->orderBy('id', 'DESC')->get();
    }
}