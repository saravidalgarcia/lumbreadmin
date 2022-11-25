<?php ?>
</head>

<body>
    <header id="header-ppal" class="cabecera">
        <div class="lumbre" onclick="location.href='<?php echo base_url('/usuarios'); ?>'" title="LUMBRE" alt="Logo de LUMBRE"></div>
        <div class="menu-cabecera">
            <button id="username" class="boton-cabecera">Administración</button>
            <div class="menu-cabecera-opciones">
              <a onclick="location.href='<?php echo base_url('/password'); ?>'">Cambiar contraseña</a>
              <a onclick="logout();">Cerrar sesión</a>
            </div>
        </div>
    </header>
    <main id="main" class="contenido">
        <section id="menu-ppal" class="menu-ppal">
            <a id="menu-ppal-usuarios" class="hola" href='<?php echo base_url('/usuarios'); ?>' title="Gestión de usuarios" target="_self">
                <img src="https://lumbreadmin.es/assets/img/icon_usuarios.png" alt="Icono de usuarios">
                <span>Usuarios</span>
            </a>
            <a id="menu-ppal-empleados" href='<?php echo base_url('/empleados'); ?>' title="Gestión de empleados" target="_self">
                <img src="https://lumbreadmin.es/assets/img/icon_empleados.png" alt="Icono de empleados">
                <span>Empleados</span>
            </a>
        </section>