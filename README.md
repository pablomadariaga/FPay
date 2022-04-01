# Configuración del proyecto

De acuerdo a los requerimientos de la prueba para desarrollo practico en el proceso de selección, estos son los puntos a seguir para la configuración del proyecto.

-   Se asume como primer punto que apache, mysql y php ya han sido instalados y configurados en el servidor.
-   Instalar composer de manera global para nuestro sistema operativo.
-   Clonar el repositorio al servidor donde correremos nuesta aplicación.
-   Configurar el archivo con las variables de entorno para nuestra aplicación.
-   Instalar las dependencias del proyecto.

## Instalar composer

En el siguiente enlace podemos encontrar una guía completa sobre la instalación y configuración de Composer en nuestro S.O de manera global [composer](https://getcomposer.org/doc/00-intro.md).

### Clonar repositorio
Copiamos el repositorio al root de nuestro servidor apache, _folder_ puede ser cualquier denominación sin caracteres especiales.

-   git clone https://gitlab.com/eyler/fspay _folder_
-   Ahora ingresamos a nuestra carpeta **fspay**, de aquí en adelante los pasos a seguir son dentro de esta ruta

## Configurar .env

Después de clonar nuestro repositorio, accedemos a nuestro proyecto desde la terminal, luego debemos duplicar el archivo **.env.example** con el nombre del nuevo archivo igual a **.env** y configurar las siguientes variables.

-   comando: cp .env.example .env
-   variables
    1. APP_NAME = 'El nombre que queramos para el proyecto'
    1. APP_URL = 'Url o IP designada para correr el proyecto'
    1. DB_HOST = HOST para nuestro servidor mysql
    1. DB_PORT = PUERTO para nuestro servidor mysql
    1. DB_DATABASE = Nombre de la base de datos que creamos
    1. DB_USERNAME = Nombre de usuario de mysql
    1. DB_PASSWORD = Si el usuario tiene contraseña
    1. USER_API_HOST = 'Url de la api que gestiona los usuarios'
    1. APP_LANG = 'El lenguaje inicial que se quiere en la aplicación'

## Dependencias

Ejecute los siguientes comandos desde la consola dentro de nuestra carpeta raiz del proyecto para instalar todas las dependecias de php.

-   composer i
-   php artisan config:cache
-   php artisan key:generate


    **Para finalizar corremos el servidor**
-   _php artisan serve_ , este comando no es necesario si tenemos un servidor para descubrir nuestras aplicaciones automaticamente, simplemente accedemos a la url configurada en nuestro servidor para la aplicación

Ahora puede acceder a la aplicación *FsPay*, por medio de la ip o url designada.

Cualquier duda sobre la configuración del proyecto, puede comunicarse conmigo por medio de correo electrónico o celular. 
**3146199466**
[juanpablomadariagacardona@gmail.com](mailto:mailjuanpablomadariagacardona@gmail.com)
