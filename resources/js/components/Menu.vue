<template>
    <nav class="navbar navbar-expand-lg" style="background-color: #fee879;">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">DineDynamo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02"
          aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor02">
          <ul class="navbar-nav me-auto">
            
            <li class="nav-item">

            <router-link to="/" class="nav-item nav-link">Home</router-link>
            </li>
            <!-- Affiche les éléments seulement pour un admin (rôle 1) -->
            <li class="nav-item">
              <router-link to="/listCat" class="nav-item nav-link">Category</router-link>
            </li>
            <li  class="nav-item">
              <router-link to="/listProd" class="nav-item nav-link">Product</router-link>
            </li>
            <li  class="nav-item">
              <router-link to="/listcmd" class="nav-item nav-link">Commande</router-link>
            </li>
  
            <!-- Affiche les éléments uniquement si l'utilisateur n'est pas connecté -->
            <li  class="nav-item">
              <router-link to="/login" class="nav-link active">Login</router-link>
            </li>
            <li  class="nav-item">
              <router-link to="/register" class="nav-link active">Register</router-link>
            </li>
            <li class="nav-item">
<router-link to="/shopping" class="nav-item nav-link"> Shopping Cart</router-link>
            </li>
       
            <!-- ... Autres éléments de menu ... -->
  
            <li  class="nav-item">
              <button class="nav-link active" @click="logout">Logout</button>
            </li>

          </ul>
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
<li class="nav-item me-3">
<router-link class="nav-link position-relative" :class="$route.name == 'Cart'? 'active':''" aria-current="page" :to="{ name: 'Cart'}">

<i class="fa-solid fa-cart-shopping fa-lg" style="color:#ffffff;"></i>

<span v-if="$store.state.Articlestore.cart.length > 0"

class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-
danger">

{{ $store.state.Articlestore.cart.length }}
</span>
</router-link>

</li>
</ul>
          <form class="d-flex">
<input class="form-control me-sm-2" type="search" placeholder="Search">
<button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
</form>

          <!-- ... Formulaire de recherche et autres éléments ... -->
        </div>
      </div>
    </nav>
  </template>
  
  <script setup>
  import axios from 'axios';
  import { useRouter } from 'vue-router';
  
  const router = useRouter();

  // Récupérer le rôle de l'utilisateur depuis le stockage local
  const userRole = parseInt(localStorage.getItem('userRole'), 10); // Parse as number (base 10)
  
  // Vérifier si l'utilisateur est connecté ou non
  const isLoggedIn = localStorage.getItem('token') !== null; // Check if user is logged in
  
  // Fonction pour déconnecter l'utilisateur
  const logout = async () => {
  let token = localStorage.getItem('token');
  console.log(token);
  axios.post('http://localhost:8000/api/logout', null, {
    headers: {
      'Authorization': `Bearer ${token}`
    }
  })
    .then((response) => { // Make sure 'response' is defined here
      console.log(response);
      localStorage.removeItem('token');
      localStorage.removeItem('user');
      router.push("/login");
    })
    .catch(err => {
      console.log(err);
      alert(err);
    });
};

  </script>
  
  <!-- ... Votre style ... -->
  