<template>
  <div class="col-md-6 offset-md-3 border rounded p-2 mt-5 shadow">
      <h4 align="center">Ajouter une commande</h4>
      <form @submit.prevent="addCommande">
        <div class="row">
          <div class="col-md-6">
            <label for="numero" class="form-label">Numéro</label>
            <input type="text" class="form-control" id="numero" v-model="commande.numero">
          </div>
          <div class="col-md-6 ms-auto">
            <label for="date" class="form-label">Date</label>
            <input type="date" class="form-control" id="date" v-model="commande.date">
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <label for="total" class="form-label">Total</label>
            <input type="number" class="form-control" id="total" v-model="commande.total">
          </div>
          <div class="col-md-6 ms-auto">
            <label for="status" class="form-label">Statut</label>
            <input type="text" class="form-control" id="status" v-model="commande.status">
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <label for="user_id" class="form-label">Utilisateur ID</label>
            <input type="number" class="form-control" id="user_id" v-model="commande.user_id">
          </div>
        </div>
        <!-- Autres champs du formulaire pour les commandes -->
        <br>
        <button type="submit" class="btn btn-outline-primary">
          <i class="fa-solid fa-floppy-disk"></i> Enregistrer
        </button>
        <router-link to="/listcmd" class="btn btn-outline-danger mx-2">
          <i class="fa-solid fa-xmark"></i> Annuler
        </router-link>
        <!-- Message de succès lors de l'ajout -->
        <div v-if="isAdded" class="alert alert-success mt-3">
          Commande ajoutée avec succès!
        </div>
      </form>
    </div>
  </template>
  
  <script setup>
  import { ref } from "vue"
  import { useRouter } from 'vue-router';
  import axios from 'axios';
  
  const router = useRouter()
  
  const isAdded = ref(false); // Initialisation de la variable isAdded
  
  const commande = ref({
    numero: "",
    date: "",
    total: 0,
    status: "",
    user_id: 0
    // Ajoutez d'autres champs de la commande si nécessaire
  })
  
  const addCommande = async () => {
    try {
      await axios.post("http://localhost:8000/api/commandes/", commande.value);
      isAdded.value = true; // Mettre à jour isAdded après l'ajout avec succès
      router.push({ name: 'ViewCommandes' });
    } catch (error) {
      console.error(error);
    }
  }
  </script>
  
  <style scoped>
    /* Styles spécifiques à la vue pour les commandes */
  </style>
  