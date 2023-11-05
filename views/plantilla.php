<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sistema de Facturacion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <?php if (isset($_GET['pagina'])) : ?>
                        <?php if ($_GET['pagina'] == "inicio") : ?>
                            <li class="nav-item">
                                <a class="nav-link active" href="index.php?pagina=inicio">Inicio</a>
                            </li>
                        <?php else : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?pagina=inicio">Inicio</a>
                            </li>
                        <?php endif ?>
                        <?php if ($_GET['pagina'] == "facturar") : ?>
                            <li class="nav-item">
                                <a class="nav-link active" href="index.php?pagina=facturar">Facturar</a>
                            </li>
                        <?php else : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?pagina=facturar">Facturar</a>
                            </li>
                        <?php endif ?>

                        <?php if ($_GET['pagina'] == "intereses") : ?>
                            <li class="nav-item">
                                <a class="nav-link active" href="index.php?pagina=intereses">Intereses</a>
                            </li>
                        <?php else : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?pagina=intereses">Intereses</a>
                            </li>
                        <?php endif ?>

                        <?php if ($_GET['pagina'] == "altaClientes") : ?>
                            <li class="nav-item">
                                <a class="nav-link active" href="index.php?pagina=altaClientes">Cargar Clientes</a>
                            </li>
                        <?php else : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?pagina=altaClientes">Cargar Clientes</a>
                            </li>
                        <?php endif ?>

                        <?php if ($_GET['pagina'] == "metricas") : ?>
                            <li class="nav-item">
                                <a class="nav-link active" href="index.php?pagina=metricas">Metricas</a>
                            </li>
                        <?php else : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?pagina=metricas">Metricas</a>
                            </li>
                        <?php endif ?>

                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php?pagina=inicio">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?pagina=facturar">Facturar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?pagina=intereses">Intereses</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?pagina=altaClientes">Cargar Clientes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?pagina=metricas">Metricas</a>
                        </li>
                    <?php endif ?>


                </ul>
            </div>
        </nav>
    </header>

    <main>

        <div class="container-fluid">
            <div class="container py-5">
                <?php
                if (isset($_GET['pagina'])) {

                    if (
                        $_GET['pagina'] == "inicio" ||
                        $_GET['pagina'] == "facturar" ||
                        $_GET['pagina'] == "intereses" ||
                        $_GET['pagina'] == "ediFact" ||
                        $_GET['pagina'] == "altaClientes" ||
                        $_GET['pagina'] == "metricas"
                    ) {
                        include "pages/" . $_GET['pagina'] . ".php";
                    } else {
                        include "pages/error404.php";
                    }
                } else {
                    include "pages/inicio.php";
                }
                ?>
            </div>
        </div>
    </main>


    <footer></footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/600e7f7446.js" crossorigin="anonymous"></script>
</body>

</html>