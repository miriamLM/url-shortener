# 👀 Enunciado práctica de recuperación

## ℹ️ Índice

* [🎉 Introducción](#-introduccin)
* [🔗 Contexto](#-contexto)
* [🎯 Casos de uso a implementar](#-casos-de-uso-a-implementar)
    * [🔗 Acortar](#-acortar)
    * [🏪 Guardar](#-guardar)
    * [🎰 Contador](#-contador)
* [🤔 Preguntas frecuentes](#-preguntas-frecuentes)

## 🎉 Introducción

En esta práctica **aplicaremos los conceptos vistos en clase**, esto es:

* Clean Code (métodos cortos, nombres con semántica que revelen intención…)
* Principios SOLID
* Arquitectura Hexagonal
* Event-Driven Architecture

Sería muy aburrido ponernos a hacer el enésimo ejemplo de animales, perros, gatos, humanos, y demás conceptos que se suelen usar en los ejemplos pero que luego cuesta ver reflejados en nuestro día a día. Con lo cuál… **¡Vamos a hacer algo útil!**

![¿Lo cualo?](https://media.giphy.com/media/auTmQCyn4Yq2s/giphy.gif)

>Eeeestooo… ¿Nos hemos venido demasiado arriba?

Que no cunda el pánico. Todos sabemos que llegados este punto tenemos una **meta clara y sencilla**: Demostrar que hemos asimilado los conceptos para poder aprobar la asignatura, y palante 😊

Así que para ello vamos a definir **3 casos de uso** muy acotados que tendremos que llevar a cabo 💪

## 🔗 Contexto

¡Vamos a hacer un **acortador de enlaces**!

![Espera que te escucho y no te veo](https://media.giphy.com/media/2BeD9bQfMxq00/giphy.gif)

>Eeeemmmmm… ¿No habíamos quedado en algo sencillo y acotado?

Hay truco. Realmente **no lo vamos a hacer de 0**, sino que vamos a usar la API de uno de los más famosos: [Bitly](https://bitly.com/).

![Noooo no no nop](https://media.giphy.com/media/y1YqNut2cuOGY/giphy.gif)

>Yo nunca he hecho eso. No lo hemos visto en clase. Solo quiero recuperar la asignatura y me estás metiendo una turra increíble aquí 

Haya paz. Justamente Bitly tiene 2 cosas buenas:

* Una [API muy bien documentada](https://dev.bitly.com/v4_documentation.html)
* [Permite autenticarnos de forma sencilla](https://dev.bitly.com/v4/#section/Application-using-a-single-account) en caso de que todas las acciones las hagamos en nombre de la aplicación que tenemos que desarrollar (¡nuestro caso! 🎉)
    * Esto es sencillo ya que una vez registrados a través de la web, podemos obtener el [Token de Acceso Genérico](https://bitly.is/accesstoken) que nos autentica como nuestro usuario
    * También dispone de [métodos para autenticar a través de OAuth 2](https://dev.bitly.com/v4/#section/OAuth-2), pero como los enlaces que vamos a generar nos da igual que se hagan en nombre de nuestra aplicación, no es necesario e incluso sería contraproducente. Esto sería útil en caso de usar la API para generar enlaces en nombre de terceros usuarios de nuestra aplicación. Como decimos, no es nuestro caso ya que el acortador de URLs solo se va a usar como proyecto para 1 usuario.

## 🎯 Casos de uso a implementar

Ahora ya sí, ¡al turrón! 💪

Deberemos implementar 3 casos de uso. Antes de verlos en detalle, repaso rápido:

* 🔗 Acortar: Comando de CLI que dado una URL devuelva una URL acortada por Bitly
* 🏪 Guardar: Cada vez que se acorte un enlace a través del caso de uso anterior, se debe guardar en la base de datos toda su información
* 🎰 Contador: Endpoint HTTP que devuelva en JSON el número total de enlaces acortados segmentados por `utm_campaign`

### 🔗 Acortar

Comando de CLI que dado una URL devuelva una URL acortada por Bitly.

#### Ejemplos

Entrada:

* Con subdominio: https://www.google.com
* Sin subdominio: https://google.com
* Con querystring: https://drive.google.com?utm_source=linkedin&utm_medium=social&utm_campaign=get-drive&utm_content=get
* Con querystring pero sin `utm_campaign`: https://drive.google.com?utm_source=linkedin&utm_medium=social&utm_content=get
* Con emojis: https://drive.google.com?utm_source=linkedin&utm_medium=social&utm_campaign=get-drive-🤯&utm_content=get
* Con caracteres [escapados](https://www.urlencoder.org/): https://twitter.com/intent/tweet?status=%C2%BFHola%20qu%C3%A9%20hase%3F
* Con caracteres escapados que contienen URL con `utm_campaign` pero no es del propio enlace: https://twitter.com/intent/tweet?status=Tweet%20con%20enlace%3A%20https%3A%2F%2Fdrive.google.com%3Futm_campaign%3Deste-no-se-debe-contar%26utm_content%3Dtweet

Salida: https://bit.ly/2LpgbVV

#### Consideraciones

* Para facilitar la implementación, [aquí el endpoint de la API que se debe usar](https://dev.bitly.com/v4/#operation/createFullBitlink).
* Si se hace click en el enlace que devuelve el comando de CLI, este debe llevar a exactamente la misma URL que se ha introducido como entrada (☝️ revisar casos con caracteres especiales).
* Puede que el comando se ejecute especificando un argumento de entrada que no sea una URL válida. En ese caso debemos evitar intentar acortar la URL e informar debidamente al usuario.

### 🏪 Guardar

Cada vez que se acorte un enlace a través del caso de uso anterior, se debe guardar en la base de datos toda su información.

El objetivo es poder mantener en esa base de datos la relación entre URL original y URL acortada.

### 🎰 Contador

Endpoint HTTP que devuelva en JSON el número total de enlaces acortados segmentados por `utm_campaign`.

#### Ejemplos

* Respuesta para el caso en el que hubiéramos acortado los 7 ejemplos que se especificaban en el caso de uso "🔗 Acortar":
    ```json
    {
      "total": 7,
      "utm_campaigns": [
        {
          "get-drive": 1
        },
        {
          "get-drive-🤯": 1
        }
      ]
    }
    ```
* Ejemplo en caso de no tener enlaces con `utm_campaign`:
    ```json
    {
      "total": 7,
      "utm_campaigns": []
    }
    ```

#### Tipos de las propiedades

* `Counter`:
    ```json
    {
      "total": int,
      "utm_campaigns": array[UtmCampaign]
    }
    ```
* `UtmCampaign`:
    ```json
    {
      "arbitrary_campaign_name": int,
    }
    ```

## 🤔 Preguntas frecuentes

### 🚀 Uso de bootstraps o esqueletos para el proyecto

* No es obligatorio, se puede empezar de 0
* Se puede partir de cualquier [proyecto de esqueleto](https://github.com/CodelyTV?q=skeleton&type=&language=php) o práctica de grupo si se considera oportuno
* Lo que importa son los criterios de calidad definidos en este enunciado y [el documento `EVALUACION.md`](EVALUACION.md) respecto al código final que entreguéis
* El objetivo es simular con el máximo de cercanía posible un entorno de trabajo real, y en este tendríais acceso a este tipo de herramientas
* En caso de usarlos, se deberá eliminar cualquier elemento (rutas, clases, métodos, dependencias, etc) que no se usen para la práctica

### 🛂 Estructura de _namespace_

* Estructura de _namespaces_ escalable. Como raíz del proyecto usaremos: `LaSalle\UrlShortener\NombreApellido\` reemplazando `NombreApellido` por los valores correspondientes
* Si se usan proyectos de esqueleto o bootstrap como los descritos en el punto anterior, se deberá reemplazar su _namespace_ por el descrito en el punto anterior
    * Por limitaciones técnicas de Composer y PSR4, no podemos definir 2 namespaces en la misma carpeta `src`, con lo que asumimos que al ser un esqueleto y no una dependencia, podemos cambiar su namespace

### 🤝 Uso de librerías para comunicarnos con la API de Bitly

* Se puede interaccionar directamente con la API usando `curl` o librerías como `Guzzle`
* Se puede interaccionar a través de cualquier cliente de la API que ya esté disponible en PHP

Conclusión: Sí. No hay ningún problema con usar cualquier dependencia de Composer que se considere oportuno. Lo único a tener en cuenta es la compatibilidad con la API de Bitly en su versión 4 (siguiente pregunta).

### 🤲 Versión de la API a usar

Se debe usar la **versión 4 de la API** ya que la 3 está abandonada.

* Esto es importante ya que hay clientes de PHP que tiran de la versión 3. Clientes que _no_ se deben usar:
    * [jsocol/bitly-api-php](https://github.com/jsocol/bitly-api-php/blob/master/Bitly.php#L290)
    * [tijsverkoyen/Bitly](https://github.com/tijsverkoyen/Bitly/blob/master/bitly.php#L63)
    * Otros que se puedan encontrar y que ataquen a versiones diferentes de la 4
* Además, en los artículos o respuestas de StackOverflow que se puedan encontrar, también puede pasar que sean para versiones anteriores y por tanto _no_ aplican:
    * [BitLy (bit.ly) PHP Class – Shorten and Expand URLs (and Hashes) with BitLy API](https://www.if-not-true-then-false.com/2009/bitly-bit-ly-php-class-shorten-and-expand-urls-and-hashes-with-bitly-api/0)
    * [Acortar urls con PHP: Con la API de Bitly](https://www.baulphp.com/acortar-urls-con-php-con-la-api-de-bitly/)
* No obstante, al ser una API bastante usada, también encontraréis ya posts o respuestas para interaccionar con la versión 4 desde hace más de 1 año:
    * [Create TinyURL Using Bitly API in PHP](https://artisansweb.net/create-tinyurl-using-bitly-api-php/)
    * [How to shorten URL using PHP Bitly v4?](https://stackoverflow.com/questions/55681871/how-to-shorten-url-using-php-bitly-v4)

### 📤 Entrega de la práctica

* Entrega vía GitHub Classroom en el _assignment_ especificado en el correo.
* A la hora de evaluar se tendrá en cuenta lo que haya en la rama `master` del repositorio obviando el resto de posibles ramas.

### 🗓️ Fecha de entrega

Los detalles de la fecha límite se encuentran en el propio _assignment_ de GitHub Classroom.

### 🧮 Nota máxima

Al tratarse de una recuperación y no de una evaluación normal, se aplicará una nota máxima de 7. Ejemplos:

| Nota práctica recuperación | Nota resultante |
| -------------------------- | --------------- |
|             1              |        1        |
|             2              |        2        |
|             3              |        3        |
|             4              |        4        |
|             5              |        5        |
|             6              |        6        |
|             7              |        7        |
|             8              |        7        |
|             9              |        7        |
|             10             |        7        |

### 🔮 Cómo se calcula la nota

En el fichero `EVALUACION.md` que acompaña a este fichero `ENUNCIADO.md` se especifican distintos criterios de evaluación que se tendrán en cuenta a la hora de valorar la nota a obtener.

☝️ **Importante**: En la entrega se debe incluir el fichero `EVALUACION.md` con las tablas de autoevaluación debidamente cumplimentadas.

### ☁️ En caso de duda

Puedes enviar un email a javier.ferrer@salle.url.edu con copia a david.vernet@salle.url.edu.
