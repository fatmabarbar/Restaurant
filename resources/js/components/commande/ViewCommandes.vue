<template>
  <div class="container mt-4">
    <div class="row justify-content-center">
      <div class="container mt-5">
        <div v-if="isLoading">
          <h2>Chargement en cours....</h2>
        </div>
        <div v-else class="py-6">
          <nav class="navbar navbar-expand-lg navbar-dark bg-danger position: relative;">
            <div class="container-fluid">
              <router-link :to="{ name: 'AddCommande' }" class="btn btn-outline-light" style="z-index: 9999;">
                <i class="fa-solid fa-square-plus"></i> Nouvelle Commande
              </router-link>
            </div>
          </nav>
          <table class="table table-striped shadow mt-4">
          <thead>
            <tr>
              <th scope="col">Numéro</th>
              <th scope="col">Date</th>
              <th scope="col">Total</th>
              <th scope="col">Statut</th>
              <th scope="col">Utilisateur</th>
              <th scope="col">Voir</th>
              <th scope="col">Modifier</th>
              <th scope="col">Supprimer</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="commande in commandes" :key="commande.id">
              <td>{{ commande.numero }}</td>
              <td>{{ commande.date }}</td>
              <td>{{ commande.total }}</td>
              <td>{{ commande.status }}</td>
              <td>{{ commande.user_id }}</td>
              <td>
                <button class="btn btn-outline-primary mx-2">
                  <i class="fa-solid fa-eye"></i> Voir
                </button>
              </td>
              <td>
                <router-link :to="{ name: 'EditCommande', params: { id: commande.id } }" class="btn btn-outline-danger mx-2">
                  <i class="fa-solid fa-trash-can"></i> Modifier
                </router-link>
              </td>
              <td>
                <button class="btn btn-outline-danger mx-2" @click="deleteConfirmation(commande.id)">
                  <i class="fa-solid fa-trash-can"></i> Supprimer
                </button>
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
  
  const commandes = ref([]);
  const isLoading = ref(true);
  
  const axiosInstance = axios.create({
    baseURL: 'http://localhost:8000/api',
    headers: {
      common: {
        Authorization: `Bearer ${localStorage.getItem('token')}`,
      },
    },
  });
  
  const getCommandes = async () => {
    try {
      const token = localStorage.getItem('token');
      const response = await axios.get("http://localhost:8000/api/commandes", {
      headers: {
        'Authorization': `Bearer ${token}`
      }
    });
      commandes.value = response.data;
      isLoading.value = false;
    } catch (error) {
      console.error(error);
    }
  }
  
  onMounted(() => {
    getCommandes();
  });
  
  const deleteCommande = async (id) => {
    try {
      await axiosInstance.delete(`/commandes/${id}`);
      getCommandes();
    } catch (error) {
      console.error(error);
    }
  }
  
  const deleteConfirmation = async (id) => {
    const confirmDelete = confirm("Êtes-vous sûr de vouloir supprimer cette commande ?");
  
    if (confirmDelete) {
      await deleteCommande(id);
    } else {
      console.log("Suppression annulée");
    }
  }
  </script>
  
  <style lang="scss" scoped>
  /* Styles spécifiques à la vue ViewCommandes */
  /* ... */
  </style>
  