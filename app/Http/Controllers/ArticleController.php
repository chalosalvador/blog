<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Resources\Article as ArticleResource;
use App\Http\Resources\ArticleCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    private static $messages = [
        'required' => 'El campo :attribute es obligatorio.',
        'body.required' => 'El body no es válido.',
    ];

    public function index()
    {
//        $this->authorize('viewAny', Article::class);
//        return new ArticleCollection(Article::paginate(10));
        return new ArticleCollection(Article::all()->sortByDesc('created_at'));
    }

    public function show(Article $article)
    {
        //$this->authorize('view', $article);
        return response()->json(new ArticleResource($article), 200);
    }

    public function image(Article $article)
    {
        return response()->download(public_path(Storage::url($article->image)), $article->title);
    }

    public function store(Request $request)
    {
        $this->authorize('create', Article::class);

        $request->validate([
            'title' => 'required|string|unique:articles|max:255',
            'body' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|dimensions:min_width=200,min_height=200',
        ], self::$messages);

//        $article = Article::create($request->all());

        $article = new Article($request->all());
        $path = $request->image->store('public/articles');
//        $path = $request->image->storeAs('public/articles', $request->user()->id . '_' . $article->title . '.' . $request->image->extension());

        $article->image = 'articles/' . basename($path);
        $article->save();

        return response()->json(new ArticleResource($article), 201);
    }

    public function update(Request $request, Article $article)
    {
        $this->authorize('update', $article);

        $request->validate([
            'title' => 'required|string|unique:articles,title,' . $article->id . '|max:255',
            'body' => 'required',
            'category_id' => 'required|exists:categories,id'
        ], self::$messages);

        $article->update($request->all());
        return response()->json($article, 200);
    }

    public function delete(Request $request, Article $article)
    {
        $this->authorize('delete', $article);

        $article->delete();
        return response()->json(null, 204);
    }
}
