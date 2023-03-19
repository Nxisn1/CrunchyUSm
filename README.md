# CrunchyUsm
Tarea 2 INF239 (BBDD) USM


Correcta ejecución:
	- Activar los servicios de 'Apache' y 'MySQL' de XAMPP.
	- En el navegador de su preferencia: 'http://localhost/phpmyadmin', luego importar base de datos a phpmyadmin.
	- En una nueva pestaña: 'http://localhost/PHP/index.php'.
	- Ingresar con los datos de administrador; Rol:2020*****-*, Contraseña:admin, o registrarse.
	- Navegar por CrunchyUSM,

Correciones:
	- Se creó una nueva tabla, llamada 'Generos'. Por lo tanto, 'Generos' como atributo de 'Animes/Peliculas' ya no existe. Esta tabla contiene todos los géneros que pueden tener el contenido.
	- Se eliminó la tabla 'Super_Users' y se agrego el atributo 'Suser' a 'usuarios', el cual es un booleano que indica si el usuario es administrador o no.
	- Se eliminó el atributo 'Puntuacion' de las tablas 'opiniones_anime' y 'opiniones_pelicula'. Se agregó el atributo 'puntuacion' a 'animes/peliculas', el cual contiene el promedio de las puntuaciones que ha tenido el anime/película,
		junto a otro atributo 'aux', el cual lleva la cuenta de cuántas actualizaciones ha tenido el anime/película en el campo 'puntuacion'.
	- Se creó una nueva tabla llamada 'valo_anime' y 'valo_pelicula', las cuales sirven para el control de puntuación, es decir que un usuario no pueda agregar más de una puntuacón por anime/película, sino que solo la pueda
		actualizar.

Triggers:
	- En tabla  animes se creó el trigger 'agregar_generoA'. Cada vez que se agregue un nuevo anime, este agregará el identificador del anime a la tabla 'generos_anime'.
	- En tabla  peliculas se creó el trigger 'agregar_generoP'. Cada vez que se agregue una nueva  película, este agregará el identificador de la película a la tabla 'generos_pelicula'.
	- En tabla  'animes' se creó el trigger 'delete_generoA'. Cada vez que se elimine un anime de 'animes', el trigger también lo eliminará de la tabla 'generos_anime'. Se creó su equivalente para la tabla 'peliculas' 

Conjeturas:
	- Primero se agrega el anime/película para luego seleccionarla y agregar las etiquetas de género que corresponda, las cuales solamente se pueden actualizar.
	- En la sección 3. Descripción del problema; Como en el punto cinco de Perfil está incompleto, se asume que únicamente se debe poder acceder al historial del usuario que tiene la sesión activa y de nadie más.
	- No se puede 'desver' un anime o película.
	- Solamente se puede crear una lista de anime, que es la de favoritos. Igualmente para películas.

Aclaraciones:
	- Me di cuenta que en varios casos se podía crear una sola tabla para los animes y películas, por ejemplo con la tabla de 'generos', sin embargo preferí seguir mi modelo e idea principal de hacerlo todo separado, a pesar de que 
		sea más eficiente juntas.
	- Algunas tildes fueron omitidas a propósito
	- Para administrar el contenido es necesario ser Administrador, es decir 'Suser = 1' en la base de datos. Al ser administrador deja de estar oculto la sección 'Administrar' en la aplicación web.
	- La base de datos se llama 'crunchyusm', por razones de entrega se modificó el nombre del archivo sql de la carpeta 'BD' a 'CrunchyUSM'. Puede generar algún error, de ser así cambiarle el nombre.
