<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cave du Nord | Tableau de bord</title>

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .sidebar-btn {
            background-color: #8B1C1C;
            color: white;
            border-radius: 12px;
            font-weight: bold;
            transition: 0.3s;
        }
        .sidebar-btn:hover, .sidebar-btn.active {
            background-color: #FFD700;
            color: #6f1d1b;
        }
        .sidebar {
            background-color: white;
            min-height: 100vh;
            padding: 20px;
        }
        .logo {
            max-height: 200px;
            margin-bottom: 50px;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">

        <!-- Sidebar -->
        <aside class="col-md-2 sidebar d-flex flex-column justify-content-between">
            <div>
                <img src="{{ asset('images/logo-cave-du-nord.png') }}" alt="Logo" class="img-fluid logo">

                <div class="d-grid gap-3">
                    <button class="btn sidebar-btn switch-btn active" data-target="vins">Vins</button>
                    <button class="btn sidebar-btn switch-btn" data-target="menus">Menus</button>
                    <button class="btn sidebar-btn switch-btn" data-target="galeries">Galerie</button>
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-warning w-100 mt-3"> Déconnexion</button>
            </form>
        </aside>

        <!-- Contenu principal -->
        <main class="col-md-10 p-4 bg-light min-vh-100">
            @yield('content')
        </main>

    </div>
</div>

<!-- Script pour afficher les sections dynamiquement -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const buttons = document.querySelectorAll('.switch-btn');
        const sections = document.querySelectorAll('.content-section');

        // Affiche Vins par défaut
        sections.forEach(sec => sec.style.display = 'none');
        const defaultSection = document.getElementById('vins');
        if(defaultSection) defaultSection.style.display = 'block';

        buttons.forEach(btn => {
            btn.addEventListener('click', () => {
                // Déco tous les boutons
                buttons.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');

                // Masque toutes les sections
                sections.forEach(sec => sec.style.display = 'none');

                // Affiche la section correspondante
                const target = btn.getAttribute('data-target');
                const section = document.getElementById(target);
                if(section) section.style.display = 'block';
            });
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Sélecteur pour tous les formulaires AJAX
    const forms = document.querySelectorAll('.ajax-form');

    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const tableId = this.getAttribute('data-table');
            const tableBody = document.querySelector(`#${tableId} tbody`);

            fetch(this.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if(data.success){
                    let row = document.createElement('tr');
                    // Différencier le contenu selon le formulaire
                    if(tableId === 'vin-table'){
                        row.innerHTML = `
                            <td>${data.vin.nom}</td>
                            <td>${data.vin.prix}</td>
                            <td>${data.vin.description}</td>
                            <td><img src="${data.vin.image_url}" width="50" height="50" /></td>
                        `;
                    } else if(tableId === 'menu-table'){
                        row.innerHTML = `
                            <td>${data.menu.name}</td>
                            <td>${data.menu.price}</td>
                            <td>${data.menu.description}</td>
                            <td><img src="${data.menu.image_url}" width="50" height="50" /></td>
                        `;
                    } else if(tableId === 'galerie-table'){
                        row.innerHTML = `
                            <td>${data.galerie.name}</td>
                            <td>${data.galerie.description}</td>
                            <td><img src="${data.galerie.image_url}" width="50" height="50" /></td>
                        `;
                    }
                    tableBody.appendChild(row);
                    this.reset();
                } else {
                    alert('Erreur lors de l’ajout.');
                }
            })
            .catch(err => {
                console.error('Erreur AJAX:', err);
                alert('Une erreur est survenue lors de l’ajout.');
            });
        });
    });
});
</script>

</body>
</html>
