<template>
    <Menu/>
    <router-view></router-view>
</template>

<script>
import Menu from "../components/Menu.vue";


export default {
    name: "Welcome.vue",
    components:{
        Menu
    },
}
</script>

<style>
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
</style>
