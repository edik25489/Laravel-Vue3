import {createRouter, createWebHistory} from "vue-router";
import Home from "./components/Home.vue";
import Login from "./components/Login.vue";
import Register from "./components/Register.vue";
import LoginManager from "./manager/LoginManager.vue";
import RegisterManager from "./manager/RegisterManager.vue";
import AccountManager from "./manager/AccountManager.vue";
import AccountUser from "./components/AccountUser.vue";
import Basket from "./components/Basket.vue";
import History from "./components/History.vue";
import Favorite from "./components/Favorite.vue";
import AddProduct from "./manager/AddProduct.vue";
import AddCategory from "./manager/AddCategory.vue";
import EditCategory from "./manager/EditCategory.vue";
import EditProduct from "./manager/EditProduct.vue";
import store from "./store";

const routes = [
    {
        path:'/',
        props:true,
        name: 'Home',
        component: Home
    },
    {
        path:'/login',
        props:true,
        name: 'Login',
        component: Login,
        meta:{
            authUser: false,
        },
    },
    {
        path:'/register',
        props:true,
        name: 'Register',
        component: Register,
        meta:{
            authUser: false,
        },
    },
    {
        path:'/account',
        props:true,
        name: 'AccountUser',
        children:[
            {
                path:'/account/basket',
                props:true,
                name: 'Basket',
                component: Basket,
            },
            {
                path:'/history',
                props:true,
                name: 'History',
                component: History,
            },
            {
                path:'/favorite',
                props:true,
                name: 'Favorite',
                component: Favorite,
            },
        ],
        component: AccountUser,
        meta:{
            authUser: true,
        },
    },
    {
        path:'/manager',
        props:true,
        name: 'AccountManager',
        children:[
            {
                path:'/addCategory',
                props:true,
                name: 'AddCategory',
                component: AddCategory,
            },
            {
                path:'/editCategory/:id',
                props:true,
                name: 'EditCategory',
                component: EditCategory,
            },
            {
                path:'/addProduct',
                props:true,
                name: 'AddProduct',
                component: AddProduct,
            },
            {
                path:'/editProduct/:id',
                props:true,
                name: 'EditProduct',
                component: EditProduct,
            },
        ],
        component: AccountManager,
        meta:{
            authManager: true,
        },
    },
    {
        path:'/login/manager',
        props:true,
        name: 'LoginManager',
        component: LoginManager,
        meta:{
            authManager: false,
        },
    },
    {
        path:'/register/manager',
        props:true,
        name: 'RegisterManager',
        component: RegisterManager,
        meta:{
            authManager: false,
        },
    },
]

const router = createRouter({
    routes,
    linkActiveClass: "active",
    linkExactActiveClass: "exact-active",
    history: createWebHistory()
})

router.beforeEach((to,from)=>{
    if (to.meta.authManager && store.getters.getTokenManager === 0){
        return {name:'LoginManager'};
    }
    if (to.meta.authManager === false && store.getters.getTokenManager !== 0){
        return {path:'/manager'};
    }
    if (to.meta.authUser && store.getters.getTokenUser === 0){
        return {name:'Login'};
    }
    if (to.meta.authUser === false && store.getters.getTokenUser !== 0){
        return {name:'AccountUser'};
    }
})
export default router;
