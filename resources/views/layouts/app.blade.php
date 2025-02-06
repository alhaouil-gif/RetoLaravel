<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Elorrieta</title>   
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">


    <!-- AdminLTE y Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
<!-- FontAwesome CDN -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Fuentes -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">




<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- jQuery (necesario para Select2) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style>
/* Style for the main menu container */
.navbar-nav {
    list-style: none;
    padding: 0;
    margin: 0;
}

/* Style for each menu item */
.navbar-nav .menu-item {
    display: inline-block;
    margin-right: 20px; /* Space between menu items */
}

/* Style for links (the buttons) */
.navbar-nav .menu-item a {
    display: inline-block;
    padding: 10px 20px; /* Padding to give the button a proper size */
    background-color: #3cb4e5; /* Button color */
    color: white; /* Text color */
    text-decoration: none; /* Remove underline */
    border-radius: 5px; /* Rounded corners for buttons */
    font-size: 16px; /* Font size */
    transition: background-color 0.3s ease; /* Smooth transition on hover */
}

/* Hover effect for buttons */
.navbar-nav .menu-item a:hover {
    background-color: #1d8ca5; /* Darker shade of #3cb4e5 for hover */
}

/* Style for the dropdowns */
.navbar-nav .menu-item.menu-item-has-children > a {
    position: relative;
}

/* Dropdown arrow styling */
.navbar-nav .menu-item.menu-item-has-children > a:after {
    content: ' ▼';
    font-size: 12px;
    position: absolute;
    right: 10px;
}

/* Style for the dropdown menu */
.navbar-nav .sub-menu {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    background-color: #3cb4e5;
    padding: 10px;
    border-radius: 5px;
    z-index: 1000;
}

/* Show dropdown on hover */
.navbar-nav .menu-item.menu-item-has-children:hover .sub-menu {
    display: block;
}

/* Style for the dropdown items */
.navbar-nav .sub-menu .menu-item a {
    padding: 10px;
    background-color: #3cb4e5;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-size: 14px;
}

/* Hover effect for dropdown items */
.navbar-nav .sub-menu .menu-item a:hover {
    background-color: #1d8ca5;
}

.navbar-brand img {
    width: 150px !important; /* Aumenta el tamaño */
    height: auto;
}





  .navbar-nav {
        justify-content: flex-start; /* Alinea los elementos a la izquierda */
    }

    .navbar-nav .menu-item {
        margin-right: 15px; /* Espacio entre los elementos del menú */
    }
</style>

    <!-- Estilos y Scripts de Laravel (Vite) -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">

            <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" style="width: 50px; height: auto;">
             </a>
             <ul class="navbar-nav ms-auto">
    <li id="menu-item-191" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children submenu">
        <a href="https://www.elorrieta.eus/es/centro/"><span>CENTRO</span></a>
        <ul class="sub-menu" style="display: none;">
            <li id="menu-item-6831" class="menu-item menu-item-type-post_type menu-item-object-page">
                <a href="#"><span>Elorrieta Erreka Mari</span></a>
            </li>
            <li id="menu-item-201" class="menu-item menu-item-type-post_type menu-item-object-page">
                <a href="#"><span>RSC</span></a>
            </li>
            <li id="menu-item-199" class="menu-item menu-item-type-post_type menu-item-object-page">
                <a href="#"><span>Política de gestión</span></a>
            </li>
            <li id="menu-item-200" class="menu-item menu-item-type-post_type menu-item-object-page">
                <a href="#"><span>Organización/departamentos</span></a>
            </li>
            <li id="menu-item-203" class="menu-item menu-item-type-post_type menu-item-object-page">
                <a href="#"><span>Localización</span></a>
            </li>
            <li id="menu-item-204" class="menu-item menu-item-type-post_type menu-item-object-page">
                <a href="#"><span>Contacto</span></a>
            </li>
            <li id="menu-item-205" class="menu-item menu-item-type-post_type menu-item-object-page">
                <a href="#"><span>Entidades colaboradoras</span></a>
            </li>
            <li id="menu-item-206" class="menu-item menu-item-type-post_type menu-item-object-page">
                <a href="#"><span>Reconocimientos</span></a>
            </li>
            <li id="menu-item-269" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children submenu">
                <a href="#"><span>ACTUALIDAD Y COMUNICACIÓN</span><i class="menu-arrow icon-right-open"></i></a>
                <ul class="sub-menu">
                    <li id="menu-item-193" class="menu-item menu-item-type-post_type menu-item-object-page">
                        <a href="#"><span>Noticias</span></a>
                    </li>
                    <li id="menu-item-194" class="menu-item menu-item-type-post_type menu-item-object-page">
                        <a href="#"><span>Identidad visual</span></a>
                    </li>
                    <li id="menu-item-3861" class="menu-item menu-item-type-post_type menu-item-object-page">
                        <a href="#"><span>Catálogos de oferta formativa</span></a>
                    </li>
                </ul>
                <a class="menu-toggle" href="#" role="link" aria-label="Toggle submenu">
                    <i class="menu-arrow icon-right-open"></i>
                </a>
            </li>
        </ul>
    </li>
    <ul class="navbar-nav ms-auto">
    <li id="menu-item-estudios" class="menu-item menu-item-type-custom menu-item-object-custom">
        <a href="#"><span>ESTUDIOS</span></a>
    </li>
    <li id="menu-item-servicios" class="menu-item menu-item-type-custom menu-item-object-custom">
        <a href="#"><span>SERVICIOS</span></a>
    </li>
    <li id="menu-item-proyectos" class="menu-item menu-item-type-custom menu-item-object-custom">
        <a href="#"><span>PROYECTOS</span></a>
    </li>
    <li id="menu-item-valor-fp" class="menu-item menu-item-type-custom menu-item-object-custom">
        <a href="#"><span>EL VALOR DE LA FP</span></a>
    </li>
</ul>
</ul>

               
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest 
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link btn" href="{{ route('login') }}" style="background-color: #211261; color: white; border-radius: 5px; padding: 10px 20px;">
                                    {{ __('Login') }}
                                </a>
                            </li>
                        @endif
                                                
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <section class="welcome-section" style="background-color: #f4f8fb; padding: 50px; text-align: center;">
  <h2 style="font-size: 36px; color: #3cb4e5;">Bienvenidos a ERREKA MARI</h2>
  <p style="font-size: 18px; color: #555;">En Elorrieta, nos enorgullece ofrecer una educación innovadora y de calidad. Prepárate para un futuro lleno de oportunidades. ¡Descubre lo que tenemos preparado para ti!</p>
  <a href="https://www.elorrieta.eus/es/" style="padding: 15px 25px; background-color: #3cb4e5; color: white; text-decoration: none; border-radius: 5px; font-size: 16px;">Ver Programas</a>
</section>


<section class="contact-section" style="background-color: #f4f8fb; padding: 50px;">
    <h2 style="text-align: center; color: #3cb4e5;">Contacto</h2>
    <div class="contact-info" style="display: flex; justify-content: space-around; flex-wrap: wrap; gap: 20px;">
        
        <!-- Elorrieta Contacto -->
        <div class="contact-item" style="flex: 1; min-width: 250px; background-color: #ffffff; padding: 20px; border-radius: 5px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <h3 style="color: #3cb4e5;">ELORRIETA</h3>
            <p><strong>Dirección:</strong> Lehendakari Agirre 184, San Inazio, 48015 Bilbao</p>
            <p><strong>Teléfono:</strong> <a href="tel:944028000" style="color: #3cb4e5;">944 028 000</a></p>
        </div>

       

        <!-- Erreka Mari Contacto -->
        <div class="contact-item" style="flex: 1; min-width: 250px; background-color: #ffffff; padding: 20px; border-radius: 5px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <h3 style="color: #3cb4e5;">ERREKA MARI</h3>
            <p><strong>Ubicación:</strong> Edificio de la Escuela Oficial de Idiomas de Deusto, Plaza San Pedro, 5, 48014, Bilbao</p>
            <p><strong>Teléfono:</strong> <a href="tel:944751117" style="color: #3cb4e5;">944 751 117</a></p>
        </div>

    </div>
</section>

<!-- Sección de Contenido Medio (con la imagen) -->
<section id="contenido-medio" style="text-align: center; padding: 50px 0;">
    <div class="contenedor-imagen" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <!-- Imagen en el medio -->
        <img src="images/elor.jpg" alt="Logo Elorrieta" style="max-width: 1250px; height: 500px; margin-bottom: 30px; display: block; margin-left: auto; margin-right: auto;">
        
        <!-- Texto adicional -->
        <p style="font-size: 18px; color: #333;">¡Gracias por visitarnos! Si tienes alguna pregunta, no dudes en ponerte en contacto con nosotros.</p>
    </div>
</section>


<!-- Footer -->
<footer style="background-color: #3cb4e5; color: white; padding: 40px 0; text-align: center;">
    <div class="footer-content" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        
        <!-- Links de contacto o redes sociales -->
        <div class="footer-links" style="margin-bottom: 20px;">
            <a href="https://www.elorrieta.eus/es/contacto" style="color: white; margin: 0 10px; text-decoration: none;">Contacto</a>
            <a href="https://www.elorrieta.eus/es/somos" style="color: white; margin: 0 10px; text-decoration: none;">Nosotros</a>
            <a href="https://www.elorrieta.eus/es/noticias" style="color: white; margin: 0 10px; text-decoration: none;">Noticias</a>
        </div>

        <!-- Información adicional (dirección, teléfono, etc.) -->
        <div class="footer-info" style="font-size: 14px;">
            <p>Lehendakari Agirre 184, San Inazio, 48015 Bilbao | Tfno: 944 028 000</p>
        </div>
    </div>
</footer>



        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Scripts necesarios para Bootstrap y AdminLTE -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

</body>
</html>
