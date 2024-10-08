# Hardware-Store
Página Web para la Empresa de Harware-Sotore

## Estado del Proyecto 
En desarrollo

## Requisitos de Instalación
 1. **Instalación de apache2**
   - Configuración de Raíz de Apache en `/etc/apache2/sites-avalable`
 2. **Instalación de MySQL**
   - Configuración de Usuario y Contraseña de Acceso Remoto
 3. **Instalación de PHP 8.3**
   - Instalación de extensiones:
     - `libapache2-mod-php`
     - `php-mysql`
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

