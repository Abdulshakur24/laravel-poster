<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class PostsController extends Controller
{
    public function index()
    {
        return Inertia::render('Home', [
            'posts' => Posts::latest()->filter(request(['tag', 'search']))->paginate(6)
        ]);
    }

    public function show(Posts $post)
    {
        return Inertia::render('Show', [
            'post' => $post
        ]);
    }

    public function create()
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
        return redirect('/',);
    }

    public function edit(Posts $post)
    {
        return Inertia::render('Edit', ['post' => $post]);
    }

    public function update(Request $request, Posts $post)
    {

        if ($post->user_id != auth()->id()) {
            session()->flash('flash.banner', 'Unauthorized Action');
            session()->flash('flash.bannerStyle', 'danger');
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

        $post->update($formField);

        session()->flash('flash.banner', 'Post successfully updated.');
        return back();
    }

    public function delete(Posts $post)
    {
        if ($post->user_id != auth()->id()) {
            session()->flash('flash.banner', 'Unauthorized Action');
            session()->flash('flash.bannerStyle', 'danger');
            return abort(403, 'Unauthorized Action');
        }

        $post->delete();
        session()->flash('flash.banner', 'Post deleted successfully.');
        return redirect('/',);
    }

    public function manage()
    {
        return Inertia::render('Manage', ['posts' => auth()->user()->postings]);
    }
}
