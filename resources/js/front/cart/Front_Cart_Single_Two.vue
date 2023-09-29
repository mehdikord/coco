<script>
export default {
    name: "Front_Cart_Single_Two",
    props:['product'],

}
</script>

<template>
    <div class="row">
        <div class="col-md-2">
            <div class="cart-media">
                <router-link :to="{name : 'product',params : { code : product.product.code , name:product.product.name }}">
                    <img v-if="product.product.image" :src="product.product.image.image" alt="product">
                </router-link>
                <button @click="this.CartRemove(product.product.id)" class="cart-delete">
                    <i class="far fa-trash-alt"></i>
                </button>
            </div>
        </div>
        <div class="col-md-10 p-0">
            <strong>
                {{product.product.name}}
            </strong>
            <div class="mt-1">
                <span>دسته بندی : </span>
                <span v-if="product.product.category" class="text-danger">{{product.product.category.name}}</span>
            </div>
            <div class="mt-3">
                <strong class="text-green-6 font-16">
                    <template v-if="product.product.sale">
                        {{this.$filters.numbers(product.product.sale * product.quantity)}}
                    </template>
                    <template v-else>
                        {{this.$filters.numbers(product.product.price  * product.quantity)}}
                    </template>
                </strong>
                <span class="text-dark me-1">تومان</span>
            </div>
            <div class="cart-action-group float-right">
            <div class="product-action">
                <button @click="this.CartReduce(product.product.id)" class="action-minus" title="Quantity Minus">
                    <i class="icofont-minus"></i>
                </button>
                <input class="action-input" title="Quantity Number" type="number"  :value="this.CartProductQuantity(product.product.id)">
                <button @click="this.CartAdd(product.product,1)" class="action-plus" title="Quantity Plus">
                    <i class="icofont-plus"></i>
                </button>
            </div>
            </div>

        </div>
    </div>
</template>

<style scoped>
.product-action{
    display: block;
}
.action-input{
    font-size: 17px!important;
    font-weight: 600;
    color: #3278ff !important;
}
</style>
