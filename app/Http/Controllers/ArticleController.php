<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function adminIndex()
    {
        $user = auth()->user();

        $allArticles = Article::with('doctor')->get();
        $doctors = Doctor::all();
        return view('admin.articles.index', ['articles' => $allArticles, 'doctors' => $doctors]);
    }

    public function memberIndex(Request $request)
    {
        $query = Article::with('doctor');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $articles = $query->latest('date_published')->get();

        return view('member.articles.index', compact('articles'));
    }

    public function memberShow($id)
    {
        $article = Article::with('doctor')->find($id);

        return view('member.articles.show', compact('article'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $article = new Article();
        $article->title = $request->get('title');
        $article->article = $request->get('article');
        $article->date_published = $request->get('date');
        $article->doctor_id = $request->get('doctor_id');
        $article->save();

        return redirect()->route('admin.articles.index')->with('success', 'Article created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $article->title = $request->get('title');
        $article->article = $request->get('article');
        $article->date_published = $request->get('date');
        $article->doctor_id = $request->get('doctor_id');
        $article->save();

        return redirect()->route('admin.articles.index')->with('success', 'Article updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $this->authorize('delete-permission', Auth::user());

        try {
            $article->delete();
            return redirect()->route('admin.articles.index')->with('success', 'Article deleted successfully.');
        } catch (\PDOException $ex) {
            $msg = "Make sure there is no related data before deleting it. Please contact Administrator to know more about it.";
            return redirect()->route('admin.articles.index')->with('status', $msg);
        }
    }

    public function getEditForm(Request $request)
    {
        $id = $request->id;
        $data = Article::find($id);
        $doctors = Doctor::all();
        return response()->json([
            'status' => 'oke',
            'msg' => view('admin.articles.getEditForm', compact('data', 'doctors'))->render()
        ], 200);
    }

    public function saveDataUpdate(Request $request)
    {
        $id = $request->id;
        $data = Article::find($id);
        $data->title = $request->title;
        $data->article = $request->article;
        $data->date_published = $request->date_published;
        $data->doctor_id = $request->doctor_id;
        $data->save();
        return response()->json(['status' => 'oke', 'msg' => 'Article data is up-to-date!'], 200);
    }

    public function deleteData(Request $request)
    {
        $this->authorize('delete-permission', Auth::user());

        $id = $request->id;
        $data = Article::find($id);

        try {
            $data->delete();
            return response()->json([
                'status' => 'oke',
                'msg' => 'Article <b>' . $data->title . '</b> berhasil dihapus!'
            ], 200);
        } catch (\PDOException $ex) {
            return response()->json([
                'status' => 'error',
                'msg' => 'Gagal menghapus! Pastikan tidak ada data terkait sebelum menghapus article ini.'
            ], 200);
        }
    }
}
