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
            <input type="text"
                   placeholder="Введите телефон"
                   name="telefon"
                   id="telefon"
                   v-model="telefon">
            <input type="date"
                   name="birthday"
                   id="birthday"
                   v-model="birthday">
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
            <router-link to="/login">Авторизация</router-link>
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
            telefon:'',
            birthday:'',
        }
    },
    methods:{
        ...mapActions(["registerUser"]),
        register(){
            this.registerUser({
                name: this.name,
                surname: this.surname,
                telefon: this.telefon,
                birthday: this.birthday,
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
