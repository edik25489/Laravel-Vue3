import {createStore} from "vuex"
import token from "./modules/token.js"
import tokenManager from "./modules/tokenManager.js"
import category from "./modules/category.js"
import product from "./modules/product.js"
import userProduct from "./modules/userProduct.js";
const store = createStore({
    modules:{
        token,
        tokenManager,
        category,
        product,
        userProduct,
    }
})
export default store;
