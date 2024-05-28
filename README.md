# VisionHub

## Repositorios relacionados

[Angular repository](https://github.com/r0zh/VisionHub-angular): Angular frontend

[Flask repository](https://github.com/r0zh/VisionHub-flask): Flask microservice


## Despliegue de la aplicación (temporalmente apagado para ahorrar recursos)
[VisionHub (laravel)](http://laravelloadbalancer-1413397690.us-east-1.elb.amazonaws.com/)

[VisionHub (angular)](http://angularloadbalancer-279767366.us-east-1.elb.amazonaws.com/)

[Flask microservice](http://flaskloadbalancer-64905749.us-east-1.elb.amazonaws.com) (Hacer petición al endpoint get_image mediante post para probar) 

## Notion del proyecto 
[Notion](https://www.notion.so/e67ae944be194b38bcba67d7642c7b3f?v=912bed725fd94a7dab5d94a88ed09741) 

[Anteproyecto](https://www.notion.so/Anteproyecto-ab2ea79e76064f66812afe1d15b711fb)

## Instalación y Uso

Para instalar y utilizar VisionHub, sigue estos pasos:

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

-   **Generate**: Crea imagenes con inteligencia artificial
-   **Upload**: Para subir una nueva foto.
-   **Gallery**: Muestra la galería personal del usuario.
-   **Community**: Visualiza todas las fotos públicas, incluyendo las del usuario.
-   **Admin**: Acceso a todas las fotos, públicas y privadas, para moderadores y administradores.
-   **Profile**: Permite editar el perfil del usuario.
