@extends('layouts.app')

@section('content')
<h2>Modifier le vin</h2>

<form action="{{ route('vins.update', $vin->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label>Nom</label>
        <input type="text" name="nom" class="form-control" value="{{ $vin->nom }}" required>
    </div>
    <div class="mb-3">
        <label>Catégorie</label>
        <input type="text" name="categorie" class="form-control" value="{{ $vin->categorie }}" required>
    </div>
    <div class="mb-3">
        <label>Prix</label>
        <input type="number" name="prix" class="form-control" value="{{ $vin->prix }}" step="0.01" required>
    </div>
    <div class="mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control">{{ $vin->description }}</textarea>
    </div>
    <div class="mb-3">
        <label>Image</label>
        <input type="file" name="image" class="form-control">
        @if($vin->image)
            <img src="{{ asset('storage/'.$vin->image) }}" width="100" class="mt-2">
        @endif
    </div>
    <button type="submit" class="btn btn-primary">Mettre à jour</button>
</form>
@endsection
