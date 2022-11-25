<?= $head ?>

<meta name="description" content="Página de información de LUMBRE">
<link href="assets/css/style.css" rel="stylesheet" type="text/css">
<link href="assets/img/favicon.png" rel="icon" type="image/png">
<title>Lumbre - Información</title>

<?= $cabecera ?>

        <section id="info" class="info">
            <section id="cabecera-info" class="cabecera-info">
                <header>
                    <div class="lumbre-texto" title="LUMBRE" alt="Logo de LUMBRE"></div>
                    <h2>Una web pensada por y para Dungeon Masters</h2>
                    <p>para organizar fácilmente tus campañas, sesiones y personajes.</p>
                </header>
            </section>

            <section class="info-about">
                <article>
                    <h3>Qué es Lumbre</h3>
                    <p>Lumbre es una aplicación web que ofrece diferentes herramientas para facilitar la gestión y el seguimiento de las partidas de rol de los usuarios. Se trata de una web dirigida a la figura del <i>Dungeon Master</i>, o director del juego, que es el jugador encargado de crear, narrar y supervisar una campaña de rol y su curso narrativo, a lo largo de las diferentes sesiones o partidas que la componen.
                    <p>A través de <a href="https://lumbre.es" title="Web de Lumbre">https://lumbre.es</a>, los usuarios pueden gestionar la información relativa a sus campañas y personajes, y también las diferentes sesiones de juego. Entre las opciones que ofrece Lumbre, destaca la de poder registrar los eventos que tienen lugar en cada sesión y planificar sesiones futuras de las campañas.</p>
                    <p>Además, el proyecto de Lumbre cuenta con una segunda aplicación, en este caso destinada a los administradores de la web, que les permite gestionar los usuarios registrados en el sistema y los empleados, realizando tareas como consultar listados de todos los usuarios y empleados existentes, crear nuevos usuarios o eliminarlos. Esta aplicación web es accesible desde la dirección <a href="https://lumbreadmin.es" title="Web de LumbreAdmin">https://lumbreadmin.es</a>.</p>
                </article>
                <article>
                    <h3>Autoría y motivación</h3>
                    <p>Lumbre es una idea desarrollada por <b>Sara Vidal García</b> como proyecto final de ciclo, para el Ciclo Superior de Desarrollo de Aplicaciones Web (curso 2022-23).</p>
                    <p>El principal motivo por el que he elegido este proyecto es que me interesa de forma personal. Como <i>Dungeon Master</i>, a lo largo de mis años de experiencia dirigiendo partidas de rol me he encontrado con dificultades para planificar de forma organizada las sesiones de mis campañas, sin poder recurrir a una aplicación o web que me permitiese gestionarlas de forma centralizada y hacer un seguimiento de las mismas. Es por ello que mi experiencia personal es, sin duda, la razón más destacable por la que he elegido este proyecto.</p>
                </article>
                <article>
                    <h3>Contacto</h3>
                    <p>Puedes contactar con el equipo de soporte de Lumbre a través de la dirección de correo electrónico <span>soporte@lumbre.es</span> o mediante el siguiente formulario. <i>Nota: El email y el formulario no son reales, son solo de ejemplo.</i></p>
                    <div class="div-form">
                        <section>
                            <form onsubmit="alert('Este formulario es solo de ejemplo, ¡no funciona realmente!');">
                                <input type="text" id="nombre" name="nombre" placeholder="Nombre" required /><br />
                                <input type="email" id="email" name="email" placeholder="Email" required /><br />
                                <textarea id="texto" placeholder="Texto" rows="4" required></textarea><br />
                                <input class="boton" title="Enviar" type="submit" value="Enviar" />
                            </form>
                        </section>
                    </div>
                </article>
                <article>
                    <h3><a href="login" title="Enlace a la página de inicio">Volver a la página de inicio de LumbreAdmin</a></h3>
                </article>
            </section>
        </section>
    </main>
    <footer>
        <p>Sara Vidal García | 2022 | <a href="https://lumbreadmin.es/about" title="Página de información sobre Lumbre">Lumbre</a></p>
    </footer>
    <script src="assets/js/about.js"></script>
</body>

</html>