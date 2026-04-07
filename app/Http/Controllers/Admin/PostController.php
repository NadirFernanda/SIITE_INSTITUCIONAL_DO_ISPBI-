<?php
namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'conteudo' => 'nullable|string|max:65535',
            'imagem' => 'nullable|image|max:2048',
        ]);

        $imagemPath = null;
        if ($request->hasFile('imagem')) {
            $imagemPath = $request->file('imagem')->store('posts', 'public');
        }

        Post::create([
            'titulo' => $request->titulo,
            'conteudo' => $request->conteudo,
            'imagem' => $imagemPath,
        ]);
        return redirect('/admin/posts')->with('success', 'Post criado com sucesso!');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.posts-edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $request->validate([
            'titulo' => 'required|string|max:255',
            'conteudo' => 'nullable|string|max:65535',
            'imagem' => 'nullable|image|max:2048',
        ]);

        $data = [
            'titulo' => $request->titulo,
            'conteudo' => $request->conteudo,
        ];
        if ($request->hasFile('imagem')) {
            // Remove imagem antiga se existir
            if ($post->imagem) {
                \Storage::disk('public')->delete($post->imagem);
            }
            $data['imagem'] = $request->file('imagem')->store('posts', 'public');
        }
        $post->update($data);
        return redirect('/admin/posts')->with('success', 'Post atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if ($post->imagem) {
            \Storage::disk('public')->delete($post->imagem);
        }
        $post->delete();
        return redirect('/admin/posts')->with('success', 'Post excluído com sucesso!');
    }
}
