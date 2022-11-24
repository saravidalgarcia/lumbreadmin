<?=$head?>
    <meta name="description" content="Página de edición de usuario de la web de administración de Lumbre">
    <link href="../../assets/css/style.css" rel="stylesheet" type="text/css">
    <link href="../../assets/img/favicon.png" rel="icon" type="image/png">
    <title>Actualizar usuario - LumbreAdmin</title>
<?=$cabecera?>
<section class="info">
            <section id="cabecera-info" class="cabecera-info">
				<h1>Actualizar usuario</h1>
			</section>
			
                <div class="div-form new-form">
                    <section>
                    <form name="formUpdateUsuario" onsubmit="updateUsuario(<?=$usuario['id'];?>); return false">
                        <input id="username" type="text" name="username" placeholder="Nombre de usuario" value="<?=$usuario['username'];?>" required autocomplete="off">
                        <br>
                        <input id="email" type="email" name="email" placeholder="Email" value="<?=$usuario['email'];?>" required autocomplete="off">
                        <br>
                            <input class="boton boton-admin" title="Actualizar usuario" type="submit" value="Actualizar">
                    </form>
                    <p id="mensaje-feedback" class="mensaje-feedback"></p>
</section>
                </div>
			
		</section>
<?=$footer?>
<script type="text/javascript" src="../../assets/js/general.js"></script>
<script type="text/javascript" src="../../assets/js/usuarios.js"></script>
</body>
</html>