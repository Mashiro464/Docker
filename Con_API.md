# INFORME  
## Montaje de una Aplicación Web basada en API usando Docker y Portainer

---

## 1. Introducción
El objetivo de este proyecto es desplegar una aplicación web que consume datos de una API externa, concretamente la **PokéAPI**, utilizando contenedores Docker gestionados mediante **Portainer**.

La aplicación permite visualizar información de Pokémon sin necesidad de una base de datos local, ya que los datos se obtienen dinámicamente desde la API.

Este enfoque es habitual en aplicaciones modernas, ya que reduce la complejidad del backend y facilita el mantenimiento.

---

## 2. Tecnologías utilizadas
Las tecnologías empleadas en el proyecto son las siguientes:

- **Docker**: plataforma de contenedores.
- **Portainer**: interfaz web para la gestión de Docker.
- **Nginx**: servidor web.
- **HTML / CSS / JavaScript**: frontend de la aplicación.
- **PokéAPI**: API REST pública con información de Pokémon.
- **GitHub**: repositorio del proyecto.

---

## 3. API utilizada: PokéAPI
La aplicación consume datos de la API pública **PokéAPI**, cuyas características son:

- **URL**: https://pokeapi.co  
- **Tipo**: API REST pública  
- **Formato de datos**: JSON  

### Información obtenida
- Nombre del Pokémon
- Tipos
- Imagen
- Estadísticas básicas

La aplicación realiza peticiones HTTP mediante `fetch` directamente desde el navegador.

---

## 4. Estructura del proyecto

```text
pokedex/
├── index.html
├── css/
│   └── styles.css
├── js/
│   └── app.js
└── docker-compose.yml
Descripción de los archivos
index.html: estructura principal de la web.

styles.css: diseño visual de la aplicación.

app.js: lógica JavaScript para consumir la API.

docker-compose.yml: definición del contenedor Nginx.

5. Docker Compose
Se utiliza un único servicio con Nginx para servir la aplicación web.

yaml
Copiar código
version: "3.8"

services:
  web:
    image: nginx:alpine
    container_name: pokedex_web
    ports:
      - "8080:80"
    volumes:
      - ./pokedex:/usr/share/nginx/html:ro
    restart: unless-stopped
Este archivo permite:

Levantar un contenedor Nginx.

Publicar la web en el puerto 8080.

Servir archivos estáticos del proyecto.

6. Despliegue en Portainer
El despliegue del proyecto se realiza siguiendo estos pasos:

Acceso a Portainer desde el navegador.

Creación de un nuevo Stack.

Pegado del archivo docker-compose.yml.

Despliegue del stack.

Verificación de que el contenedor está en estado Running.

7. Funcionamiento de la aplicación
El funcionamiento de la aplicación es el siguiente:

El usuario accede a la web desde el navegador.

JavaScript realiza peticiones a la PokéAPI.

La API devuelve los datos en formato JSON.

Los datos se muestran dinámicamente en pantalla.

No se almacena información localmente.

8. Pruebas realizadas
Durante el desarrollo se realizaron las siguientes pruebas:

Acceso correcto a la web desde el navegador.

Carga correcta de datos desde la API.

Visualización de imágenes de Pokémon.

Funcionamiento sin base de datos.

Persistencia del servicio tras reinicio del contenedor.

9. Ventajas del uso de una API
El uso de una API externa presenta varias ventajas:

No es necesario gestionar una base de datos.

Los datos están siempre actualizados.

Menor complejidad del backend.

Escalabilidad sencilla.

Ideal para proyectos de demostración y aprendizaje.

10. Problemas encontrados y soluciones
Problema	Solución
Puerto ocupado	Cambio de puerto en docker-compose.yml
No cargaban datos	Verificación de la URL de la API
Error de permisos	Uso correcto de volúmenes en modo lectura

11. Conclusión
El proyecto demuestra cómo desplegar una aplicación web moderna basada en una API externa utilizando Docker y Portainer.

Este enfoque es eficiente, escalable y muy utilizado en entornos reales de desarrollo, especialmente cuando no se requiere almacenamiento local de datos.
