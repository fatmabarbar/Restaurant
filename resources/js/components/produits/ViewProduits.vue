<template>
  <div class="container mt-4 position-relative">
    <div class="row justify-content-center">
      <div class="container mt-5">
        <div v-if="isLoading">
          <h2>Chargement en cours....</h2>
        </div>
        <div v-else class="py-6">
          <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
            <div class="container-fluid">
              <div class="dropdown position-absolute" style="top: 10px; right: 10px;">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Trier par
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <li @click="sortBy('nom')"><a class="dropdown-item">Nom</a></li>
    <li @click="sortBy('categorie_id')"><a class="dropdown-item">Catégorie</a></li>
    <li @click="sortBy('prix')"><a class="dropdown-item">Prix</a></li>
  </ul>
</div>

              <router-link :to="{ name: 'AddProduit' }" class="btn btn-outline-light">
                <i class="fa-solid fa-square-plus"></i> Nouveau Produit
              </router-link>
            </div>
            <br>
            <br>
            <br>
          </nav>

          <div class="row">
            <div v-for="produit in produits" :key="produit.id" class="col-md-4 mb-4">
              <div class="card">
                <img :src="produit.image" class="card-img-top" alt="Product Image" style="max-height: 150px; object-fit: cover;">
                <div class="card-body">
                  <h5 class="card-title">{{ produit.nom }}</h5>
                  <p class="card-text">{{ produit.description }}</p>
                  <p class="card-text">Catégorie: {{ getCategoryName(produit.categorie_id) }}</p>
                  <p class="card-text">Prix: {{ produit.prix }}</p>
                  <button class="btn btn-outline-primary mx-2">
                    <i class="fa-solid fa-eye"></i> Voir
                  </button>
                  <router-link :to="{ name: 'EditProduit', params: { id: produit.id } }" class="btn btn-outline-warning mx-2">
                    <i class="fa-solid fa-pen-to-square"></i>
                  </router-link>
                  <button class="btn btn-outline-danger mx-2" @click="deleteConfirmation(produit.id)">
                    <i class="fa-solid fa-trash-can"></i>
                  </button>
                  <!--<button class="btn btn-outline-primary" @click="addToCart(prod)" >Add to Cart</button>-->
    
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
//import { Store } from "vuex";
import store from '../store';


const produits = ref([]);
const categories = ref([]);
const isLoading = ref(true);

const axiosInstance = axios.create({
  baseURL: 'http://localhost:8000/api',
  headers: {
    common: {
      Authorization: `Bearer ${localStorage.getItem('token')}`,
    },
  },
});

const sortBy = (field) => {
  produits.value.sort((a, b) => {
    if (field === 'nom') {
      return a.nom.localeCompare(b.nom);
    } else if (field === 'categorie_id') {
      return a.categorie_id - b.categorie_id;
    } else if (field === 'prix') {
      return a.prix - b.prix;
    }
    // Default to 0 to maintain the existing order if the field is not recognized
    return 0;
  });
  // Use the spread operator to create a new array reference
  produits.value = [...produits.value];
};



const getCategoryName = (categoryId) => {
  const category = categories.value.find(cat => cat.id === categoryId);
  return category ? category.nomcategorie : 'N/A';
};

const fetchCategories = async () => {
  try {
    const response = await axios.get("http://localhost:8000/api/categories");
    categories.value = response.data;
    isLoading.value = false;
  } catch (error) {
    console.error("Error fetching categories:", error);
  }
};

axiosInstance.get('/produits')
  .then((response) => {
    produits.value = response.data;
    isLoading.value = false;
  })
  .catch((error) => {
    console.error(error);
  });

const getProduits = async () => {
  try {
    const token = localStorage.getItem('token');
    const response = await axios.get("http://localhost:8000/api/produits", {
      headers: {
        'Authorization': `Bearer ${token}`
      }
    });
    produits.value = response.data;
    isLoading.value = false;
  } catch (error) {
    console.error(error);
  }
};

onMounted(async() => {
  await fetchCategories();
  getProduits();
});

const deleteProduit = async (id) => {
  try {
    const token = localStorage.getItem('token');
    await axios.delete(`http://localhost:8000/api/produits/${id}`, {
      headers: {
        'Authorization': `Bearer ${token}`
      }
    });
    getProduits();
  } catch (error) {
    console.error("Erreur lors de la suppression du produit :", error);
  }
};

const deleteConfirmation = async (id) => {
  const confirmDelete = confirm("Êtes-vous sûr de vouloir supprimer cet élément ?");

  if (confirmDelete) {
    await deleteProduit(id);
  } else {
    console.log("Suppression annulée");
  }
};
/*const addToCart=(prod)=> {
    store.commit("Articlestore/addCart", { prod, qty: 1 });
}*/
</script>

<style lang="scss" scoped>
/* Vos styles spécifiques à la vue ici */
</style>

<style lang="scss" scoped>
/* Styles spécifiques à la vue viewproduits */

/* Style du bouton "New Produit" */
.btn-outline-light {
  background-color: transparent;
  color: #a90909;
  border-color: #fff;
  transition: background-color 0.3s, color 0.3s;
}

.btn-outline-light:hover {
  background-color: #db8d8d;
  color: #000;
}

/* Style de la navbar */
.navbar-dark {
  background-color: #fff !important;
}

/* Additional style for table images */
.table img {
  border-radius: 5px;
  object-fit: cover;
}
:root {
  --confirmation-bg: #fff; /* Background color */
  --confirmation-text: #f8d117; /* Text color */
  --confirmation-border: #d02d04; /* Border color */
}

/* Override the default dialog styles */
.confirmation-dialog {
  background-color: var(--confirmation-bg);
  color: var(--confirmation-text);
  border: 1px solid var(--confirmation-border);
}
</style>
