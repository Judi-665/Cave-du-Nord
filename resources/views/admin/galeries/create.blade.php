@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ajouter Photo</h1>
    <form action="{{ route('galeries.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Photo</label>
            <input type="file" name="photo" class="form-control">
        </div>
        <button class="btn btn-success">Ajouter</button>
    </form>
</div>
@endsection
