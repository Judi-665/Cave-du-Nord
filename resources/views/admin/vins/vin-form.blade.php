<div class="container mt-4">
    <h2>Gestion des Vins</h2>
    
    <!-- Formulaire d'ajout/modification -->
    <form id="vin-form" action="{{ route('vins.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_method" id="form-method" value="POST">
        <input type="hidden" name="id" id="vin-id">

        <div class="mb-3">
            <label for="vin-nom" class="form-label">Nom du vin <span class="text-danger">*</span></label>
            <input type="text" id="vin-nom" name="nom" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="vin-prix" class="form-label">Prix (FCFA) <span class="text-danger">*</span></label>
            <input type="number" id="vin-prix" name="prix" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="vin-description" class="form-label">Description <span class="text-danger">*</span></label>
            <textarea id="vin-description" name="description" class="form-control" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label for="vin-image" class="form-label">Image du vin <span class="text-danger">*</span></label>
            <input type="file" id="vin-image" name="image" class="form-control" accept="image/*">
            <small class="text-muted">Laissez vide pour conserver l'image actuelle lors de la modification</small>
        </div>

        <button type="submit" class="btn btn-success" id="submit-btn">Ajouter</button>
        <button type="button" class="btn btn-secondary" id="cancel-btn" style="display:none;">Annuler</button>
    </form>

    <hr class="my-4">

    <!-- Messages de succès/erreur -->
    <div id="message-container"></div>

    <!-- Tableau des vins -->
    <h3>Liste des Vins</h3>
    <table class="table table-striped mt-4" id="vin-table">
        <thead class="table-dark">
            <tr>
                <th>Image</th>
                <th>Nom du vin</th>
                <th>Prix (FCFA)</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($vins) && $vins->count() > 0)
                @foreach($vins as $vin)
                <tr data-id="{{ $vin->id }}">
                    <td>
                        <img src="{{ asset('storage/' . $vin->image) }}" alt="{{ $vin->nom }}" style="width: 50px; height: 50px; object-fit: cover;">
                    </td>
                    <td>{{ $vin->nom }}</td>
                    <td>{{ number_format($vin->prix, 0, ',', ' ') }}</td>
                    <td>{{ Str::limit($vin->description, 50) }}</td>
                    <td>
                        <button class="btn btn-sm btn-primary btn-edit" data-id="{{ $vin->id }}">Modifier</button>
                        <button class="btn btn-sm btn-danger btn-delete" data-id="{{ $vin->id }}">Supprimer</button>
                    </td>
                </tr>
                @endforeach
            @else
                <tr id="no-data-row">
                    <td colspan="5" class="text-center">Aucun vin ajouté</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('vin-form');
    const submitBtn = document.getElementById('submit-btn');
    const cancelBtn = document.getElementById('cancel-btn');
    const messageContainer = document.getElementById('message-container');
    const tbody = document.querySelector('#vin-table tbody');

    // Gestion de la soumission du formulaire
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(form);
        const vinId = document.getElementById('vin-id').value;
        const method = document.getElementById('form-method').value;
        
        let url = form.action;
        if (method === 'PUT') {
            url = `/admin/vins/${vinId}`;
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
                    addVinToTable(data.vin);
                } else {
                    updateVinInTable(data.vin);
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
        if (e.target.classList.contains('btn-edit')) {
            const vinId = e.target.dataset.id;
            
            fetch(`/admin/vins/${vinId}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('vin-id').value = data.id;
                    document.getElementById('vin-nom').value = data.nom;
                    document.getElementById('vin-prix').value = data.prix;
                    document.getElementById('vin-description').value = data.description;
                    document.getElementById('form-method').value = 'PUT';
                    document.getElementById('vin-image').required = false;
                    
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
        if (e.target.classList.contains('btn-delete')) {
            if (confirm('Êtes-vous sûr de vouloir supprimer ce vin ?')) {
                const vinId = e.target.dataset.id;
                
                fetch(`/admin/vins/${vinId}`, {
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
                        removeVinFromTable(vinId);
                    } else {
                        showMessage('danger', data.message);
                    }
                });
            }
        }
    });

    // Bouton Annuler
    cancelBtn.addEventListener('click', resetForm);

    function addVinToTable(vin) {
        const noDataRow = document.getElementById('no-data-row');
        if (noDataRow) noDataRow.remove();

        const tr = document.createElement('tr');
        tr.dataset.id = vin.id;
        tr.innerHTML = `
            <td><img src="/storage/${vin.image}" alt="${vin.nom}" style="width: 50px; height: 50px; object-fit: cover;"></td>
            <td>${vin.nom}</td>
            <td>${new Intl.NumberFormat('fr-FR').format(vin.prix)}</td>
            <td>${vin.description.substring(0, 50)}${vin.description.length > 50 ? '...' : ''}</td>
            <td>
                <button class="btn btn-sm btn-primary btn-edit" data-id="${vin.id}">Modifier</button>
                <button class="btn btn-sm btn-danger btn-delete" data-id="${vin.id}">Supprimer</button>
            </td>
        `;
        tbody.appendChild(tr);
    }

    function updateVinInTable(vin) {
        const tr = tbody.querySelector(`tr[data-id="${vin.id}"]`);
        if (tr) {
            tr.innerHTML = `
                <td><img src="/storage/${vin.image}" alt="${vin.nom}" style="width: 50px; height: 50px; object-fit: cover;"></td>
                <td>${vin.nom}</td>
                <td>${new Intl.NumberFormat('fr-FR').format(vin.prix)}</td>
                <td>${vin.description.substring(0, 50)}${vin.description.length > 50 ? '...' : ''}</td>
                <td>
                    <button class="btn btn-sm btn-primary btn-edit" data-id="${vin.id}">Modifier</button>
                    <button class="btn btn-sm btn-danger btn-delete" data-id="${vin.id}">Supprimer</button>
                </td>
            `;
        }
    }

    function removeVinFromTable(vinId) {
        const tr = tbody.querySelector(`tr[data-id="${vinId}"]`);
        if (tr) tr.remove();
        
        if (tbody.children.length === 0) {
            tbody.innerHTML = '<tr id="no-data-row"><td colspan="5" class="text-center">Aucun vin ajouté</td></tr>';
        }
    }

    function resetForm() {
        form.reset();
        document.getElementById('vin-id').value = '';
        document.getElementById('form-method').value = 'POST';
        document.getElementById('vin-image').required = true;
        
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