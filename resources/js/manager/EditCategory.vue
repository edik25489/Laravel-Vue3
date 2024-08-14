<template>
    <form enctype="multipart/form-data" @submit.prevent="saveCategory">
        <div class="form-group">
            <label for="name">Обновите название категории</label>
            <input v-model="name"  type="text" name="name" id="name">
        </div>
        <div class="form-group">
            <label for="description">Обновите описание категории</label>
            <textarea v-model="description" name="description" id="description" cols="30" rows="10"></textarea>
        </div>
        <div class="form-group">
            <label for="image">Обновите файл</label>
            <input type="file" name="image" id="image" @change="onChange">
        </div>
        <button type="submit">Сохранить</button>
    </form>
</template>

<script>
import {mapActions, mapGetters} from "vuex"

export default {
    name: "EditCategory",
    data(){
        return{
            name:"",
            description: "",
            image:"",
        }
    },
    computed:{
        ...mapGetters(["fullCategory"])
    },
    methods:{
        ...mapActions(["storeCategory","getCategory"]),
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
    async mounted() {
        await this.getCategory(2);
    }
}
</script>

<style scoped>
form{
    width: 500px;
    margin: 0px auto;
}
</style>
