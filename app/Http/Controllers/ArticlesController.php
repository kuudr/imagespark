<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use willvincent\Rateable\RateableServiceProvider;
use Willvincent\Rateable\Rating;

class ArticlesController extends Controller
{

    public function index()
    {
        $articles = Articles::query()->get();

        return view('articles/articles',
            ['articles' => DB::table('articles')->paginate(5)
            ]);
    }


    public function create()
    {
        return View::make('articles/articleCreate');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'text' => 'required',
            'created_by' => 'required',

        ]);
        if ($validator->fails()) {
            return redirect('articles/create')
                ->withErrors($validator)
                ->withInput();
        }else {
            $article = new Articles([
                'name' => $request->get('name'),
                'text' => $request->get('text'),
                'created_by' => $request->get('created_by'),
            ]);

            $article->save();

            return redirect('/articles')->with('success', 'Статья добавлена!');
        }
    }


    public function show($id)
    {
        /**
         * @var Articles|null $article
         */
        $article = Articles::query()->findOrFail($id);
        return view('articles/articleView',
            [
                'article' => $article,
                'avg' => $article->ratings()->avg('rating')

            ]);
    }


    public function edit($id)
    {
        $article = Articles::query()->findOrFail($id);

        return view('articles/articleUpdate', ['article' => $article]);

    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'text' => 'required',
        ]);


        if ($validator->fails()) {
            return redirect('articles/' . $id . '/edit')
                ->withErrors($validator);
        } else {
            /**
             * @var Articles|null $article
             */
            $article = Articles::query()->findOrFail($id);
            $article->name = $request->get('name');
            $article->text = $request->get('text');
            $article->save();
            return Redirect('/articles');
        }
    }


    public function destroy($id)
    {
        /**
         * @var Articles|null $article
         */

        $article = Articles::query()->findOrFail($id);

        $article->delete();

        return view('articles/articleDelete', ['user'=>$article]);
    }


    public function rating(Request $request, $id)
    {

        request()->validate(['rate' => 'required']);
        $article = Articles::query()->findOrFail($id);
        $rating = new \willvincent\Rateable\Rating;
        $rating->rating = $request->rate;
        $article->ratings()->save($rating);
        return Redirect('/articles');
    }

}
