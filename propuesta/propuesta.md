% AlCar
% Eduardo López Manga
% Curso 2022/23

# Descripción general del proyecto
Esta aplicación web está diseñada para la venta y gestión de un portal de alquileres de coche donde cualquier persona que cumpla los requisitos 
pueda generar beneficios, tanto para él como para nosotros. Así cualquier persona puede optar a alquilar un coche sin necesidad de otro intermediario
más allá de este portal.


## Funcionalidad principal de la aplicación

Realizar búsquedas de coches, dar de alta a clientes y estos a su vez pueden dar de alta a sus coches.

Para poder acceder al contenido de la web, el usuario debe registrarse y se le generará un perfil donde podrá ver sus coches en alquiler
y podrá acceder tanto a sus reservas como buscar un coche en la web.

Los administradores no tendrán un perfil pero podrán borrar usuarios y ver datos **básicos**. La funcionalidad más necesaria del adminstrador es la 
validación de coches antes de que se muestren al resto de usuarios. 


## Objetivos generales

* Objetivo: Añadir y localizar coches en alquiler además de poder añadir los propios coches.

* Casos de uso: 
    * Usuario *Sin Sesión*: "Registrarse", "Iniciar Sesión".
    * Usuario *Huésped*: "Realizar búsquedas", "Alquilar coches","Ver Reservas de coches", "Editar sus datos", "Ver perfil de *Anfitrión*".
    * Usuario *Huésped y Anfitrión*: "Realizar búsquedas", "Alquilar coches", "Ver Reservas de coches", "Editar sus datos", "Ver perfil de *Anfitrión*", 
                                     "Registrar su coche", "Ver sus coches", "Ver perfiles de Huéspedes", "Editar coche", "Borrar Coche".
    * Administrador: "Dar de Baja Clientes", "Validar coches", "Dar de Baja coches".

# Elemento de innovación
	Introducción de las APIs de Google para la localización de los puntos de recogida de los vehículos.