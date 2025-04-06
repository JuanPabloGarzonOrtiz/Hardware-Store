# Hardware-Store
Hardware-Store es una página web desarrollada en PHP puro, orientada a la gestión de productos de una ferretería. Permite a los usuarios registrarse, iniciar sesión, explorar productos personalizados y gestionar su carrito de compras.

## Estado del Proyecto
En desarrollo

<<<<<<< HEAD
## Requisitos de Instalación
 1. **Instalación de apache2**
   - Configuración de Raíz de Apache en `/etc/apache2/sites-avalable`
 2. **Instalación de MySQL**
   - Configuración de Usuario y Contraseña de Acceso Remoto
 3. **Instalación de PHP 8.3**
   - Instalación de extensiones:
     - `libapache2-mod-php`
     - `php-mysql`
     - `php-sqlite3`
     - `composer`
   - Habilitar PHP para servidor:
     - `sudo a2enmod php`
     - `sudo systemctl restart apache2`

## Estructura
### Archivos Principales
 - `README.md`: Archivo de explicación de Proyecto.
 - `index.php`: Archivo de inicio de aplicación e invoca el inicio.
 - **database/**: 
   - `Hardware_Store.db`: Archivo donde se guarda el registro del SQL de la Base de datos, con la creación e inserción de datos.
   - `database.php`: Archivo de Gestión de Consultas SQL del Proyecto.
### Directorios
 - **templates/**:
   - `base.php`: Archivo de  donde se crean el header y el footer, reutilizado en todas las Plantillas.
   - `inicio.php`: Archivo de Página inicial de Proyecto.
   - `division-productos.php`: Archivo de Pagina de Productos, adaptable por medio de consultas SQL para mostrar los productos según la sección seleccionada en el Header.
   - `carrito.php`: Archivo de Página  donde se mostrara los Productos añadidos al carrito.
   - `logeo.php`: Página donde el usuario se puede autentificar para poder tener acceso a su cuenta personal.
   - `registro-user.php`: Página para que los usuarios sin cuenta puedan crear su cuenta de usuario.
 - **statics/**:
   - `style.css`: Archivo de Estilo usado para el Header y Footer.
   - `style-Home`: Archivo de Estilo para el main de la Plantilla de inicio.
   - `style-division-productos.css`: Archivo de Estilo para el main de la Plantilla de Página de Productos.
   - `style-carrito.css`: Archivo de Estilo para el main de la Plantilla del Carrito de Compras.
   - `style-Logeo.css`:  Archivo de Estilo para el main de la Plantilla del Logeo y Registro.
 - **imgs/**: Directorio donde se guardan las Imágenes del Proyecto.
=======
## Tecnologías Usadas
- PHP 8.3 
- MariaDB 
- Apache2 
- HTML5 & CSS3 
- JSON *(manejo de carrito y sesiones)* 
- JavaScript *(pendiente de integración)* 

## Instalación y Configuración

### Requisitos Previos
- Apache2
- MariaDB || MySQL
- PHP 8.3

### Pasos de Instalación
1. Configuración de la raíz de Apache en:
   `/etc/apache2/sites-available`
2. Crear la base de datos en MariaDB.
3. Configuración de usuario y contraseña de acceso.
4. Instalación de extensiones necesarias:
   - `libapache2-mod-php`
   - `php-mysql` 
5. Habilitar PHP:
   - `sudo a2enmod php`
   - `sudo systemctl restart apache2`

##Organización del Proyecto

```
Hardware-Store/
│
├── index.php               # Archivo de inicio de aplicación
├── README.md               # Documentación del proyecto
│
├── database/               # Gestión de la base de datos
│   ├── Hardware_Store.db   # Script SQL con creación e inserción de datos
│   └── database.php        # Conexión y consultas SQL
│
├── templates/              # Plantillas HTML/PHP reutilizables
│   ├── base.php            # Header y Footer global
│   ├── inicio.php          # Página principal
│   ├── division-productos.php  # Página de productos por sección
│   ├── carrito.php         # Página del carrito de compras
│   ├── logeo.php           # Página de login
│   └── registro-user.php   # Página de registro de usuario
│
├── statics/                # Archivos estáticos (CSS)
│   ├── style.css                      # Estilo global (Header & Footer)
│   ├── style-Home.css                 # Estilo página principal
│   ├── style-division-productos.css   # Estilo productos
│   ├── style-carrito.css              # Estilo carrito
│   └── style-Logeo.css                # Estilo login/registro
│
└── imgs/                   # Imágenes del proyecto

```

## Próximos Pasos
- Integrar JavaScript para mejorar la experiencia de usuario.
- Mejorar la gestión del carrito de compras.
- Añadir filtrado dinámico de productos sin recarga.
