<template>
    <table>
        <thead>
        <th>id</th>
        <th>name</th>
        <th>Категория</th>
        <th>Изображение</th>
        <th>Количество </th>
        <th>Операции</th>
        </thead>
        <tr v-for="basket in getBasket" :key="basket">
            <td>{{ basket.id }}</td>
            <td>{{ basket.name }}</td>
            <td>{{ basket.category }}</td>
            <td><img :src="basket.image" alt="" style="width: 100px;height: 100px; object-fit: contain;"></td>
            <td><input type="number" v-model="count"></td>
            <td>
                <button type="button" @click.prevent="del(basket.id)">Удалить</button>
                <button type="button" @click.prevent="buy(basket.id)">Купить</button>
            </td>
        </tr>
    </table>
</template>

<script>
import {mapGetters, mapActions} from "vuex"

export default {
    name: "Basket",
    data(){
        return{
            count: 1,
        }
    },
    computed: {
        ...mapGetters(["getBasket","getAuthUser"]),
    },
    methods: {
        ...mapActions(["fullBasket","delBasket","buyBasket","userInfo"]),
        del(item) {
            this.delBasket(item)
        },
        buy(item) {
            this.buyBasket({
                count: this.count,
                userId: this.getAuthUser,
                item: item
            })
        },

    },
    async mounted() {
        await this.fullBasket();
        await this.userInfo({
            userId: localStorage.getItem('userId')
        });
    }
}
</script>

<style scoped>

</style>
