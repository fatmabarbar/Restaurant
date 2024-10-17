<template>
    <div class="col-md-6 offset-md-3 border rounded p-4 mt-2 shadow">
      <h4 align="center">Modifier la commande</h4>
      <form @submit.prevent="modifierCommande">
        <div class="row">
          <div class="col-md-6">
            <label for="numero" class="form-label">Numéro</label>
            <input type="text" class="form-control" id="numero" v-model="commande.numero">
          </div>
          <div class="col-md-6 ms-auto">
            <label for="date" class="form-label">Date</label>
            <input type="text" class="form-control" id="date" v-model="commande.date">
          </div>
        </div>
        <!-- Ajoutez d'autres champs de formulaire pour la modification de la commande -->
        <br>
        <button type="submit" class="btn btn-outline-primary">
          <i class="fa-solid fa-floppy-disk"></i> Enregistrer
        </button>
        <router-link to="/listcmd" class="btn btn-outline-danger mx-2">
          <i class="fa-solid fa-xmark"></i> Annuler
        </router-link>
        <!-- Afficher un message de succès lors de la modification -->
        <div v-if="isUpdated" class="alert alert-success mt-3">
          Commande modifiée avec succès!
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
  const commande = ref({
    numero: "",
    date: ""
    // Ajoutez d'autres champs de la commande si nécessaire
  });
  
  const loadCommande = async () => {
    try {
      const response = await axios.get(`http://localhost:8000/api/commandes/${route.params.id}`);
      const commandData = response.data;
  
      if (commandData) {
        commande.value = {
          numero: commandData.numero || "",
          date: commandData.date || ""
          // Initialisez les autres champs de la commande à modifier
        };
      }
    } catch (error) {
      console.error(error);
    }
  };
  
  onMounted(() => {
    loadCommande();
  });
  
  const modifierCommande = async () => {
    try {
      await axios.put(`http://localhost:8000/api/commandes/${route.params.id}`, commande.value);
      router.push({ name: 'ViewCommandes' }); // Redirection vers la liste après la modification
    } catch (error) {
      console.error(error);
    }
  };
  </script>
  
  <style scoped>
  /* Styles spécifiques à la vue pour les commandes */
  </style>
  