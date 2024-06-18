<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class PostsController extends Controller
{

    public function index () {
        $posts = Posts::all();
         return view("pages.posts", compact('posts'));
    }

    public function store (Request $request) {
        $validatedData = $request->validate([
            'judul' => 'required|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'body' => 'required'
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('images', 'public');
        }
        $userId = Auth::id();
        $validatedData['user_id'] = $userId;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 100);

        Posts::create($validatedData);
        return redirect()->route('posts')->with('success', 'Data Post berhasil ditambahkan.');

    }

    public function update(Request $request, $id)
{
    // Validate the request data
    $validatedData = $request->validate([
        'judul' => 'required|max:255',
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        'body' => 'required'
    ]);

    // Find the post by ID
    $post = Posts::findOrFail($id);

    // Check if an image is uploaded
    if ($request->file('image')) {
        // Store the new image and delete the old one if it exists
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }
        $validatedData['image'] = $request->file('image')->store('images', 'public');
    }

    // Update the post details
    $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 100);

    // Update the post in the database
    $post->update($validatedData);

    // Redirect with success message
    return redirect()->route('posts')->with('success', 'Data Post berhasil diperbarui.');
}
public function destroy($id)
{
    // Find the post by ID
    $post = Posts::findOrFail($id);

    // Delete the associated image file if it exists
    if ($post->image) {
        Storage::disk('public')->delete($post->image);
    }

    // Delete the post from the database
    $post->delete();

    // Redirect back with success message
    return redirect()->route('posts')->with('success', 'Data Post berhasil dihapus.');
}

}
