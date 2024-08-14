<template>
    <div>
        <h1>Личный кабинет пользователя {{getInfoUser.name}}  {{getInfoUser.surname}}</h1>
        <router-link active-class="active" :to="{ name: 'Basket'}">Корзина пользователя</router-link>
        <router-link active-class="active" :to="{ name: 'History'}">История покупок</router-link>
        <router-link active-class="active" :to="{ name: 'Favorite'}">Избранное пользователя</router-link>
        <button type="button" @click="logout" class="logout">
            Выйти с кабинета
        </button>
    </div>
    <router-view></router-view>
</template>

<script>
import {mapGetters, mapActions} from "vuex"
export default {
    name: "AccountUser",
    computed: {
        ...mapGetters(["getInfoUser"]),
    },
    methods: {
        ...mapActions(["removeTokenUser","userInfo"]),
        logout() {
            this.removeTokenUser()
        },
    },
    async mounted() {
        await this.userInfo({
            userId: localStorage.getItem('userId')
        });
    }
}
</script>

<style scoped>
.logout{
    color: white;
    background: #6a6868;
    font-size: 20px;
    padding: 10px;
    border: 2px solid #5c5959;
}

a {
    text-decoration: none;
    display: block;
    background: #6a6868;
    padding: 8px 20px;
    color: white;
    font-size: 20px;
}

a:hover {
    color: #1a202c;
    background: white;
}

.active {
    color: #1a202c;
    background: white;
}
</style>
