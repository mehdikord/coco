<script>


import Front_Cart_Single_Two from "../cart/Front_Cart_Single_Two.vue";

export default {
    name: "Front_Shop_Checkout",
    components: {
        'cart_single_two' : Front_Cart_Single_Two,
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
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <strong class="font-15">سبد خرید شما</strong>
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
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                adasdadad
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
