<div class="container mt-4">
    <h2>Gestion des Menus</h2>
    
    <!-- Formulaire d'ajout/modification -->
    <form id="menu-form" action="{{ route('menus.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_method" id="menu-form-method" value="POST">
        <input type="hidden" name="id" id="menu-id">

        <div class="mb-3">
            <label for="menu-nom" class="form-label">Nom du plat <span class="text-danger">*</span></label>
            <input type="text" id="menu-nom" name="nom" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="menu-type" class="form-label">Type <span class="text-danger">*</span></label>
            <select id="menu-type" name="type" class="form-control" required>
                <option value="">Sélectionnez un type</option>
                <option value="Entrée">Entrée</option>
                <option value="Plat principal">Plat principal</option>
                <option value="Dessert">Dessert</option>
                <option value="Boisson">Boisson</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="menu-prix" class="form-label">Prix (FCFA) <span class="text-danger">*</span></label>
            <input type="number" id="menu-prix" name="prix" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="menu-description" class="form-label">Description <span class="text-danger">*</span></label>
            <textarea id="menu-description" name="description" class="form-control" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label for="menu-image" class="form-label">Image du plat <span class="text-danger">*</span></label>
            <input type="file" id="menu-image" name="image" class="form-control" accept="image/*">
            <small class="text-muted">Laissez vide pour conserver l'image actuelle lors de la modification</small>
        </div>

        <button type="submit" class="btn btn-success" id="menu-submit-btn">Ajouter</button>
        <button type="button" class="btn btn-secondary" id="menu-cancel-btn" style="display:none;">Annuler</button>
    </form>

    <hr class="my-4">

    <!-- Messages de succès/erreur -->
    <div id="menu-message-container"></div>

    <!-- Tableau des menus -->
    <h3>Liste des Menus</h3>
    <table class="table table-striped mt-4" id="menu-table">
        <thead class="table-dark">
            <tr>
                <th>Image</th>
                <th>Nom du plat</th>
                <th>Prix (FCFA)</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($menus) && $menus->count() > 0)
                @foreach($menus as $menu)
                <tr data-id="{{ $menu->id }}">
                    <td>
                        <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->nom }}" style="width: 50px; height: 50px; object-fit: cover;">
                    </td>
                    <td>{{ $menu->nom }}</td>
                    <td>{{ number_format($menu->prix, 0, ',', ' ') }}</td>
                    <td>{{ Str::limit($menu->description, 50) }}</td>
                    <td>
                        <button class="btn btn-sm btn-primary menu-btn-edit" data-id="{{ $menu->id }}">Modifier</button>
                        <button class="btn btn-sm btn-danger menu-btn-delete" data-id="{{ $menu->id }}">Supprimer</button>
                    </td>
                </tr>
                @endforeach
            @else
                <tr id="menu-no-data-row">
                    <td colspan="5" class="text-center">Aucun menu ajouté</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('menu-form');
    const submitBtn = document.getElementById('menu-submit-btn');
    const cancelBtn = document.getElementById('menu-cancel-btn');
    const messageContainer = document.getElementById('menu-message-container');
    const tbody = document.querySelector('#menu-table tbody');

    // Gestion de la soumission du formulaire
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(form);
        const menuId = document.getElementById('menu-id').value;
        const method = document.getElementById('menu-form-method').value;
        
        let url = form.action;
        if (method === 'PUT') {
            url = `/admin/menus/${menuId}`;
            formData.append('_method', 'PUT');
        }

        fetch(url, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showMessage('success', data.message);
                
                if (method === 'POST') {
                    addMenuToTable(data.menu);
                } else {
                    updateMenuInTable(data.menu);
                }
                
                resetForm();
            } else {
                showMessage('danger', data.message || 'Une erreur est survenue');
            }
        })
        .catch(error => {
            showMessage('danger', 'Erreur lors de la requête');
            console.error(error);
        });
    });

    // Bouton Modifier
    tbody.addEventListener('click', function(e) {
        if (e.target.classList.contains('menu-btn-edit')) {
            const menuId = e.target.dataset.id;
            
            fetch(`/admin/menus/${menuId}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('menu-id').value = data.id;
                    document.getElementById('menu-nom').value = data.nom;
                    document.getElementById('menu-type').value = data.type || '';
                    document.getElementById('menu-prix').value = data.prix;
                    document.getElementById('menu-description').value = data.description;
                    document.getElementById('menu-form-method').value = 'PUT';
                    document.getElementById('menu-image').required = false;
                    
                    submitBtn.textContent = 'Mettre à jour';
                    submitBtn.classList.remove('btn-success');
                    submitBtn.classList.add('btn-warning');
                    cancelBtn.style.display = 'inline-block';
                    
                    form.scrollIntoView({ behavior: 'smooth' });
                });
        }
    });

    // Bouton Supprimer
    tbody.addEventListener('click', function(e) {
        if (e.target.classList.contains('menu-btn-delete')) {
            if (confirm('Êtes-vous sûr de vouloir supprimer ce menu ?')) {
                const menuId = e.target.dataset.id;
                
                fetch(`/admin/menus/${menuId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showMessage('success', data.message);
                        removeMenuFromTable(menuId);
                    } else {
                        showMessage('danger', data.message);
                    }
                });
            }
        }
    });

    // Bouton Annuler
    cancelBtn.addEventListener('click', resetForm);

    function addMenuToTable(menu) {
        const noDataRow = document.getElementById('menu-no-data-row');
        if (noDataRow) noDataRow.remove();

        const tr = document.createElement('tr');
        tr.dataset.id = menu.id;
        tr.innerHTML = `
            <td><img src="/storage/${menu.image}" alt="${menu.nom}" style="width: 50px; height: 50px; object-fit: cover;"></td>
            <td>${menu.nom}</td>
            <td>${new Intl.NumberFormat('fr-FR').format(menu.prix)}</td>
            <td>${menu.description.substring(0, 50)}${menu.description.length > 50 ? '...' : ''}</td>
            <td>
                <button class="btn btn-sm btn-primary menu-btn-edit" data-id="${menu.id}">Modifier</button>
                <button class="btn btn-sm btn-danger menu-btn-delete" data-id="${menu.id}">Supprimer</button>
            </td>
        `;
        tbody.appendChild(tr);
    }

    function updateMenuInTable(menu) {
        const tr = tbody.querySelector(`tr[data-id="${menu.id}"]`);
        if (tr) {
            tr.innerHTML = `
                <td><img src="/storage/${menu.image}" alt="${menu.nom}" style="width: 50px; height: 50px; object-fit: cover;"></td>
                <td>${menu.nom}</td>
                <td>${new Intl.NumberFormat('fr-FR').format(menu.prix)}</td>
                <td>${menu.description.substring(0, 50)}${menu.description.length > 50 ? '...' : ''}</td>
                <td>
                    <button class="btn btn-sm btn-primary menu-btn-edit" data-id="${menu.id}">Modifier</button>
                    <button class="btn btn-sm btn-danger menu-btn-delete" data-id="${menu.id}">Supprimer</button>
                </td>
            `;
        }
    }

    function removeMenuFromTable(menuId) {
        const tr = tbody.querySelector(`tr[data-id="${menuId}"]`);
        if (tr) tr.remove();
        
        if (tbody.children.length === 0) {
            tbody.innerHTML = '<tr id="menu-no-data-row"><td colspan="5" class="text-center">Aucun menu ajouté</td></tr>';
        }
    }

    function resetForm() {
        form.reset();
        document.getElementById('menu-id').value = '';
        document.getElementById('menu-form-method').value = 'POST';
        document.getElementById('menu-image').required = true;
        
        submitBtn.textContent = 'Ajouter';
        submitBtn.classList.remove('btn-warning');
        submitBtn.classList.add('btn-success');
        cancelBtn.style.display = 'none';
    }

    function showMessage(type, message) {
        messageContainer.innerHTML = `
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;
        
        setTimeout(() => {
            messageContainer.innerHTML = '';
        }, 5000);
    }
});
</script>