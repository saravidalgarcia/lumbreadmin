<?php ?>
<div class="cabecera-admin">
    <h3>Crear administrador</h3>
</div>
<div class="div-form">
    <form name="formCrearAdmin" onsubmit="crearAdmin(); return false">
        <input id="username" type="text" name="username" placeholder="Nombre de usuario" required autocomplete="off">
        <br>
        <input id="email" type="email" name="email" placeholder="Email" required autocomplete="off">
        <br>
        <input id="dni" type="text" name="dni" placeholder="DNI" required autocomplete="off">
        <br>
        <input id="nombre" type="text" name="nombre" placeholder="Nombre" autocomplete="off">
        <br>
        <input id="apellidos" type="text" name="apellidos" placeholder="Apellidos" autocomplete="off">
        <br>
        <input id="passwd" type="password" name="passwd" placeholder="Contraseña" required autocomplete="off">
        <br>
        <input id="passwd2" type="password" name="passwd2" placeholder="Repetir contraseña" required autocomplete="off">
        <br>
        <p>Información de contacto:</p>
        <br>
        <input id="telefono" type="text" name="telefono" placeholder="Teléfono" autocomplete="off">
        <br>
        <input id="direccion" type="text" name="direccion" placeholder="Dirección" autocomplete="off">
        <br>
        <input id="poblacion" type="text" name="poblacion" placeholder="Población" autocomplete="off">
        <br>
        <input id="cp" type="text" name="cp" placeholder="CP" autocomplete="off">
        <br>
        <input id="pais" type="text" name="pais" placeholder="País" autocomplete="off">
        <br>
        <div class="botones">
            <button class="boton boton-admin" type="submit">Crear</button>
            <button class="boton boton-admin" type="button" onclick="verAdmins();">Volver</button>
        </div>
    </form>
    <p id="mensaje-feedback" class="mensaje-feedback"></p>
</div>