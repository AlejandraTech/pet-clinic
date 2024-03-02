# Clínica Veterinaria - Gestión de Usuarios 🐾

Este proyecto consiste en una página web para la gestión de usuarios de una clínica veterinaria. Permite realizar operaciones CRUD (Crear, Leer, Actualizar y Eliminar) en las entidades de propietarios, mascotas e historiales médicos. El sistema está desarrollado en PHP y utiliza una base de datos MySQL para almacenar la información.

## Contenido del Repositorio 📂

El repositorio contiene los siguientes archivos y carpetas:

- `index.php`: Página principal de la aplicación.
- `model/`: Carpeta que contiene las clases PHP que representan los modelos de datos.
- `util/`: Carpeta que contiene clases de utilidad y mensajes de error.
- `view/`: Carpeta que contiene las vistas de la aplicación, incluyendo formularios y páginas de resultados.
- `controller/`: Carpeta que contiene los controladores PHP que manejan las peticiones del usuario.
- `persist/`: Carpeta que contiene clases para la persistencia de datos, incluyendo la conexión a la base de datos y la interfaz de modelo.
- `css/`, `js/`, `img/`: Carpetas que contienen recursos estáticos como hojas de estilo CSS, scripts JavaScript e imágenes.
- `README.md`: Este archivo que proporciona información sobre el proyecto.

## Funcionalidades 🛠️

1. **Gestión de Propietarios**:
   - Agregar, modificar, eliminar y buscar propietarios.
   - Listar todos los propietarios registrados en la base de datos.

2. **Gestión de Mascotas**:
   - Agregar, modificar, eliminar y buscar mascotas.
   - Listar todas las mascotas registradas en la base de datos.
   - Asociar mascotas a sus respectivos propietarios.

3. **Gestión de Historiales Médicos**:
   - Agregar y buscar historiales médicos.
   - Listar todos los historiales médicos registrados en la base de datos.

## Cómo Usar 📋

1. Clona este repositorio en tu entorno local.
2. Configura la conexión a la base de datos en el archivo `persist/DBConnection.class.php`.
3. Importa la estructura de la base de datos utilizando el archivo SQL proporcionado.
4. Abre la aplicación en tu navegador web.
5. Utiliza las diferentes funcionalidades disponibles para gestionar los usuarios de la clínica veterinaria.

## Contribuciones 🤝

Las contribuciones son bienvenidas. Si encuentras algún problema o tienes una idea para mejorar la aplicación, no dudes en abrir un issue o enviar un pull request.

## Autor 👩‍💻

Este proyecto fue creado por **@AlejandraTech** ([GitHub](https://github.com/AlejandraTech)).
