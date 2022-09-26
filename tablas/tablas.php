<?php
  
  error_reporting(E_ERROR);
  ini_set("display-errors", 0);

  $conexion = mysqli_connect("localhost", "root", "", "subasta");
  
?>

<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Todas las tablas</title>
  <link href="tablas.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

  <form action="" method="POST" enctype="multipart/form-data">

    <div class="row">

      <div class="col-25">
        <label for="categoria">Según la categoría:</label>
      </div>

      <div class="col-75">

        <select name="categoria" id="categoria">
          <option></option>
          <option value="Multiherramientas">Multiherramientas</option>
          <option value="Mueble Autotransformable">Mueble Autotransformable</option>
          <option value="Super coches">Super coches</option>
          <option value="Dispositivo cambiante">Dispositivo cambiante</option>
          <option value="Piedras preciosas" disabled>Piedras preciosas</option>
        </select>

      </div>

    </div>

    <div class="row">
      <input type="submit" name="submit" id="submit" value="Mostrar datos">
    </div>

  </form>

  <?php

    $category = $_POST['categoria'];

    $productQuery = "SELECT * FROM producto";
    $productResult = mysqli_query($conexion, $productQuery);

    while ($row = mysqli_fetch_array($productResult)) { $productos[] = $row; }

    if (isset($_POST['submit'])) {

      if (!empty($category)) {
  ?>

      <!-- Tabla productos -->
      <div class="table-responsive">

        <table class="table table-bordered border-primary container">

          <thead>

            <tr>
              <td>Código producto</td>
              <td>Nombre producto</td>
              <td>Material</td>
              <td>Anchura</td>
              <td>Altura</td>
              <td>Categoría</td>
              <td>Código subasta</td>
            </tr>

          </thead>

          <tbody>

            <?php

            for ($i = 0; $i < count($productos); $i++) {

              if (strcmp($productos[$i]['categoria'], $category) == 0) {
            ?>

                <tr>
                  <td><?php echo $productos[$i]['codProd']; ?></td>
                  <td><?php echo $productos[$i]['nomProd']; ?></td>
                  <td><?php echo $productos[$i]['material']; ?></td>
                  <td><?php echo $productos[$i]['anchura']; ?></td>
                  <td><?php echo $productos[$i]['altura']; ?></td>
                  <td><?php echo $productos[$i]['categoria']; ?></td>
                  <td><?php echo $productos[$i]['codSubasta']; ?></td>
                </tr>

            <?php
                break;
              }
            }
            ?>

          </tbody>

        </table>

      </div>

      <?php

      $codigo = $productos[$i]['codSubasta'];

      $subastaQuery = "SELECT * FROM subasta WHERE codSubasta = $codigo AND precIni > 0";
      $subastaResult = mysqli_query($conexion, $subastaQuery);

      while ($row = mysqli_fetch_array($subastaResult)) { $subastas[] = $row; }

      ?>

      <!-- Tabla subastas -->
      <div class="table-responsive">

        <table class="table table-bordered border-primary container">

          <thead>

            <tr>
              <td>Código Subasta</td>
              <td>fecha inicial</td>
              <td>fecha fin</td>
              <td>precio inicial</td>
            </tr>

          </thead>

          <tbody>

            <?php
            for ($j = 0; $j < count($subastas); $j++) {
            ?>

              <tr>
                <td><?php echo $subastas[$j]['codSubasta']; ?></td>
                <td><?php echo $subastas[$j]['fechaInic']; ?></td>
                <td><?php echo $subastas[$j]['fechaFin']; ?></td>
                <td><?php echo $subastas[$j]['precIni']; ?></td>
              </tr>

            <?php
            }
            ?>

          </tbody>

        </table>

      </div>

      <?php

      $pujaQuery = "SELECT * FROM puja WHERE codSubasta=" . $productos[$i]['codSubasta'];
      $pujaResult = mysqli_query($conexion, $pujaQuery);

      while ($row = mysqli_fetch_array($pujaResult)) { $pujas[] = $row; }

      ?>

      <!-- Tabla pujas -->
      <div class="table-responsive">

        <table class="table table-bordered border-primary container">

          <thead>

            <tr>
              <td>Código puja</td>
              <td>valor</td>
              <td>fecha</td>
              <td>Código usuario</td>
              <td>Código subasta</td>
            </tr>

          </thead>

          <tbody>

            <?php
            for ($p = 0; $p < count($pujas); $p++) {
            ?>

              <tr>
                <td><?php echo $pujas[$p]['codPuja'] ?></td>
                <td><?php echo $pujas[$p]['valor'] ?></td>
                <td><?php echo $pujas[$p]['fecha'] ?></td>
                <td><?php echo $pujas[$p]['codUsu'] ?></td>
                <td><?php echo $pujas[$p]['codSubasta'] ?></td>
              </tr>

            <?php
            }
            ?>

          </tbody>

        </table>

      </div>

      <?php

      $usuarioQuery = "SELECT codUsu, nomUsu, apeUsu, fechaUnion FROM usuario WHERE permiso < 1";
      $usuarioResult = mysqli_query($conexion, $usuarioQuery);

      while ($row = mysqli_fetch_array($usuarioResult)) {$usuarios[] = $row; }

      ?>

      <!-- Tabla usuarios -->
      <div class="table-responsive">

        <table class="table table-bordered border-primary container">

          <thead>

            <tr>
              <td>Código usuario</td>
              <td>nombre usuario</td>
              <td>apellidos usuario</td>
              <td>fecha union</td>
            </tr>

          </thead>

          <tbody>

            <?php
            for ($u = 0; $u < count($usuarios); $u++) {
            ?>

              <tr>
                <td><?php echo $usuarios[$u]['codUsu'] ?></td>
                <td><?php echo $usuarios[$u]['nomUsu'] ?></td>
                <td><?php echo $usuarios[$u]['apeUsu'] ?></td>
                <td><?php echo $usuarios[$u]['fechaUnion'] ?></td>
              </tr>

            <?php
            }
            ?>

          </tbody>

        </table>

      </div>

  <?php

    echo "Puja ganadora: " . $pujas[(count($pujas) - 1)]['valor'];

        for ($u = 0; $u < count($usuarios); $u++) {

          if ($usuarios[$u]['codUsu'] == $pujas[(count($pujas) - 1)]['codUsu']) {
            echo "<br/>Ganador de la subasta: " . $usuarios[$u]['nomUsu'] . " " . $usuarios[$u]['apeUsu'];
            break;
          }
        }
      }
    }

    echo "<br/>Precio inicial de subasta: ". $subastas[count($subastas) - 1]['precIni'];

  ?>

  <hr>

  <form action="pujar.php" method="POST" enctype="multipart/form-data">

    <div class="row">

      <div class="col-25">
        <label for="inicial">Precio inicial de la subasta</label>
      </div>

      <div class="col-75">
        <input type="number" name="inicial" id="inicial" value="<?php echo $subastas[count($subastas) - 1]['precIni'] ?>" readonly>
      </div>

    </div>

    <div class="row">

      <div class="col-25">
        <label for="actual">Precio actual de la subasta</label>
      </div>

      <div class="col-75">
        <input type="number" name="actual" id="actual" min="<?php echo $subastas[count($subastas) - 1]['precIni'] ?>">
      </div>

    </div>

    <div class="row">
      <input type="hidden" name="fecha1" id="fecha1" value="<?php echo $subastas[count($subastas) - 1]['fechaInic']; ?>" readonly>
    </div>

    <div class="row">
      <input type="hidden" name="fecha2" id="fecha2" value="<?php echo $subastas[count($subastas) - 1]['fechaFin']; ?>" readonly>
    </div>

    <div class="row">
      <input type="submit" name="submit" id="submit" value="Pujar">
    </div>

  </form>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" type="text/javascript" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" type="text/javascript" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" type="text/javascript" defer></script>

</body>

</html>

<?php
  mysqli_close($conexion);
?>