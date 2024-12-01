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
 <!-- Enlaces de referencia -->
 <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Enlaces importantes del Instituto Arturo Capdevila </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Página oficial -->
                        <div class="col-md-4">
                            <h4><i class="bi bi-globe"></i> Página oficial</h4>
                            <p>Acceder a la página oficial para más información:</p>
                            <a href="https://www.instituto-capdevila.com.ar/web/" target="_blank" class="btn btn-primary">
                                <i class="bi bi-box-arrow-up-right"></i> Visitar Página Oficial
                            </a>
                        </div>

                        <!-- Instagram -->
                        <div class="col-md-4">
                            <h4><i class="bi bi-instagram"></i> Instagram</h4>
                            <p>Acceder al Instagram para novedades y fotos:</p>
                            <a href="https://www.instagram.com/instituto_capdevila/" target="_blank" class="btn btn-danger">
                                <i class="bi bi-instagram"></i> Instagram oficial
                            </a>
                        </div>

                        <!-- Correo electrónico -->
                        <div class="col-md-4">
                            <h4><i class="bi bi-envelope"></i> Correo electrónico</h4>
                            <p>Contactar con la dirección del Instituto:</p>
                            <a href="mailto:direccion@instituto-capdevila.com.ar" class="btn btn-secondary">
                                <i class="bi bi-envelope"></i> direccion@instituto-capdevila.com.ar
                            </a>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <!-- Ubicación -->
                        <div class="col-md-4">
                            <h4><i class="bi bi-geo-alt"></i> Ubicación</h4>
                            <p>Ubicación en el mapa:</p>
                            <a href="https://www.google.com/maps/place/Dr.+Arturo+Capdevila+709,+X5012+C%C3%B3rdoba/@-31.3765377,-64.165637,17z/data=!3m1!4b1!4m6!3m5!1s0x9432983a7b49a6e3:0x8915d91cc192daf3!8m2!3d-31.3765377!4d-64.1630621!16s%2Fg%2F11vjlbd4zm?entry=ttu&g_ep=EgoyMDI0MTEyNC4xIKXMDSoASAFQAw%3D%3D" target="_blank" class="btn btn-success">
                                <i class="bi bi-geo-alt"></i> Ver en Google Maps
                            </a>
                        </div>

                        <!-- Contacto adicional -->
                        <div class="col-md-4">
                            <h4><i class="bi bi-telephone"></i> Teléfono</h4>
                            <p>Teléfono: (351) 478-7685</p>
                        </div>
                    </div>
                </div>
            </div>

            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Material descargable</h3>
                            <!-- <div class="card-tools">
                                <a href="create.php" class="btn btn-primary"><i class="bi bi-plus-square"></i> Subir material</a>
                            </div> -->
                        </div>
                        <div class="btn-group">
                            <a href="show.php?categoria=manual" class="button button-1">Manual de Usuario</a>
                            <a href="show.php?categoria=documentacion" class="button button-2">Documentación</a>
                            <a href="show.php?categoria=aula_unida" class="button button-3">Proyecto Aula Unida</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-outline card-primary mt-4">
    <div class="card-header">
        <h3 class="card-title">Preguntas Frecuentes</h3>
    </div>
    <div class="card-body">
        <div id="faq">
            <div class="faq-item">
                <h5 class="faq-question">¿Cómo registro un nuevo usuario?</h5>
                <p class="faq-answer">Puedes registrar un nuevo usuario accediendo al módulo de "Usuarios" y seleccionando la opción "Registrar usuario".</p>
            </div>
            <div class="faq-item">
                <h5 class="faq-question">¿Dónde puedo consultar los reportes?</h5>
                <p class="faq-answer">Los reportes se encuentran en el módulo Indicadores, al cual puedes acceder desde el menú principal.</p>
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
