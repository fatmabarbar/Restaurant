<template>
    <div class="col-md-6 offset-md-3 border rounded p-4 mt-2 shadow">
      <br>
      <br>
      <h4 align="center">Modifier le produit</h4>
      <form @submit.prevent="modifierProduit">
        
        <div class="row">
          <div class="col-md-6">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" v-model="produit.nom">
          </div>
          <div class="col-md-6 ms-auto">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" id="description" v-model="produit.description">
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <label for="image" class="form-label">Image</label>
            <input type="text" class="form-control" id="image" v-model="produit.image">
          </div>
          <div class="col-md-6 ms-auto">
            <label for="prix" class="form-label">Prix</label>
            <input type="number" class="form-control" id="prix" v-model="produit.prix">
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <label for="categorie_id" class="form-label">Catégorie ID</label>
            <input type="number" class="form-control" id="categorie_id" v-model="produit.categorie_id">
          </div>
        </div>
        <!-- Autres champs du formulaire pour les produits -->
        <br>
        <button type="submit" class="btn btn-outline-primary">
          <i class="fa-solid fa-floppy-disk"></i> Enregistrer
        </button>
        <router-link to="/listProd" class="btn btn-outline-danger mx-2">
          <i class="fa-solid fa-xmark"></i> Annuler
        </router-link>
        <!-- Display success message when item is updated -->
        <div v-if="isUpdated" class="alert alert-success mt-3">
          Produit modifié avec succès!
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
const produit = ref({
  nom: "",
  description: "",
  image: "",
  prix: 0,
  categorie_id: 0
});

const loadProduit = async () => {
  try {
    const token = localStorage.getItem('token');
    console.log('Token:', token);

    if (!token) {
      console.error("Jetons d'accès manquant. L'utilisateur n'est pas authentifié.");
      // Gérer le cas où l'utilisateur n'est pas authentifié, peut-être rediriger vers la page de connexion
      return;
    }

    // Ajouter le jeton d'authentification dans les en-têtes de la requête
    const response = await axios.get(`http://localhost:8000/api/produits/${route.params.id}`, {
      headers: {
        'Authorization': `Bearer ${token}`
      }
    });

    const productData = response.data;

    if (productData) {
      produit.value = {
        nom: productData.nom || "",
        description: productData.description || "",
        image: productData.image || "",
        prix: productData.prix || 0,
        categorie_id: productData.categorie_id || 0
      };
    }

    console.log("Produit chargé :", produit.value);
  } catch (error) {
    console.error(error);
  }
};

onMounted(() => {
  loadProduit();
});

const modifierProduit = async () => {
  try {
    const token = localStorage.getItem('token');
    console.log('Token:', token);

    if (!token) {
      console.error("Jetons d'accès manquant. L'utilisateur n'est pas authentifié.");
      // Gérer le cas où l'utilisateur n'est pas authentifié, peut-être rediriger vers la page de connexion
      return;
    }

    // Ajouter le jeton d'authentification dans les en-têtes de la requête
    const response = await axios.put(
      `http://localhost:8000/api/produits/${route.params.id}`,
      produit.value,
      {
        headers: {
          'Authorization': `Bearer ${token}`
        }
      }
    );

    if (response.status === 200) {
      // Le produit a été modifié avec succès
      router.push({ name: 'ViewProduits' }); // Redirection vers la liste après la modification
    } else {
      console.error("Erreur lors de la modification du produit. Statut de la réponse :", response.status);
    }
  } catch (error) {
    console.error("Erreur lors de la requête PUT pour modifier le produit :", error);
  }
};
</script>


  
  <style scoped>
    /* Styles spécifiques à la vue pour les produits */
  </style>
  