<script>
import {defineComponent} from 'vue'
import Front_Skeleton_Product_Single_One from "../skeletons/Front_Skeleton_Product_Single_One.vue";

export default defineComponent({
    name: "Front_Product_Single_One",
    components:{
        'skeleton_product':Front_Skeleton_Product_Single_One,
    },
    props:['product'],
    data(){
        return{

        }
    }
})
</script>


<template>
    <div v-if="product" class="product-card">

        <div class="product-media text-center">
            <div class="product-label">
<!--                <label class="label-text new">جدید</label>-->
            </div>
            <button class="product-wish wish">
                <i class="fas fa-heart font-20"></i>
            </button>
            <router-link :to="{name : 'product',params : { code : product.code , name:product.name }}" class="product-image">
                <img v-if="product.image" :src="product.image.image" alt="product" />
                <img v-else src="/front/images/coffee2.png" alt="product" />
            </router-link>

        </div>
        <div class="product-content">
            <h6 class="product-name">
                <router-link :to="{name : 'product',params : { code : product.code , name:product.name }}">
                    {{product.name}}
                </router-link>
            </h6>
            <div class="product-rating">
                <template v-if="product.rate">
                    <i v-for="i in 5" class="icofont-star" :class="{'active' : i <= product.rate}"></i>
                </template>
            </div>
            <h6 class="product-price mt-2">
                <span>{{this.$filters.numbers(product.price)}}<small></small></span>
            </h6>
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
    <skeleton_product v-else></skeleton_product>
</template>

<style scoped>

.product-image img {
    width: 185px;
}
.product-name{
    font-size: 14px;
}
.product-rating > i{
    font-size: 12px !important;
}
.product-price{
    font-size: 15px;
}
.product-add{
    font-size: 14px;
}
.product-action{
    display: flex;
}

@media only screen and (max-width: 600px) {
    .product-image img {
        width: 125px;
    }
    .label-text{
        font-size: 11px;
    }
    .product-name{
        font-size: 14px;
    }
    .product-rating > i{
        font-size: 10px !important;
    }
    .product-price{
        font-size: 14px;
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
}
</style>
