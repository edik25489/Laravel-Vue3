<template>
    <div class="category">
        <h2>Список категорий</h2>
        <table>
            <tr v-for="category in fullCategories" :key="category">
                <td>{{ category.id }}</td>
                <td>{{ category.name }}</td>
            </tr>
        </table>
    </div>
    <div class="product">
        <h2>Список продуктов</h2>
        <table>
            <thead>
            <th>id</th>
            <th>name</th>
            <th>Категория</th>
            <th>Изображение</th>
            <th>Операции</th>
            </thead>
            <tr v-for="product in fullProducts" :key="product">
                <td>{{ product.id }}</td>
                <td>{{ product.name }}</td>
                <td>{{ product.category }}</td>
                <td><img :src="product.image" alt="" style="width: 100px;height: 100px; object-fit: contain;"></td>
                <td>
                    <button type="button" @click.prevent="add(product.id)">Добавить в корзину</button>
                    <button type="button" @click.prevent="favorite(product.id)">Добавить в избранное</button>
                </td>
            </tr>
        </table>
    </div>
</template>

<script>
import {mapGetters, mapActions} from "vuex"
import store from "../store";

export default {
    name: "Home",
    setup() {
        return {
            store
        }
    },
    computed: {
        ...mapGetters(["fullCategories", "fullProducts","getAuthUser"]),
    },
    methods: {
        ...mapActions(["getCategories", "getProducts", "addBasket", "addFavorite"]),
        add(item) {
            this.addBasket(item)
        },
        favorite(item) {
            this.addFavorite({
                userId: this.getAuthUser,
                item: item
            })
        }
    },
    async mounted() {
        await this.getCategories();
        await this.getProducts();
    }
}
</script>

<style scoped>
.product {
    margin-top: 20px;
}
</style>
