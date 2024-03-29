import {createStore} from "vuex";
import managers from "./modules/users/managers";
import members from "./modules/users/members";
import faqs from "./modules/faqs/faqs";
import brands from "./modules/brands/brands";
import categories from "./modules/categories/categories";
import products from "./modules/products/products";
import slider from "./modules/slider/slider";
import cart from "./modules/cart/cart";
import user from "./modules/user/user";
import shopping from "./modules/shopping/shopping";
const store = createStore({
    state(){
        return {
            Auth_Manage : [],
            Auth_User : [],

        }
    },

    modules:{
        managers,
        members,
        faqs,
        brands,
        categories,
        products,
        slider,
        cart,
        user,
        shopping

    },

    mutations : {
        AuthManageLogin(state,item){
            state.Auth_Manage = item
            localStorage.setItem('coco_manage_auth_token',item.access_token)
            localStorage.setItem('coco_manage_auth_user',JSON.stringify(item.user))
        },
        AuthLogout(state){
            state.Auth_Manage = {}
            localStorage.removeItem('coco_manage_auth_token')
            localStorage.removeItem('coco_manage_auth_user')
        },
        AuthManageSync(state){
            if (localStorage.getItem('coco_manage_auth_token') && localStorage.getItem('coco_manage_auth_user')){
                var item;
                item = {
                    token : localStorage.getItem('coco_manage_auth_token'),
                    user : JSON.parse(localStorage.getItem('coco_manage_auth_user')),
                }
                state.Auth_Manage = item
            }
        },

        AuthUserLogin(state,item){
            state.Auth_User = item
            localStorage.setItem('coco_user_auth_token',item.token)
            localStorage.setItem('coco_user_auth_user',JSON.stringify(item.user))
        },
        AuthUserLogout(state){
            state.Auth_User = {}
            localStorage.removeItem('coco_user_auth_token')
            localStorage.removeItem('coco_user_auth_user')
        },
        AuthUserSync(state){
            if (localStorage.getItem('coco_user_auth_token') && localStorage.getItem('coco_user_auth_user')){
                var item;
                item = {
                    token : localStorage.getItem('coco_user_auth_token'),
                    user : JSON.parse(localStorage.getItem('coco_user_auth_user')),
                }
                state.Auth_User = item
            }
        },

    },
    getters : {
        AuthManageCheck : state => {
            return !!state.Auth_Manage.token;
        },
        AuthManageUser : state => {
            return state.Auth_Manage.user;
        },
        AutManageToken : state => {
            return state.Auth_Manage.token;
        },

        AuthUserCheck : state => {
            return !!state.Auth_User.token;
        },
        AuthUserUser : state => {
            return state.Auth_User.user;
        },
        AutUserToken : state => {
            return state.Auth_User.token;
        },

    },
    actions : {
        Auth_Manage_Login(state,item){
            state.commit('AuthManageLogin',item)
        },
        Auth_Manage_Logout(state){
            state.commit('AuthManageLogout')
        },

        Auth_User_Login(state,item){
            state.commit('AuthUserLogin',item)
        },
        Auth_User_Logout(state){
            state.commit('AuthUserLogout')
        },

    }
});

export default store
