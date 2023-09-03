<script>
export default {
    name: "Front_Skeleton_Product_Single_One"
}
</script>

<template>
    <div class="product-card">
        <div class="product-media text-center">
            <q-skeleton type="text" width="30px" />
            <button class="product-wish wish" disabled>
                <i class="fas fa-heart"></i>
            </button>
            <q-skeleton class="img-skeleton mt-2 mb-2 rounded-borders" type="QAvatar" square />
        </div>
        <div class="product-content">
            <h6 class="product-name">
                <q-skeleton type="text" />
            </h6>
            <div class="product-rating">
                <i class=" icofont-star"></i>
                <i class=" icofont-star"></i>
                <i class=" icofont-star"></i>
                <i class=" icofont-star"></i>
                <i class="icofont-star"></i>
            </div>

            <q-skeleton class="mt-1 mb-1 price-skeleton" type="text" />

            <q-skeleton type="QBtn" class="w-100" />

        </div>
    </div>

</template>

<style scoped>
.product-card:hover{
    border-color: transparent!important;
    box-shadow: none;
}
.price-skeleton{
    margin: 0 auto;
    width: 70%;
    height: 35px;
}
.img-skeleton{
    margin: 0 auto;
    width:170px ;
    height:170px ;
}

.product-rating > i{
    font-size: 12px !important;
}
@media only screen and (max-width: 600px) {

    .img-skeleton{
        margin: 0 auto;
        width:120px ;
        height:120px ;
    }


    .product-name{
        font-size: 14px;
    }
    .product-rating > i{
        font-size: 10px !important;
    }


}
</style>
