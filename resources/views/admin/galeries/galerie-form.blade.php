<div class="container mt-4">
    <h2>Gestion de la Galerie</h2>
    
    <!-- Formulaire d'ajout/modification -->
    <form id="galerie-form" action="{{ route('galeries.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_method" id="galerie-form-method" value="POST">
        <input type="hidden" name="id" id="galerie-id">

        <div class="mb-3">
            <label for="galerie-image" class="form-label">Image <span class="text-danger">*</span></label>
            <input type="file" id="galerie-image" name="image" class="form-control" accept="image/*">
            <small class="text-muted">Laissez vide pour conserver l'image actuelle lors de la modification</small>
        </div>

        <div class="mb-3">
            <label for="galerie-legende" class="form-label">Légende</label>
            <input type="text" id="galerie-legende" name="legende" class="form-control" placeholder="Description de l'image (optionnel)">
        </div>

        <button type="submit" class="btn btn-success" id="galerie-submit-btn">Ajouter</button>
        <button type="button" class="btn btn-secondary" id="galerie-cancel-btn" style="display:none;">Annuler</button>
    </form>

    <hr class="my-4">

    <!-- Messages de succès/erreur -->
    <div id="galerie-message-container"></div>

    <!-- Galerie d'images -->
    <h3>Images de la Galerie</h3>
    <div class="row mt-4" id="galerie-grid">
        @if(isset($galeries) && $galeries->count() > 0)
            @foreach($galeries as $galerie)
            <div class="col-md-3 mb-4" data-id="{{ $galerie->id }}">
                <div class="card h-100">
                    <img src="{{ asset('storage/' . $galerie->image) }}" class="card-img-top" alt="{{ $galerie->legende ?? 'Image' }}" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <p class="card-text small">{{ $galerie->legende ?? 'Pas de légende' }}</p>
                        <div class="d-flex gap-2">
                            <button class="btn btn-sm btn-primary galerie-btn-edit flex-fill" data-id="{{ $galerie->id }}">Modifier</button>
                            <button class="btn btn-sm btn-danger galerie-btn-delete flex-fill" data-id="{{ $galerie->id }}">Supprimer</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <div class="col-12" id="galerie-no-data">
                <p class="text-center text-muted">Aucune image dans la galerie</p>
            </div>
        @endif
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('galerie-form');
    const submitBtn = document.getElementById('galerie-submit-btn');
    const cancelBtn = document.getElementById('galerie-cancel-btn');
    const messageContainer = document.getElementById('galerie-message-container');
    const galerieGrid = document.getElementById('galerie-grid');

    // Gestion de la soumission du formulaire
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(form);
        const galerieId = document.getElementById('galerie-id').value;
        const method = document.getElementById('galerie-form-method').value;
        
        let url = form.action;
        if (method === 'PUT') {
            url = `/admin/galeries/${galerieId}`;
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
                    addGalerieToGrid(data.galerie);
                } else {
                    updateGalerieInGrid(data.galerie);
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
    galerieGrid.addEventListener('click', function(e) {
        if (e.target.classList.contains('galerie-btn-edit')) {
            const galerieId = e.target.dataset.id;
            
            fetch(`/admin/galeries/${galerieId}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('galerie-id').value = data.id;
                    document.getElementById('galerie-legende').value = data.legende || '';
                    document.getElementById('galerie-form-method').value = 'PUT';
                    document.getElementById('galerie-image').required = false;
                    
                    submitBtn.textContent = 'Mettre à jour';
                    submitBtn.classList.remove('btn-success');
                    submitBtn.classList.add('btn-warning');
                    cancelBtn.style.display = 'inline-block';
                    
                    form.scrollIntoView({ behavior: 'smooth' });
                });
        }
    });

    // Bouton Supprimer
    galerieGrid.addEventListener('click', function(e) {
        if (e.target.classList.contains('galerie-btn-delete')) {
            if (confirm('Êtes-vous sûr de vouloir supprimer cette image ?')) {
                const galerieId = e.target.dataset.id;
                
                fetch(`/admin/galeries/${galerieId}`, {
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
                        removeGalerieFromGrid(galerieId);
                    } else {
                        showMessage('danger', data.message);
                    }
                });
            }
        }
    });

    // Bouton Annuler
    cancelBtn.addEventListener('click', resetForm);

    function addGalerieToGrid(galerie) {
        const noData = document.getElementById('galerie-no-data');
        if (noData) noData.remove();

        const col = document.createElement('div');
        col.className = 'col-md-3 mb-4';
        col.dataset.id = galerie.id;
        col.innerHTML = `
            <div class="card h-100">
                <img src="/storage/${galerie.image}" class="card-img-top" alt="${galerie.legende || 'Image'}" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <p class="card-text small">${galerie.legende || 'Pas de légende'}</p>
                    <div class="d-flex gap-2">
                        <button class="btn btn-sm btn-primary galerie-btn-edit flex-fill" data-id="${galerie.id}">Modifier</button>
                        <button class="btn btn-sm btn-danger galerie-btn-delete flex-fill" data-id="${galerie.id}">Supprimer</button>
                    </div>
                </div>
            </div>
        `;
        galerieGrid.appendChild(col);
    }

    function updateGalerieInGrid(galerie) {
        const col = galerieGrid.querySelector(`[data-id="${galerie.id}"]`);
        if (col) {
            col.innerHTML = `
                <div class="card h-100">
                    <img src="/storage/${galerie.image}" class="card-img-top" alt="${galerie.legende || 'Image'}" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <p class="card-text small">${galerie.legende || 'Pas de légende'}</p>
                        <div class="d-flex gap-2">
                            <button class="btn btn-sm btn-primary galerie-btn-edit flex-fill" data-id="${galerie.id}">Modifier</button>
                            <button class="btn btn-sm btn-danger galerie-btn-delete flex-fill" data-id="${galerie.id}">Supprimer</button>
                        </div>
                    </div>
                </div>
            `;
        }
    }

    function removeGalerieFromGrid(galerieId) {
        const col = galerieGrid.querySelector(`[data-id="${galerieId}"]`);
        if (col) col.remove();
        
        if (galerieGrid.children.length === 0) {
            galerieGrid.innerHTML = '<div class="col-12" id="galerie-no-data"><p class="text-center text-muted">Aucune image dans la galerie</p></div>';
        }
    }

    function resetForm() {
        form.reset();
        document.getElementById('galerie-id').value = '';
        document.getElementById('galerie-form-method').value = 'POST';
        document.getElementById('galerie-image').required = true;
        
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