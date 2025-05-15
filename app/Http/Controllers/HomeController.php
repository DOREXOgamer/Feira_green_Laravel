<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request; // Adicionei esta importação
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Exibe a página inicial
     */
   public function home()
    {
        $produtos = Produto::all() ?? []; // Garante que sempre será uma coleção
        
        $jsonPath = public_path('imagens/imagens.json');
        $imagens = []; // Valor padrão
        
        if (File::exists($jsonPath)) {
            $imagens = json_decode(File::get($jsonPath), true) ?? [];
        }

        return view('home', [
            'produtos' => $produtos,
            'imagens' => $imagens
        ]);
    }

    /**
     * Processa a busca de produtos
     */
    public function buscar(Request $request)
    {
        $termo = $request->input('termo', ''); // Valor padrão vazio
        
        $produtos = Produto::where('nome', 'LIKE', "%{$termo}%")
            ->get();

        return view('busca', compact('produtos', 'termo'));
    }

    /**
     * Área do painel administrativo
     */
    public function dashboard()
    {
        return view('dashboard');
    }

    /**
     * Exibe a página de perfil do usuário
     */
    public function perfil()
    {
        $user = Auth::user();
        return view('perfil', compact('user'));
    }

    /**
     * Atualiza o perfil do usuário (nome e imagem)
     */
    public function updatePerfil(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048', // max 2MB
        ]);

        $user->name = $request->input('name');

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($user->image) {
                Storage::delete('public/profile_images/' . $user->image);
            }
            $path = $request->file('image')->store('public/profile_images');
            $user->image = basename($path);
        }

        $user->save();

        return redirect()->route('perfil')->with('success', 'Perfil atualizado com sucesso!');
    }

    /**
     * Adiciona um novo produto
     */
    public function addProduto(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'preco' => 'required|numeric',
            'categoria' => 'required|string|max:255',
            'imagem' => 'nullable|image|max:2048',
        ]);

        $produto = new Produto();
        $produto->nome = $request->input('nome');
        $produto->preco = $request->input('preco');
        $produto->categoria = $request->input('categoria');

        if ($request->hasFile('imagem')) {
            $path = $request->file('imagem')->store('public/product_images');
            $produto->imagem = basename($path);
        }

        $produto->save();

        return redirect()->route('perfil')->with('success', 'Produto adicionado com sucesso!');
    }

    /**
     * Exibe os detalhes de um produto
     */
    public function showProduto($id)
    {
        $produto = Produto::findOrFail($id);
        return view('produto.show', compact('produto'));
    }
}
