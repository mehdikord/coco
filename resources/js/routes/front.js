import { createRouter, createWebHistory } from "vue-router";
import Front_Index from "../front/index/Front_Index.vue";
import test from "../front/test.vue";
import Front_Shop_Index from "../front/shop/Front_Shop_Index.vue";
import Front_Product_Page from "../front/products/Front_Product_Page.vue";
import Front_Profile_Index from "../front/profile/Front_Profile_Index.vue";
import Front_Auth from "../front/auth/Front_Auth.vue";
import store from "../store";
import Front_Shop_Checkout from "../front/shop/Front_Shop_Checkout.vue";
import Front_Payment_Result_Success from "../front/payment/Front_Payment_Result_Success.vue";
import Front_Payment_Result_Failed from "../front/payment/Front_Payment_Result_Failed.vue";

const routes = [
    {
        path : "/",
        name : "index",
        component : Front_Index,
    },
    {
        path : "/shop",
        name : "shop",
        component : Front_Shop_Index,
    },
    {
        path : "/product/:code/:name",
        name : "product",
        component : Front_Product_Page,
    },
    {
        path : "/profile/orders",
        name : "profile_orders",
        component : Front_Profile_Index,
    },
    {
        path : "/profile/orders/:code",
        name : "profile_orders_detail",
        component : Front_Profile_Index,
    },
    {
        path : "/auth",
        name : "auth",
        component : Front_Auth,
    },
    {
        path : "/profile",
        name : "profile",
        component : Front_Profile_Index,
    },
    {
        path : "/checkout/cart",
        name : "checkout_cart",
        component : Front_Shop_Checkout,
    },
    {
        path : "/checkout/shipping",
        name : "checkout_shipping",
        component : Front_Shop_Checkout,
    },
    {
        path : "/checkout/payment-result/success",
        name : "checkout_payment_result_success",
        component : Front_Payment_Result_Success,
    },
    {
        path : "/checkout/payment-result/failed",
        name : "checkout_payment_result_failed",
        component : Front_Payment_Result_Failed,
    },




]

const router = createRouter({
    history: createWebHistory(),
    routes : routes

})

router.beforeEach((to, from, next) => {

    if (to.path === '/auth' && store.getters.AuthUserCheck){
        next('/profile');
    }
    if (to.path === '/profile' && !store.getters.AuthUserCheck){
        next('/auth');
    }
    next();

    setTimeout(() => {
        window.scrollTo(0, 0);
    }, 1);


});

export default router
