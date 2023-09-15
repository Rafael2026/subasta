<?php

  use App\Models\Producto;
  use App\Models\Subasta;
  use App\Models\Puja;

  $productos = new Producto();
  $products = $productos->getProductos();

  $id = $_GET["codigo"];

?>


<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Portal de Subastas</title>
  <link href="img/logo.png" type="image/x-icon" rel="icon">
  <link href="css/login.css" rel="stylesheet">
  <link href="css/estilos.css" rel="stylesheet">
  <link href="css/styles.css" rel="stylesheet">
</head>

<body>

  <header>
    <img src="img/cabecera.webp" alt="Logo de Subasta total">
  </header>

  <nav class="topnav" id="myTopnav">

    <a href="/" class="active">Inicio</a>
    <a href="/subasta">Subastas</a>
    <a href="/puja">Pujas</a>
    <a href="/login" class="disabled">Iniciar sesion</a>
    <a href="/registro" class="disabled">Registrarse</a>

    <a href="/">
      <button name="out" id="out">Log out</button>
    </a>

    <a href="javascript:void(0);" class="icon nav">
      <img src="img/menu.svg" alt="Menu">
    </a>

  </nav>

  <div class="fin-float"></div>

  <main>

    <section>

      <!-- Title: Hora Central Europea / Central European Time -->
      <div>
        <span class="fecha"></span>
        <span class="tiempo"></span>
        <span class="horario">CET</span>
      </div>

    </section>

    <section>

      <h2>Producto Nº <?php echo htmlspecialchars($id); ?></h2>

      <!--<ul>

        <li>
          <a href="/subasta">Busqueda</a>
        </li>

        <li>
          <a href="/resultados">Resultados</a>
        </li>

        <li>

          <a href="/guardar" class="guardar">
            Guardar
            <span>Busqueda</span>
            <img src="img/logoAcceso.png" srcset="img/logoAcceso.svg" alt="Sesion activa" />
          </a>

        </li>

      </ul>-->

    </section>

    <section>

      <?php

        $productos = new Producto();
        $products = $productos->getProductos();

        $subastas = new Subasta();
        $sub = $subastas->getSubastas();

        $pujas = new Puja();
        $pu = $pujas->getPujas();

        for ($i = 0; $i < count($products); $i++) {

          if (intval($i + 1) == $id) {
      ?>

      <div class="producto">

        <ul>

          <li>
            <img src="img/productos/<?php echo $products[$i]['nomProd'] ?>.jpg" alt="<?php echo $products[$i]['nomProd'] ?>">
          </li>

          <li>
            <h3>Producto: <?php echo $products[$i]['nomProd']; ?></h3>
          </li>

          <li>
            <h4>Materiales: <?php echo $products[$i]['material']; ?></h4>
          </li>

          <li>
            <p>Anchura del producto: <?php echo $products[$i]['anchura']; ?></p>
          </li>

          <li>
            <p>Altura del producto: <?php echo $products[$i]['altura']; ?></p>
          </li>

          <!--<li>
            <p>Categoría del producto: <?php // echo $products[$i]['categoria'] ?></p>
          </li>-->

          <li>
            <p>Fecha inicial: <?php echo $sub[$i]['fechaInic']; ?></p>
          </li>

          <li>
            <p>Fecha fin: <?php echo $sub[$i]['fechaFin']; ?></p>
          </li>

          <li>
            <p>Precio inicial: <?php echo $sub[$i]['precIni']; ?></p>
          </li>

        </ul>

        <button class="atras">
          <a href="/portal">Volver atrás</a>
        </button>

      </div>

        <?php
            }
          }
        ?>

    </section>

    <section>

      <ul>

        <li>
          <span class="fuera">Está usted en la página de resultados número</span>
          <span class="current">1</span>
        </li>

        <li>
          <a href="/portal">2</a>
        </li>

        <li>

          <a href="/user">
            <abbr title="Página">Pág.</abbr> siguiente
          </a>

        </li>

      </ul>

    </section>

  </main>

  <footer>
    <h2>Proyecto final de Grado Superior</h2>
    <p>Autor: Rafael Aguilar Muñoz</p>
  </footer>

  <!--<script src="{{ secure_asset('js/app.js') }}" defer></script>
  <script src="{{ secure_asset('js/reloj.js') }}" defer></script>
  <script src="{{ secure_asset('js/script.js') }}" defer></script>-->

  <script src="js/app.js" defer></script>
  <script src="js/reloj.js" defer></script>
  <script src="js/script.js" defer></script>

</body>

</html>
