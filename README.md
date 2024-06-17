# VisionHub
Por David Natanael y Roberto Sánchez
## Repositorios relacionados

[Angular repository](https://github.com/r0zh/VisionHub-angular)

[Flask Image Generator Repository](https://github.com/r0zh/VisionHub-flask-images)

[Flask Model Generator Repository](https://github.com/r0zh/VisionHub-flask-models)


## Despliegue de la aplicación (temporalmente apagado para ahorrar recursos)
[VisionHub (laravel)](http://laravelloadbalancer-1094644412.us-east-1.elb.amazonaws.com)

[VisionHub (angular)](http://angularloadbalancer-1607106454.us-east-1.elb.amazonaws.com)


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

-   **Usuario**: email: [johndoe@gmail.com](mailto:johndoe@gmail.com), contraseña: password, rol: usuario
-   **Moderador**: email: [janedoe@gmail.com](mailto:janedoe@gmail.com), contraseña: password, rol: moderador
-   **Admin**: email: [admin@admin.com](mailto:admin@admin.com), contraseña: password, rol: admin

### Páginas Principales

-   **Generate**: Crea imagenes con inteligencia artificial
-   **Upload**: Para subir una nueva foto.
-   **Gallery**: Muestra la galería personal del usuario.
-   **Community**: Visualiza todas las fotos públicas, incluyendo las del usuario.
-   **Admin**: Acceso a todas las fotos, públicas y privadas, para moderadores y administradores.
-   **Profile**: Permite editar el perfil del usuario.

## Esquema de la base de datos
![EN](https://github.com/r0zh/VisionHub/assets/32245814/c76699a5-608b-4338-bc01-7f4c7f549087)
![image](https://github.com/r0zh/VisionHub/assets/32245814/264affa0-cd6b-49e6-9cbe-4b1d2ad33c07)

### CheckPoint
[Video](https://drive.google.com/file/d/1GPy1Gv4cX6CCfkl943jLvkfbpGoQ8JoE/view?usp=sharing)

### Figma
[Dev Mode Model](https://www.figma.com/design/aEFF26799mmBetGKZAb16l/VisionHub-Langing?m=dev&node-id=0-1&t=04fA0WBxkUMyFb8W-1)
