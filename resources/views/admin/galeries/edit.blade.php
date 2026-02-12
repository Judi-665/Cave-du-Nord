@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier Photo</h1>
    <form action="{{ route('galeries.update', $galerie->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Photo</label>
            <input type="file" name="photo" class="form-control">
            @if($galerie->photo)
                <img src="{{ asset('storage/'.$galerie->photo) }}" width="150" class="mt-2">
            @endif
        </div>
        <button class="btn btn-primary">Enregistrer</button>
    </form>
</div>
@endsection
