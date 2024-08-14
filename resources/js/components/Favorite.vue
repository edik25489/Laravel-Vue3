<template>
    <table>
        <thead>
        <th>id</th>
        <th>name</th>
        <th>Категория</th>
        <th>Изображение</th>
        <th>Операции</th>
        </thead>
        <tr v-for="favorite in getFavorite" :key="favorite">
            <td>{{ favorite.id }}</td>
            <td>{{ favorite.name }}</td>
            <td>{{ favorite.category }}</td>
            <td><img :src="favorite.image" alt="" style="width: 100px;height: 100px; object-fit: contain;"></td>
            <td>
                <button type="button" @click.prevent="del(favorite.id)">Удалить</button>
            </td>
        </tr>
    </table>
</template>

<script>
import {mapGetters, mapActions} from "vuex"
export default {
    name: "Favorite",
    computed: {
        ...mapGetters(["getFavorite"]),
    },
    methods: {
        ...mapActions(["fullFavorite","delFavorite"]),
        del(item) {
            this.delFavorite(item)
        },
    },
    async mounted() {
        await this.fullFavorite();
    }
}
</script>

<style scoped>

</style>
