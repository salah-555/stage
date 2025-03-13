@extends('layouts.app')

@section('content')

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Client</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
    background-size: cover;
    position: relative;
}

/* Overlay et flou pour améliorer la lisibilité */
body::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.4);
    backdrop-filter: blur(6px);
    z-index: 0;
}

/* Conteneur principal */
.form-container {
    position: relative;
    z-index: 1;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    padding: 30px;
}

/* Formulaire plus large */
.form-card {
    width: 600px;  /* Augmenté à 600px */
    background: rgba(255, 255, 255, 0.95);
    padding: 40px;
    border-radius: 15px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
    animation: fadeIn 1s ease-in-out;
}

/* Animation du formulaire */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Titre du formulaire */
.card-header {
    text-align: center;
    font-size: 2rem;
    font-weight: bold;
    color: #007bff;
    margin-bottom: 25px;
}

/* Champs du formulaire */
.form-control {
    border-radius: 8px;
    border: 1px solid #ddd;
    padding: 16px;
    font-size: 1.1rem;
    transition: all 0.3s ease-in-out;
}

.form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
}

/* Bouton de connexion stylé */
.btn-primary {
    background: linear-gradient(135deg, #007bff, #00d4ff);
    border: none;
    border-radius: 10px;
    padding: 16px;
    font-size: 1.3rem;
    font-weight: bold;
    transition: all 0.3s ease-in-out;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #0056b3, #00a2d4);
    transform: scale(1.05);
}

/* Lien d'inscription */
.text-center a {
    color: #007bff;
    font-weight: bold;
    font-size: 1.1rem;
    text-decoration: none;
    transition: color 0.3s ease;
}

.text-center a:hover {
    color: #0056b3;
}

/* Responsive */
@media (max-width: 768px) {
    .form-card {
        width: 90%;
        padding: 30px;
    }
}
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card p-4" style="width: 800px; hight: 800px;">
            <h3 class="text-center">Connexion</h3>
            @if($errors->any())
                <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif
            <form action="{{ route('client.login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Se connecter</button>
                <p class="text-center mt-3">Pas encore inscrit ? <a href="{{ route('client.register') }}">Créer un compte</a></p>
            </form>
        </div>
    </div>
</body>
</html>



@endsection