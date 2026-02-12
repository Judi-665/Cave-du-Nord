@extends('layouts.app')

@section('content')
<div class="container" x-data="menuApp()">
    <h1>Menus</h1>
    <button class="btn btn-success mb-3" @click="showAddModal = true">Ajouter Menu</button>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Plat</th>
                <th>Prix</th>
                <th>Description</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <template x-for="menu in menus" :key="menu.id">
                <tr>
                    <td x-text="menu.plat"></td>
                    <td x-text="menu.prix + ' €'"></td>
                    <td x-text="menu.description"></td>
                    <td>
                        <img :src="'/storage/' + menu.image" width="80" x-show="menu.image">
                    </td>
                    <td>
                        <a :href="'/admin/menus/' + menu.id + '/edit'" class="btn btn-primary btn-sm">Modifier</a>
                        <button class="btn btn-danger btn-sm" @click="deleteMenu(menu.id)">Supprimer</button>
                    </td>
                </tr>
            </template>
        </tbody>
    </table>

    <!-- Modal Ajouter -->
    <div x-show="showAddModal" class="modal-backdrop">
        <div class="modal-dialog">
            <div class="modal-content p-3">
                <h5>Ajouter Menu</h5>
                <form @submit.prevent="addMenu">
                    <input type="text" placeholder="Plat" x-model="newMenu.plat" class="form-control mb-2" required>
                    <input type="number" step="0.01" placeholder="Prix" x-model="newMenu.prix" class="form-control mb-2" required>
                    <textarea placeholder="Description" x-model="newMenu.description" class="form-control mb-2" required></textarea>
                    <input type="file" @change="handleFileUpload($event, 'newMenu')" class="form-control mb-2">
                    <button class="btn btn-success">Ajouter</button>
                    <button type="button" class="btn btn-secondary" @click="showAddModal=false">Annuler</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function menuApp() {
    return {
        menus: @json($menus),
        showAddModal: false,
        newMenu: {plat:'', prix:'', description:'', image:null},

        handleFileUpload(event, target) {
            this[target].image = event.target.files[0];
        },

        async addMenu() {
            let formData = new FormData();
            formData.append('plat', this.newMenu.plat);
            formData.append('prix', this.newMenu.prix);
            formData.append('description', this.newMenu.description);
            if(this.newMenu.image) formData.append('image', this.newMenu.image);
            formData.append('_token', '{{ csrf_token() }}');

            let response = await fetch("{{ route('menus.store') }}", {
                method: 'POST',
                body: formData
            });

            if(response.ok){
                let menu = await response.json();
                this.menus.push(menu);
                this.newMenu = {plat:'', prix:'', description:'', image:null};
                this.showAddModal=false;
            }
        },

        async deleteMenu(id){
            if(!confirm('Supprimer ce menu ?')) return;
            let formData = new FormData();
            formData.append('_token','{{ csrf_token() }}');
            formData.append('_method','DELETE');

            let response = await fetch(`/admin/menus/${id}`, {method:'POST', body:formData});
            if(response.ok) this.menus = this.menus.filter(m => m.id !== id);
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
