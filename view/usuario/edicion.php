<?php ?>
<div class="cabecera-admin">
    <h3>Actualizar usuario</h3>
</div>
<div class="div-form">
    <form name="formUpdateUsuario" onsubmit="updateUsuario(); return false">
        <!-- Campos ocultos: -->
        <input type="text" name="id" id="id" style="display: none;">
        <input id="oldusername" type="text" name="oldusername" style="display: none;">
        <input id="oldemail" type="email" name="oldemail" style="display: none;">
        <!-- Campos visibles: -->
        <input id="newusername" type="text" name="newusername" placeholder="Nombre de usuario" required autocomplete="off">
        <br>
        <input id="newemail" type="email" name="newemail" placeholder="Email" required autocomplete="off">
        <br>
        <div class="botones">
            <button class="boton boton-admin" type="submit">Actualizar</button>
            <button class="boton boton-admin" type="button" onclick="verUsuarios();">Volver</button>
        </div>
    </form>
    <p id="mensaje-feedback" class="mensaje-feedback"></p>
</div>