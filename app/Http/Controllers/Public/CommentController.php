<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Berita;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $slug)
    {
        $berita = Berita::where('slug', $slug)->published()->firstOrFail();

        $request->validate([
            'name' => 'required_if:user_id,null|max:100',
            'email' => 'required_if:user_id,null|email|max:100',
            'content' => 'required|min:5|max:1000',
        ]);

        $data = [
            'berita_id' => $berita->id,
            'content' => $request->content,
            'status' => 'approved',
        ];

        if (auth()->check()) {
            $data['user_id'] = auth()->id();
            $data['name'] = auth()->user()->name;
            $data['email'] = auth()->user()->email;
        } else {
            $data['name'] = $request->name;
            $data['email'] = $request->email;
        }

        Comment::create($data);

        return redirect()->route('berita.show', $berita->slug)->with('success', 'Komentar berhasil ditambahkan!');
    }
}
