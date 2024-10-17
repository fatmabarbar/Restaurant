<template>
  <div class="container mt-5 position-relative">
    <br>
    <br>
    <div v-if="isLoading">
      <h2>Loading ....</h2>
    </div>
    <div v-else class="row justify-content-center">
      <div class="col-md-4 mb-4" v-for="product in Produits" :key="product.id">
        <div class="card">
          <img :src="product.image" class="card-img-top" alt="Product Image" style="max-height: 150px; object-fit: cover;">
          <div class="card-body">
            <h5 class="card-title">{{ product.nom ? product.nom : '' }}</h5>
            <p class="card-text">{{ product.description }}</p>
            <p class="card-text">Catégorie: {{ getCategoryName(product.categorie_id) }}</p>
            <p class="card-text">Prix: {{ product.prix }} TND</p>
            <button class="btn btn-outline-primary mx-2" @click="addToCart(product)">
              <i class="fa-solid fa-eye"></i> Add to Cart
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

</template>

<script setup>

import axios from 'axios';
import { ref, onMounted } from 'vue';
import { useStore } from 'vuex';  // Import useStore from vuex
import { useRouter } from 'vue-router';
const store = useStore();  



const Produits = ref([]);
const categories = ref([]);
const isLoading = ref(true);
const router = useRouter();


const axiosInstance = axios.create({
  baseURL: 'http://localhost:8000/api',
  headers: {
    common: {
      Authorization: `Bearer ${localStorage.getItem('token')}`,
    },
  },
});

axiosInstance.get('/produits')
  .then((response) => {
    Produits.value = response.data;
    isLoading.value = false;
  })
  .catch((error) => {
    console.error(error);
  });


  // HomeCart.vue
  const    addToCart=(prod)=> {

store.commit("Articlestore/addCart", {product:prod,qty:1});

             }  



const getCategoryName = (categoryId) => {
  const category = categories.value.find((cat) => cat.id === categoryId);
  return category ? category.nomcategorie : 'N/A';
};

const fetchCategories = async () => {
  try {
    const response = await axios.get('http://localhost:8000/api/categories');
    categories.value = response.data;
    isLoading.value = false;
  } catch (error) {
    console.error('Error fetching categories:', error);
  }
};

axiosInstance.get('/produits')
  .then((response) => {
    Produits.value = response.data;
    isLoading.value = false;
  })
  .catch((error) => {
    console.error(error);
  });

onMounted(async () => {
  fetchCategories();
});
</script>


<style scoped>
.container {
  margin-top: 70px;
}

.card {
  width: 25rem;
  margin-bottom: 1rem;
  border: 0.5px solid #4e4d56; /* Border color */
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Box shadow for a subtle lift */
  transition: transform 0.2s;
}

.card:hover {
  transform: scale(1.02); /* Enlarge the card on hover for a subtle effect */
}

.card-img-top {
  max-height: 150px;
  object-fit: cover;
  border-top-left-radius: 8px;
  border-top-right-radius: 8px;
}

.card-body {
  padding: 1.25rem;
}

.card-title {
  font-size: 1.25rem;
  font-weight: bold;
}

.card-text {
  margin-bottom: 1rem;
}

.btn-outline-primary {
  background-color: transparent;
  color: #4e4d56;
  border-color: #4e4d56;
  transition: background-color 0.3s, color 0.3s;
}

.btn-outline-primary:hover {
  background-color: #8f8e9b;
  color: #fff;
}
</style>

