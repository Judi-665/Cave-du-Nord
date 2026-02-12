@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier Vin</h1>
    <form action="{{ route('vins.update', $vin->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Nom</label>
            <input type="text" name="nom" class="form-control" value="{{ $vin->nom }}">
        </div>
        <div class="mb-3">
            <label>Prix</label>
            <input type="number" step="0.01" name="prix" class="form-control" value="{{ $vin->prix }}">
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ $vin->description }}</textarea>
        </div>
        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
            @if($vin->image)
                <img src="{{ asset('storage/'.$vin->image) }}" width="80" class="mt-2">
            @endif
        </div>
        <button class="btn btn-primary">Enregistrer</button>
    </form>
</div>
@endsection
