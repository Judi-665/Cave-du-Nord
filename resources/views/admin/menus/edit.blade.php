@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier Menu</h1>
    <form action="{{ route('menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Plat</label>
            <input type="text" name="plat" class="form-control" value="{{ $menu->plat }}">
        </div>
        <div class="mb-3">
            <label>Prix</label>
            <input type="number" step="0.01" name="prix" class="form-control" value="{{ $menu->prix }}">
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ $menu->description }}</textarea>
        </div>
        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
            @if($menu->image)
                <img src="{{ asset('storage/'.$menu->image) }}" width="80" class="mt-2">
            @endif
        </div>
        <button class="btn btn-primary">Enregistrer</button>
    </form>
</div>
@endsection
