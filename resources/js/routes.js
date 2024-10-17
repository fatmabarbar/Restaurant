import Accueil from './components/accueil.vue';
import ViewProduits from './components/produits/ViewProduits.vue';
import Addproduit from './components/produits/AddProduit.vue';
import EditProduit from './components/produits/EditProduit.vue';
import ViewCategories from './components/categories/ViewCategories.vue';
import AddCategorie from './components/categories/AddCategorie.vue';
import EditCategorie from './components/categories/EditCatgorie.vue';
import Login from './components/authentification/Login.vue'
import Register from './components/authentification/Register.vue'
import Dashboard from './components/admin/dashboard.vue'
import ViewCommandes from './components/commande/ViewCommandes.vue';
import AddCommande from './components/commande/AddCommande.vue';
import EditCommande from './components/commande/EditCommande.vue';
import HomeCart from './components/cart/HomeCart.vue';
import Cart from './components/cart/Cart.vue';

export const routes = [
{
name: 'accueil',
path: '/',
component: Accueil
},{
    name: 'ViewProduits',
    path: '/listProd',
    component: ViewProduits,
    meta:{isAuth:true}
  },
  {
    name: 'AddProduit',
    path: '/addprod',
    component: Addproduit
  },
  {
    path: '/editproduit/:id',
    name: 'EditProduit',
    component: EditProduit
  },
  {
    name: 'ViewCategories',
    path: '/ListCat',
    component: ViewCategories,
    meta:{isAuth:true}
  },
  {
    name: 'AddCategorie',
    path: '/addCat',
    component: AddCategorie
  },
  {
    name: 'EditCategorie',
    path: '/EditCat/:id',
    component: EditCategorie
  },
  {
    name: "login",
    path: "/login",
    component: Login,
    },
    {
    name: "register",
    path: "/register",
    component: Register,
    },
    {
    
    name: "dashboard",
    path: '/dashboard',
    component: Dashboard,
    
    } ,  {
      name: 'ViewCommandes',
      path: '/listcmd',
      component: ViewCommandes,
    },  {
      name: 'AddCommande',
      path: '/addcmd',
      component: AddCommande,
    },  {
      name: 'EditCommande',
      path: '/editcmd',
      component: EditCommande,
    },{
      path:'/shopping',
      name:'HomeCart',
      component:HomeCart
      }
      ,{
        path:'/cart',
        name:'Cart',
        component:Cart
        }
]