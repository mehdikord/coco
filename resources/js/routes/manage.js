import { createRouter, createWebHistory } from "vue-router";
import Manage_Dashboard from "../manage/pages/dashboard/Manage_Dashboard.vue";
import Manage_Auth from "../manage/pages/auth/Manage_Auth.vue";
import store from "../store"
import Manage_Users_Managers from "@/manage/pages/users/Manage_Users_Managers.vue";
import Manage_Users_Members from "../manage/pages/users/Manage_Users_Members.vue";
import Manage_Faqs from "@/manage/pages/faqs/Manage_Faqs.vue";
import Manage_Brands from "../manage/pages/brands/Manage_Brands.vue";
import Manage_Categories from "../manage/pages/categories/Manage_Categories.vue";
import Manage_Products from "../manage/pages/products/Manage_Products.vue";
import Manage_Slider from "../manage/pages/slider/Manage_Slider.vue";
import axios from 'axios';


const routes = [

    {
        path : "/management/login",
        name : "login",
        component : Manage_Auth,
        meta : { title : "ورود مدیران"}
    },
    {
        path : "/management/dashboard",
        name : "dashboard",
        component : Manage_Dashboard,
        meta : { title : "داشبورد مدیریت"}
    },
    {
        path : "/management/users/managers",
        name : "users_managers",
        component : Manage_Users_Managers,
        meta : { title : "مدیران سیستم"}
    },
    {
        path : "/management/brands",
        name : "brands",
        component : Manage_Brands,
        meta : { title : "برند ها"}
    },
    {
        path : "/management/categories",
        name : "categories",
        component : Manage_Categories ,
        meta : { title : "دسته بندی ها"}
    },
    {
        path : "/management/products",
        name : "products",
        component : Manage_Products ,
        meta : { title : "محصولات"}
    },
    {
        path : "/management/users/members",
        name : "users_members",
        component : Manage_Users_Members,
        meta : { title : "مشتریان فروشگاه"}
    },
    {
        path : "/management/slider",
        name : "slider",
        component : Manage_Slider,
        meta : { title : " تنظیمات اسلایدر"}
    },
    {
        path : "/management/faqs",
        name : "faqs",
        component : Manage_Faqs,
        meta : { title : "سوالات متداول"}
    },

]


const router = createRouter({
    history: createWebHistory(),
    routes : routes

})

router.beforeEach((to, from, next) => {
    // trying to access a restricted page + not logged in
    // redirect to login page

    axios.defaults.baseURL="/api/manage"

    if (to.path !== '/management/login' && !store.getters.AuthManageCheck) {
        next('/management/login');
    }else if (to.path === '/management/login' && store.getters.AuthManageCheck){
        next('/management/dashboard');
    }
    else {
        next();
    }

});

export default router
