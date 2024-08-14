<template>
    <ul>
        <li>
            <router-link
                active-class="active"
                to="/">
                Главная страница
            </router-link>
        </li>
        <li>
            <router-link
                active-class="active"
                to="/login"
                v-if="store.getters.getTokenUser === 0">
                Авторизация пользователя
            </router-link>
        </li>
        <li>
            <router-link
                active-class="active"
                to="/login/manager"
                v-if="store.getters.getTokenManager === 0">
                Авторизация менеджера
            </router-link>
        </li>
        <li>
            <router-link
                active-class="active"
                to="/manager"
                v-if="store.getters.getTokenManager !== 0">
                Кабинет менеджера
            </router-link>
        </li>
        <li>
            <router-link
                active-class="active"
                to="/account"
                v-if="store.getters.getTokenUser !== 0">
                Кабинет пользователя
            </router-link>
        </li>
    </ul>
</template>

<script>
import store from "../store";

export default {
    name: "Menu",
    setup() {
        return {
         store
        }
    }
}
</script>

<style scoped>
ul {
    display: flex;
    flex-direction: row;
    justify-content: space-around;
    align-items: center;
    height: 50px;
    background: #6a6868;
}

li {
    display: block;
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
