<template>
  <div class="col-md-6 offset-md-3 border rounded p-2 mt-5 shadow">
    <br>
    <br>
    <h4 align="center">Add a Category</h4>
    <form @submit.prevent="addCategory">
      <div class="row">
        <div class="col-md-6">
          <label for="nom" class="form-label">Name</label>
          <input type="text" class="form-control" id="nom" v-model="category.nomcategorie">
        </div>
        <div class="col-md-6 ms-auto">
          <label for="description" class="form-label">Description</label>
          <input type="text" class="form-control" id="description" v-model="category.description">
        </div>
      </div>
      <!-- Other form fields for categories -->
      <br>
      <button type="submit" class="btn btn-outline-primary">
        Save
      </button>
      <!-- Display success message when category is added -->
      <div v-if="isAdded" class="alert alert-success mt-3">
        Category added successfully!
      </div>
    </form>
  </div>
</template>

<script setup>
import { ref } from "vue";
import axios from 'axios';
import { useRouter } from 'vue-router';

const router = useRouter();

const isAdded = ref(false);
const category = ref({
  nomcategorie: "",
  description: ""
  // Add other category fields if necessary
});

const addCategory = async () => {
  try {
    await axios.post("http://localhost:8000/api/categories/", category.value);
    isAdded.value = true;
    router.push({ name: 'ViewCategories' });
  } catch (error) {
    console.error("Error adding category:", error);
    // Handle error, e.g., show an error message
  }
};
</script>

<style scoped>
/* Your component-specific styles */
</style>
