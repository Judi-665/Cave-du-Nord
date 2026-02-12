@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ajouter Menu</h1>
    <form action="{{ route('menus.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Plat</label>
            <input type="text" name="plat" class="form-control">
        </div>
        <div class="mb-3">
            <label>Prix</label>
            <input type="number" step="0.01" name="prix" class="form-control">
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
        </div>
        <button class="btn btn-success">Ajouter</button>
    </form>
</div>
@endsection
