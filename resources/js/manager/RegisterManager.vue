<template>
    <div>

        <form class="register" @submit.prevent="register">
            <input type="text"
                   placeholder="Введите имя"
                   name="name"
                   id="name"
                   v-model="name">
            <input type="text"
                   placeholder="Введите фамилию"
                   name="surname"
                   id="surname"
                   v-model="surname">
            <input type="email"
                   placeholder="Введите электронную почту"
                   name="email"
                   id="email"
                   v-model="email">
            <input type="password"
                   name="password"
                   placeholder="Введите пароль"
                   id="password"
                   v-model="password">
            <input type="submit" value="Зарегистрироваться">
            <router-link to="/login/manager">Авторизация менеджера</router-link>
        </form>
    </div>
</template>

<script>

import {mapActions} from "vuex"

export default {
    name: "Register",
    data(){
        return{
            email: '',
            password: '',
            name:'',
            surname:'',
        }
    },
    methods:{
        ...mapActions(["registerManager"]),
        register(){
            this.registerManager({
                name: this.name,
                surname: this.surname,
                email: this.email,
                password: this.password
            })
        },
    },
}
</script>

<style scoped>
.register {
    display: flex;
    flex-direction: column;
    width: 400px;
    margin: 0 auto;
}
input {
    padding: 15px 7px;
    line-height: 16px;
    margin-top: 10px;
    font-size: 20px;
    text-align: center;
}
</style>
