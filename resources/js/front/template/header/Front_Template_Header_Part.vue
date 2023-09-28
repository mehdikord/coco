<template>
    <header class="header-part">
        <div class="container">
            <div class="header-content">
                <div class="header-media-group">
                    <button class="header-user">
                        <img src="/front/images/user.png" alt="user">
                    </button>
                    <router-link :to="{name:'index'}">
                        <img src="/front/images/logo.png" alt="logo">
                    </router-link>
                    <button class="header-src">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                <router-link :to="{name : 'index'}" class="header-logo">
                    <img src="/front/images/logo.png" alt="logo">
                </router-link>

                <router-link v-if="AuthUserCheck" :to="{name : 'profile'}" class="header-widget" title="My Account">
                    <img src="/front/images/user.png" alt="user"><span class="name-bold">{{AuthUserUser.name}}</span>
                </router-link>
                <router-link v-else :to="{name : 'auth'}" class="header-widget" title="My Account">
                    <img src="/front/images/user.png" alt="user"><span>حساب کاربری</span>
                </router-link>

                <form class="header-form">
                    <input type="text" placeholder="جستجو در محصولات ...">
                    <button><i class="fas fa-search"></i></button>
                </form>
                <div class="header-widget-group">

                    <a href="" class="header-widget" title="علاقه مندی ها"><i class="fas fa-heart"></i><sup>0</sup>
                    </a>
                    <button class="header-widget header-cart" title="سبد خرید">
                        <i class="fas fa-shopping-basket"></i>
                        <sup>{{this.CartItemCount}}</sup>
                        <span>
                            مجموع سبد خرید
                            <small class="text-danger">
                                {{this.$filters.numbers(this.CartTotalPrice) }}
                            </small>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </header>
    <header_cart></header_cart>


</template>

<style scoped>
.name-bold{
    font-weight: 600;
}
</style>
<script>
import {defineComponent} from 'vue'
import Front_Template_Header_Cart from "./Front_Template_Header_Cart.vue";
import {mapGetters} from "vuex";

export default defineComponent({
    name: "Front_Template_Header_Part",
    components : {
        'header_cart' : Front_Template_Header_Cart,
    },
    computed:{
        ...mapGetters([
            "AuthUserCheck",
            "AuthUserUser"
        ])

    }
})
</script>

