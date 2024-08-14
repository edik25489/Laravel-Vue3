<template>
    <form enctype="multipart/form-data" @submit.prevent="saveCategory">
        <div class="form-group">
            <label for="name">Введите название категории</label>
            <input v-model="name"  type="text" name="name" id="name">
        </div>
        <div class="form-group">
            <label for="description">Введите описание категории</label>
            <textarea v-model="description" name="description" id="description" cols="30" rows="10"></textarea>
        </div>
        <div class="form-group">
            <label for="image">Выберите файл</label>
            <input type="file" name="image" id="image" @change="onChange">
        </div>
        <button type="submit">Сохранить</button>
    </form>
</template>

<script>
import {mapActions} from "vuex"
export default {
    name: "AddCategory",
    data(){
        return{
            name:"",
            description: "",
            image:"",
        }
    },
    methods:{
        ...mapActions(["storeCategory"]),
        onChange(e){
            this.image = e.target.files[0]
        },
        saveCategory(){
            this.storeCategory({
                name: this.name,
                description: this.description,
                href: this.image,
            })
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
