<template>
  <ul
    class="dropdown-menu dropdown-menu-right animated bounceInDown"
    aria-labelledby="dLabel"
  >
    <li>
      <p>
        <router-link to="/cuenta"><b> Jesus </b></router-link>
      </p>
    </li>
    <li>
      <router-link to="/cuenta"
        ><i class="material-icons">person</i> Jesus
      </router-link>
    </li>
    <li>
      <router-link to="/administrador">
        <i class="material-icons">settings</i>Configuración</router-link
      >
    </li>
    <li>
      <a href="/logout">
        <i class="material-icons">power_settings_new</i> Cerrar Sesión</a
      >
    </li>
  </ul>
</template>
