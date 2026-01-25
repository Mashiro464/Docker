# Proyecto: Pokédex con MySQL y Docker (Portainer)

## Descripción general
Este proyecto consiste en el despliegue de una aplicación web Pokédex conectada a una base de datos MySQL real, utilizando contenedores Docker y gestionado mediante Portainer.

La aplicación muestra un listado de Pokémon almacenados en una base de datos MySQL, demostrando el uso de contenedores, volúmenes persistentes y comunicación entre servicios.

---

## Arquitectura del proyecto
El sistema está compuesto por tres servicios principales:

- MySQL 8.0 como sistema gestor de base de datos
- Aplicación web PHP con Apache
- phpMyAdmin para la administración de la base de datos

Todos los servicios se orquestan mediante Docker Compose.

---

## Estructura del proyecto
```
/opt/pokemon-mysql
├── docker-compose.yml
├── Dockerfile
├── db/
│   └── init.sql
└── www/
    └── index.php
```
---
## Objetivos del proyecto
El objetivo principal del proyecto es desplegar una aplicación web funcional conectada a una base de datos relacional, utilizando contenedores Docker y herramientas de orquestación.

### Objetivos específicos:
- Desplegar una base de datos MySQL en un contenedor Docker.
- Desarrollar una aplicación web PHP que consulte datos desde MySQL.
- Utilizar volúmenes Docker para garantizar la persistencia de los datos.
- Gestionar el despliegue mediante Portainer.
- Documentar el proceso y las incidencias encontradas.

---

## Tecnologías utilizadas

| Tecnología      | Descripción |
|----------------|-------------|
| Docker         | Plataforma de contenedores utilizada para el despliegue |
| Docker Compose | Orquestación de múltiples servicios |
| Portainer      | Gestión visual de contenedores y stacks |
| MySQL 8.0      | Sistema gestor de bases de datos |
| PHP 8.2        | Lenguaje de programación de la aplicación web |
| Apache         | Servidor web |
| phpMyAdmin     | Administración de la base de datos |

---

## Funcionamiento del sistema
El sistema está compuesto por tres contenedores que se comunican entre sí mediante una red Docker interna creada automáticamente por Docker Compose.

- El contenedor **web** ejecuta Apache y PHP.
- El contenedor **db** ejecuta MySQL y expone el servicio internamente.
- El contenedor **phpMyAdmin** se conecta a la base de datos para su administración.

La aplicación web se conecta a MySQL utilizando el nombre del servicio (`db`) como host, aprovechando la resolución DNS interna de Docker.

---

## Persistencia de datos
Para garantizar que los datos no se pierdan al reiniciar los contenedores, se utiliza un volumen Docker:

- `pokemon_mysql_data`

Este volumen almacena los datos de MySQL en el host y permite que la información persista aunque los contenedores sean eliminados o recreados.

---

## Inicialización de la base de datos
La base de datos se inicializa automáticamente mediante el archivo `init.sql`, que se ejecuta en el primer arranque del contenedor MySQL.

Este script:
- Crea la base de datos `pokemon`.
- Crea la tabla `pokedex`.
- Inserta 151 Pokémon correspondientes a la primera generación.

---

## Despliegue con Portainer
El despliegue del proyecto se realiza mediante un stack en Portainer, lo que permite gestionar los servicios de forma visual.

El uso de Portainer facilita:
- El control del estado de los contenedores.
- El acceso a logs.
- La gestión de volúmenes y redes.
- La modificación del stack sin usar la línea de comandos.

---

## Justificación de decisiones técnicas
Se ha elegido Docker como tecnología principal debido a su portabilidad y facilidad de despliegue.

MySQL se utiliza como base de datos relacional por su uso extendido y estabilidad.  
PHP se ha seleccionado para la aplicación web por su integración sencilla con MySQL.  
Portainer se emplea para simplificar la administración de contenedores.

---

## Limitaciones del proyecto
- La aplicación web solo muestra datos (no incluye CRUD completo).
- No se implementa autenticación de usuarios.
- El diseño de la interfaz es básico.

Estas limitaciones se deben al enfoque del proyecto en el despliegue y la infraestructura.

---




# Conceptos teóricos sobre contenedores
## ¿Qué son los contenedores Docker?

Los contenedores Docker son entornos ligeros y aislados que permiten ejecutar aplicaciones junto con todas sus dependencias (librerías, configuración y código) de forma consistente. Comparten el kernel del sistema operativo del host, lo que los hace más eficientes que las máquinas virtuales tradicionales.

## ¿Qué diferencias hay entre los contenedores Docker y LXC?

Los contenedores LXC están orientados a la virtualización de sistemas completos, funcionando como un sistema Linux reducido.
Por el contrario, Docker está enfocado a la ejecución de aplicaciones concretas y microservicios, ofreciendo un ecosistema más sencillo para construir, distribuir y desplegar aplicaciones mediante imágenes estandarizadas.

## ¿Cuál es la diferencia entre una imagen y un contenedor en Docker?

Imagen: es una plantilla inmutable que define cómo será el entorno de la aplicación (sistema base, dependencias y configuración).

Contenedor: es una instancia en ejecución creada a partir de una imagen.

En resumen, la imagen es el modelo y el contenedor es la aplicación en funcionamiento.

## ¿Qué sucede con los datos cuando un contenedor se elimina?

Si no se utilizan volúmenes, los datos almacenados dentro del contenedor se pierden al eliminarlo.
Para evitarlo, Docker permite el uso de volúmenes, que almacenan los datos fuera del contenedor y garantizan su persistencia aunque este sea eliminado o recreado.

¿Cuáles son las ventajas de utilizar contenedores Docker?

- Portabilidad entre distintos entornos.

- Aislamiento de aplicaciones y dependencias.

- Despliegue rápido y reproducible.

- Menor consumo de recursos que las máquinas virtuales.

- Escalabilidad y facilidad de mantenimiento.

## ¿Qué tipo de aplicaciones y servicios se pueden desplegar con Docker?

Docker permite desplegar una amplia variedad de aplicaciones, entre ellas:

- Aplicaciones web.

- APIs y microservicios.

- Bases de datos.

- Servidores web.

- Herramientas de monitorización y administración.

- Entornos de desarrollo y pruebas.

## ¿Qué otros tipos de contenedores existen además de Docker?

Además de Docker, existen otras tecnologías de contenedores como:

- LXC / LXD

- Podman

- containerd

- CRI-O

- Contenedores Windows

# Guía de usuario: despliegue de una aplicación web con Docker
## 1. Requisitos previos

- Sistema con Docker y Docker Compose instalados.
  
- Acceso a Portainer.

- Proyecto web organizado en carpetas.

## 2. Preparación del proyecto

Se define la estructura del proyecto, incluyendo:

- Archivo docker-compose.yml.

- Dockerfile para la aplicación web.

- Archivos de la base de datos y de la aplicación.

## 3. Definición de servicios

En el archivo docker-compose.yml se definen los servicios necesarios:

- Servicio web (Apache + PHP).

- Servicio de base de datos MySQL.

- Servicio phpMyAdmin para la administración.

## 4. Configuración de red

Docker Compose crea automáticamente una red interna que permite la comunicación entre contenedores utilizando el nombre del servicio como host.

## 5. Persistencia de datos

Se configura un volumen Docker para almacenar los datos de MySQL y evitar su pérdida al reiniciar o eliminar los contenedores.

## 6. Inicialización de la base de datos

La base de datos se inicializa mediante un script SQL que se ejecuta automáticamente en el primer arranque del contenedor MySQL.

## 7. Despliegue del stack

El despliegue se realiza desde Portainer creando un stack y cargando el archivo docker-compose.yml.

## 8. Verificación del sistema

- Acceso a la aplicación web desde el navegador.

- Comprobación del estado de los contenedores.

- Acceso a phpMyAdmin para validar la base de datos.

## 9. Mantenimiento

- Portainer permite:

- Revisar logs.

- Reiniciar servicios.
  

Modificar el stack.

Gestionar volúmenes y redes.
