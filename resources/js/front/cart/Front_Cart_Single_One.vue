
<template>
    <template v-if="product">
        <div class="cart-media">
            <a href="#">
                <img v-if="product.product.image" :src="product.product.image.image" alt="product">
            </a>
            <button class="cart-delete">
                <i class="far fa-trash-alt"></i>
            </button>
        </div>
        <div class="cart-info-group">
            <div class="cart-info">
                <div>
                    <a href="" class="product-name text-dark">{{product.product.name}}</a>
                </div>
                <span class="text-danger">{{product.product.category.name}}</span>
                <p class="sub-price">
                    <template v-if="product.product.sale">
                        {{this.$filters.numbers(product.product.sale)}}
                    </template>
                    <template v-else>
                        {{this.$filters.numbers(product.product.price)}}
                    </template>
                </p>
            </div>
            <div class="cart-action-group">
                <div class="product-action">
                    <button @click="this.CartReduce(product.product.id)" class="action-minus" title="Quantity Minus">
                        <i class="icofont-minus"></i>
                    </button>
                    <input class="action-input" title="Quantity Number" type="number"  :value="this.CartProductQuantity(product.product.id)">
                    <button @click="this.CartAdd(product.product,1)" class="action-plus" title="Quantity Plus">
                        <i class="icofont-plus"></i>
                    </button>
                </div>
                <h6 class="total-price">
                    <template v-if="product.product.sale">
                        {{this.$filters.numbers(product.product.sale * product.quantity)}}
                    </template>
                    <template v-else>
                        {{this.$filters.numbers(product.product.price * product.quantity)}}
                    </template>
                    <span class="font-12 text-dark me-1">تومان</span>
                </h6>
            </div>
        </div>
    </template>

</template>

<style scoped>
.product-name{
    font-size: 14px;
    font-weight: 500;
}
.total-price{
    font-size: 17px;
}
@media only screen and (max-width: 600px) {
    .product-name{
        font-size: 13px;
        font-weight: 400;
    }
    .sub-price{
        font-size: 13px;
        margin-top: 3px;
    }
    .total-price{
        font-size: 14px;
    }
}
</style>
<script>
import {defineComponent} from 'vue'

export default defineComponent({
    name: "Front_Cart_Single_One",
    props : ['product'],
})
</script>
