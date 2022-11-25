# Lumbre Admin

## Introducción
### Lumbre: Aplicación de administración
Este proyecto es una aplicación web en PHP con el framework Codeigniter 4 y siguiendo el patrón de arquitectura MVC. Constituye la aplicación de administración de LUMBRE.

## Tecnologías
* PHP 7.4.3
* MySQL 8.0.30
* Codeigniter 4.2.10

## Estructura
El proyecto se ha realizado utilizando Codeigniter 4, por lo que contiene diferentes archivos y carpetas de configuración autogenerados por el propio framework, que no han sido alterados. La estructura de directorios y archivos que han sido añadidos o modificados es la siguiente:
```bash
├───app
│   │
│   ├───Config
│   │       App.php
│   │       Database.php
│   │       Routes.php
│   │
│   ├───Controllers
│   │       AutenticacionController.php
│   │       EmpleadoController.php
│   │       Home.php
│   │       UsuarioController.php
│   │
│   ├───Models
│   │       Contacto.php
│   │       Empleado.php
│   │       Usuario.php
│   │
│   └───Views
│       │   about.php
│       │   contrasenha.php
│       │   login.php
│       │
│       ├───empleado
│       │       crear.php
│       │       editar.php
│       │       listar.php
│       │       ver.php
│       │
│       ├───templates
│       │       cabecera.php
│       │       footer.php
│       │       head.php
│       │
│       └───usuario
│               crear.php
│               editar.php
│               listar.php
│
└───public
    │
    └───assets
        │   BD.sql
        │
        ├───css
        │       style.css
        │
        ├───img
        │       favicon.png
        │       icon_empleados.png
        │       icon_usuarios.png
        │       logo1.png
        │       logo2.png
        │       logo3.png
        │       logo4.png
        │       logo_texto1.png
        │       logo_texto2.png
        │       logo_texto3.png
        │       logo_texto4.png
        │
        └───js
                about.js
                autenticacion.js
                empleados.js
                general.js
                usuarios.js
```

## Ejecución del proyecto (Ubuntu)
### Requisitos mínimos
* Servidor Apache instalado y activo
* PHP 
* MySQL

### Configuración  
Se debe situar el contenido del proyecto en el directorio /var/www/html/lumbreadmin (u otro directorio con el nombre que se desee) y ejecutar el archivo "BD.sql" ubicado en la carpeta "public/assets" para cargar la base de datos. En el archivo "Database.php", que se encuentra en "app/Config/", se pueden configurar los datos de conexión con la BD.

### Acceso
Una vez realizados los pasos de configuración, el proyecto es accesible desde el navegador, en la dirección http://localhost/lumbreadmin (o el nombre que se le haya dado al directorio raíz dentro de /var/www/html).