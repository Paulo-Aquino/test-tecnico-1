# Codys Test - Formulario de contacto
El proyecto esta sobre laravel 8 utiliza como base de datos mysql , es un sistema simple que administra colaboradores cargados en un formulario de contacto

>Requisitos del sistema

* PHP >= 7.3
* BCMath PHP Extension
* Ctype PHP Extension
* Fileinfo PHP Extension
* JSON PHP Extension
* Mbstring PHP Extension
* OpenSSL PHP Extension
* PDO PHP Extension
* Tokenizer PHP Extension
* XML PHP Extension
* Maria DB mysql
* Composer
* php.ini configurado para max_upload de 10MB

>Pasos para instalar

1. Descargar el repositorio
2. Abrir la terminal y ejecutar el comando   
    composer install    
    cp .env.example .env    
    php artisan key:generate    
3. Crear base de datos en MySQL
4. Configurar las credenciaes de base de datos en el archivo .env
5. Ejecutar el comando para migrar tablas php artisan migrate --seed
6. Ejecutar el comando para crear carpeta de imagen php artisan storage:link