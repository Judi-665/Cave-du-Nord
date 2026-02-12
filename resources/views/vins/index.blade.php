@extends('layouts.app')

@section('content')
<h2>Nos Vins</h2>
<a href="{{ route('vins.create') }}" class="btn btn-success mb-3">Ajouter un vin</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Image</th>
            <th>Nom</th>
            <th>Catégorie</th>
            <th>Prix</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($vins as $vin)
        <tr>
            <td>
                @if($vin->image)
                    <img src="{{ asset('storage/'.$vin->image) }}" width="80">
                @endif
            </td>
            <td>{{ $vin->nom }}</td>
            <td>{{ $vin->categorie }}</td>
            <td>{{ $vin->prix }} €</td>
            <td>{{ $vin->description }}</td>
            <td>
                <a href="{{ route('vins.edit', $vin->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                <form action="{{ route('vins.destroy', $vin->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce vin ?')">Supprimer</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
