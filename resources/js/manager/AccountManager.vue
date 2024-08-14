<template>
    <div class="content">
        <div class="header">
            <h2>Личный кабинет администратора {{getManager.name}} {{getManager.surname}}</h2>
            <button type="button" @click="logout" class="logout">
                Выйти с кабинета
            </button>
        </div>
        <div class="body">
            <table>
                <thead>
                <tr>
                    <th>id</th>
                    <th>Название категории</th>
                    <th>Операции</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="category in fullCategories" :key="category">
                    <td>{{ category.id }}</td>
                    <td>{{category.name}}</td>
                    <td>
                        <router-link :to="{ name: 'EditCategory', params:{id:category.id}}" >edit</router-link>
                        <button type="button" class="delete" @click="delCategory">
                            x
                        </button>
                    </td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="3" style="text-align: right;">
                        <router-link :to="{ name: 'AddCategory'}">+ add category</router-link>
                    </td>
                </tr>
                </tfoot>
            </table>
            <table>
                <thead>
                <tr>
                    <th>id</th>
                    <th>Название продукта</th>
                    <th>Операции</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="product in fullProducts" :key="product">
                    <td>{{product.id}}</td>
                    <td>{{product.name}}</td>
                    <td>
                        <router-link :to="{ name: 'EditProduct', params:{id:product.id}}">edit</router-link>
                        <button type="button" class="delete" @click="delProduct">
                            x
                        </button>
                    </td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="3" style="text-align: right;">
                        <router-link :to="{ name: 'AddProduct'}">+ add product</router-link>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <router-view></router-view>
</template>

<script>
import {mapGetters, mapActions} from "vuex"
export default {
    name: "AccountManager",
    computed: {
        ...mapGetters(["getManager","fullCategories", "fullProducts"]),
    },
    methods: {
        ...mapActions(["getCategories", "getProducts","removeTokenManager","managerInfo"]),
        logout() {
            this.removeTokenManager()
        },
    },
    async mounted() {
        await this.managerInfo({
            managerId: localStorage.getItem('managerId')
        });
        await this.getCategories();
        await this.getProducts();
    }
}
</script>

<style scoped>
.logout{
    color: white;
    background: #6a6868;
    font-size: 20px;
    padding: 10px;
    border: 2px solid #5c5959;
}
.content{
    display: flex;
    flex-direction: column;
    justify-content: space-around;
    width: 900px;
    margin: 50px auto;
}
.header{
    width: 100%;
    background: #6a6666;
    color: white;
    text-align: center;
    border-radius: 20px;
    margin-bottom: 10px;
}
.body{
    width: 100%;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
}
table{
    text-align: justify;
    font-size: 18px;
    background: #e7e5e5;
    padding: 10px;
    border-radius: 20px;
}
tbody tr:hover{
    background: #f8f8f8;
}
td{
    border-bottom: 1px solid  #6a6666;
    line-height: 40px;
}
button{
    padding: 2px;
    border:none;
    border-radius: 10px;
    font-size: 15px;
}
button:hover{
    opacity: 50%;
    color: black;
}

.update{
    width: 40px;
    background: #28ea14;
    color: white;
}
.delete{
    width: 40px;
    background: #fa0f0f;
    color: white;
}
</style>
