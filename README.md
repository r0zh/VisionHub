# VisionHub

## [Notion](https://www.notion.so/Anteproyecto-ab2ea79e76064f66812afe1d15b711fb)

## Instalación y Uso

Para instalar y comenzar a utilizar Artivision, sigue estos pasos:

1.  Clona el repositorio del proyecto.
2.  Navega al directorio del proyecto.
3.  Ejecuta `composer install` para instalar las dependencias de PHP.
4.  Ejecuta `npm install` para instalar las dependencias de Node.js.
6.  Utiliza `./vendor/laravel/sail/bin/sail up -d` para iniciar el servidor Laravel Sail.
7.  Ejecuta `./vendor/laravel/sail/bin/sail artisan migrate` para aplicar las migraciones de la base de datos.
8.  Ejecuta `./vendor/laravel/sail/bin/sail artisan db:seed` para sembrar la base de datos con datos de prueba.
9.  Ejecuta `./vendor/laravel/sail/bin/sail artisan storage:link` para crear un enlace simbólico desde el directorio `public/storage` al directorio `storage/app/public`.
10.  Ejecuta `npm run dev` para compilar los assets de JavaScript y CSS.
11. Accede al servidor en `localhost`.

### Cuentas de Prueba

-   **Usuario**: gmail: [johndoe@gmail.com](mailto:johndoe@gmail.com), contraseña: password, rol: usuario
-   **Moderador**: gmail: [janedoe@gmail.com](mailto:janedoe@gmail.com), contraseña: password, rol: moderador
-   **Admin**: gmail: [admin@admin.com](mailto:admin@admin.com), contraseña: password, rol: admin

### Páginas Principales

-   **Upload**: Para subir una nueva foto.
-   **Gallery**: Muestra la galería personal del usuario.
-   **Community**: Visualiza todas las fotos públicas, incluyendo las del usuario.
-   **Admin**: Acceso a todas las fotos, públicas y privadas, para moderadores y administradores.
-   **Profile**: Permite editar el perfil del usuario.
-   **Create**: Crea imagenes con inteligencia artificial
