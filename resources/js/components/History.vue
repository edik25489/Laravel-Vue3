<template>
    <table>
        <thead>
        <th>id</th>
        <th>name</th>
        <th>Цена</th>
        <th>Количество </th>
        <th>Изображение</th>
        <th>Категория</th>
        <th>Дата операции</th>
        </thead>
        <tr v-for="history in getHistory" :key="history">
            <td>{{ history.id }}</td>
            <td>{{ history.name }}</td>
            <td>{{ history.price }}</td>
            <td>{{ history.count }}</td>
            <td><img :src="history.image" alt="" style="width: 100px;height: 100px; object-fit: contain;"></td>
            <td>{{history.category}}</td>
            <td>{{history.date}}</td>
        </tr>
    </table>
</template>

<script>
import {mapGetters, mapActions} from "vuex"
export default {
    name: "History",
    computed: {
        ...mapGetters(["getHistory"]),
    },
    methods: {
        ...mapActions(["fullHistory"]),
    },
    async mounted() {
        await this.fullHistory();
    }
}
</script>

<style scoped>

</style>
