<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class PostsController extends Controller
{
    // show all posts
    public function index()
    {
        // dd(Posts::latest()->filter(request(['tag', 'search']))->paginate(10));
        return Inertia::render('Home', [
            'posts' => Posts::latest()->filter(request(['tag', 'search']))->paginate(6)
        ]);
    }

    // show single post
    public function show(Posts $post)
    {
        return Inertia::render('Show', [
            'post' => $post
        ]);
    }

    public function create(Request $request)
    {
        return Inertia::render('Create', [
            'postings' => Posts::latest()->filter(request(['tag', 'search']))->get()
        ]);
    }

    public function store(Request $request)
    {
        $formField = $request->validate([
            'company' => ['required', Rule::unique('posts', 'company')],
            'title' => 'required',
            'location' => 'required',
            'email' => ['required', 'email'],
            'website' => 'required',
            'tags' => 'required',
            'description' => 'required'
        ]);

        if ($request->hasFile('logo')) {
            $formField['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formField['user_id'] = auth()->id();

        Posts::create($formField);

        session()->flash('flash.banner', 'Post created!');
        return redirect('/posts/create',);
    }

    public function edit(Posts $postings)
    {
        return Inertia::render('Edit', ['listing' => $postings]);
    }

    public function update(Request $request, Posts $postings)
    {

        if ($postings->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $formField = $request->validate([
            'company' => ['required',],
            'title' => 'required',
            'location' => 'required',
            'email' => ['required', 'email'],
            'website' => 'required',
            'tags' => 'required',
            'description' => 'required'
        ]);

        if ($request->hasFile('logo')) {
            $formField['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formField['user_id'] = auth()->id();

        $postings->update($formField);

        return back()->with('message', 'Post updated successfully.');
    }

    public function delete(Posts $postings)
    {
        if ($postings->user_id != auth()->id()) {
            session()->flash('flash.banner', 'Unauthorized Action');
            session()->flash('flash.bannerStyle', 'danger');
            return abort(403, 'Unauthorized Action');
        }

        $postings->delete();
        session()->flash('flash.banner', 'Post deleted successfully.');
        return redirect('/', 201);
    }

    public function manage()
    {
        return Inertia::render('Manage', ['posts' => auth()->user()->postings]);
    }
}
