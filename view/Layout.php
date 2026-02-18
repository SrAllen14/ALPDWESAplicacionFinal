<html lang="es"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Indice general de la asignatura">
    <meta name="author" content="Álvaro Allén Perlines">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="webroot/estilos/estilos.css"/>
    <link rel="stylesheet" href="webroot/estilos/banderas.css"/>
    <link rel="stylesheet" href="webroot/estilos/estilosFormulario.css"/>
    <link rel="stylesheet" href="webroot/estilos/estilosTabla.css"/>
    <link rel="stylesheet" href="webroot/estilos/estilosAPI.css"/>
    <link rel="stylesheet" href="webroot/estilos/estilosNasa.css"/>
    <link rel="stylesheet" href="webroot/estilos/carrusel.css"/>
    <link rel="stylesheet" href="webroot/estilos/menuInicioPublico.css"/>
    <title>Álvaro Allén Perlines</title>
</head>
<body>
    <header>
        <div class="cabecera1">
            <h2>Aplicación Final</h2>
        </div>
        <?php require_once $view[$_SESSION['paginaEnCurso']];?>
    <footer>
        <div class="pie1">
            <a href="../index.html">Álvaro Allén Perlines</a>
            <time>2026/01/26</time>
        </div>
        <div class="pie3"></div>
        <div class="pie2">
            <a href="https://github.com/SrAllen14/ALPDAWProyectoDAW/tree/master" target="blank"><i class="fa-solid fa-gear"></i></a>
            <a href="https://github.com/SrAllen14/ALPDWESAplicacionFinal/tree/master" target="blank"><i class="fab fa-github"></i></a>
            <a href="doc/CV.pdf" target="blank"><i class="fa-solid fa-address-card"></i></a>
            <a href="https://elpais.com/subscriptions/#/sign-in?prod=REG&o=CABEP&prm=login_cabecera_el-pais&backURL=https%3A%2F%2Felpais.com" target="blank"><i class="fa-solid fa-house"></i></a>
            <a href="doc/phpDocument/index.html" target="blank"><i class="fa-solid fa-circle-info"></i></a>
        </div>
    </footer>
</body>
</html>