<?php

namespace App\Http\Controllers;

use App\Jobs\VeryLongJob;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')->latest()->paginate(6);
        $categories = Category::orderBy('name')->get();

        return view('posts.index', compact('posts', 'categories'));
    }

    public function create()
    {
        $this->authorize('create', Post::class);

        $categories = Category::orderBy('name')->get();

        return view('posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Post::class);

        $validated = $request->validate([
            'title' => 'required|min:5|max:255',
            'excerpt' => 'required|min:10|max:500',
            'content' => 'required|min:20',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        $post = Post::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title'] . '-' . time()),
            'excerpt' => $validated['excerpt'],
            'content' => $validated['content'],
            'category_id' => $validated['category_id'],
            'image' => $imagePath,
            'published_at' => now(),
        ]);

        VeryLongJob::dispatch($post);

        return redirect()->route('posts.index')->with('success', 'Новость создана. Уведомление поставлено в очередь.');
    }

    public function show(Post $post)
    {
        $post->load(['comments.user', 'category']);

        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        $categories = Category::orderBy('name')->get();

        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $validated = $request->validate([
            'title' => 'required|min:5|max:255',
            'excerpt' => 'required|min:10|max:500',
            'content' => 'required|min:20',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $imagePath = $post->image;

        if ($request->hasFile('image')) {
            if ($post->image && Storage::disk('public')->exists($post->image)) {
                Storage::disk('public')->delete($post->image);
            }

            $imagePath = $request->file('image')->store('posts', 'public');
        }

        $post->update([
            'title' => $validated['title'],
            'excerpt' => $validated['excerpt'],
            'content' => $validated['content'],
            'category_id' => $validated['category_id'],
            'image' => $imagePath,
        ]);

        return redirect()->route('posts.index')->with('success', 'Новость обновлена.');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        if ($post->image && Storage::disk('public')->exists($post->image)) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Новость удалена.');
    }

    public function search(Request $request)
    {
        $query = trim((string) $request->input('q'));

        $posts = Post::with('category')
            ->when($query !== '', function ($builder) use ($query) {
                $builder->where(function ($subQuery) use ($query) {
                    $subQuery->where('title', 'like', "%{$query}%")
                        ->orWhere('excerpt', 'like', "%{$query}%")
                        ->orWhere('content', 'like', "%{$query}%");
                });
            })
            ->latest()
            ->paginate(6)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();

        return view('posts.index', compact('posts', 'categories', 'query'));
    }

    public function byCategory(Category $category)
    {
        $posts = Post::with('category')
            ->where('category_id', $category->id)
            ->latest()
            ->paginate(6)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();

        return view('posts.index', compact('posts', 'categories', 'category'));
    }
}