<?=$head?>
    <meta name="description" content="Página de cambio de contraseña de la web de administración de Lumbre">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">
    <link href="assets/img/favicon.png" rel="icon" type="image/png">
    <title>Contraseña - LumbreAdmin</title>
<?=$cabecera?>
<section class="info">
            <section id="cabecera-info" class="cabecera-info">
            <h1>Actualizar contraseña</h1>
			</section>
            <div class="div-form new-form">
            <section>
                    <form name="formUpdatePassword" onsubmit="updatePassword(); return false">
                        <input type="password" id="passwd" name="passwd" placeholder="Contraseña actual" required /><br />
                        <input type="password" id="passwdn" name="passwdn" placeholder="Contraseña nueva" required /><br />
                        <input type="password" id="passwdn2" name="passwdn2" placeholder="Repetir contraseña nueva" required /><br />
                        <input class="boton" title="Actualizar contraseña" type="submit" value="Actualizar" />
                    </form>
                    <p id="mensaje-feedback" class="mensaje-feedback"></p>
                
                <hr>
                <input type="button" class="boton" title="Volver a la página de gestión de usuarios" onclick="location.href='usuarios'" value="Volver" />
</section>
        </div>
        </section>
<?=$footer?>
<script type="text/javascript" src="assets/js/general.js"></script>
</body>
</html>