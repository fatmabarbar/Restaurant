<template>
  <div class="marge">
    <div class="background-image">
      <div class="container my-5">
        <div class="row justify-content-center align-items-center min-vh-100">
          <div class="col-md-8">
            <div class="card card-default p-4 shadow-lg rounded">
              <div class="card-header text-center fs-4 fw-bold">Login</div>
              <div class="card-body">
                <form @submit.prevent="handleLogin">
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
                  <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-block">
                      Login
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
  
  const handleLogin = async () => {
  axios.post('http://localhost:8000/api/login/', user)
    .then((response) => {
      console.log('Successful login response:', response.data);
      router.push("/");
      localStorage.setItem('user', response.data.user.name);
      localStorage.setItem('token', response.data.token);
      localStorage.setItem('userRole', response.data.user.role); // Assuming 'role' is the user's role attribute

    })
    .catch(err => {
      console.log('Login error:', err);
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
    border-color:#ffcc66;
    font-weight: bold;
    transition: background-color 0.3s, border-color 0.3s;
  }
  .background-image {
  background-image: url('resources/images/food.jpg');
  background-size: cover;
  background-position: center;
  /* Other background properties as needed */
}
  .min-vh-100 {
  min-height: calc(100vh - 56px); /* Subtract the navbar height from viewport height */
  display: flex;

}
  .btn-primary:hover {
    background-color:#ffbb33 ;
    border-color:  #ffbb33;
  }
  </style>
  