@extends('layouts.app')

@section('content')
<div x-data="vinApp()">
    <h1>Vins</h1>
    <button class="btn btn-success mb-3" @click="openAddModal()">Ajouter Vin</button>

    <!-- Tableau des vins -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prix</th>
                <th>Description</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <template x-for="vin in vins" :key="vin.id">
                <tr>
                    <td x-text="vin.nom"></td>
                    <td x-text="vin.prix + ' FCFA'"></td>
                    <td x-text="vin.description"></td>
                    <td>
                        <img :src="vin.image_url" width="80" x-show="vin.image_url">
                    </td>
                    <td>
                        <button class="btn btn-primary btn-sm" @click="openEditModal(vin)">Modifier</button>
                        <button class="btn btn-danger btn-sm" @click="deleteVin(vin.id)">Supprimer</button>
                    </td>
                </tr>
            </template>
        </tbody>
    </table>

    <!-- Modal Ajouter / Modifier -->
    <div x-show="showModal" class="modal-backdrop">
        <div class="modal-dialog">
            <div class="modal-content p-3">
                <h5 x-text="isEdit ? 'Modifier Vin' : 'Ajouter Vin'"></h5>
                <form @submit.prevent="isEdit ? updateVin() : addVin()">
                    <input type="text" placeholder="Nom" x-model="formVin.nom" class="form-control mb-2" required>
                    <input type="number" step="0.01" placeholder="Prix" x-model="formVin.prix" class="form-control mb-2" required>
                    <textarea placeholder="Description" x-model="formVin.description" class="form-control mb-2" required></textarea>
                    <input type="file" @change="handleFileUpload($event)" class="form-control mb-2">
                    <button class="btn btn-success" type="submit" x-text="isEdit ? 'Modifier' : 'Ajouter'"></button>
                    <button type="button" class="btn btn-secondary" @click="closeModal()">Annuler</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function vinApp() {
    return {
        vins: @json($vins),
        showModal: false,
        isEdit: false,
        formVin: {id:null, nom:'', prix:'', description:'', image:null},

        handleFileUpload(event) {
            this.formVin.image = event.target.files[0];
        },

        openAddModal() {
            this.isEdit = false;
            this.formVin = {id:null, nom:'', prix:'', description:'', image:null};
            this.showModal = true;
        },

        openEditModal(vin) {
            this.isEdit = true;
            this.formVin = {...vin, image:null};
            this.showModal = true;
        },

        closeModal() {
            this.showModal = false;
        },

        addVin() {
            let formData = new FormData();
            formData.append('nom', this.formVin.nom);
            formData.append('prix', this.formVin.prix);
            formData.append('description', this.formVin.description);
            if (this.formVin.image) formData.append('image', this.formVin.image);
            formData.append('_token', '{{ csrf_token() }}');

            fetch("{{ route('vins.store') }}", {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    this.vins.push(data.vin);
                    this.closeModal();
                }
            });
        },

        updateVin() {
            let formData = new FormData();
            formData.append('nom', this.formVin.nom);
            formData.append('prix', this.formVin.prix);
            formData.append('description', this.formVin.description);
            if (this.formVin.image) formData.append('image', this.formVin.image);
            formData.append('_method', 'PUT');
            formData.append('_token', '{{ csrf_token() }}');

            fetch(`/admin/vins/${this.formVin.id}`, {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    const index = this.vins.findIndex(v => v.id === data.vin.id);
                    if (index !== -1) this.vins[index] = data.vin;
                    this.closeModal();
                }
            });
        },

        deleteVin(id) {
            if (!confirm('Supprimer ?')) return;

            let formData = new FormData();
            formData.append('_method', 'DELETE');
            formData.append('_token', '{{ csrf_token() }}');

            fetch(`/admin/vins/${id}`, {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    this.vins = this.vins.filter(v => v.id !== id);
                }
            });
        }
    }
}
</script>

<style>
.modal-backdrop {
    position: fixed; top:0; left:0; right:0; bottom:0;
    background: rgba(0,0,0,0.5);
    display: flex; justify-content: center; align-items: center;
}
</style>
@endsection
