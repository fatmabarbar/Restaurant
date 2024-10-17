<template>
  <div>
    <section id="main-image">
      <div class="wrapper">
        <a href="#top"> <!-- Ajoutez cette ligne -->
          <img src="https://images.france.fr/zeaejvyq9bhj/2Je56scW4aKhHZab6AR7MH/d5c2effa502e8b632fcb122d1e510250/undefined" alt="Description de l'image" class="main-image">
          <br>
          <br>
          <h2>Découvrez nos spécialités<br></h2>
          <router-link to="/shopping" class="nav-item nav-link button-yellow">Voir le menu</router-link>
        </a> <!-- Ajoutez cette ligne -->
      </div>
    </section>

    <section id="steps">
      <div class="wrapper">
        <ul class="steps-list">
            <section>
              <h4>Explorer le Menu</h4>
              <img src="https://cdn.theforkmanager.com/static/styles/blog_article_header_image/public/wp-blog/5-el-tenedor-gestion-restaurantes-contratar-al-mejor-chef.jpg?itok=hDZiX5AS" alt="Description de l'image" class="image-angled-and-small">
              <p>Parcourez notre délicieux menu rempli de plats savoureux et d'options alléchantes.</p>
              <router-link to="/register" class="button-3">S'inscrire</router-link>

            </section>
    
            <section>
              <h4>Commander en ligne</h4>
              <img src="https://static.vecteezy.com/ti/vecteur-libre/p3/4853879-livraison-en-ligne-telephone-concept-service-de-livraison-de-colis-et-courrier-et-suivi-vector-illustration-gratuit-vectoriel.jpg" alt="Description de l'image" class="image-angled-and-small">
              <p>Commandez facilement vos plats préférés en ligne et personnalisez-les selon vos goûts.</p>
              <router-link to="/register" class="button-3">S'inscrire</router-link>

            </section>

            <section>
              <h4>Livraison rapide</h4>
              <img src="https://png.pngtree.com/png-vector/20230831/ourlarge/pngtree-d-cartoon-express-delivery-courier-takes-box-out-of-van-phone-png-image_9192918.png" alt="Description de l'image" class="image-angled-and-small">
              <p>Nous vous assurons une livraison rapide à votre porte pour que vous puissiez profiter de votre repas.</p>
              <router-link to="/register" class="button-3">S'inscrire</router-link>

            </section>

        </ul>
      </div>
    </section>
    <br>
    <br>
     <br>
    <div>
      <h2 class="title">Par nos chefs internationaux <span style="color: #f8d117;">les plus compétents !</span><br></h2>
      <br>
    <img src="https://www.president.gov.ua/storage/j-image-storage/28/94/73/a7e3d771189203cb6e73fbef399f3acb_1669305355_extra_large.jpeg" alt="Description de l'image" class="centered-image">
  </div>
  <br>
     <br>
     <div class="center-container">
    <h2 class="title">Top Categories in Tunis</h2>
    <br>
    <div class="category">
      <section class="rounded-rectangle"><h5>Healthy Options</h5></section>
      <section class="rounded-rectangle"><h5>Local Specialties</h5></section>
      <section class="rounded-rectangle"><h5>Breakfast Items</h5></section>
      <section class="rounded-rectangle"><h5>Beverages</h5></section>
    </div>
  </div>
   
     <br>
     <br>
     <br>
     <br>
    <section id="steps">
      <div class="wrapper">
        <h2 class="title">Nos spécialités</h2>
        <br><br><br>

        <ul class="steps-list">
            <section>
              <h4>cucina italiana</h4>
              <img src="https://upload.wikimedia.org/wikipedia/en/0/03/Flag_of_Italy.svg" alt="Description de l'image" class="image-angled-and-small">

            </section>
    
            <section>
              <h4>Cuisine Française</h4>
              <img src="https://upload.wikimedia.org/wikipedia/en/thumb/c/c3/Flag_of_France.svg/1200px-Flag_of_France.svg.png" alt="Description de l'image" class="image-angled-and-small">

            </section>
            <section>
              <h4>Cuisine Marrocaine</h4>
              <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2c/Flag_of_Morocco.svg/langca-220px-Flag_of_Morocco.svg.png" alt="Description de l'image" class="image-angled-and-small">

            </section>
            <section>
              <h4>Cuisine Tunisienne</h4>
              <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/ce/Flag_of_Tunisia.svg/langfr-225px-Flag_of_Tunisia.svg.png" alt="Description de l'image" class="image-angled-and-small">

            </section>
            <section>
              <h4>Cuisine Libanese</h4>
              <img src="https://upload.wikimedia.org/wikipedia/commons/5/59/Flag_of_Lebanon.svg" alt="Description de l'image" class="image-angled-and-small">

            </section>

        

        </ul>
      </div>
    </section>
<br><br><br><br>
    <section id="contact" class="center-container">
      <div class="wrapper">
        <h3>Contactez-nous</h3>
        <p>Réservez une table ou posez-nous des questions. Nous sommes là pour vous servir!</p>

        <!-- Informations de Contact -->
        <div class="contact-info">
          <p><strong>Adresse:</strong> 123 Rue de la Gastronomie, Ville, Pays</p>
          <p><strong>Téléphone:</strong> +123 456 7890</p>
          <p><strong>Email:</strong> info@dinedynamo.com</p>
        </div>
      </div>
    </section>

    <footer class="center-container">
      <p>&copy; 2024 DineDynamo. Tous droits réservés.</p>
    </footer>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const specialties = ref([]);

const getSpecialties = async () => {
  try {
    const response = await api.get("/api/specialties");
    const specialtiesData = response.data.slice(0, 3); // Get the first three rows

    specialties.value = specialtiesData;
  } catch (error) {
    console.log(error);
  }
};

onMounted(() => {
  getSpecialties();
});
</script>

<style scoped>
/* Styles spécifiques à votre restaurant */

#main-image {
  height: 580px;
  background: url('images/restaurant-main.jpg') center;
}

.specialties {
  background-color: #efefef;
}
.steps-list {
  display: flex;
  justify-content: space-around;
  align-items: center;
}
.center-container {
  display: flex;
  flex-direction: column;
  align-items: center;
}
/* Ajustez le style des sections */
#steps section {
  text-align: center;
  width: 250px; /* Ajustez la largeur selon vos besoins */
}
.image-angled-and-small {
  /* Cela permet de conserver les proportions de l'image */
  width: 150px; /* Ajustez la largeur selon vos besoins */
  height: 150px; /* Assurez-vous que la hauteur est égale à la largeur pour obtenir une image circulaire */
  border-radius: 50%; /* Applique un bord arrondi pour créer une forme circulaire */
  object-fit: cover; /* Rotation de l'image de 45 degrés (ajustez selon vos besoins) */
}
.button-3 {
  display: inline-block;
  padding: 10px 20px;
  font-size: 16px;
  text-align: center;
  text-decoration: none;
  cursor: pointer;
  border: 1px solid #02b8dd;
  border-radius: 3px;
  color: #02b8dd;
  background-color: #fff;
  transition: background-color 0.3s, color 0.3s;
}
.button-yellow {
  display: inline-block;
  padding: 10px 20px;
  background-color: #fdd835; /* Couleur jaune */
  color: #000; /* Couleur du texte */
  text-decoration: none;
  border-radius: 5px;
  font-weight: bold;
  transition: background-color 0.3s ease;
}

.button-yellow:hover {
  background-color: #fbc02d; /* Changement de couleur au survol */
}
.rounded-rectangle {
  width: 120px; /* Taille fixe des rectangles */
  height: 60px;
  border-radius: 15px; /* Bordures arrondies */
  background-color: #91c2a3; /* Couleur de gris pastel */
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  text-align: center;
  margin-right: 20px; /* Marge entre les rectangles */
}

.rounded-rectangle h5 {
  margin: 0;
}
.category {
  display: flex;
  align-items: center; /* Aligne les cercles verticalement */
}
.circle h5 {
  margin: 0;
}

.button-3:hover {
  background-color: #f8d117;
  color: #fff;
}
.specialty {
  width: 45%;
  height: 50%;
  float: left;
  border-radius: 10px;
  padding-left: 10%;
  padding-bottom: 10%;

}
#main-image a {
  text-decoration: none; /* Supprimez le soulignement par défaut du lien */
  color: inherit; /* Héritez de la couleur du texte du parent */
  cursor: pointer;
}
.main-image {
  width: 100%; /* Ajustez la largeur selon vos besoins */
  max-height: 400px; /* Limitez la hauteur pour éviter qu'elle ne prenne trop de place */
  object-fit: cover; /* Assurez-vous que l'image couvre la totalité du conteneur */
}

/* Ajustez le positionnement de la section principale */
#main-image {
  text-align: center; /* Centrez le contenu horizontalement */
  padding: 50px 0; /* Ajustez l'espacement selon vos besoins */
}
.overlay {
  display: flex;
}
.title {
  text-align: center;
  font-size: 30px;
  font-weight: bold;
  /* Ajoutez d'autres styles ou effets souhaités ici */
}

.centered-image {
  display: block;
  margin: 0 auto;
  max-width: 400px; /* Ajustez la nouvelle largeur selon vos besoins */
  /* Ajoutez d'autres styles ou effets souhaités ici */
}

.overlay div {
  background: rgba(255, 255, 250, 0.95);
  height: 200px;
  width: 300px;
  text-align: center;
  justify-content: space-between;
}

.overlay div img {
  border-radius: 12%;
}

article h4 {
  border-bottom: 1px solid #ddd;
  padding-bottom: 20px;
  text-transform: uppercase;
  margin-bottom: 20px;
  text-align: center;
}

.specialties p {
  text-align: center;
  margin-bottom: 20px;
}

.button-2 {
  color: #fff;
  background-color: #ff7a00;
  padding: 6px;
  border-radius: 3px;
}

.button-2:hover {
  color: #fff;
  background-color: #02b8dd;
}
</style>

