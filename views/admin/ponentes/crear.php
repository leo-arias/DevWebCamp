<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>

<div class="dashboard__contenedor-boton">
    <a href="/admin/ponentes" class="dashboard__boton">
        <i class="fas fa-arrow-circle-left"></i>
        Volver
    </a>
</div>

<div class="dashboard__formulario">
    <?php
        include_once __DIR__ . "/../../templates/alertas.php";
    ?>

    <form method="POST" action="/admin/ponentes/crear" enctype="multipart/form-data" class="formulario">

        <?php include_once __DIR__ . "/formulario.php"; ?>

        <input type="submit" class="formulario__submit formulario__submit--registrar" value="Registrar Ponente">
    </form>
</div>