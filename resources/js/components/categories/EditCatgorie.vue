<template>
    <div class="col-md-6 offset-md-3 border rounded p-4 mt-2 shadow">
      <br>
      <br>
      <h4 align="center">Modifier la catégorie</h4>
      <form @submit.prevent="modifierCategorie">
        <div class="row">
          <div class="col-md-6">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" v-model="categorie.nomcategorie">
          </div>
          <div class="col-md-6 ms-auto">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" id="description" v-model="categorie.description">
          </div>
        </div>
        <!-- Autres champs du formulaire pour les catégories -->
        <br>
        <button type="submit" class="btn btn-outline-primary">
          <i class="fa-solid fa-floppy-disk"></i> Enregistrer
        </button>
        <router-link to="/ListCat" class="btn btn-outline-danger mx-2">
          <i class="fa-solid fa-xmark"></i> Annuler
        </router-link>
        <!-- Afficher un message de succès lors de la modification -->
        <div v-if="isUpdated" class="alert alert-success mt-3">
          Catégorie modifiée avec succès!
        </div>
      </form>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import axios from 'axios';
  import { useRoute, useRouter } from 'vue-router';
  
  const route = useRoute();
  const router = useRouter();
  const categorie = ref({
    nomcategorie: "",
    description: ""
  });
  
  const loadCategorie = async () => {
    try {
      const response = await axios.get(`http://localhost:8000/api/categories/${route.params.id}`);
      const categoryData = response.data;
  
      if (categoryData) {
        categorie.value = {
          nomcategorie: categoryData.nomcategorie || "",
          description: categoryData.description || ""
        };
      }
    } catch (error) {
      console.error(error);
    }
  };
  
  onMounted(() => {
    loadCategorie();
  });
  
  const modifierCategorie = async () => {
    try {
      await axios.put(`http://localhost:8000/api/categories/${route.params.id}`, categorie.value);
      router.push({ name: 'ViewCategories' }); // Redirection vers la liste après la modification
    } catch (error) {
      console.error(error);
    }
  };
  </script>
  
  <style scoped>
  /* Styles spécifiques à la vue pour les catégories */
  </style>
  