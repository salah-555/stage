@extends('layouts.app')

@section('content')

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription Client</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    
    <style>
        /* Arrière-plan moderne avec image et overlay */
        body {
            /* background: url('https://source.unsplash.com/1600x900/?shopping,ecommerce') no-repeat center center fixed; */
            background-color: #598eff00;
            background-size: cover;
            position: relative;
        }
        
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(5px);
            z-index: 0;
        }

        /* Conteneur du formulaire */
        .form-container {
            position: relative;
            z-index: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 30px;
        }

        .form-card {
            width: 990px;
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
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

        /* Titre */
        .card-header {
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 20px;
        }

        /* Champs avec icônes */
        .input-group-text {
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 8px 0 0 8px;
        }

        .form-control {
            border-radius: 0 8px 8px 0;
            border: 1px solid #ddd;
            padding: 12px;
            transition: all 0.3s ease-in-out;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
        }

        /* Bouton d'inscription */
        .btn-primary {
            background: linear-gradient(135deg, #007bff, #00d4ff);
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-size: 1.2rem;
            font-weight: bold;
            transition: all 0.3s ease-in-out;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #0056b3, #00a2d4);
            transform: scale(1.05);
        }

        /* Lien de connexion */
        .text-center a {
            color: #007bff;
            font-weight: bold;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .text-center a:hover {
            color: #0056b3;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .form-container {
                justify-content: center;
            }
            .form-card {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <div class="form-card">
            <div class="card-header">
                Inscription
            </div>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form action="{{ route('client.register') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nom</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="prenom" class="form-label">Prénom</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                            <input type="text" class="form-control" name="prenom" required>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="password" class="form-label">Mot de passe</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-lock"></i></span>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="password_confirmation" class="form-label">Confirmer</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-lock"></i></span>
                            <input type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary w-100">S'inscrire</button>
                </div>
                <div class="text-center">
                    <p>Déjà inscrit ? <a href="{{ route('client.login') }}">Connexion</a></p>
                </div>
            </form>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

@endsection


{{-- <style>
    body {
        background: linear-gradient(to right, #a0c9ff, #33AEFF);
        font-family: 'Arial', sans-serif;
        height: 120vh;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
    }

    .form-container {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100vh;
        padding: 10px;
        box-sizing: border-box;
    }

    .form-card {
        width: 900px; /* Ajustez la largeur ici */
        background-color: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        animation: fadeIn 0.8s ease-in-out;
    }

    .form-card .card-header {
        text-align: center;
        background-color: #00bcd4;
        color: #fff;
        padding: 15px;
        border-radius: 10px;
        font-size: 1.4rem;
        text-transform: uppercase;
    }

    .form-label {
        font-size: 1.1rem;
        color: #333;
    }

    .form-control {
        border-radius: 8px;
        border: 1px solid #ddd;
        margin-bottom: 15px;
        padding: 12px;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #00bcd4;
        box-shadow: 0 0 8px rgba(0, 188, 212, 0.5);
    }

    .btn-primary {
        background-color: #00bcd4;
        border-color: #00bcd4;
        border-radius: 8px;
        padding: 12px;
        font-weight: bold;
        width: 100%;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0097a7;
        border-color: #0097a7;
    }

    .text-center a {
        text-decoration: none;
        color: #00bcd4;
        font-weight: bold;
        transition: color 0.3s ease;
    }

    .text-center a:hover {
        color: #0097a7;
    }

    .alert {
        border-radius: 8px;
        font-size: 1rem;
        margin-bottom: 15px;
    }

    /* Animation effect */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive design */
    @media (max-width: 768px) {
        .form-card {
            width: 90%;
            padding: 20px;
        }
    }
</style> --}}

