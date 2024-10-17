<template>
    <div class="marge">
      <div class="background-image">
        <div class="container my-5">
          <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-8">
              <div class="card card-default p-4 shadow-lg rounded">
                <div class="card-header text-center fs-4 fw-bold">Register</div>
                <div class="card-body">
                  <form @submit.prevent="handleRegister">
                    <div class="mb-3">
                      <label for="name" class="form-label">Name</label>
                      <input
                        id="name"
                        type="text"
                        class="form-control"
                        v-model="user.name"
                        required
                        placeholder="Enter your name"
                      />
                    </div>
                    <div class="mb-3">
                      <label for="email" class="form-label">E-Mail Address</label>
                      <input
                        id="email"
                        type="email"
                        class="form-control"
                        v-model="user.email"
                        required
                        placeholder="Enter your email"
                      />
                    </div>
                    <div class="mb-3">
                      <label for="password" class="form-label">Password</label>
                      <input
                        id="password"
                        type="password"
                        class="form-control"
                        v-model="user.password"
                        required
                        placeholder="Enter your password"
                      />
                    </div>
                    <div class="mb-3">
                      <label for="password_confirmation" class="form-label">Password Confirmation</label>
                      <input
                        id="password_confirmation"
                        type="password"
                        class="form-control"
                        v-model="user.password_confirmation"
                        required
                        placeholder="Confirm your password"
                      />
                    </div>
                    <div class="d-grid">
                      <button type="submit" class="btn btn-primary btn-block">
                        Register
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import axios from 'axios';
  import { useRouter } from 'vue-router';
  const router = useRouter();
  let user = {};
  
  const handleRegister = async () => {
    axios.post('http://localhost:8000/api/register/', user)
      .then((response) => {
        console.log('Successful registration response:', response.data);
        router.push("/dashboard");
        localStorage.setItem('user', response.data.user.name);
        localStorage.setItem('token', response.data.token);
        localStorage.setItem('userRole', response.data.user.role); // Assuming 'role' is the user's role attribute
      })
      .catch(err => {
        console.log('Registration error:', err);
        alert(err);
      });
  };
  </script>
  
  <style scoped>
  .marge {
    margin-top: 50px; /* Adjust the margin as needed */
  }
  
  .card {
    background-color: #ffffff;
    box-shadow: 0px 4px 16px rgba(0, 0, 0, 0.1);
  }
  
  input[type="text"],
  input[type="email"],
  input[type="password"] {
    border-radius: 5px;
    height: 48px;
  }
  
  .card-header {
    background-color: #8cacd3;
  }
  
  .btn-primary {
    background-color: #ffcc66;
    
  }
  </style>