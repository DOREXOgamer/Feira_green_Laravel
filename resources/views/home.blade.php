@extends('layouts.main')

@section('content')

<section id="home" class="d-flex">
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Carrossel de imagens --}}
    @isset($imagens)
        @include('partials.carousel', ['imagens' => $imagens])
    @else
        <div class="alert alert-warning">Nenhuma imagem disponível</div>
    @endisset
</section>

<div class="line"></div>

<section class="promocao-header">
    <span class="promocao-header--title">PROMOÇÕES</span>
    <span>Produtos</span>
</section>

<div class="container-principal">
    @forelse($produtos ?? [] as $produto)
        <div class='produto-container-principal'>
            <div class='produto-principal'>
                <a href="{{ route('produto.show', $produto->id) }}" aria-label="Ver detalhes do produto {{ $produto->nome }}">
                    <img src="{{ asset('storage/produtos/' . $produto->imagem) }}" 
                         alt="{{ $produto->nome }}" 
                         class="img-fluid" 
                         onerror="this.onerror=null; this.src='{{ asset('images/default-product.jpg') }}';" />
                </a>
                <span>{{ $produto->nome }}</span>
                <span>R$ <span class='price'>{{ number_format($produto->preco, 2, ',', '.') }}</span></span>
                <span class='unit'>{{ $produto->categoria }}</span>
            </div>
        </div>
    @empty
        <div class='produto-container-principal'>
            <p>Nenhum produto encontrado.</p>
        </div>
    @endforelse
</div>

@endsection