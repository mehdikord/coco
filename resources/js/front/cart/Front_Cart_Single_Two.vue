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

        </div>
    </div>
</template>

<style scoped>

</style>
