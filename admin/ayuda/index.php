<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');
include('../../app/controllers/ayuda/listado_ayuda.php');


?>
<style>
/* Estilo para los botones */
.button {
    padding: 12px 24px;  /* Aumenté el tamaño de los botones */
    font-size: 16px;  /* Aumenté el tamaño de la fuente */
    border-radius: 25px;  /* Bordes redondeados */
    margin: 10px;  /* Espacio entre los botones */
    cursor: pointer;  /* Cambia el cursor al pasar sobre el botón */
    transition: background-color 0.3s, transform 0.2s;  /* Animación suave para el cambio de color y el efecto de escala */
    color: #000;  /* Texto negro */
}

/* Colores pastel */
.button-1 {
    background-color: #a8d8e8;  /* Pastel azul */
}

.button-2 {
    background-color: #ffb3b3;  /* Pastel rosa */
}

.button-3 {
    background-color: #d1e7d1;  /* Pastel verde */
}

/* Efecto hover para los botones */
.button:hover {
    background-color: #ffffff;  /* Color de fondo blanco cuando el cursor pasa por encima */
    transform: scale(1.05);  /* Efecto de ampliación al pasar el cursor */
    color: #000;  /* Color de texto oscuro */
}

/* Opcional: Estilo para cambiar el color al pasar el cursor sobre cada botón */
.button-1:hover {
    background-color: #84c7d7;  /* Azul pastel más oscuro */
}

.button-2:hover {
    background-color: #f4a6a6;  /* Rosa pastel más oscuro */
}

.button-3:hover {
    background-color: #b4d0b4;  /* Verde pastel más oscuro */
}

</style>
<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h1 style="margin-left: 20px;"><i class="bi bi-info-square"></i> Información</h1>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Material descargable</h3>
                            <div class="card-tools">
                                <a href="create.php" class="btn btn-primary"><i class="bi bi-plus-square"></i> Subir material</a>
                            </div>
                        </div>
                        <div class="btn-group">
                            <a href="show.php?categoria=manual" class="button button-1">Manual de Usuario</a>
                            <a href="show.php?categoria=documentacion" class="button button-2">Documentación</a>
                            <a href="show.php?categoria=aula_unida" class="button button-3">Proyecto Aula Unida</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" >
                    <div class="form-group">
                        <a href="<?= APP_URL; ?>/admin" class="btn btn-danger">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

 

<?php 
include('../../admin/layout/parte2.php');
include ('../../layout/mensajes.php');
?>
