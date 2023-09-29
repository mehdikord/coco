<template>
    <aside class="cart-sidebar">
        <div class="cart-header">
            <div class="cart-total">
                <i class="fas fa-shopping-basket"></i>
                <span class="me-2">محصولات در سبد خرید ( {{this.CartTotalProducts}} )</span>
            </div>
            <button class="cart-close">
                <i class="icofont-close text-danger"></i>
            </button>
        </div>
        <cart_empty v-if="this.CartTotalProducts < 1"></cart_empty>
        <ul v-else class="cart-list">

            <li v-for="item in this.CartItemGet" class="cart-item">
                <cart_single_one :product="item"></cart_single_one>
            </li>

        </ul>
        <div class="cart-footer">
            <button class="coupon-btn">آیا کد تخفیف دارید ؟</button>
            <form class="coupon-form">
                <input type="text" placeholder="کد تخفیف را وارد کنید">
                <button type="submit">
                    <span>ثبت کد</span>
                </button>
            </form>
            <router-link :to="{'name' : 'checkout'}" class="cart-checkout-btn pointer" :class="{'bg-dark cursor-not-allowed' : this.CartTotalProducts < 1}" >
                <span class="checkout-label">ثبت نهایی سفارشات</span>
                <span class="checkout-price">{{this.$filters.numbers(this.CartTotalPrice) }} </span><span class="checkout-price font-14">تومان</span>
            </router-link>
        </div>
    </aside>

</template>

<style scoped>
.checkout-price{
   font-size: 17px;
    font-weight: 600;
}
@media only screen and (max-width: 600px) {
    .checkout-price{
        font-size: 15px;
        font-weight: 500;
    }
}

</style>
<script>
import {defineComponent} from 'vue'
import Front_Cart_Single_One from "../../cart/Front_Cart_Single_One.vue";
import Front_Cart_Empty from "@/front/cart/Front_Cart_Empty.vue";

export default defineComponent({
    name: "Front_Template_Header_Cart",
    components :{
        'cart_single_one' : Front_Cart_Single_One,
        'cart_empty' : Front_Cart_Empty,
    }
})
</script>

