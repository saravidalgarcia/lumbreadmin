<?php ?>
<div class="cabecera-admin">
    <h3>Actualizar información de contacto</h3>
</div>
<div class="div-form">
    <form name="formUpdateContacto" onsubmit="updateContacto(); return false">
        <!-- Se pasa el ID del administrador como campo oculto: -->
        <input type="text" name="id" id="id" style="display: none;">
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
            <button class="boton boton-admin" type="submit">Actualizar</button>
            <button class="boton boton-admin" type="button" onclick="verAdmins();">Volver</button>
        </div>
    </form>
    <p id="mensaje-feedback" class="mensaje-feedback"></p>
</div>