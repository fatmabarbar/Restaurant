<template>
  <div class="col-md-6 offset-md-3 border rounded p-2 mt-5 shadow">
    <br>
    <br>
    <h4 align="center">Ajouter un produit</h4>
    <form @submit.prevent="addProduit">
      
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
      <router-link to="/listeproduits" class="btn btn-outline-danger mx-2">
        <i class="fa-solid fa-xmark"></i> Annuler
      </router-link>
      <!-- Display success message when item is added -->
      <div v-if="isAdded" class="alert alert-success mt-3">
        Produit ajouté avec succès!
      </div>
    </form>
  </div>
</template>

<script setup>
import { ref } from "vue"
import { useRouter } from 'vue-router';
import axios from 'axios';

const router = useRouter()

const isAdded = ref(false); // Initialiser la variable isAdded

const produit = ref({
  nom: "",
  description: "",
  image: "",
  prix: 0,
  categorie_id: 0
  // Ajoutez d'autres champs du produit si nécessaire
})

const addProduit = async () => {
  try {
    const token = localStorage.getItem('token');

    if (!token) {
      console.error("Jetons d'accès manquant. L'utilisateur n'est pas authentifié.");
      return;
    }

    const response = await axios.post("http://localhost:8000/api/produits", produit.value, {
      headers: {
        'Authorization': `Bearer ${token}`
      }
    });

    if (response.status === 201) {
      isAdded.value = true;
      router.push({ name: 'ViewProduits' });
    } else {
      console.error("Erreur lors de l'ajout du produit. Statut de la réponse :", response.status);
      // Afficher un message d'erreur ici
    }
  } catch (error) {
    console.error("Erreur lors de la requête POST pour ajouter le produit :", error);
    // Afficher un message d'erreur ici
  }
}



</script>

<style scoped>
  /* Styles spécifiques à la vue pour les produits */
</style>
