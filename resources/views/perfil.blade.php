@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="{{ asset('css/perfil_custom.css') }}">
@endsection

@section('content')
<div class="container perfil-container">
    <h1 class="mb-4">Perfil do Usuário</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="perfil-section mb-5 p-4 border rounded shadow-sm bg-light">
        <h2 class="mb-3">Informações do Perfil</h2>
        <form action="{{ route('perfil.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
                <label for="name" class="form-label">Nome:</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required class="form-control">
                @error('name')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="image" class="form-label">Imagem de Perfil:</label><br>
                @if($user->image)
                    <img src="{{ asset('storage/profile_images/' . $user->image) }}" alt="Imagem de Perfil" class="profile-image-preview rounded mb-3">
                @else
                    <p>Sem imagem de perfil.</p>
                @endif
                <input type="file" id="image" name="image" accept="image/*" class="form-control">
                @error('image')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Atualizar Perfil</button>
        </form>
    </div>

    <hr>

    <div class="produto-section mb-5 p-4 border rounded shadow-sm bg-light">
        <h2 class="mb-3">Adicionar Produto</h2>
        <form action="{{ route('produto.add') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
                <label for="nome" class="form-label">Nome do Produto:</label>
                <input type="text" id="nome" name="nome" value="{{ old('nome') }}" required class="form-control">
                @error('nome')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="preco" class="form-label">Preço:</label>
                <input type="number" step="0.01" id="preco" name="preco" value="{{ old('preco') }}" required class="form-control">
                @error('preco')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="categoria" class="form-label">Categoria:</label>
                <input type="text" id="categoria" name="categoria" value="{{ old('categoria') }}" required class="form-control">
                @error('categoria')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="imagem" class="form-label">Imagem do Produto:</label>
                <input type="file" id="imagem" name="imagem" accept="image/*" class="form-control">
                @error('imagem')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Adicionar Produto</button>
        </form>
    </div>

    <hr>

    <div class="logout-section text-center">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger px-5">Sair</button>
        </form>
    </div>
</div>
@endsection
