# <h1 align="center">  :ocean:  API REST DE CRUCEROS Y TOURS  :ocean: </h1>

## ÍNDICE
1. [Introducción](#Introducción)
	1. 	[Descripción de la API](#Descripción)
	2. 	[URL Base](#URL)

2. [Recursos Disponibles](#Recursos-Disponibles)
	1. [Cruceros](#Cruceros)
		1. [Métodos admitidos: GET, POST](#m%C3%A9todos-admitidos-get-post)
  		2. [Métodos admitidos: GET, DELETE, PUT](#m%C3%A9todos-admitidos-get-delete-put)
	1. [Tours](#Tours)
    	1. [Métodos admitidos: GET, POST](#tours-m%C3%A9todos-admitidos-get-post)
        2. [Métodos admitidos: GET, DELETE, PUT](#tours-m%C3%A9todos-admitidos-get-delete-put)
3.[Autenticación y autorización](#-autenticaci%C3%B3n-y-autorizaci%C3%B3n-)

3. [CRUD de Cruceros](#crud-de-cruceros)
	1. [Obtener todos los cruceros](#obtener-todos-los-cruceros-(get-cruceros))
 	3. 	[Filtrar cruceros](#filtrado-de-cruceros)
  	4. 	[Ordenar cruceros](#ordenamiento-de-cruceros)
   	5. 	[Paginar cruceros](#paginaci%C3%B3n-de-cruceros)
   	6. 	[Obtener un crucero específico](#obtener-un-crucero-espec%C3%ADfico)
	7. 	[Agregar un nuevo crucero](#agregar-un-nuevo-crucero)
	8. 	[Actualizar un crucero existente](#actualizar-un-crucero-existente)
	9. 	[Eliminar un crucero](#eliminar-un-crucero)

4. [CRUD de Tours](#crud-de-tours)
	1. 	[Obtener todos los tours](#obtener-todos-los-tours)
 	2. 	[Filtrar Tours](#filtrado-de-tours)
  	4. 	[Ordenar Tours](#ordenamiento-de-tours)
   	5. 	[Paginar Tours](#paginaci%C3%B3n-de-tours)
	3. 	[Obtener un tour específico](#obtener-un-tour-espec%C3%ADfico)
	4. 	[Agregar un nuevo tour](#agregar-un-nuevo-tour)
	5. 	[Actualizar un tour existente](#actualizar-un-tour-existente)
	6. 	[Eliminar un tour](#eliminar-un-tour)


5. [Tabla de ruteo](#tabla-de-ruteo)

6. [Ejemplos de Uso](#ejemplos-de-uso)
7. [Relación entre Cruceros y Tours](#-relaci%C3%B3n-entre-cruceros-y-tours)

8. [Conclusiones](#conclusiones)

---------------------------------------------------------------

## <h2 align="center"> Introducción</h2>
### Descripción
La API RESTful proporciona acceso a recursos relacionados con cruceros y tours para una aplicación de turismo marítimo. La aplicación permite administrar información sobre cruceros y los tours asociados a cada crucero. Los cruceros pueden tener múltiples tours asignados, mientras que un tour solo puede estar asociado a un crucero.
### URL

La URL base de la API es:
`http://<dominio>:<puerto>/ruta/cruceros_api/`

------------------------------------

## <h2 align="center"> Recursos Disponibles</h2>
-----------------------------------------
### Cruceros

#### **Ruta:**
`/cruceros`


#### **Métodos admitidos: GET, POST**

**Descripción**: Este recurso permite obtener una lista de todos los cruceros o agregar un nuevo crucero.

--------
#### **Ruta:**
`/cruceros/:ID`

#### **Métodos admitidos: GET, DELETE, PUT**

 **Descripción:** Este recurso permite obtener información sobre un crucero específico, eliminar un crucero o actualizar los detalles de un crucero existente.

-----------------------

### Tours

#### **Ruta:**
`/tours`

#### **Tours. Métodos admitidos: GET, POST**

**Descripción:** Este recurso permite obtener una lista de todos los tours o agregar un nuevo tour.

---------
#### **Ruta:**
`/tours/:ID`


#### **Tours. Métodos admitidos: GET, DELETE, PUT**

**Descripción:** Este recurso permite obtener información sobre un tour específico, eliminar un tour o actualizar los detalles de un tour existente.

----------------------------

## <h2 align="center"> Autenticación y Autorización </h2>

La API utiliza un mecanismo de autenticación basado en tokens para asegurar el acceso a los recursos protegidos. Cada solicitud a la API debe incluir un encabezado Authorization con el valor del token de acceso.

El token de acceso se obtiene mediante el siguiente endpoint:
`POST /usuarios`
Enviando las credenciales de usuario (nombre de usuario y contraseña) en el cuerpo de la solicitud. Si las credenciales son válidas, se devuelve un token de acceso que debe utilizarse en las solicitudes posteriores.
###### Ruta para obtener el token: 
`POST /usuarios`
###### Cuerpo de la solicitud:
    {
	    "nombre_usuario":"admin@admin.com",
	    "password":"admin"
    }
###### Respuesta:

    {
		"token":"eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOjEsImlhdCI6MTY4ODQ5MTI3NSwiZXhwIjoxNjg4NDkzMDc1LCJkYXRhIjoiYWRtaW5AYWRtaW4uY29tIn0=.AlnKx38bPmhtVsZ4e4MEI32WD+z4IFAr8sBvAvvxksc="
    }

##### Uso del Token de Acceso

Una vez que hayas obtenido el token de acceso, debes incluirlo en el encabezado Authorization indicando el tipo `Bearer Token` de todas tus solicitudes a los recursos protegidos.

--------------------
## <h2 align="center"> CRUD de Cruceros</h2>

----------------------------

### Obtener todos los cruceros (GET /cruceros)

##### Descripción:
Este método permite obtener una lista de todos los cruceros disponibles.
##### Ruta:
`GET /cruceros`

------------------------

### Filtrado de cruceros
##### Ruta genérica para filtrar:
`cruceros?filtrar=filtrar&valor=valor`

En la ruta generica para filtrado, se deben reemplazar los valores de "filtrar" por el nombre de la columna de la base de datos por la que se quieran filtrar los cruceros (ID, nombre, compania, capacidad y origen). Y el valor "valor" por el valor que debe tomar el atributo para ser mostrado en el filtro
##### Parámetros de filtrado
###### Filtro por nombre: 
    `cruceros?filtrar=nombre&valor=Oasis`
###### Devuelve:
    {
        "ID": 16,
        "nombre": "Oasis",
        "compania": "Oceanic Cruises",
        "capacidad": 4004,
        "origen": "Seattle",
        "img1": "https://a.travel-assets.com/flex/flexmanager/images/2019/11/25/SLP_Hero_cNC-sBL.jpg",
        "img2": "https://assets3.thrillist.com/v1/image/2764645/792x529/scale;webp=auto;jpeg_quality=60;progressive.jpg",
        "descripcion": "El Oasis es un crucero de Norwegian Cruise Line, que entró en servicio el 21 de abril de 2018. El barco fue construido por Meyer Werft en Papenburg, Alemania",
        "detalles": "El Oasis es un crucero de lujo perteneciente a la flota de Norwegian Cruise Line. Inaugurado en 2018, este magnífico barco ha sido diseñado para ofrecer una experiencia de vacaciones inigualable a bordo. Con su elegante diseño, comodidades de última generación y una amplia variedad de entretenimiento, el Norwegian Bliss es una opción perfecta para aquellos que buscan lujo y diversión en alta mar.\n\nCon una longitud de aproximadamente 333 metros, el Norwegian Bliss tiene capacidad para albergar a más de 4,000 pasajeros en ocupación doble. Cada rincón del barco ha sido cuidadosamente diseñado para proporcionar confort y estilo a los viajeros exigentes.\n\nEl Norwegian Bliss cuenta con una gran variedad de restaurantes de alta calidad que ofrecen opciones gastronómicas para todos los gustos. Desde platos internacionales hasta especialidades locales, los comensales pueden deleitarse con una amplia selección de sabores y experiencias culinarias. Además, el barco cuenta con bares y salones temáticos donde los pasajeros pueden disfrutar de cócteles exquisitos y música en vivo.\n\nPara los amantes del entretenimiento, el Norwegian Bliss ofrece una amplia gama de actividades y espectáculos. Desde musicales y producciones teatrales de Broadway hasta conciertos en vivo y clubes nocturnos, hay algo para todos los gustos. También hay opciones de entretenimiento al aire libre, como una pista de carreras de karting y un parque acuático con toboganes emocionantes.\n\nEl bienestar y la relajación son aspectos fundamentales en el Norwegian Bliss. Cuenta con un spa de lujo donde los pasajeros pueden disfrutar de tratamientos rejuvenecedores y relajantes. También hay una variedad de piscinas, jacuzzis y áreas de descanso para disfrutar del sol y la brisa marina.\n\nEn cuanto al alojamiento, el Norwegian Bliss ofrece una amplia selección de camarotes, desde acogedores camarotes interiores hasta amplias suites con balcón privado. Cada camarote ha sido diseñado con atención al detalle y cuenta con comodidades modernas para asegurar una estancia confortable.\n\nEn resumen, el Norwegian Bliss es un crucero de lujo que combina comodidades modernas, opciones gastronómicas de primera clase y entretenimiento de alta calidad. Con su estilo elegante y su ambiente relajado, ofrece a los pasajeros una experiencia inolvidable en alta mar. Ya sea que estés buscando relajarte, disfrutar de la buena comida o divertirte con actividades emocionantes, el Norwegian Bliss tiene todo lo que necesitas para unas vacaciones inolvidables."
    }
###### Filtro por compañia: 
    `cruceros?filtrar=compania&valor=Oasis`
###### Devuelve:
Este filtro aplicado devolverá todos los cruceros que tengan como compañía a Oasis, en este caso en uno solo.

    {
        "ID": 1,
        "nombre": "Oasis of the Seas",
        "compania": "Royal",
        "capacidad": 5400,
        "origen": "Miami",
        "img1": "https://www.ship-technology.com/wp-content/uploads/sites/8/2021/04/Image_1-Oasis_of_the_Seas1.jpg",
        "img2": "https://media-cdn.tripadvisor.com/media/photo-m/1280/15/3b/2f/64/cc-oasis-of-the-seas.jpg",
        "descripcion": "El Oasis of the Seas es un crucero de la clase Oasis perteneciente a la empresa naviera Royal Caribbean International. Su construcción finalizó en septiembre de 2009, en los astilleros de la empresa STX Europe",
        "detalles": "El Oasis of the Seas es uno de los cruceros más emblemáticos y populares del mundo. Es parte de la clase Oasis de barcos de Royal Caribbean International, conocida por su tamaño impresionante y sus innovadoras instalaciones a bordo. Con su diseño revolucionario, el Oasis of the Seas ofrece una experiencia de crucero inigualable.\r\n\r\nConstruido en 2009, el Oasis of the Seas cuenta con una longitud de aproximadamente 361 metros y puede albergar a más de 5,400 pasajeros en ocupación doble. Este gigante de los mares ofrece una amplia variedad de opciones de entretenimiento, actividades y servicios para satisfacer los gustos y necesidades de todos los huéspedes.\r\n\r\nA bordo del Oasis of the Seas, encontrarás una gran cantidad de características destacadas. El barco cuenta con una zona de paseo central llamada \"Central Park\", que está lleno de exuberantes jardines, restaurantes y tiendas. También puedes disfrutar de emocionantes atracciones como el \"Aquatheater\", un anfiteatro acuático donde se presentan espectáculos de alta calidad con acróbatas y saltadores profesionales.\r\n\r\nEl barco cuenta con una amplia selección de restaurantes que ofrecen opciones gastronómicas para todos los gustos, desde restaurantes de especialidades hasta bufés informales. Además, cuenta con diversas piscinas y jacuzzis, un parque acuático, paredes de escalada, pista de patinaje sobre hielo, casino, teatro, discoteca, spa y gimnasio totalmente equipado.\r\n\r\nLas cabinas a bordo del Oasis of the Seas son modernas, elegantes y cómodas, brindando un espacio privado para relajarse después de un día lleno de actividades. Desde acogedoras cabinas interiores hasta lujosas suites con balcón, hay opciones de alojamiento para satisfacer las necesidades de todos los pasajeros.\r\n\r\nEn resumen, el Oasis of the Seas es un barco extraordinario que ofrece una experiencia de crucero incomparable. Con su tamaño impresionante, innovadoras instalaciones y una amplia gama de opciones de entretenimiento, este crucero de Royal Caribbean es perfecto para aquellos que buscan una aventura inolvidable en alta mar."
    }
###### Filtro por capacidad: 
    `cruceros?filtrar=capacidad&valor=2000`
###### Devuelve:
Este filtro aplicado devolverá todos los cruceros que tengan como capacidad a 2000 tripulantes.

    {
        "ID": 5,
        "nombre": "Norwegian Bliss",
        "compania": "Norwegian Cruise Line",
        "capacidad": 2000,
        "origen": "Seattle",
        "img1": "https://a.travel-assets.com/flex/flexmanager/images/2019/11/25/SLP_Hero_cNC-sBL.jpg",
        "img2": "https://assets3.thrillist.com/v1/image/2764645/792x529/scale;webp=auto;jpeg_quality=60;progressive.jpg",
        "descripcion": "El Norwegian Bliss es un crucero de Norwegian Cruise Line, que entró en servicio el 21 de abril de 2018. El barco fue construido por Meyer Werft en Papenburg, Alemania",
        "detalles": "El Norwegian Bliss es un crucero de lujo perteneciente a la flota de Norwegian Cruise Line. Inaugurado en 2018, este magnífico barco ha sido diseñado para ofrecer una experiencia de vacaciones inigualable a bordo. Con su elegante diseño, comodidades de última generación y una amplia variedad de entretenimiento, el Norwegian Bliss es una opción perfecta para aquellos que buscan lujo y diversión en alta mar.\n\nCon una longitud de aproximadamente 333 metros, el Norwegian Bliss tiene capacidad para albergar a más de 4,000 pasajeros en ocupación doble. Cada rincón del barco ha sido cuidadosamente diseñado para proporcionar confort y estilo a los viajeros exigentes.\n\nEl Norwegian Bliss cuenta con una gran variedad de restaurantes de alta calidad que ofrecen opciones gastronómicas para todos los gustos. Desde platos internacionales hasta especialidades locales, los comensales pueden deleitarse con una amplia selección de sabores y experiencias culinarias. Además, el barco cuenta con bares y salones temáticos donde los pasajeros pueden disfrutar de cócteles exquisitos y música en vivo.\n\nPara los amantes del entretenimiento, el Norwegian Bliss ofrece una amplia gama de actividades y espectáculos. Desde musicales y producciones teatrales de Broadway hasta conciertos en vivo y clubes nocturnos, hay algo para todos los gustos. También hay opciones de entretenimiento al aire libre, como una pista de carreras de karting y un parque acuático con toboganes emocionantes.\n\nEl bienestar y la relajación son aspectos fundamentales en el Norwegian Bliss. Cuenta con un spa de lujo donde los pasajeros pueden disfrutar de tratamientos rejuvenecedores y relajantes. También hay una variedad de piscinas, jacuzzis y áreas de descanso para disfrutar del sol y la brisa marina.\n\nEn cuanto al alojamiento, el Norwegian Bliss ofrece una amplia selección de camarotes, desde acogedores camarotes interiores hasta amplias suites con balcón privado. Cada camarote ha sido diseñado con atención al detalle y cuenta con comodidades modernas para asegurar una estancia confortable.\n\nEn resumen, el Norwegian Bliss es un crucero de lujo que combina comodidades modernas, opciones gastronómicas de primera clase y entretenimiento de alta calidad. Con su estilo elegante y su ambiente relajado, ofrece a los pasajeros una experiencia inolvidable en alta mar. Ya sea que estés buscando relajarte, disfrutar de la buena comida o divertirte con actividades emocionantes, el Norwegian Bliss tiene todo lo que necesitas para unas vacaciones inolvidables."
    },
    {
        "ID": 14,
        "nombre": "Crucero del Mar",
        "compania": "Oceanic Cruises",
        "capacidad": 2000,
        "origen": "Miami, Estados Unidos",
        "img1": "https://cf.bstatic.com/xdata/images/hotel/max1024x768/226433525.jpg?k=bf571ea6d4b18c09bab955c4e7488166706f146e551b37aa3c1714716e2da7bc&o=&hp=1",
        "img2": "https://i.ytimg.com/vi/VNNblqthOQA/maxresdefault.jpg",
        "descripcion": "Disfruta de unas vacaciones inolvidables en nuestro lujoso crucero. Explora destinos exóticos y relájate en nuestras modernas instalaciones.",
        "detalles": "Nuestro crucero del Mar es el epítome del lujo y la comodidad. Con una amplia gama de servicios y comodidades, te garantizamos unas vacaciones inolvidables. Nuestro amable personal estará encantado de atenderte y asegurarse de que disfrutes de cada momento a bordo. Disfruta de las impresionantes vistas al mar desde tu camarote, relájate en nuestras piscinas de lujo o disfruta de una deliciosa cena en nuestros restaurantes de clase mundial. Además, ofrecemos una variedad de actividades y entretenimiento a bordo, desde espectáculos en vivo hasta clases de cocina y actividades para toda la familia. ¡No te pierdas la oportunidad de vivir una experiencia inigualable en nuestro Crucero del Mar!"
    }
###### Filtro por origen: 
    `cruceros?filtrar=origen&valor=Miami`
###### Devuelve:
Este filtro aplicado devolverá todos los cruceros que tengan como origen a Miami.

    {
        "ID": 1,
        "nombre": "Oasis of the Seas",
        "compania": "Royal",
        "capacidad": 5400,
        "origen": "Miami",
        "img1": "https://www.ship-technology.com/wp-content/uploads/sites/8/2021/04/Image_1-Oasis_of_the_Seas1.jpg",
        "img2": "https://media-cdn.tripadvisor.com/media/photo-m/1280/15/3b/2f/64/cc-oasis-of-the-seas.jpg",
        "descripcion": "El Oasis of the Seas es un crucero de la clase Oasis perteneciente a la empresa naviera Royal Caribbean International. Su construcción finalizó en septiembre de 2009, en los astilleros de la empresa STX Europe",
        "detalles": "El Oasis of the Seas es uno de los cruceros más emblemáticos y populares del mundo. Es parte de la clase Oasis de barcos de Royal Caribbean International, conocida por su tamaño impresionante y sus innovadoras instalaciones a bordo. Con su diseño revolucionario, el Oasis of the Seas ofrece una experiencia de crucero inigualable.\r\n\r\nConstruido en 2009, el Oasis of the Seas cuenta con una longitud de aproximadamente 361 metros y puede albergar a más de 5,400 pasajeros en ocupación doble. Este gigante de los mares ofrece una amplia variedad de opciones de entretenimiento, actividades y servicios para satisfacer los gustos y necesidades de todos los huéspedes.\r\n\r\nA bordo del Oasis of the Seas, encontrarás una gran cantidad de características destacadas. El barco cuenta con una zona de paseo central llamada \"Central Park\", que está lleno de exuberantes jardines, restaurantes y tiendas. También puedes disfrutar de emocionantes atracciones como el \"Aquatheater\", un anfiteatro acuático donde se presentan espectáculos de alta calidad con acróbatas y saltadores profesionales.\r\n\r\nEl barco cuenta con una amplia selección de restaurantes que ofrecen opciones gastronómicas para todos los gustos, desde restaurantes de especialidades hasta bufés informales. Además, cuenta con diversas piscinas y jacuzzis, un parque acuático, paredes de escalada, pista de patinaje sobre hielo, casino, teatro, discoteca, spa y gimnasio totalmente equipado.\r\n\r\nLas cabinas a bordo del Oasis of the Seas son modernas, elegantes y cómodas, brindando un espacio privado para relajarse después de un día lleno de actividades. Desde acogedoras cabinas interiores hasta lujosas suites con balcón, hay opciones de alojamiento para satisfacer las necesidades de todos los pasajeros.\r\n\r\nEn resumen, el Oasis of the Seas es un barco extraordinario que ofrece una experiencia de crucero incomparable. Con su tamaño impresionante, innovadoras instalaciones y una amplia gama de opciones de entretenimiento, este crucero de Royal Caribbean es perfecto para aquellos que buscan una aventura inolvidable en alta mar."
    },
    {
        "ID": 14,
        "nombre": "Crucero del Mar",
        "compania": "Oceanic Cruises",
        "capacidad": 2000,
        "origen": "Miami",
        "img1": "https://cf.bstatic.com/xdata/images/hotel/max1024x768/226433525.jpg?k=bf571ea6d4b18c09bab955c4e7488166706f146e551b37aa3c1714716e2da7bc&o=&hp=1",
        "img2": "https://i.ytimg.com/vi/VNNblqthOQA/maxresdefault.jpg",
        "descripcion": "Disfruta de unas vacaciones inolvidables en nuestro lujoso crucero. Explora destinos exóticos y relájate en nuestras modernas instalaciones.",
        "detalles": "Nuestro crucero del Mar es el epítome del lujo y la comodidad. Con una amplia gama de servicios y comodidades, te garantizamos unas vacaciones inolvidables. Nuestro amable personal estará encantado de atenderte y asegurarse de que disfrutes de cada momento a bordo. Disfruta de las impresionantes vistas al mar desde tu camarote, relájate en nuestras piscinas de lujo o disfruta de una deliciosa cena en nuestros restaurantes de clase mundial. Además, ofrecemos una variedad de actividades y entretenimiento a bordo, desde espectáculos en vivo hasta clases de cocina y actividades para toda la familia. ¡No te pierdas la oportunidad de vivir una experiencia inigualable en nuestro Crucero del Mar!"
    }

-------------------

### Ordenamiento de cruceros

##### Ruta genérica para ordenar:
`cruceros?criterio=criterio&orden=orden`

En la ruta generica para ordenar los resultados, se deben reemplazar los valores de "criterio" por el nombre de la columna de la base de datos por la que se quieran ordenar los cruceros (ID, nombre, compania, capacidad y origen). Y el valor "orden" por "asc" para mostrar los resultados en orden ascendente o por "desc" para mostrar los resultados por orden descendente. Si no se especifica el parámetro "orden", por defecto se ordenan de manera ascendente.
##### Parámetros de ordenado


###### Ordenar por nombre: 
    `cruceros?criterio=nombre&orden=asc`
###### Devuelve:
Este endpoint devuelve todos los cruceros ordenados alfabeticamente por el nombre de manera ascendente.

###### Ordenar por compañía: 
    `cruceros?criterio=compania&orden=asc`
###### Devuelve:
Este endpoint devuelve todos los cruceros ordenados alfabeticamente por la compañía a la que pertenecen de manera ascendente:

###### Ordenar por capacidad: 
    `cruceros?criterio=capacidad`
###### Devuelve:
Este endpoint devuelve todos los cruceros ordenados por la capacidad de tripulantes de manera ascendente:

###### Ordenar por origen: 
    `cruceros?criterio=origen&orden=desc`
###### Devuelve:
Este endpoint devuelve todos los cruceros ordenados alfabeticamente por el origen de donde parte el crucero de manera descendente:

-----------
### Paginación de cruceros
##### Ruta genérica para paginar:
`cruceros?pagina=pagina&filas=filas`

En la ruta generica para paginar los resultados, se deben reemplazar los valores de "pagina" por el número de página que se quiera ver. Y el valor "filas" por la cantidad de elementos que se quieran mostrar por cada pagina. Tanto el valor de pagina como el de filas deben ser valores numéricos, no puede ser negativos y deben ser números enteros.

##### Parámetros de paginación
###### Ejemplo 1: 
    `cruceros?pagina=1&filas=5`
###### Devuelve:
Este endpoint devuelve los cruceros paginados de a 5, y muestra la primera página, es decir, los primeros 5 cruceros.
###### Ejemplo 2: 
    `cruceros?pagina=2&filas=5`
###### Devuelve:
Este endpoint devuelve los cruceros paginados de a 5, y muestra la segunda página, es decir, los elementos desde el quinto hasta el décimo.
###### Ejemplo 3: 
    `cruceros?pagina=1&filas=3`
###### Devuelve:
Este endpoint devuelve los cruceros paginados de a 3, y muestra la primera página, es decir, los primeros 3 elementos.


-------------------
### Obtener un crucero específico
##### Descripción:
Este método permite obtener información detallada sobre un crucero específico.
##### Ruta:
`GET /cruceros/:ID`

---------------------------

### Agregar un nuevo crucero
##### Descripción:
Este método permite agregar un nuevo crucero.
##### Ruta:
`POST /cruceros`

---------------------------

### Actualizar un crucero existente
##### Descripción:
Este método permite actualizar los detalles de un crucero existente.
##### Ruta:
`PUT /cruceros/:ID`

-----------------------------

### Eliminar un crucero
##### Descripción:
Este método permite eliminar un crucero específico.
##### Ruta:
`DELETE /cruceros/:ID`

----------------------------------

## <h2 align="center"> CRUD de Tours</h2>

------------------

### Obtener todos los tours

##### Descripción:
Este método permite obtener una lista de todos los tours disponibles.
##### Ruta:
`GET /tours`

------------------------

### Filtrado de tours
##### Ruta genérica para filtrar:
`tours?filtrar=filtrar&valor=valor`
En la ruta generica para filtrado, se deben reemplazar los valores de "filtrar" por el nombre de la columna de la base de datos por la que se quieran filtrar los tours (ID, id_crucero, destino, fecha_salida, precio). Y el valor "valor" por el valor que debe tomar el atributo para ser mostrado en el filtro
##### Parámetros de filtrado
###### Filtro por id: 
    `tours?filtrar=ID&valor=1`
###### Devuelve:
       {
        "ID": 1,
        "id_crucero": 1,
        "destino": "Bahamas",
        "fecha_salida": "2023-06-01",
        "precio": 1200,
        "descripcion": "Embárcate en un emocionante crucero a las Bahamas y sumérgete en aguas cristalinas, playas de ensueño y una vibrante cultura caribeña. Disfruta de actividades acuáticas, relájate en paradisíacas playas y descubre su belleza tropical.",
        "img1": "https://w0.peakpx.com/wallpaper/288/293/HD-wallpaper-bahamas-ocean-bahamas-nature-sky-blue.jpg",
        "img2": "https://media-cdn.tripadvisor.com/media/photo-m/1280/15/3b/2f/64/cc-oasis-of-the-seas.jpg",
        "detalles": "El crucero Oasis of the Seas dispone de una variada oferta de entretenimiento a bordo protagonizada por un teatro, casino, discoteca, cine en 3D, biblioteca, sala de videojuegos, punto de internet, sala de cartas, oficina de excursiones, miniclub y área de shopping.\r\n\r\nEl Oasis of the Seas incluye 4 piscinas, 10 Jacuzzis, parque acuático para niños, solarium, spa y salón de belleza, área wellness, gimnasio, tirolina suspendida a nueve cubiertas de 25 m de largo, 2 simuladores de surf, pista de patinaje sobre hielo, 2 paredes de escalada de 13 m, simulador de golf, cancha de baloncesto, pista de jogging al aire libre, minigolf y dispone de instalaciones, clubs y zonas de entretenimiento para niños y jóvenes.\r\n\r\nAdemás cuenta con servicios de guardería.\r\n\r\nA bordo también hay actividades que se ajustas a todas las edades y gustos. Los niños de 6 a 18 meses podrán disfrutar con sus padres del programa Royal Babies & Royal Tots, los niños de 3 a 5 años se divertirán realizando geniales experimentos y se convertirán en pequeños aventureros de la ciencia. El programa Explorers (6 a 8 años de edad) está lleno de emocionantes actividades, desde fiestas temáticas hasta la fabricación de caramelos. Los Voyagers (9 a 11 años de edad) explorarán diversas actividades que le devuelven la diversión al aprendizaje.\r\n\r\nCon la experiencia Dreamworks los niños podrán compartir momentos inolvidables con los personajes de DreamWorks y disfrutar de entretenidas actividades como cuenta cuentos, fiestas de baile, desfiles y espectáculos de patinaje sobre hielo.\r\n\r\nLos adolescentes tendrán también sus propios espacios y una gran variedad de actividades.\r\n\r\nLa oferta de restauración a bordo del Oasis of the Seas incluye, entre otros, los siguientes restaurantes: el Restaurante principal, el restaurante 150 Central Park, Chops Grille, Bar Sabor Taquería & Tequila, Izumi Hibach y Sushi y el restaurante italiano Giovanni’s Table así como con 15 bares y salones."
    }
###### Filtro por crucero: 
    `tours?filtrar=id_crucero&valor=1`
###### Devuelve:
Este filtro aplicado devolverá todos los tours que tengan como crucero asociado a Oasis of the Seas, en este caso en uno solo.

      {
        "ID": 1,
        "id_crucero": 1,
        "destino": "Bahamas",
        "fecha_salida": "2023-06-01",
        "precio": 1200,
        "descripcion": "Embárcate en un emocionante crucero a las Bahamas y sumérgete en aguas cristalinas, playas de ensueño y una vibrante cultura caribeña. Disfruta de actividades acuáticas, relájate en paradisíacas playas y descubre su belleza tropical.",
        "img1": "https://w0.peakpx.com/wallpaper/288/293/HD-wallpaper-bahamas-ocean-bahamas-nature-sky-blue.jpg",
        "img2": "https://media-cdn.tripadvisor.com/media/photo-m/1280/15/3b/2f/64/cc-oasis-of-the-seas.jpg",
        "detalles": "El crucero Oasis of the Seas dispone de una variada oferta de entretenimiento a bordo protagonizada por un teatro, casino, discoteca, cine en 3D, biblioteca, sala de videojuegos, punto de internet, sala de cartas, oficina de excursiones, miniclub y área de shopping.\r\n\r\nEl Oasis of the Seas incluye 4 piscinas, 10 Jacuzzis, parque acuático para niños, solarium, spa y salón de belleza, área wellness, gimnasio, tirolina suspendida a nueve cubiertas de 25 m de largo, 2 simuladores de surf, pista de patinaje sobre hielo, 2 paredes de escalada de 13 m, simulador de golf, cancha de baloncesto, pista de jogging al aire libre, minigolf y dispone de instalaciones, clubs y zonas de entretenimiento para niños y jóvenes.\r\n\r\nAdemás cuenta con servicios de guardería.\r\n\r\nA bordo también hay actividades que se ajustas a todas las edades y gustos. Los niños de 6 a 18 meses podrán disfrutar con sus padres del programa Royal Babies & Royal Tots, los niños de 3 a 5 años se divertirán realizando geniales experimentos y se convertirán en pequeños aventureros de la ciencia. El programa Explorers (6 a 8 años de edad) está lleno de emocionantes actividades, desde fiestas temáticas hasta la fabricación de caramelos. Los Voyagers (9 a 11 años de edad) explorarán diversas actividades que le devuelven la diversión al aprendizaje.\r\n\r\nCon la experiencia Dreamworks los niños podrán compartir momentos inolvidables con los personajes de DreamWorks y disfrutar de entretenidas actividades como cuenta cuentos, fiestas de baile, desfiles y espectáculos de patinaje sobre hielo.\r\n\r\nLos adolescentes tendrán también sus propios espacios y una gran variedad de actividades.\r\n\r\nLa oferta de restauración a bordo del Oasis of the Seas incluye, entre otros, los siguientes restaurantes: el Restaurante principal, el restaurante 150 Central Park, Chops Grille, Bar Sabor Taquería & Tequila, Izumi Hibach y Sushi y el restaurante italiano Giovanni’s Table así como con 15 bares y salones."
    },
    {
        "ID": 3,
        "id_crucero": 1,
        "destino": "Jamaica",
        "fecha_salida": "2023-06-15",
        "precio": 1500,
        "descripcion": "Embárcate en un crucero a Jamaica y descubre sus playas, exquisita gastronomía y vibrante cultura reggae. Disfruta de actividades acuáticas, excursiones emocionantes y relájate en el paraíso caribeño mientras creas recuerdos inolvidables.",
        "img1": "https://cdn.pixabay.com/photo/2020/04/29/18/36/jamaica-5110094_1280.jpg",
        "img2": "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSkxwgTWaXOzJ3zUDpRl5VAv1_x5OyadocC_h6nVRnDv1AHjBlHOTmOs674PWvDGtJHsY0&usqp=CAU",
        "detalles": "Embárcate en un emocionante crucero hacia la hermosa isla de Jamaica. Disfruta de días de sol, maravillosas playas de arena blanca y un ambiente vibrante y relajado. Durante tu viaje, tendrás la oportunidad de explorar las maravillas naturales de Jamaica, desde las cascadas de Dunn's River hasta las increíbles montañas azules.\r\n\r\nSumérgete en la cultura jamaicana mientras visitas los pintorescos pueblos costeros y te deleitas con la deliciosa gastronomía local, como el jerk chicken y el ackee con saltfish. Descubre el ritmo contagioso del reggae mientras te adentras en la animada vida nocturna de Montego Bay o Negril, donde encontrarás música en vivo y coloridos mercados.\r\n\r\nDurante tu tiempo en tierra, puedes aventurarte en emocionantes excursiones, como practicar snorkel en los arrecifes de coral, explorar las misteriosas cuevas de Green Grotto, disfrutar de un paseo en bobsleigh en Mystic Mountain o relajarte en las paradisíacas playas de Ocho Ríos.\r\n\r\nA bordo del crucero, encontrarás una amplia gama de comodidades y entretenimiento para todos los gustos. Disfruta de restaurantes de clase mundial, bares y espectáculos en vivo. Relájate en las piscinas, disfruta de tratamientos de spa y participa en emocionantes actividades y deportes acuáticos.\r\n\r\nUn crucero a Jamaica ofrece la combinación perfecta de aventura, relajación y una inmersión en la rica cultura caribeña. Prepárate para crear recuerdos inolvidables mientras exploras esta increíble isla llena de belleza natural y hospitalidad jamaicana."
    },
    {
        "ID": 6,
        "id_crucero": 1,
        "destino": "Alaska",
        "fecha_salida": "2023-08-01",
        "precio": 1800,
        "descripcion": "Embárcate en un crucero de ensueño hacia Alaska y la costa oeste de Canadá. Explora glaciares majestuosos, paisajes impresionantes y encantadoras ciudades mientras disfrutas de la comodidad y la aventura a bordo",
        "img1": "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTeIZZi4GkJat0skjxUx6bs94npv6H0ZEnAc0lZ3La5-dLO3vcLVUNxMCq2qXh0SGq3cz4&usqp=CAU",
        "img2": "https://fotografias.lasexta.com/clipping/cmsimages01/2022/02/15/0B3AE943-53FB-494B-A9AF-CF2922B8B86A/imagen-archivo-iceberg-costa-terranova-canada_98.jpg?crop=1920,1080,x0,y102&width=1900&height=1069&optimize=low&format=webply",
        "detalles": "Embárcate en un extraordinario viaje hacia la fascinante belleza natural de Alaska y la cautivadora costa oeste de Canadá. Navega a través de los mares turquesa y maravíllate con los majestuosos glaciares que se alzan imponentes, deslumbrándote con su esplendor helado. Explora la diversidad de vida silvestre en su hábitat natural, desde ballenas juguetonas hasta osos grizzly poderosos. Adéntrate en pintorescas ciudades costeras como Vancouver, con su moderna arquitectura y vibrante cultura, y visita pequeñas comunidades llenas de encanto y tradiciones arraigadas. Disfruta de experiencias únicas, como caminar sobre el hielo en un glaciar o realizar excursiones en kayak rodeado de paisajes impresionantes. A bordo del crucero, deléitate con una variedad de opciones gastronómicas de clase mundial, entretenimiento emocionante y comodidades excepcionales que te harán sentir como en un resort flotante. Déjate llevar por la majestuosidad y la aventura mientras creas recuerdos inolvidables en este viaje único hacia el norte salvaje."
    },
    {
        "ID": 58,
        "id_crucero": 1,
        "destino": "Bahamassssssss",
        "fecha_salida": "2023-06-01",
        "precio": 1200,
        "descripcion": "Embárcate en un emocionante crucero a las Bahamas y sumérgete en aguas cristalinas, playas de ensueño y una vibrante cultura caribeña. Disfruta de actividades acuáticas, relájate en paradisíacas playas y descubre su belleza tropical.",
        "img1": "images/6494c718073b1.jpg",
        "img2": "images/6494c718074f5.jpg",
        "detalles": "El crucero Oasis of the Seas dispone de una variada oferta de entretenimiento a bordo protagonizada por un teatro, casino, discoteca, cine en 3D, biblioteca, sala de videojuegos, punto de internet, sala de cartas, oficina de excursiones, miniclub y área de shopping.\r\n\r\nEl Oasis of the Seas incluye 4 piscinas, 10 Jacuzzis, parque acuático para niños, solarium, spa y salón de belleza, área wellness, gimnasio, tirolina suspendida a nueve cubiertas de 25 m de largo, 2 simuladores de surf, pista de patinaje sobre hielo, 2 paredes de escalada de 13 m, simulador de golf, cancha de baloncesto, pista de jogging al aire libre, minigolf y dispone de instalaciones, clubs y zonas de entretenimiento para niños y jóvenes.\r\n\r\nAdemás cuenta con servicios de guardería.\r\n\r\nA bordo también hay actividades que se ajustas a todas las edades y gustos. Los niños de 6 a 18 meses podrán disfrutar con sus padres del programa Royal Babies & Royal Tots, los niños de 3 a 5 años se divertirán realizando geniales experimentos y se convertirán en pequeños aventureros de la ciencia. El programa Explorers (6 a 8 años de edad) está lleno de emocionantes actividades, desde fiestas temáticas hasta la fabricación de caramelos. Los Voyagers (9 a 11 años de edad) explorarán diversas actividades que le devuelven la diversión al aprendizaje.\r\n\r\nCon la experiencia Dreamworks los niños podrán compartir momentos inolvidables con los personajes de DreamWorks y disfrutar de entretenidas actividades como cuenta cuentos, fiestas de baile, desfiles y espectáculos de patinaje sobre hielo.\r\n\r\nLos adolescentes tendrán también sus propios espacios y una gran variedad de actividades.\r\n\r\nLa oferta de restauración a bordo del Oasis of the Seas incluye, entre otros, los siguientes restaurantes: el Restaurante principal, el restaurante 150 Central Park, Chops Grille, Bar Sabor Taquería & Tequila, Izumi Hibach y Sushi y el restaurante italiano Giovanni’s Table así como con 15 bares y salones."
    }
###### Filtro por destino: 
    `tours?filtrar=destino&valor=Bahamas`
###### Devuelve:
Este filtro aplicado devolverá todos los tours que tengan como destino a las Bahamas.

    {
        "ID": 1,
        "id_crucero": 1,
        "destino": "Bahamas",
        "fecha_salida": "2023-06-01",
        "precio": 1200,
        "descripcion": "Embárcate en un emocionante crucero a las Bahamas y sumérgete en aguas cristalinas, playas de ensueño y una vibrante cultura caribeña. Disfruta de actividades acuáticas, relájate en paradisíacas playas y descubre su belleza tropical.",
        "img1": "https://w0.peakpx.com/wallpaper/288/293/HD-wallpaper-bahamas-ocean-bahamas-nature-sky-blue.jpg",
        "img2": "https://media-cdn.tripadvisor.com/media/photo-m/1280/15/3b/2f/64/cc-oasis-of-the-seas.jpg",
        "detalles": "El crucero Oasis of the Seas dispone de una variada oferta de entretenimiento a bordo protagonizada por un teatro, casino, discoteca, cine en 3D, biblioteca, sala de videojuegos, punto de internet, sala de cartas, oficina de excursiones, miniclub y área de shopping.\r\n\r\nEl Oasis of the Seas incluye 4 piscinas, 10 Jacuzzis, parque acuático para niños, solarium, spa y salón de belleza, área wellness, gimnasio, tirolina suspendida a nueve cubiertas de 25 m de largo, 2 simuladores de surf, pista de patinaje sobre hielo, 2 paredes de escalada de 13 m, simulador de golf, cancha de baloncesto, pista de jogging al aire libre, minigolf y dispone de instalaciones, clubs y zonas de entretenimiento para niños y jóvenes.\r\n\r\nAdemás cuenta con servicios de guardería.\r\n\r\nA bordo también hay actividades que se ajustas a todas las edades y gustos. Los niños de 6 a 18 meses podrán disfrutar con sus padres del programa Royal Babies & Royal Tots, los niños de 3 a 5 años se divertirán realizando geniales experimentos y se convertirán en pequeños aventureros de la ciencia. El programa Explorers (6 a 8 años de edad) está lleno de emocionantes actividades, desde fiestas temáticas hasta la fabricación de caramelos. Los Voyagers (9 a 11 años de edad) explorarán diversas actividades que le devuelven la diversión al aprendizaje.\r\n\r\nCon la experiencia Dreamworks los niños podrán compartir momentos inolvidables con los personajes de DreamWorks y disfrutar de entretenidas actividades como cuenta cuentos, fiestas de baile, desfiles y espectáculos de patinaje sobre hielo.\r\n\r\nLos adolescentes tendrán también sus propios espacios y una gran variedad de actividades.\r\n\r\nLa oferta de restauración a bordo del Oasis of the Seas incluye, entre otros, los siguientes restaurantes: el Restaurante principal, el restaurante 150 Central Park, Chops Grille, Bar Sabor Taquería & Tequila, Izumi Hibach y Sushi y el restaurante italiano Giovanni’s Table así como con 15 bares y salones."
    }
###### Filtro por fecha de salida: 
    `tours?filtrar=fecha_salida&valor=2023-06-15`
###### Devuelve:
Este filtro aplicado devolverá todos los tours que tengan como fecha de salida el dia 2023-06-15.

    {
        "ID": 3,
        "id_crucero": 1,
        "destino": "Jamaica",
        "fecha_salida": "2023-06-15",
        "precio": 1500,
        "descripcion": "Embárcate en un crucero a Jamaica y descubre sus playas, exquisita gastronomía y vibrante cultura reggae. Disfruta de actividades acuáticas, excursiones emocionantes y relájate en el paraíso caribeño mientras creas recuerdos inolvidables.",
        "img1": "https://cdn.pixabay.com/photo/2020/04/29/18/36/jamaica-5110094_1280.jpg",
        "img2": "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSkxwgTWaXOzJ3zUDpRl5VAv1_x5OyadocC_h6nVRnDv1AHjBlHOTmOs674PWvDGtJHsY0&usqp=CAU",
        "detalles": "Embárcate en un emocionante crucero hacia la hermosa isla de Jamaica. Disfruta de días de sol, maravillosas playas de arena blanca y un ambiente vibrante y relajado. Durante tu viaje, tendrás la oportunidad de explorar las maravillas naturales de Jamaica, desde las cascadas de Dunn's River hasta las increíbles montañas azules.\r\n\r\nSumérgete en la cultura jamaicana mientras visitas los pintorescos pueblos costeros y te deleitas con la deliciosa gastronomía local, como el jerk chicken y el ackee con saltfish. Descubre el ritmo contagioso del reggae mientras te adentras en la animada vida nocturna de Montego Bay o Negril, donde encontrarás música en vivo y coloridos mercados.\r\n\r\nDurante tu tiempo en tierra, puedes aventurarte en emocionantes excursiones, como practicar snorkel en los arrecifes de coral, explorar las misteriosas cuevas de Green Grotto, disfrutar de un paseo en bobsleigh en Mystic Mountain o relajarte en las paradisíacas playas de Ocho Ríos.\r\n\r\nA bordo del crucero, encontrarás una amplia gama de comodidades y entretenimiento para todos los gustos. Disfruta de restaurantes de clase mundial, bares y espectáculos en vivo. Relájate en las piscinas, disfruta de tratamientos de spa y participa en emocionantes actividades y deportes acuáticos.\r\n\r\nUn crucero a Jamaica ofrece la combinación perfecta de aventura, relajación y una inmersión en la rica cultura caribeña. Prepárate para crear recuerdos inolvidables mientras exploras esta increíble isla llena de belleza natural y hospitalidad jamaicana."
    }

###### Filtro por precio: 
    `tours?filtrar=precio&valor=2000`
###### Devuelve:
Este filtro aplicado devolverá todos los tours que tengan como precio $2000.

    {
        "ID": 4,
        "id_crucero": 2,
        "destino": "Mediterraneo Occidental",
        "fecha_salida": "2023-07-01",
        "precio": 2000,
        "descripcion": "Embárcate en un crucero al Mediterráneo occidental para descubrir historia, cultura y belleza natural. Explora Roma, Barcelona y Atenas, disfruta de playas encantadoras y vive la experiencia única del mar Mediterráneo.",
        "img1": "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSDznjbApwf3E5YyPl9-LoQBGOO3v2Vw2mGaXEP8WOWYGNptpXcdVuBakC9pmShkwzapM4&usqp=CAU",
        "img2": "https://images.ecestaticos.com/APRDb9GMWFzl8DQ_uX6H3CPYVzQ=/28x17:2028x1517/1200x900/filters:fill(white):format(jpg)/f.elconfidencial.com%2Foriginal%2F740%2F8fc%2F12c%2F7408fc12cea568647e0fe588e839efc2.jpg",
        "detalles": "Embárcate en un fascinante crucero por el Mediterráneo occidental y descubre una mezcla perfecta de historia, cultura y belleza natural. Navegarás por las aguas azules y cristalinas de este icónico mar, visitando algunos de los destinos más emblemáticos de Europa.\r\n\r\nExplora las pintorescas costas de Italia, donde podrás admirar la majestuosidad del Coliseo en Roma, sumergirte en el romance de Venecia o deleitarte con la deliciosa gastronomía en Nápoles. Continúa tu viaje hacia la vibrante ciudad de Barcelona, ​​donde te sorprenderán las obras maestras arquitectónicas de Gaudí y la animada vida en las Ramblas.\r\n\r\nAdéntrate en la historia antigua en Atenas, Grecia, donde podrás explorar la Acrópolis y maravillarte con los tesoros de la antigua civilización. Sumérgete en la belleza de las islas mediterráneas, como Mallorca o Sicilia, con sus playas de arena blanca y aguas turquesas.\r\n\r\nDisfruta de una amplia variedad de entretenimiento y comodidades a bordo del crucero, desde exquisitos restaurantes hasta relajantes spas y emocionantes actividades. A medida que navegas por el Mediterráneo occidental, serás testigo de impresionantes vistas panorámicas, puestas de sol de ensueño y un ambiente inolvidable.\r\n\r\nUn crucero por el Mediterráneo occidental es una experiencia única que te sumergirá en la riqueza cultural y la diversidad de esta región encantadora. Prepara tu cámara y tus ganas de explorar, porque te esperan momentos inolvidables en cada puerto que visites."
    },
    {
        "ID": 54,
        "id_crucero": 14,
        "destino": "Islas del Caribe",
        "fecha_salida": "2023-07-08",
        "precio": 2000,
        "descripcion": " Descubre la belleza tropical de las Islas del Caribe en este emocionante tour a bordo del Crucero del Mar. Disfruta de playas paradisíacas, aguas cristalinas y una amplia variedad de actividades acuáticas. ¡No te lo pierdas!",
        "img1": "https://acrobatadelcamino.com/wp-content/uploads/2022/10/mejores-islas-del-caribe-704x454.jpg",
        "img2": "https://www.cinconoticias.com/wp-content/uploads/Mejores-islas-del-Caribe-Providenciales-Emerald-Cay-Estate.jpg",
        "detalles": "Este increíble tour te llevará a explorar algunas de las islas más hermosas del Caribe, como Aruba, Jamaica, Bahamas y Barbados. Disfruta de excursiones en tierra para conocer la cultura local, bucea en los arrecifes de coral más impresionantes y relájate en las playas de arena blanca. Además, a bordo del Crucero del Mar, disfrutarás de entretenimiento en vivo, deliciosa gastronomía y actividades para toda la familia. ¡Una experiencia inolvidable en el paraíso caribeño!"
    }

-------------------

### Ordenamiento de tours

##### Ruta genérica para ordenar:
`tours?criterio=criterio&orden=orden`

En la ruta generica para ordenar los resultados, se deben reemplazar los valores de "criterio" por el nombre de la columna de la base de datos por la que se quieran ordenar los tours (ID, destino, fecha_salida, precio). Y el valor "orden" por "asc" para mostrar los resultados en orden ascendente o por "desc" para mostrar los resultados por orden descendente. Si no se especifica el parámetro "orden", por defecto se ordenan de manera ascendente.
##### Parámetros de ordenado


###### Ordenar por ID: 
    `tours?criterio=ID&orden=asc`
###### Devuelve:
Este endpoint devuelve todos los tours ordenados por su id de manera ascendente.

###### Ordenar por destino: 
    `tours?criterio=destino&orden=asc`
###### Devuelve:
Este endpoint devuelve todos los tours ordenados alfabeticamente por el destino al que se dirigen de manera ascendente:

###### Ordenar por fecha de salida: 
    `tours?criterio=fecha_salida`
###### Devuelve:
Este endpoint devuelve todos los tours ordenados por lafecha de salida de manera ascendente:

###### Ordenar por precio: 
    `tours?criterio=precio&orden=desc`
###### Devuelve:
Este endpoint devuelve todos los tours ordenados por el precio de manera descendente:


-----------
### Paginación de tours
##### Ruta genérica para paginar:
`tours?pagina=pagina&filas=filas`

En la ruta generica para paginar los resultados, se deben reemplazar los valores de "pagina" por el número de página que se quiera ver. Y el valor "filas" por la cantidad de elementos que se quieran mostrar por cada pagina. Tanto el valor de pagina como el de filas deben ser valores numéricos, no puede ser negativos y deben ser números enteros.

##### Parámetros de paginación
###### Ejemplo 1: 
    `tours?pagina=1&filas=5`
###### Devuelve:
Este endpoint devuelve los tours paginados de a 5, y muestra la primera página, es decir, los primeros 5 tours.
###### Ejemplo 2: 
    `tours?pagina=2&filas=5`
###### Devuelve:
Este endpoint devuelve los tours paginados de a 5, y muestra la segunda página, es decir, los elementos desde el quinto hasta el décimo.
###### Ejemplo 3: 
    `tours?pagina=1&filas=3`
###### Devuelve:
Este endpoint devuelve los tours paginados de a 3, y muestra la primera página, es decir, los primeros 3 elementos.

----------------------------------

### Obtener un tour específico
##### Descripción:
Este método permite obtener información detallada sobre un tour específico.
##### Ruta
`GET /tours/:ID`

--------------------------------------

### Agregar un nuevo tour
##### Descripción: 
Este método permite agregar un nuevo tour.
##### Ruta
`POST /tours`

----------------------------------------

### Actualizar un tour existente
##### Descripción:
Este método permite actualizar los detalles de un tour existente.
##### Ruta
`PUT /tours/:ID`

-----------------------

### Eliminar un tour
##### Descripción:
Este método permite eliminar un tour específico.
##### Ruta
`DELETE /tours/:ID`



--------------------------------------------------------------------------------
## <h2 align="center">Tabla de ruteo</h2>

----------------------------------------------------------------
<div align="center">

| Método | Ruta                                   | Descripción                                                      |
|--------|----------------------------------------|------------------------------------------------------------------|
| GET    | /cruceros                              | Obtener todos los cruceros                                       |
| GET    | /cruceros/:ID                          | Obtener un crucero específico                                    |
| POST   | /cruceros                              | Agregar un nuevo crucero                                         |
| PUT    | /cruceros/:ID                          | Actualizar un crucero existente                                  |
| DELETE | /cruceros/:ID                          | Eliminar un crucero                                              |
| GET    | /cruceros?criterio=criterio&orden=orden| Obtener todos los tours ordenados por un campo específico        |
| GET    | /cruceros?filtrar=filtrar&valor=valor  | Obtener todos los tours que cumplan un criterio de filtrado      |
| GET    | /cruceros?pagina=pagina&filas=filas    | Obtener una página específica de tours limitada por una cantidad |
| GET    | /tours                                 | Obtener todos los tours                                          |
| GET    | /tours/:ID                             | Obtener un tour específico                                       |
| POST   | /tours                                 | Agregar un nuevo tour                                            |
| PUT    | /tours/:ID                             | Actualizar un tour existente                                     |
| DELETE | /tours/:ID                             | Eliminar un tour                                                 |
| GET    | /tours?criterio=criterio&orden=orden   | Obtener todos los tours ordenados por un campo específico        |
| GET    | /tours?filtrar=filtrar&valor=valor     | Obtener todos los tours que cumplan un criterio de filtrado      |
| GET    | /tours?pagina=pagina&filas=filas       | Obtener una página específica de tours limitada por una cantidad |

-----------------------------------------------
</div>

--------------------------

### <h2 align="center">Ejemplos de Uso</h2>

---------------------------------------

Ejemplos de solicitud y respuesta para cada método

##### Obtener todos los cruceros

###### Petición:
`GET /cruceros`

###### Respuesta:

    {
        "ID": 1,
        "nombre": "Oasis of the Seas",
        "compania": "Royal",
        "capacidad": 5400,
        "origen": "Miami",
        "img1": "https://www.ship-technology.com/wp-content/uploads/sites/8/2021/04/Image_1-Oasis_of_the_Seas1.jpg",
        "img2": "https://media-cdn.tripadvisor.com/media/photo-m/1280/15/3b/2f/64/cc-oasis-of-the-seas.jpg",
        "descripcion": "El Oasis of the Seas es un crucero de la clase Oasis perteneciente a la empresa naviera Royal Caribbean International. Su construcción finalizó en septiembre de 2009, en los astilleros de la empresa STX Europe",
        "detalles": "El Oasis of the Seas es uno de los cruceros más emblemáticos y populares del mundo. Es parte de la clase Oasis de barcos de Royal Caribbean International, conocida por su tamaño impresionante y sus innovadoras instalaciones a bordo. Con su diseño revolucionario, el Oasis of the Seas ofrece una experiencia de crucero inigualable.\r\n\r\nConstruido en 2009, el Oasis of the Seas cuenta con una longitud de aproximadamente 361 metros y puede albergar a más de 5,400 pasajeros en ocupación doble. Este gigante de los mares ofrece una amplia variedad de opciones de entretenimiento, actividades y servicios para satisfacer los gustos y necesidades de todos los huéspedes.\r\n\r\nA bordo del Oasis of the Seas, encontrarás una gran cantidad de características destacadas. El barco cuenta con una zona de paseo central llamada \"Central Park\", que está lleno de exuberantes jardines, restaurantes y tiendas. También puedes disfrutar de emocionantes atracciones como el \"Aquatheater\", un anfiteatro acuático donde se presentan espectáculos de alta calidad con acróbatas y saltadores profesionales.\r\n\r\nEl barco cuenta con una amplia selección de restaurantes que ofrecen opciones gastronómicas para todos los gustos, desde restaurantes de especialidades hasta bufés informales. Además, cuenta con diversas piscinas y jacuzzis, un parque acuático, paredes de escalada, pista de patinaje sobre hielo, casino, teatro, discoteca, spa y gimnasio totalmente equipado.\r\n\r\nLas cabinas a bordo del Oasis of the Seas son modernas, elegantes y cómodas, brindando un espacio privado para relajarse después de un día lleno de actividades. Desde acogedoras cabinas interiores hasta lujosas suites con balcón, hay opciones de alojamiento para satisfacer las necesidades de todos los pasajeros.\r\n\r\nEn resumen, el Oasis of the Seas es un barco extraordinario que ofrece una experiencia de crucero incomparable. Con su tamaño impresionante, innovadoras instalaciones y una amplia gama de opciones de entretenimiento, este crucero de Royal Caribbean es perfecto para aquellos que buscan una aventura inolvidable en alta mar."
    },
    {
        "ID": 2,
        "nombre": "Symphony of the Seas",
        "compania": "Royal Caribbean",
        "capacidad": 5518,
        "origen": "Barcelona",
        "img1": "https://www.royalcaribbean.com/content/dam/royal/ships/symphony/symphony-of-the-seas-night-time-moon.jpg",
        "img2": "https://hospitality-on.com/sites/default/files/2018-03/0326_naviresymphony-of-the-seas_max133536455_2.jpg",
        "descripcion": "Symphony of the Seas es un crucero de clase Oasis operado por Royal Caribbean International.​ Fue construido en 2018 en el astillero Chantiers de l'Atlantique en Saint-Nazaire, Francia, ​ siendo el cuarto en la clase de cruceros Oasis de Royal Caribbean.",
        "detalles": "El Symphony of the Seas es el barco más grande y moderno de la flota de Royal Caribbean International. Es un crucero de la clase Oasis, famosa por sus innovadoras instalaciones y por ofrecer una experiencia excepcional a bordo. Con su diseño vanguardista y sus características impresionantes, el Symphony of the Seas es una opción perfecta para aquellos que buscan una experiencia de crucero inigualable.\n\nConstruido en 2018, el Symphony of the Seas tiene una longitud de aproximadamente 362 metros y puede albergar a más de 6,600 pasajeros en ocupación doble. Este coloso de los mares cuenta con una variedad de atracciones y actividades para satisfacer todos los gustos y edades.\n\nUna de las características más destacadas del Symphony of the Seas es su área al aire libre llamada \"Boardwalk\", que ofrece una experiencia similar a un muelle de playa con tiendas, restaurantes y un carrusel de estilo antiguo. También cuenta con el \"Ultimate Abyss\", un tobogán de diez pisos de altura que ofrece una emocionante experiencia de descenso.\n\nEl barco ofrece una amplia selección de restaurantes, desde opciones de comida rápida y bufés hasta restaurantes de especialidades donde puedes disfrutar de cocina gourmet. Además, cuenta con espectáculos en vivo de primer nivel, como producciones teatrales de Broadway, música en vivo, comedias y más.\n\nPara los amantes del agua, el Symphony of the Seas tiene una zona acuática llamada \"Splashaway Bay\" que cuenta con toboganes y piscinas para niños. También hay varias piscinas para relajarse y tomar el sol, así como jacuzzis y áreas de descanso.\n\nEn cuanto al alojamiento, el Symphony of the Seas ofrece una amplia gama de opciones de cabinas, desde cómodas habitaciones interiores hasta lujosas suites con balcones privados y conserje personal.\n\nEn resumen, el Symphony of the Seas es un barco impresionante que redefine la experiencia de crucero. Con su tamaño gigantesco, atracciones emocionantes, opciones gastronómicas excepcionales y entretenimiento de primera clase, este crucero de Royal Caribbean es perfecto para aquellos que buscan una experiencia inolvidable en alta mar."
    },
    {
        "ID": 5,
        "nombre": "Norwegian Bliss",
        "compania": "Norwegian Cruise Line",
        "capacidad": 2000,
        "origen": "Seattle",
        "img1": "https://a.travel-assets.com/flex/flexmanager/images/2019/11/25/SLP_Hero_cNC-sBL.jpg",
        "img2": "https://assets3.thrillist.com/v1/image/2764645/792x529/scale;webp=auto;jpeg_quality=60;progressive.jpg",
        "descripcion": "El Norwegian Bliss es un crucero de Norwegian Cruise Line, que entró en servicio el 21 de abril de 2018. El barco fue construido por Meyer Werft en Papenburg, Alemania",
        "detalles": "El Norwegian Bliss es un crucero de lujo perteneciente a la flota de Norwegian Cruise Line. Inaugurado en 2018, este magnífico barco ha sido diseñado para ofrecer una experiencia de vacaciones inigualable a bordo. Con su elegante diseño, comodidades de última generación y una amplia variedad de entretenimiento, el Norwegian Bliss es una opción perfecta para aquellos que buscan lujo y diversión en alta mar.\n\nCon una longitud de aproximadamente 333 metros, el Norwegian Bliss tiene capacidad para albergar a más de 4,000 pasajeros en ocupación doble. Cada rincón del barco ha sido cuidadosamente diseñado para proporcionar confort y estilo a los viajeros exigentes.\n\nEl Norwegian Bliss cuenta con una gran variedad de restaurantes de alta calidad que ofrecen opciones gastronómicas para todos los gustos. Desde platos internacionales hasta especialidades locales, los comensales pueden deleitarse con una amplia selección de sabores y experiencias culinarias. Además, el barco cuenta con bares y salones temáticos donde los pasajeros pueden disfrutar de cócteles exquisitos y música en vivo.\n\nPara los amantes del entretenimiento, el Norwegian Bliss ofrece una amplia gama de actividades y espectáculos. Desde musicales y producciones teatrales de Broadway hasta conciertos en vivo y clubes nocturnos, hay algo para todos los gustos. También hay opciones de entretenimiento al aire libre, como una pista de carreras de karting y un parque acuático con toboganes emocionantes.\n\nEl bienestar y la relajación son aspectos fundamentales en el Norwegian Bliss. Cuenta con un spa de lujo donde los pasajeros pueden disfrutar de tratamientos rejuvenecedores y relajantes. También hay una variedad de piscinas, jacuzzis y áreas de descanso para disfrutar del sol y la brisa marina.\n\nEn cuanto al alojamiento, el Norwegian Bliss ofrece una amplia selección de camarotes, desde acogedores camarotes interiores hasta amplias suites con balcón privado. Cada camarote ha sido diseñado con atención al detalle y cuenta con comodidades modernas para asegurar una estancia confortable.\n\nEn resumen, el Norwegian Bliss es un crucero de lujo que combina comodidades modernas, opciones gastronómicas de primera clase y entretenimiento de alta calidad. Con su estilo elegante y su ambiente relajado, ofrece a los pasajeros una experiencia inolvidable en alta mar. Ya sea que estés buscando relajarte, disfrutar de la buena comida o divertirte con actividades emocionantes, el Norwegian Bliss tiene todo lo que necesitas para unas vacaciones inolvidables."
    }
-----------
##### Obtener un crucero específico

###### Petición:
`GET /cruceros/1`

###### Respuesta:

    {
        "ID": 1,
        "0": 1,
        "nombre": "Oasis of the Seas",
        "1": "Oasis of the Seas",
        "compania": "Royal",
        "2": "Royal",
        "capacidad": 5400,
        "3": 5400,
        "origen": "Miami",
        "4": "Miami",
        "img1": "https://www.ship-technology.com/wp-content/uploads/sites/8/2021/04/Image_1-Oasis_of_the_Seas1.jpg",
        "5": "https://www.ship-technology.com/wp-content/uploads/sites/8/2021/04/Image_1-Oasis_of_the_Seas1.jpg",
        "img2": "https://media-cdn.tripadvisor.com/media/photo-m/1280/15/3b/2f/64/cc-oasis-of-the-seas.jpg",
        "6": "https://media-cdn.tripadvisor.com/media/photo-m/1280/15/3b/2f/64/cc-oasis-of-the-seas.jpg",
        "descripcion": "El Oasis of the Seas es un crucero de la clase Oasis perteneciente a la empresa naviera Royal Caribbean International. Su construcción finalizó en septiembre de 2009, en los astilleros de la empresa STX Europe",
        "7": "El Oasis of the Seas es un crucero de la clase Oasis perteneciente a la empresa naviera Royal Caribbean International. Su construcción finalizó en septiembre de 2009, en los astilleros de la empresa STX Europe",
        "detalles": "El Oasis of the Seas es uno de los cruceros más emblemáticos y populares del mundo. Es parte de la clase Oasis de barcos de Royal Caribbean International, conocida por su tamaño impresionante y sus innovadoras instalaciones a bordo. Con su diseño revolucionario, el Oasis of the Seas ofrece una experiencia de crucero inigualable.\r\n\r\nConstruido en 2009, el Oasis of the Seas cuenta con una longitud de aproximadamente 361 metros y puede albergar a más de 5,400 pasajeros en ocupación doble. Este gigante de los mares ofrece una amplia variedad de opciones de entretenimiento, actividades y servicios para satisfacer los gustos y necesidades de todos los huéspedes.\r\n\r\nA bordo del Oasis of the Seas, encontrarás una gran cantidad de características destacadas. El barco cuenta con una zona de paseo central llamada \"Central Park\", que está lleno de exuberantes jardines, restaurantes y tiendas. También puedes disfrutar de emocionantes atracciones como el \"Aquatheater\", un anfiteatro acuático donde se presentan espectáculos de alta calidad con acróbatas y saltadores profesionales.\r\n\r\nEl barco cuenta con una amplia selección de restaurantes que ofrecen opciones gastronómicas para todos los gustos, desde restaurantes de especialidades hasta bufés informales. Además, cuenta con diversas piscinas y jacuzzis, un parque acuático, paredes de escalada, pista de patinaje sobre hielo, casino, teatro, discoteca, spa y gimnasio totalmente equipado.\r\n\r\nLas cabinas a bordo del Oasis of the Seas son modernas, elegantes y cómodas, brindando un espacio privado para relajarse después de un día lleno de actividades. Desde acogedoras cabinas interiores hasta lujosas suites con balcón, hay opciones de alojamiento para satisfacer las necesidades de todos los pasajeros.\r\n\r\nEn resumen, el Oasis of the Seas es un barco extraordinario que ofrece una experiencia de crucero incomparable. Con su tamaño impresionante, innovadoras instalaciones y una amplia gama de opciones de entretenimiento, este crucero de Royal Caribbean es perfecto para aquellos que buscan una aventura inolvidable en alta mar.",
        "8": "El Oasis of the Seas es uno de los cruceros más emblemáticos y populares del mundo. Es parte de la clase Oasis de barcos de Royal Caribbean International, conocida por su tamaño impresionante y sus innovadoras instalaciones a bordo. Con su diseño revolucionario, el Oasis of the Seas ofrece una experiencia de crucero inigualable.\r\n\r\nConstruido en 2009, el Oasis of the Seas cuenta con una longitud de aproximadamente 361 metros y puede albergar a más de 5,400 pasajeros en ocupación doble. Este gigante de los mares ofrece una amplia variedad de opciones de entretenimiento, actividades y servicios para satisfacer los gustos y necesidades de todos los huéspedes.\r\n\r\nA bordo del Oasis of the Seas, encontrarás una gran cantidad de características destacadas. El barco cuenta con una zona de paseo central llamada \"Central Park\", que está lleno de exuberantes jardines, restaurantes y tiendas. También puedes disfrutar de emocionantes atracciones como el \"Aquatheater\", un anfiteatro acuático donde se presentan espectáculos de alta calidad con acróbatas y saltadores profesionales.\r\n\r\nEl barco cuenta con una amplia selección de restaurantes que ofrecen opciones gastronómicas para todos los gustos, desde restaurantes de especialidades hasta bufés informales. Además, cuenta con diversas piscinas y jacuzzis, un parque acuático, paredes de escalada, pista de patinaje sobre hielo, casino, teatro, discoteca, spa y gimnasio totalmente equipado.\r\n\r\nLas cabinas a bordo del Oasis of the Seas son modernas, elegantes y cómodas, brindando un espacio privado para relajarse después de un día lleno de actividades. Desde acogedoras cabinas interiores hasta lujosas suites con balcón, hay opciones de alojamiento para satisfacer las necesidades de todos los pasajeros.\r\n\r\nEn resumen, el Oasis of the Seas es un barco extraordinario que ofrece una experiencia de crucero incomparable. Con su tamaño impresionante, innovadoras instalaciones y una amplia gama de opciones de entretenimiento, este crucero de Royal Caribbean es perfecto para aquellos que buscan una aventura inolvidable en alta mar."
    }

--------------------------

##### Agregar un nuevo crucero

###### Petición:
`POST /cruceros`
###### Cuerpo de la solicitud:

	{
		  "nombre": "Nuevo Crucero",
		  "compania": "Royal Caribean"
		  "capacidad": 150,
		   "origen": "Bahamas",
		  "img1": "https://media-cdn.tripadvisor.com/media/photo-m/1280/15/3b/2f/64/cc-				oasis-of-the-seas.jpg",
		  "img2":"https://www.ship-technology.com/wp-																		content/uploads/sites/8/2021/04/Image_1-Oasis_of_the_Seas1.jpg",
		  "descripcion": "El crucero "Nuevo Crucero" de Royal Caribbean es una emocionante 			opción con capacidad para 150 pasajeros. Parte desde las Bahamas y ofrece una 			experiencia única en el Caribe. ¡Embárcate y disfruta de lujo y diversión sin 						igual!",
		  "detalles":"El "Nuevo Crucero" de la reconocida compañía Royal Caribbean es una 				emocionante opción para aquellos que buscan una experiencia única en alta mar. 				Con una capacidad para 150 pasajeros, este crucero ofrece un ambiente íntimo y 				acogedor, permitiendo una atención personalizada y momentos inolvidables.
		Partiendo desde las hermosas islas de las Bahamas, el crucero te llevará a explorar 		algunos de los destinos más espectaculares del Caribe. Disfruta de las cristalinas 				aguas turquesas, playas de arena blanca y una gran variedad de actividades a bordo 			que te mantendrán entretenido durante toda la travesía.
		Embárcate en el "Nuevo Crucero" y descubre una experiencia de lujo y diversión sin 			igual. Ya sea que desees relajarte junto a la piscina, deleitarte con la exquisita 					gastronomía a bordo o participar en emocionantes actividades y entretenimiento, 		este crucero tiene todo lo necesario para hacer de tus vacaciones una experiencia 			inolvidable.
		¡Prepárate para zarpar en el "Nuevo Crucero" y vivir momentos inolvidables en un 			entorno de lujo y comodidad mientras exploras las maravillas del Caribe!"
	}

###### Respuesta:


    {
			"ID": 18,
			"0": 18,
			"nombre": "Nuevo Crucero",
			"1": "Nuevo Crucero",
			"compania": "Royal Caribean",
			"2": "Royal Caribean",
			"capacidad": 150,
			"3": 150,
			"origen": "Bahamas",
			"4": "Bahamas",
			"img1": "https://media-cdn.tripadvisor.com/media/photo-m/1280/15/3b/2f/64/cc-oasis-of-the-seas.jpg",
			"5": "https://media-cdn.tripadvisor.com/media/photo-m/1280/15/3b/2f/64/cc-oasis-of-the-seas.jpg",
			"img2": "https://www.ship-technology.com/wp-content/uploads/sites/8/2021/04/Image_1-Oasis_of_the_Seas1.jpg",
			"6": "https://www.ship-technology.com/wp-content/uploads/sites/8/2021/04/Image_1-Oasis_of_the_Seas1.jpg",
			"descripcion": "El crucero Nuevo Crucero de Royal Caribbean es una emocionante opción con capacidad para 150 pasajeros. Parte desde las Bahamas y ofrece una experiencia única en el Caribe. ¡Embárcate y disfruta de lujo y diversión sin igual!",
			"7": "El crucero Nuevo Crucero de Royal Caribbean es una emocionante opción con capacidad para 150 pasajeros. Parte desde las Bahamas y ofrece una experiencia única en el Caribe. ¡Embárcate y disfruta de lujo y diversión sin igual!",
			"detalles": "El Nuevo Crucero es uno de los cruceros más emblemáticos y populares del mundo. Es parte de la clase Oasis de barcos de Royal Caribbean International, conocida por su tamaño impresionante y sus innovadoras instalaciones a bordo. Con su diseño revolucionario, el Oasis of the Seas ofrece una experiencia de crucero inigualable.",
			"8": "El Nuevo Crucero es uno de los cruceros más emblemáticos y populares del mundo. Es parte de la clase Oasis de barcos de Royal Caribbean International, conocida por su tamaño impresionante y sus innovadoras instalaciones a bordo. Con su diseño revolucionario, el Oasis of the Seas ofrece una experiencia de crucero inigualable."
    }

##### Actualizar un crucero existente

###### Petición:
`PUT /cruceros/18`

###### Cuerpo de la solicitud:


	{
		  "nombre": "Nuevo Crucero actualizado",
		  "compania": "Royal Caribean"
		  "capacidad": 190,
		   "origen": "Bahamas",
		  "img1": "https://media-cdn.tripadvisor.com/media/photo-m/1280/15/3b/2f/64/cc-				oasis-of-the-seas.jpg",
		  "img2":"https://www.ship-technology.com/wp-																		content/uploads/sites/8/2021/04/Image_1-Oasis_of_the_Seas1.jpg",
		  "descripcion": "El crucero "Nuevo Crucero" de Royal Caribbean es una emocionante 			opción con capacidad para 150 pasajeros. Parte desde las Bahamas y ofrece una 			experiencia única en el Caribe. ¡Embárcate y disfruta de lujo y diversión sin 						igual!",
		  "detalles":"El "Nuevo Crucero" de la reconocida compañía Royal Caribbean es una 				emocionante opción para aquellos que buscan una experiencia única en alta mar. 				Con una capacidad para 150 pasajeros, este crucero ofrece un ambiente íntimo y 				acogedor, permitiendo una atención personalizada y momentos inolvidables.
		Partiendo desde las hermosas islas de las Bahamas, el crucero te llevará a explorar 		algunos de los destinos más espectaculares del Caribe. Disfruta de las cristalinas 				aguas turquesas, playas de arena blanca y una gran variedad de actividades a bordo 			que te mantendrán entretenido durante toda la travesía.
		Embárcate en el "Nuevo Crucero" y descubre una experiencia de lujo y diversión sin 			igual. Ya sea que desees relajarte junto a la piscina, deleitarte con la exquisita 					gastronomía a bordo o participar en emocionantes actividades y entretenimiento, 		este crucero tiene todo lo necesario para hacer de tus vacaciones una experiencia 			inolvidable.
		¡Prepárate para zarpar en el "Nuevo Crucero" y vivir momentos inolvidables en un 			entorno de lujo y comodidad mientras exploras las maravillas del Caribe!"
	}

###### Respuesta:

`"Crucero id=18 actualizado con éxito"`

---------------------------------

##### Eliminar un crucero

###### Petición:
`DELETE /cruceros/2`
###### Respuesta:
`"El crucero fue borrado con exito."`

-----------------------------------------

##### Obtener todos los tours

###### Petición:
`GET /tours`

###### Respuesta:


    {
        "ID": 1,
        "id_crucero": 1,
        "destino": "Bahamas",
        "fecha_salida": "2023-06-01",
        "precio": 1200,
        "descripcion": "Embárcate en un emocionante crucero a las Bahamas y sumérgete en aguas cristalinas, playas de ensueño y una vibrante cultura caribeña. Disfruta de actividades acuáticas, relájate en paradisíacas playas y descubre su belleza tropical.",
        "img1": "https://w0.peakpx.com/wallpaper/288/293/HD-wallpaper-bahamas-ocean-bahamas-nature-sky-blue.jpg",
        "img2": "https://media-cdn.tripadvisor.com/media/photo-m/1280/15/3b/2f/64/cc-oasis-of-the-seas.jpg",
        "detalles": "El crucero Oasis of the Seas dispone de una variada oferta de entretenimiento a bordo protagonizada por un teatro, casino, discoteca, cine en 3D, biblioteca, sala de videojuegos, punto de internet, sala de cartas, oficina de excursiones, miniclub y área de shopping.\r\n\r\nEl Oasis of the Seas incluye 4 piscinas, 10 Jacuzzis, parque acuático para niños, solarium, spa y salón de belleza, área wellness, gimnasio, tirolina suspendida a nueve cubiertas de 25 m de largo, 2 simuladores de surf, pista de patinaje sobre hielo, 2 paredes de escalada de 13 m, simulador de golf, cancha de baloncesto, pista de jogging al aire libre, minigolf y dispone de instalaciones, clubs y zonas de entretenimiento para niños y jóvenes.\r\n\r\nAdemás cuenta con servicios de guardería.\r\n\r\nA bordo también hay actividades que se ajustas a todas las edades y gustos. Los niños de 6 a 18 meses podrán disfrutar con sus padres del programa Royal Babies & Royal Tots, los niños de 3 a 5 años se divertirán realizando geniales experimentos y se convertirán en pequeños aventureros de la ciencia. El programa Explorers (6 a 8 años de edad) está lleno de emocionantes actividades, desde fiestas temáticas hasta la fabricación de caramelos. Los Voyagers (9 a 11 años de edad) explorarán diversas actividades que le devuelven la diversión al aprendizaje.\r\n\r\nCon la experiencia Dreamworks los niños podrán compartir momentos inolvidables con los personajes de DreamWorks y disfrutar de entretenidas actividades como cuenta cuentos, fiestas de baile, desfiles y espectáculos de patinaje sobre hielo.\r\n\r\nLos adolescentes tendrán también sus propios espacios y una gran variedad de actividades.\r\n\r\nLa oferta de restauración a bordo del Oasis of the Seas incluye, entre otros, los siguientes restaurantes: el Restaurante principal, el restaurante 150 Central Park, Chops Grille, Bar Sabor Taquería & Tequila, Izumi Hibach y Sushi y el restaurante italiano Giovanni’s Table así como con 15 bares y salones."
    },
    {
        "ID": 3,
        "id_crucero": 1,
        "destino": "Jamaica",
        "fecha_salida": "2023-06-15",
        "precio": 1500,
        "descripcion": "Embárcate en un crucero a Jamaica y descubre sus playas, exquisita gastronomía y vibrante cultura reggae. Disfruta de actividades acuáticas, excursiones emocionantes y relájate en el paraíso caribeño mientras creas recuerdos inolvidables.",
        "img1": "https://cdn.pixabay.com/photo/2020/04/29/18/36/jamaica-5110094_1280.jpg",
        "img2": "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSkxwgTWaXOzJ3zUDpRl5VAv1_x5OyadocC_h6nVRnDv1AHjBlHOTmOs674PWvDGtJHsY0&usqp=CAU",
        "detalles": "Embárcate en un emocionante crucero hacia la hermosa isla de Jamaica. Disfruta de días de sol, maravillosas playas de arena blanca y un ambiente vibrante y relajado. Durante tu viaje, tendrás la oportunidad de explorar las maravillas naturales de Jamaica, desde las cascadas de Dunn's River hasta las increíbles montañas azules.\r\n\r\nSumérgete en la cultura jamaicana mientras visitas los pintorescos pueblos costeros y te deleitas con la deliciosa gastronomía local, como el jerk chicken y el ackee con saltfish. Descubre el ritmo contagioso del reggae mientras te adentras en la animada vida nocturna de Montego Bay o Negril, donde encontrarás música en vivo y coloridos mercados.\r\n\r\nDurante tu tiempo en tierra, puedes aventurarte en emocionantes excursiones, como practicar snorkel en los arrecifes de coral, explorar las misteriosas cuevas de Green Grotto, disfrutar de un paseo en bobsleigh en Mystic Mountain o relajarte en las paradisíacas playas de Ocho Ríos.\r\n\r\nA bordo del crucero, encontrarás una amplia gama de comodidades y entretenimiento para todos los gustos. Disfruta de restaurantes de clase mundial, bares y espectáculos en vivo. Relájate en las piscinas, disfruta de tratamientos de spa y participa en emocionantes actividades y deportes acuáticos.\r\n\r\nUn crucero a Jamaica ofrece la combinación perfecta de aventura, relajación y una inmersión en la rica cultura caribeña. Prepárate para crear recuerdos inolvidables mientras exploras esta increíble isla llena de belleza natural y hospitalidad jamaicana."
    },
    {
        "ID": 4,
        "id_crucero": 2,
        "destino": "Mediterraneo Occidental",
        "fecha_salida": "2023-07-01",
        "precio": 2000,
        "descripcion": "Embárcate en un crucero al Mediterráneo occidental para descubrir historia, cultura y belleza natural. Explora Roma, Barcelona y Atenas, disfruta de playas encantadoras y vive la experiencia única del mar Mediterráneo.",
        "img1": "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSDznjbApwf3E5YyPl9-LoQBGOO3v2Vw2mGaXEP8WOWYGNptpXcdVuBakC9pmShkwzapM4&usqp=CAU",
        "img2": "https://images.ecestaticos.com/APRDb9GMWFzl8DQ_uX6H3CPYVzQ=/28x17:2028x1517/1200x900/filters:fill(white):format(jpg)/f.elconfidencial.com%2Foriginal%2F740%2F8fc%2F12c%2F7408fc12cea568647e0fe588e839efc2.jpg",
        "detalles": "Embárcate en un fascinante crucero por el Mediterráneo occidental y descubre una mezcla perfecta de historia, cultura y belleza natural. Navegarás por las aguas azules y cristalinas de este icónico mar, visitando algunos de los destinos más emblemáticos de Europa.\r\n\r\nExplora las pintorescas costas de Italia, donde podrás admirar la majestuosidad del Coliseo en Roma, sumergirte en el romance de Venecia o deleitarte con la deliciosa gastronomía en Nápoles. Continúa tu viaje hacia la vibrante ciudad de Barcelona, ​​donde te sorprenderán las obras maestras arquitectónicas de Gaudí y la animada vida en las Ramblas.\r\n\r\nAdéntrate en la historia antigua en Atenas, Grecia, donde podrás explorar la Acrópolis y maravillarte con los tesoros de la antigua civilización. Sumérgete en la belleza de las islas mediterráneas, como Mallorca o Sicilia, con sus playas de arena blanca y aguas turquesas.\r\n\r\nDisfruta de una amplia variedad de entretenimiento y comodidades a bordo del crucero, desde exquisitos restaurantes hasta relajantes spas y emocionantes actividades. A medida que navegas por el Mediterráneo occidental, serás testigo de impresionantes vistas panorámicas, puestas de sol de ensueño y un ambiente inolvidable.\r\n\r\nUn crucero por el Mediterráneo occidental es una experiencia única que te sumergirá en la riqueza cultural y la diversidad de esta región encantadora. Prepara tu cámara y tus ganas de explorar, porque te esperan momentos inolvidables en cada puerto que visites."
    }

--------------------------------------

##### Obtener un tour específico

###### Petición:
`GET /tours/1`

###### Respuesta:


    {
        "ID": 1,
        "0": 1,
        "id_crucero": 1,
        "1": 1,
        "destino": "Bahamas",
        "2": "Bahamas",
        "fecha_salida": "2023-06-01",
        "3": "2023-06-01",
        "precio": 1200,
        "4": 1200,
        "descripcion": "Embárcate en un emocionante crucero a las Bahamas y sumérgete en aguas cristalinas, playas de ensueño y una vibrante cultura caribeña. Disfruta de actividades acuáticas, relájate en paradisíacas playas y descubre su belleza tropical.",
        "5": "Embárcate en un emocionante crucero a las Bahamas y sumérgete en aguas cristalinas, playas de ensueño y una vibrante cultura caribeña. Disfruta de actividades acuáticas, relájate en paradisíacas playas y descubre su belleza tropical.",
        "img1": "https://w0.peakpx.com/wallpaper/288/293/HD-wallpaper-bahamas-ocean-bahamas-nature-sky-blue.jpg",
        "6": "https://w0.peakpx.com/wallpaper/288/293/HD-wallpaper-bahamas-ocean-bahamas-nature-sky-blue.jpg",
        "img2": "https://media-cdn.tripadvisor.com/media/photo-m/1280/15/3b/2f/64/cc-oasis-of-the-seas.jpg",
        "7": "https://media-cdn.tripadvisor.com/media/photo-m/1280/15/3b/2f/64/cc-oasis-of-the-seas.jpg",
        "detalles": "El crucero Oasis of the Seas dispone de una variada oferta de entretenimiento a bordo protagonizada por un teatro, casino, discoteca, cine en 3D, biblioteca, sala de videojuegos, punto de internet, sala de cartas, oficina de excursiones, miniclub y área de shopping.\r\n\r\nEl Oasis of the Seas incluye 4 piscinas, 10 Jacuzzis, parque acuático para niños, solarium, spa y salón de belleza, área wellness, gimnasio, tirolina suspendida a nueve cubiertas de 25 m de largo, 2 simuladores de surf, pista de patinaje sobre hielo, 2 paredes de escalada de 13 m, simulador de golf, cancha de baloncesto, pista de jogging al aire libre, minigolf y dispone de instalaciones, clubs y zonas de entretenimiento para niños y jóvenes.\r\n\r\nAdemás cuenta con servicios de guardería.\r\n\r\nA bordo también hay actividades que se ajustas a todas las edades y gustos. Los niños de 6 a 18 meses podrán disfrutar con sus padres del programa Royal Babies & Royal Tots, los niños de 3 a 5 años se divertirán realizando geniales experimentos y se convertirán en pequeños aventureros de la ciencia. El programa Explorers (6 a 8 años de edad) está lleno de emocionantes actividades, desde fiestas temáticas hasta la fabricación de caramelos. Los Voyagers (9 a 11 años de edad) explorarán diversas actividades que le devuelven la diversión al aprendizaje.\r\n\r\nCon la experiencia Dreamworks los niños podrán compartir momentos inolvidables con los personajes de DreamWorks y disfrutar de entretenidas actividades como cuenta cuentos, fiestas de baile, desfiles y espectáculos de patinaje sobre hielo.\r\n\r\nLos adolescentes tendrán también sus propios espacios y una gran variedad de actividades.\r\n\r\nLa oferta de restauración a bordo del Oasis of the Seas incluye, entre otros, los siguientes restaurantes: el Restaurante principal, el restaurante 150 Central Park, Chops Grille, Bar Sabor Taquería & Tequila, Izumi Hibach y Sushi y el restaurante italiano Giovanni’s Table así como con 15 bares y salones.",
        "8": "El crucero Oasis of the Seas dispone de una variada oferta de entretenimiento a bordo protagonizada por un teatro, casino, discoteca, cine en 3D, biblioteca, sala de videojuegos, punto de internet, sala de cartas, oficina de excursiones, miniclub y área de shopping.\r\n\r\nEl Oasis of the Seas incluye 4 piscinas, 10 Jacuzzis, parque acuático para niños, solarium, spa y salón de belleza, área wellness, gimnasio, tirolina suspendida a nueve cubiertas de 25 m de largo, 2 simuladores de surf, pista de patinaje sobre hielo, 2 paredes de escalada de 13 m, simulador de golf, cancha de baloncesto, pista de jogging al aire libre, minigolf y dispone de instalaciones, clubs y zonas de entretenimiento para niños y jóvenes.\r\n\r\nAdemás cuenta con servicios de guardería.\r\n\r\nA bordo también hay actividades que se ajustas a todas las edades y gustos. Los niños de 6 a 18 meses podrán disfrutar con sus padres del programa Royal Babies & Royal Tots, los niños de 3 a 5 años se divertirán realizando geniales experimentos y se convertirán en pequeños aventureros de la ciencia. El programa Explorers (6 a 8 años de edad) está lleno de emocionantes actividades, desde fiestas temáticas hasta la fabricación de caramelos. Los Voyagers (9 a 11 años de edad) explorarán diversas actividades que le devuelven la diversión al aprendizaje.\r\n\r\nCon la experiencia Dreamworks los niños podrán compartir momentos inolvidables con los personajes de DreamWorks y disfrutar de entretenidas actividades como cuenta cuentos, fiestas de baile, desfiles y espectáculos de patinaje sobre hielo.\r\n\r\nLos adolescentes tendrán también sus propios espacios y una gran variedad de actividades.\r\n\r\nLa oferta de restauración a bordo del Oasis of the Seas incluye, entre otros, los siguientes restaurantes: el Restaurante principal, el restaurante 150 Central Park, Chops Grille, Bar Sabor Taquería & Tequila, Izumi Hibach y Sushi y el restaurante italiano Giovanni’s Table así como con 15 bares y salones."
    }

----------------------------

##### Agregar un nuevo tour

###### Petición:
`POST /tours`

###### Cuerpo de la solicitud:

	{
			"id_crucero": 1,
			"1": 1,
			"destino": "Bahamas",
			"fecha_salida": "2023-06-01",
			"precio": 1200,
			"descripcion": "Embárcate en un emocionante crucero a las Bahamas y sumérgete en aguas cristalinas, playas de ensueño y una vibrante cultura caribeña. Disfruta de actividades acuáticas, relájate en paradisíacas playas y descubre su belleza tropical.",
			"img1": "https://w0.peakpx.com/wallpaper/288/293/HD-wallpaper-bahamas-ocean-bahamas-nature-sky-blue.jpg",
			"img2": "https://media-cdn.tripadvisor.com/media/photo-m/1280/15/3b/2f/64/cc-oasis-of-the-seas.jpg",
			"detalles": "El crucero Oasis of the Seas dispone de una variada oferta de entretenimiento a bordo protagonizada por un teatro, casino, discoteca, cine en 3D, biblioteca, sala de videojuegos, punto de internet, sala de cartas, oficina de excursiones, miniclub y área de shopping.\r\n\r\nEl Oasis of the Seas incluye 4 piscinas, 10 Jacuzzis, parque acuático para niños, solarium, spa y salón de belleza, área wellness, gimnasio, tirolina suspendida a nueve cubiertas de 25 m de largo, 2 simuladores de surf, pista de patinaje sobre hielo, 2 paredes de escalada de 13 m, simulador de golf, cancha de baloncesto, pista de jogging al aire libre, minigolf y dispone de instalaciones, clubs y zonas de entretenimiento para niños y jóvenes.\r\n\r\nAdemás cuenta con servicios de guardería.\r\n\r\nA bordo también hay actividades que se ajustas a todas las edades y gustos. Los niños de 6 a 18 meses podrán disfrutar con sus padres del programa Royal Babies & Royal Tots, los niños de 3 a 5 años se divertirán realizando geniales experimentos y se convertirán en pequeños aventureros de la ciencia. El programa Explorers (6 a 8 años de edad) está lleno de emocionantes actividades, desde fiestas temáticas hasta la fabricación de caramelos. Los Voyagers (9 a 11 años de edad) explorarán diversas actividades que le devuelven la diversión al aprendizaje.\r\n\r\nCon la experiencia Dreamworks los niños podrán compartir momentos inolvidables con los personajes de DreamWorks y disfrutar de entretenidas actividades como cuenta cuentos, fiestas de baile, desfiles y espectáculos de patinaje sobre hielo.\r\n\r\nLos adolescentes tendrán también sus propios espacios y una gran variedad de actividades.\r\n\r\nLa oferta de restauración a bordo del Oasis of the Seas incluye, entre otros, los siguientes restaurantes: el Restaurante principal, el restaurante 150 Central Park, Chops Grille, Bar Sabor Taquería & Tequila, Izumi Hibach y Sushi y el restaurante italiano Giovanni’s Table así como con 15 bares y salones."
		}

###### Respuesta:
    {
        "ID": 61,
        "0": 61,
        "id_crucero": 1,
        "1": 1,
        "destino": "Bahamas",
        "2": "Bahamas",
        "fecha_salida": "2023-06-01",
        "3": "2023-06-01",
        "precio": 1200,
        "4": 1200,
        "descripcion": "Embárcate en un emocionante crucero a las Bahamas y sumérgete en aguas cristalinas, playas de ensueño y una vibrante cultura caribeña. Disfruta de actividades acuáticas, relájate en paradisíacas playas y descubre su belleza tropical.",
        "5": "Embárcate en un emocionante crucero a las Bahamas y sumérgete en aguas cristalinas, playas de ensueño y una vibrante cultura caribeña. Disfruta de actividades acuáticas, relájate en paradisíacas playas y descubre su belleza tropical.",
        "img1": "https://w0.peakpx.com/wallpaper/288/293/HD-wallpaper-bahamas-ocean-bahamas-nature-sky-blue.jpg",
        "6": "https://w0.peakpx.com/wallpaper/288/293/HD-wallpaper-bahamas-ocean-bahamas-nature-sky-blue.jpg",
        "img2": "https://media-cdn.tripadvisor.com/media/photo-m/1280/15/3b/2f/64/cc-oasis-of-the-seas.jpg",
        "7": "https://media-cdn.tripadvisor.com/media/photo-m/1280/15/3b/2f/64/cc-oasis-of-the-seas.jpg",
        "detalles": "El crucero Oasis of the Seas dispone de una variada oferta de entretenimiento a bordo protagonizada por un teatro, casino, discoteca, cine en 3D, biblioteca, sala de videojuegos, punto de internet, sala de cartas, oficina de excursiones, miniclub y área de shopping.\r\n\r\nEl Oasis of the Seas incluye 4 piscinas, 10 Jacuzzis, parque acuático para niños, solarium, spa y salón de belleza, área wellness, gimnasio, tirolina suspendida a nueve cubiertas de 25 m de largo, 2 simuladores de surf, pista de patinaje sobre hielo, 2 paredes de escalada de 13 m, simulador de golf, cancha de baloncesto, pista de jogging al aire libre, minigolf y dispone de instalaciones, clubs y zonas de entretenimiento para niños y jóvenes.\r\n\r\nAdemás cuenta con servicios de guardería.\r\n\r\nA bordo también hay actividades que se ajustas a todas las edades y gustos. Los niños de 6 a 18 meses podrán disfrutar con sus padres del programa Royal Babies & Royal Tots, los niños de 3 a 5 años se divertirán realizando geniales experimentos y se convertirán en pequeños aventureros de la ciencia. El programa Explorers (6 a 8 años de edad) está lleno de emocionantes actividades, desde fiestas temáticas hasta la fabricación de caramelos. Los Voyagers (9 a 11 años de edad) explorarán diversas actividades que le devuelven la diversión al aprendizaje.\r\n\r\nCon la experiencia Dreamworks los niños podrán compartir momentos inolvidables con los personajes de DreamWorks y disfrutar de entretenidas actividades como cuenta cuentos, fiestas de baile, desfiles y espectáculos de patinaje sobre hielo.\r\n\r\nLos adolescentes tendrán también sus propios espacios y una gran variedad de actividades.\r\n\r\nLa oferta de restauración a bordo del Oasis of the Seas incluye, entre otros, los siguientes restaurantes: el Restaurante principal, el restaurante 150 Central Park, Chops Grille, Bar Sabor Taquería & Tequila, Izumi Hibach y Sushi y el restaurante italiano Giovanni’s Table así como con 15 bares y salones.",
        "8": "El crucero Oasis of the Seas dispone de una variada oferta de entretenimiento a bordo protagonizada por un teatro, casino, discoteca, cine en 3D, biblioteca, sala de videojuegos, punto de internet, sala de cartas, oficina de excursiones, miniclub y área de shopping.\r\n\r\nEl Oasis of the Seas incluye 4 piscinas, 10 Jacuzzis, parque acuático para niños, solarium, spa y salón de belleza, área wellness, gimnasio, tirolina suspendida a nueve cubiertas de 25 m de largo, 2 simuladores de surf, pista de patinaje sobre hielo, 2 paredes de escalada de 13 m, simulador de golf, cancha de baloncesto, pista de jogging al aire libre, minigolf y dispone de instalaciones, clubs y zonas de entretenimiento para niños y jóvenes.\r\n\r\nAdemás cuenta con servicios de guardería.\r\n\r\nA bordo también hay actividades que se ajustas a todas las edades y gustos. Los niños de 6 a 18 meses podrán disfrutar con sus padres del programa Royal Babies & Royal Tots, los niños de 3 a 5 años se divertirán realizando geniales experimentos y se convertirán en pequeños aventureros de la ciencia. El programa Explorers (6 a 8 años de edad) está lleno de emocionantes actividades, desde fiestas temáticas hasta la fabricación de caramelos. Los Voyagers (9 a 11 años de edad) explorarán diversas actividades que le devuelven la diversión al aprendizaje.\r\n\r\nCon la experiencia Dreamworks los niños podrán compartir momentos inolvidables con los personajes de DreamWorks y disfrutar de entretenidas actividades como cuenta cuentos, fiestas de baile, desfiles y espectáculos de patinaje sobre hielo.\r\n\r\nLos adolescentes tendrán también sus propios espacios y una gran variedad de actividades.\r\n\r\nLa oferta de restauración a bordo del Oasis of the Seas incluye, entre otros, los siguientes restaurantes: el Restaurante principal, el restaurante 150 Central Park, Chops Grille, Bar Sabor Taquería & Tequila, Izumi Hibach y Sushi y el restaurante italiano Giovanni’s Table así como con 15 bares y salones."
    }

---------------------------------

##### Actualizar un tour existente

###### Petición:
`PUT /tours/61`

###### Cuerpo de la solicitud:

	{
        "id_crucero": 1,
        "1": 1,
        "destino": "Bahamas Actualizado",
        "fecha_salida": "2023-08-01",
        "precio": 1900,
        "descripcion": "Embárcate en un emocionante crucero a las Bahamas y sumérgete en aguas cristalinas, playas de ensueño y una vibrante cultura caribeña. Disfruta de actividades acuáticas, relájate en paradisíacas playas y descubre su belleza tropical.",
        "img1": "https://w0.peakpx.com/wallpaper/288/293/HD-wallpaper-bahamas-ocean-bahamas-nature-sky-blue.jpg",
        "img2": "https://media-cdn.tripadvisor.com/media/photo-m/1280/15/3b/2f/64/cc-oasis-of-the-seas.jpg",
        "detalles": "El crucero Oasis of the Seas dispone de una variada oferta de entretenimiento a bordo protagonizada por un teatro, casino, discoteca, cine en 3D, biblioteca, sala de videojuegos, punto de internet, sala de cartas, oficina de excursiones, miniclub y área de shopping.\r\n\r\nEl Oasis of the Seas incluye 4 piscinas, 10 Jacuzzis, parque acuático para niños, solarium, spa y salón de belleza, área wellness, gimnasio, tirolina suspendida a nueve cubiertas de 25 m de largo, 2 simuladores de surf, pista de patinaje sobre hielo, 2 paredes de escalada de 13 m, simulador de golf, cancha de baloncesto, pista de jogging al aire libre, minigolf y dispone de instalaciones, clubs y zonas de entretenimiento para niños y jóvenes.\r\n\r\nAdemás cuenta con servicios de guardería.\r\n\r\nA bordo también hay actividades que se ajustas a todas las edades y gustos. Los niños de 6 a 18 meses podrán disfrutar con sus padres del programa Royal Babies & Royal Tots, los niños de 3 a 5 años se divertirán realizando geniales experimentos y se convertirán en pequeños aventureros de la ciencia. El programa Explorers (6 a 8 años de edad) está lleno de emocionantes actividades, desde fiestas temáticas hasta la fabricación de caramelos. Los Voyagers (9 a 11 años de edad) explorarán diversas actividades que le devuelven la diversión al aprendizaje.\r\n\r\nCon la experiencia Dreamworks los niños podrán compartir momentos inolvidables con los personajes de DreamWorks y disfrutar de entretenidas actividades como cuenta cuentos, fiestas de baile, desfiles y espectáculos de patinaje sobre hielo.\r\n\r\nLos adolescentes tendrán también sus propios espacios y una gran variedad de actividades.\r\n\r\nLa oferta de restauración a bordo del Oasis of the Seas incluye, entre otros, los siguientes restaurantes: el Restaurante principal, el restaurante 150 Central Park, Chops Grille, Bar Sabor Taquería & Tequila, Izumi Hibach y Sushi y el restaurante italiano Giovanni’s Table así como con 15 bares y salones."
    }

###### Respuesta:

`"Tour id=61 actualizado con éxito"`

--------------------------------

##### Eliminar un tour

##### Petición:
`DELETE /tours/61`

###### Respuesta:
`"El tour fue borrado con exito."`

--------------------------

### <h2 align="center"> Relación entre Cruceros y Tours</h2>

---------------------------------

La aplicación utiliza una base de datos MySQL con dos tablas principales: cruceros y tours. Estas tablas están relacionadas en una relación de uno a muchos (1:N), donde un crucero puede tener varios tours asociados, pero un tour puede tener solo un crucero asociado.
## **<h4>Tabla cruceros</h4>**

La tabla cruceros almacena la información de los cruceros disponibles. Tiene los siguientes campos:

    id (clave primaria): Identificador único del crucero.
    nombre: Nombre del crucero.
    compania: Compañía naviera a la que pertenece el crucero.
    capacidad: Capacidad máxima de pasajeros del crucero.
    origen: Origen del crucero.
    img1: Ruta de la imagen principal del crucero.
    img2: Ruta de una imagen adicional del crucero.
    descripcion: Descripción del crucero.
    detalles: Detalles adicionales del crucero.

## **<h4>Tabla tours</h4>**

La tabla tours almacena la información de los tours asociados a cada crucero. Tiene los siguientes campos:

    id (clave primaria): Identificador único del tour.
    id_crucero (clave foránea): Identificador del crucero al que pertenece el tour.
    destino: Destino del tour.
    fecha_salida: Fecha de salida del tour.
    precio: Precio del tour.
    descripcion: Descripción del tour.
    img1: Ruta de la imagen principal del tour.
    img2: Ruta de una imagen adicional del tour.
    detalles: Detalles adicionales del tour.

## **La relación entre las tablas se establece mediante la columna id_crucero en la tabla tours, que es una clave foránea que hace referencia al campo id en la tabla cruceros. Esto permite asociar varios tours a un crucero específico.**


## <h2 align="center">Conclusiones</h2>

La API RESTful proporciona una interfaz para administrar los cruceros y tours de una aplicación de turismo marítimo. Los métodos GET, POST, PUT y DELETE permiten realizar operaciones de lectura, creación, actualización y eliminación de cruceros y tours. Además, se pueden aplicar filtros, ordenamientos y paginación al obtener la lista de cruceros para facilitar la búsqueda y la presentación de resultados. La API es flexible y fácil de usar, lo que permite una integración eficiente con otras aplicaciones o sistemas que requieran acceso a los datos de cruceros y tours.
