<template>
    <form enctype="multipart/form-data" @submit.prevent="saveProduct">
        <div class="form-group">
            <label for="name">Введите название продукта</label>
            <input v-model="name"  type="text" name="name" id="name">
        </div>
        <div class="form-group">
            <label for="description">Введите описание продукта</label>
            <textarea v-model="info" name="description" id="description" cols="30" rows="10"></textarea>
        </div>
        <div class="form-group">
            <label for="price">Введите цену продукта</label>
            <input type="number" v-model="price" name="price" id="price">
        </div>
        <div class="form-group">
            <label for="count">Введите количество продукта</label>
            <input type="number" v-model="count" name="count" id="count">
        </div>
        <div class="form-group">
            <label for="category">Выберите категорию</label>
            <select v-model="category" name="category" id="category">
                <option
                    v-for="category in fullCategories" :key="category"
                    v-bind:value="category.id">
                    {{category.name}}
                </option>
            </select>
        </div>
        <div class="form-group">
            <label for="image">Выберите файл</label>
            <input type="file" name="image" id="image" @change="onChange">
        </div>
        <button type="submit">Сохранить</button>
    </form>
</template>

<script>
import {mapActions, mapGetters} from "vuex"
export default {
    name: "AddProduct",
    data(){
        return{
            name:"",
            info: "",
            image:"",
            price:100,
            count: 100,
            category: 0,
        }
    },
    computed: {
        ...mapGetters(["fullCategories"]),
    },
    methods:{
        ...mapActions(["storeProduct"]),
        onChange(e){
            this.image = e.target.files[0]
        },
        saveProduct(){
            this.storeProduct({
                name: this.name,
                info: this.info,
                href: this.image,
                price: this.price,
                count: this.count,
                category_id: this.category
            })
            this.name = this.info = this.image = ""
            this.price = this.count = 0
        }
    },
}
</script>

<style scoped>
form{
    width: 500px;
    margin: 0px auto;
}
</style>
