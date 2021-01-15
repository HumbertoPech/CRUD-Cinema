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