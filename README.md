# CRUD CINEMA 🚀
Se trata de simular unas pocas funcionalidades de un cine, en el que se puedan guardar películas, actores y directores de cine.
Este pequeño CRUD contiene lo siguiente siguientes modelos:

### Movie
Correspondiente a la entidad Película, en ella se guardan datos como: nombre, sinopsis, fecha de lanzamiento, país de origen y una imagen de su portada.

### Actor
Corresponde a la entidad Actor, en ella se guardan datos como: nombre, biografía, fecha de nacimiento y país de origen.

### FilmDirector
Corresponde a la entidad Director de cine, en ella se guardan datos como: nombre, biografía, fecha de nacimiento y país de origen.


Las relaciones consisten en:
### Movie <---> Actor
Esta relación hace referencia a que, 1 película tienen varios actores y que, 1 actor puede estar en varias películas.

### Movie <---> FilmDirector
Esta relación hace referencia a que, 1 película tienen varios directores de cine y que, 1 director puede dirigir varias películas.

## Set-Up
Se deberá renombrar el archivo .env.example por .env y se deberán agregar las credenciales de la base de datos correspondiente (MySQL).
Una vez creado este archivo y teniendo la base de datos en el sistema, se deberá correr el siguiente comando estando en la raíz del proyecto:
php artisan migrate.

También se puede setear manualmente la BD. Siguiendo los paso anteriores hasta antes de correr el comando en la línea de comandos. 
En este caso se debe importar el SQL: crud_laravel-BD.sql (este archivo se encuentra en la raíz del proyecto) a la base de datos creada.
