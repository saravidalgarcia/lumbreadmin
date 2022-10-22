<?php ?>
<div class="cabecera-admin">
    <h3>Crear usuario</h3>
</div>
<div class="div-form">
    <form name="formCrearUsuario" onsubmit="crearUsuario(); return false">
        <input id="username" type="text" class="form-control" name="username" placeholder="Nombre de usuario" required autocomplete="off">
        <br>
        <input id="email" type="email" class="form-control" name="email" placeholder="Email" required autocomplete="off">
        <br>
        <div class="botones">
            <button class="boton boton-admin" type="submit">Crear</button>
            <button class="boton boton-admin" type="button" onclick="verUsuarios();">Volver</button>
        </div>
    </form>
    <p id="mensaje-feedback" class="mensaje-feedback"></p>
</div>