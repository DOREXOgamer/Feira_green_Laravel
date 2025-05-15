@extends('layouts.app')

@section('content')
<div class="container produto-detalhes-container">
    <h1>{{ $produto->nome }}</h1>

    @if($produto->imagem)
        <img src="{{ asset('storage/product_images/' . $produto->imagem) }}" alt="Imagem do produto {{ $produto->nome }}" class="produto-imagem">
    @endif

    <p><strong>Preço:</strong> R$ {{ number_format($produto->preco, 2, ',', '.') }}</p>
    <p><strong>Categoria:</strong> {{ $produto->categoria }}</p>

    <a href="{{ route('home') }}" class="btn btn-secondary">Voltar para a lista de produtos</a>
</div>

<style>
.produto-detalhes-container {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
}

.produto-imagem {
    max-width: 100%;
    height: auto;
    margin-bottom: 20px;
}

.btn {
    padding: 10px 15px;
    border: none;
    cursor: pointer;
    background-color: #6c757d;
    color: white;
    text-decoration: none;
    display: inline-block;
    margin-top: 20px;
}

.btn:hover {
    background-color: #5a6268;
}
</style>
@endsection
