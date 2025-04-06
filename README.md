# Hardware-Store
Hardware-Store es una página web desarrollada en PHP puro, orientada a la gestión de productos de una ferretería. Permite a los usuarios registrarse, iniciar sesión, explorar productos personalizados y gestionar su carrito de compras.

## Estado del Proyecto
En desarrollo

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
