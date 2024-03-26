# Artivision: Almacén de Imágenes en la Nube

## Descripción del Proyecto

Artivision es una plataforma innovadora diseñada para permitir a los usuarios almacenar y compartir sus imágenes generadas por IA en la nube. Esta aplicación ofrece una solución única para los artistas, fotógrafos y cualquier persona interesada en compartir su trabajo con la comunidad.

## Características Principales

-   **Subida de Imágenes Generadas por IA**: Los usuarios pueden subir imágenes generadas por IA junto con sus parámetros específicos, facilitando la replicación y el intercambio de ideas.

## Tecnologías Utilizadas

-   **Laravel 10**: Un framework robusto y eficiente que proporciona una base sólida para el desarrollo de aplicaciones web.
-   **Livewire**: Simplifica la creación de interfaces dinámicas en PHP, permitiendo la construcción de aplicaciones web modernas sin salir del entorno de Laravel.
-   **wire-elements/modal**: Un componente Livewire que ofrece una modal personalizable y fácil de usar, manteniendo el estado de múltiples modales hijos. [wire-elements/modal](https://github.com/wire-elements/modal?tab=readme-ov-file)
-   **AlpineJs**: Una librería ligera y potente para crear interacciones dinámicas en la web con un enfoque declarativo.
-   **Guzzle**: Un cliente HTTP para PHP que facilita el envío de solicitudes a través de una API.

## Estructura de la base de datos

![Alt text](<image(2).png>)

## Roles de Usuario

-   **Usuario Normal**: Puede subir sus propias fotos, establecerlas como privadas o públicas y eliminarlas.
-   **Moderador**: Similar al usuario normal, pero con la capacidad adicional de marcar las fotos de otros usuarios como privadas, eliminándolas de la pestaña de la comunidad.
-   **Admin**: Tiene todas las capacidades de un moderador, además de poder ver y eliminar fotos de todos los usuarios.

## Instalación y Uso

Para instalar y comenzar a utilizar Artivision, sigue estos pasos:

1.  Clona el repositorio del proyecto.
2.  Navega al directorio del proyecto.
3.  Ejecuta `composer install` para instalar las dependencias de PHP.
4.  Ejecuta `npm install` para instalar las dependencias de Node.js.
5.  Utiliza `sail up -d` para iniciar el servidor Laravel Sail.
6.  Ejecuta `sail artisan migrate` para aplicar las migraciones de la base de datos.
7.  Ejecuta `sail artisan db:seed` para sembrar la base de datos con datos de prueba.
8.  Ejecuta `sail artisan storage:link` para crear un enlace simbólico desde el directorio `public/storage` al directorio `storage/app/public`.
9.  Ejecuta `npm run dev` para compilar los assets de JavaScript y CSS.
10. Accede al servidor en `localhost`.

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
