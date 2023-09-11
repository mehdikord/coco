<script>
export default {
    name: "Front_Skeleton_Product_Single_Two"
}
</script>

<template>
    <div class="feature-card">
        <div class="feature-media">
            <div class="feature-label">
                <!--                <label class="label-text feat">پیشنهاد ما</label>-->
            </div>
            <a class="feature-image">
                <q-skeleton class="img-skeleton mt-2 mb-2 rounded-borders" type="QAvatar" square />
            </a>
        </div>
        <div class="feature-content text-left">
            <h6 class="product-name">
                <q-skeleton type="text" />
            </h6>
            <div class="product-rating float-left">
                <i class="active icofont-star"></i>
                <i class="active icofont-star"></i>
                <i class="active icofont-star"></i>
                <i class="active icofont-star"></i>
                <i class="icofont-star"></i>

            </div>
            <div class="mt-4 mobile-price">
                <q-skeleton class="mt-1 mb-1 price-skeleton" type="text" />
            </div>
            <p class="product-desc">
            </p>
            <q-skeleton type="QBtn" class="w-100" />
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
.img-skeleton{
    margin: 0 auto;
    width:170px ;
    height:170px ;
}
.price-skeleton{
    margin: 0 auto;
    width: 70%;
    height: 35px;
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
