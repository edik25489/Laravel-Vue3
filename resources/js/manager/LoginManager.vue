<template>
    <div>
        <form class="login" @submit.prevent="login">
            <input type="email"
                   placeholder="example@mail.ru"
                   name="email"
                   id="email"
                   v-model="email">
            <input type="password"
                   name="password"
                   placeholder="Password"
                   id="password"
                   v-model="password">
            <input type="submit" value="Войти">
            <router-link to="/register/manager">Регистрация менеджера</router-link>
        </form>
    </div>
</template>

<script>
import {mapActions} from "vuex"
import store from "../store";

export default {
    name: "LoginManager",
    data(){
        return{
            email:"",
            password:"",
        }
    },
    methods:{
        ...mapActions(["loginManager"]),
        login(){
            this.loginManager({
                email: this.email,
                password: this.password
            })
        },
    },
}
</script>

<style scoped>
.login {
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
}
</style>
