<script>


import Front_Cart_Single_Two from "../cart/Front_Cart_Single_Two.vue";
import {mapGetters} from "vuex";

export default {
    name: "Front_Shop_Checkout",
    components: {
        'cart_single_two' : Front_Cart_Single_Two,
    },
    computed : {
        ...mapGetters([
            "AuthUserCheck"
        ])
    }
}
</script>

<template>
    <section class="inner-section checkout-part">
        <div class="container">
            <div class="mt-4 mb-3">
                <strong class="title">ثبت نهایی سفارشات</strong>
            </div>
            <template v-if="this.CartTotalProducts > 0">
                <div class="row">
                    <div class="col-md-12 ">
                        <q-banner class="bg-yellow-10">

                        </q-banner>
                    </div>
                    <div class="col-md-9 q-px-xs">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <strong class="font-16 text-success">سبد خرید شما</strong>
                                    <q-btn class="float-start" color="red" flat>خالی کردن سبد خرید</q-btn>
                                </div>
                                <div class="mt-4">
                                    <template v-for="item in this.CartItemGet">
                                        <cart_single_two :product="item"></cart_single_two>
                                        <q-separator color="grey-6" class="mt-3 mb-4"/>
                                    </template>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 q-px-xs">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <span class="font-14 text-grey-8">قیمت کالاها <strong class="text-indigo-5">({{CartTotalProducts}})</strong></span>
                                    <strong class="float-right text-grey-8">{{this.$filters.numbers(this.CartTotalPrice) }}</strong>
                                </div>
                                <q-separator class="mt-3 mb-3" />
                                <div>
                                    <strong class="font-14 text-dark">جمع سبد خرید</strong>
                                    <span class="float-right me-1 text-grey-7">تومان</span>
                                    <strong class="float-right font-16 text-success">{{this.$filters.numbers(this.CartTotalPrice) }}</strong>
                                </div>
                                <q-separator class="mt-3 mb-3" />
                                <div class="text-center">
                                    <q-btn color="green-6" class="w-100 font-16"  glossy :disable="!AuthUserCheck">ثبت سفارش و پرداخت</q-btn>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </template>
            <template v-else>
                <div class="text-center mt-5">
                    <img src="/front/images/cart-empty.png" alt="" width="200">
                    <div class="mt-4 font-15">
                        <strong>سبد خرید شما خالی است برای مشاهده محصولات به فروشگاه بروید</strong>
                    </div>
                </div>
            </template>
        </div>
    </section>

</template>

<style scoped>
.title{
    font-size: 17px;
    font-weight: 600;
}
@media only screen and (max-width: 600px) {
    .title{
        font-size: 15px;
        font-weight: 600;
    }
}
</style>
