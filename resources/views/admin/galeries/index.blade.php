@extends('layouts.app')

@section('content')
<div class="container" x-data="galerieApp()">
    <h1>Galerie</h1>
    <button class="btn btn-success mb-3" @click="showAddModal=true">Ajouter Photo</button>

    <div class="row">
        <template x-for="photo in galeries" :key="photo.id">
            <div class="col-md-3 mb-3">
                <div class="card">
                    <img :src="'/storage/' + photo.photo" class="card-img-top" style="height:150px; object-fit:cover;">
                    <div class="card-body text-center">
                        <button class="btn btn-danger btn-sm" @click="deletePhoto(photo.id)">Supprimer</button>
                        <a :href="'/admin/galeries/' + photo.id + '/edit'" class="btn btn-primary btn-sm mt-1">Modifier</a>
                    </div>
                </div>
            </div>
        </template>
    </div>

    <!-- Modal Ajouter -->
    <div x-show="showAddModal" class="modal-backdrop">
        <div class="modal-dialog">
            <div class="modal-content p-3">
                <h5>Ajouter Photo</h5>
                <form @submit.prevent="addPhoto">
                    <input type="file" @change="handleFileUpload($event,'newPhoto')" class="form-control mb-2" required>
                    <button class="btn btn-success">Ajouter</button>
                    <button type="button" class="btn btn-secondary" @click="showAddModal=false">Annuler</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function galerieApp() {
    return {
        galeries: @json($galeries),
        showAddModal:false,
        newPhoto:null,

        handleFileUpload(event, target) {
            this[target] = event.target.files[0];
        },

        async addPhoto() {
            let formData = new FormData();
            formData.append('photo', this.newPhoto);
            formData.append('_token', '{{ csrf_token() }}');

            let response = await fetch("{{ route('galeries.store') }}", {method:'POST', body:formData});
            if(response.ok){
                let photo = await response.json();
                this.galeries.push(photo);
                this.newPhoto=null;
                this.showAddModal=false;
            }
        },

        async deletePhoto(id){
            if(!confirm('Supprimer cette photo ?')) return;
            let formData = new FormData();
            formData.append('_token','{{ csrf_token() }}');
            formData.append('_method','DELETE');

            let response = await fetch(`/admin/galeries/${id}`, {method:'POST', body:formData});
            if(response.ok) this.galeries = this.galeries.filter(p=>p.id!==id);
        }
    }
}
</script>

<style>
.modal-backdrop {
    position: fixed; top:0; left:0; right:0; bottom:0;
    background: rgba(0,0,0,0.5);
    display:flex; justify-content:center; align-items:center;
}
</style>
@endsection
