@extends('layouts.app')

@section('content')
<h2>Ajouter un vin</h2>

<form action="{{ route('vins.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label>Nom</label>
        <input type="text" name="nom" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Catégorie</label>
        <input type="text" name="categorie" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Prix</label>
        <input type="number" name="prix" class="form-control" step="0.01" required>
    </div>
    <div class="mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control"></textarea>
    </div>
    <div class="mb-3">
        <label>Image</label>
        <input type="file" name="image" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Ajouter</button>
</form>
@endsection
