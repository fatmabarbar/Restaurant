<template>
  <div class="container mt-4">
    <div class="row justify-content-center">
      <div class="container mt-5">
    <div v-if="isLoading">
      <h2>Loading...</h2>
    </div>
    <div v-else class="py-6">
      <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
        <div class="container-fluid">
          <router-link :to="{ name: 'AddCategorie' }" class="btn btn-outline-light">
            <i class="fa-solid fa-square-plus"></i> New Category
          </router-link>
        </div>
      </nav>
      <table class="table table-striped shadow">
        <thead>
          <tr>
            <th scope="col">Category Name</th>
            <th scope="col">Description</th>
            
          </tr>
        </thead>
        <tbody>
          <tr v-for="category in categories" :key="category.id">
            <td>{{ category.nomcategorie }}</td>
            <td>{{ category.description }}</td>
         
            <td>
              <template v-if="category && category.id"> <!-- Null check -->
                <router-link :to="{ name: 'EditCategorie', params: { id: category.id } }" class="btn btn-outline-success mx-2">
  <i class="fa-solid fa-edit"></i> Modifier
</router-link>
                <button class="btn btn-outline-danger mx-2" @click="deleteConfirmation(category.id)">
                  <i class="fa-solid fa-trash-can"></i> Supprimer
                </button>
              </template>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const categories = ref([]);
const isLoading = ref(true);

const fetchCategories = async () => {
  try {
    const response = await axios.get("http://localhost:8000/api/categories");
    categories.value = response.data;
    isLoading.value = false;
  } catch (error) {
    console.error("Error fetching categories:", error);
    // Handle error, e.g., show an error message or retry fetching
  }
};

onMounted(fetchCategories);

const deleteCategorie = async (id) => {
  try {
    await axios.delete(`http://localhost:8000/api/categories/${id}`);
    fetchCategories();
  } catch (error) {
    console.error("Error deleting category:", error);
    // Handle error, e.g., show an error message
  }
};

const deleteConfirmation = async (id) => {
  const confirmDelete = confirm("Are you sure you want to delete this category?");
  if (confirmDelete) {
    await deleteCategorie(id);
  } else {
    console.log("Deletion cancelled");
  }
};
</script>

<style scoped>

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
.navbar-dark {
  background-color: #fff !important;
}
/* Your component-specific styles */
</style>
