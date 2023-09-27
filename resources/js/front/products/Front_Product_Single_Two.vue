
<template>
    <div v-if="product" class="feature-card">
        <div class="feature-media">
            <div class="feature-label">
<!--                <label class="label-text feat">پیشنهاد ما</label>-->
            </div>
            <router-link :to="{name : 'product',params : { code : product.code , name:product.name }}" class="feature-image" >
                <img v-if="product.image" :src="product.image.image" alt="product">
                <img v-else src="/front/images/coffee2.png" alt="product" />

            </router-link>
        </div>
        <div class="feature-content text-left">
            <h6 class="product-name">
                <router-link :to="{name : 'product',params : { code : product.code , name:product.name }}">
                    {{product.name}}
                </router-link>
            </h6>
            <div class="product-rating float-left">
                <i class="active icofont-star"></i>
                <i class="active icofont-star"></i>
                <i class="active icofont-star"></i>
                <i class="active icofont-star"></i>
                <i class="icofont-star"></i>

            </div>

            <div class="mt-4 mobile-price text-dark">
                <div class="mb-1 text-danger font-13">
                    {{ product.category.name }}
                </div>
                <template v-if="product.sale">


                </template>
                <template v-else>
                    <strong class="text-success">{{this.$filters.numbers(product.price)}}</strong>
                </template>
                <small> تومان </small>
            </div>
            <p class="product-desc">
            </p>
            <button v-if="!this.CartProductCheck(product.id)" @click="this.CartAdd(product,1)" class="product-add pt-2 pb-2" title="افزودن این محصول به سبد خرید">
                <span>افزودن به سبد</span>
                <i class="fas fa-shopping-basket me-2"></i>
            </button>
            <div v-else class="product-action">
                <button @click="this.CartReduce(product.id)" title="کم کردن تعداد">
                    <i class="icofont-minus">
                    </i>
                </button>
                <input  title="افزودن تعداد" type="number" :value="this.CartProductQuantity(product.id)">
                <button @click="this.CartAdd(product,1)" title="Quantity Plus"><i class="icofont-plus"></i></button>
            </div>

        </div>
    </div>

</template>

<style scoped>
.feature-image img {
    width: 175px;
}
.product-name{
    font-size: 15px;
}
.product-rating > i{
    font-size: 12px !important;
}
.product-price{
    font-size: 16px;
}
.mobile-price{
    font-size: 16px;
    font-weight: 500;

}
.product-add{
    font-size: 14px;
}
.product-desc{
    font-size: 13px;
}
.product-action{
    display: flex;
}

@media only screen and (max-width: 600px) {
    .feature-image img {
        width: 90px;
    }
    .product-name{
        font-size: 13px;
    }
    .product-rating > i{
        font-size: 10px !important;
    }
    .product-price{
        font-size: 13px;
    }
    .mobile-price{
        font-size: 14px;
        font-weight: 500;
        color: #1b9124;
    }
    .product-add{
        font-size: 12px;
    }
    .product-add > i{
        display: block;
        font-size: 10px;
    }
    .action-input .action-plus .action-minus{
        font-size: 13px !important;
    }
    .label-text{
        font-size: 10px;
    }

}
</style>
<script>
import {defineComponent} from 'vue'

export default defineComponent({
    name: "Front_Product_Single_Two",
    props:['product'],
})
</script>
