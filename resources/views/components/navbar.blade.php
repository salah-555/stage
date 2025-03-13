<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SportShop - Navbar Professionnelle</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body {
            background-color: #f8f9fa;
            
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(255, 255, 255, 0.95); /* Fond légèrement transparent */
            padding: 15px 40px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Ombre douce */
            position: fixed; /* Fixe la navbar en haut */
            top: 0;
            left: 0;
            width: 100%;
            height: 100px;
            z-index: 1000;
            transition: all 0.3s ease-in-out;
}
        .navbar .logo a {
            font-size: 1.8rem;
            font-weight: 700;
            color: #2c3e50;
            text-decoration: none;
            letter-spacing: -0.5px;
        }
        .nav-links {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
        }
        .nav-links li {
            margin: 0 20px;
            position: relative;
        }
        .nav-links a {
            color: #2c3e50;
            text-decoration: none;
            font-size: 1.3rem;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        .nav-links a::after {
            content: '';
            display: block;
            width: 0;
            height: 2px;
            background-color: #e67e22;
            transition: width 0.3s ease;
            position: absolute;
            bottom: -5px;
            left: 0;
        }
        .nav-links a:hover::after {
            width: 100%;
        }
        .nav-links a:hover {
            color: #e67e22;
        }
        .nav-actions {
            display: flex;
            gap: 15px;
            align-items: center;
        }
        .nav-actions a {
            background-color: #338fe4;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 500;
            transition: background 0.3s ease, transform 0.3s ease;
        }
        .nav-actions a:hover {
            background-color: #e67e22;
            transform: translateY(-2px);
        }
        .nav-actions span {
            color: #2c3e50;
            font-weight: 500;
            margin-right: 10px;
        }
        .menu-toggle {
            display: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #2c3e50;
        }
        @media (max-width: 768px) {
            .navbar {
                padding: 15px 20px;
            }
            .nav-links {
                display: none;
                flex-direction: column;
                background: #ffffff;
                position: absolute;
                top: 70px;
                left: 0;
                width: 100%;
                padding: 20px 0;
                text-align: center;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            }
            .nav-links.active {
                display: flex;
            }
            .nav-links li {
                margin: 15px 0;
            }
            .menu-toggle {
                display: block;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            <a href="{{route('accueil')}}">SportShop</a>
        </div>
        <ul class="nav-links">
            <li><a href="/">Accueil</a></li>
            <li><a href="/products">Produits</a></li>
            <li><a href="#">Catégories</a></li>
            <li><a href="/contact">Contact</a></li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('orders.index') }}">
                    <i class="fas fa-box"></i> Mes Commandes
                </a>
            </li>

            @if(auth()->check() && auth()->user()->is_admin)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-chart-line"></i> Dashboard Admin
                    </a>
                </li>
            @endif
        </ul>
        <div class="nav-actions">
            @if(session('client'))
                <span>👤 {{ session('client')->email }}</span>
                <form action="{{route('logout')}}" method="POST" style="display:inline;">
                    @csrf
                    <button class="btn btn-primary" type="submit">Déconnexion</button>
                </form>
            @else
                <a href="{{route('client.login')}}">Connexion</a>
                <a href="{{route('client.register')}}">Inscription</a>
            @endif
        </div>
        <div class="menu-toggle">
            <i class="fas fa-bars"></i>
        </div>
    </nav>

    <script>
        document.querySelector('.menu-toggle').addEventListener('click', function() {
            document.querySelector('.nav-links').classList.toggle('active');
        });
    </script>
</body>
</html>