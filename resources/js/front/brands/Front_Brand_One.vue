
<template>
    <div v-if="brand" class="text-center">
        <div class="brand-media text-center">
            <img :src="brand.image ?? '/front/images/coffee3.png'" alt="brand">

        </div>
        <div class="brand-meta mt-1">
            <h6 class="title"> {{brand.name}}</h6>
            <small class="mt-1">({{brand.products_count}} محصول)</small>
        </div>
    </div>
    <skeleton v-else />
</template>

<style scoped>
.brand-media::before{
    width: 150px;
    height: 150px;
}
.brand-media img{
    width: 135px;
    height: 135px;
}
.title{
    font-size: 18px;
}

@media only screen and (max-width: 750px) {
    .brand-media::before{
        width: 110px;
        height: 110px;
    }
    .brand-media img{
        width: 80px;
        height: 80px;
    }
    .title{
        font-size: 13px;
    }

}
@media only screen and (max-width: 600px) {
    .brand-media::before{
        width: 80px;
        height: 80px;
    }
    .brand-media img{
        width: 60px;
        height: 60px;
    }
    .title{
        font-size: 13px;
    }

}
</style>
<script>
import {defineComponent} from 'vue'
import Front_Skeleton_Brand from "../skeletons/Front_Skeleton_Brand.vue";

export default defineComponent({
    name: "Front_Brand_One",
    props:['brand'],
    components:{
        'skeleton' : Front_Skeleton_Brand,
    }

})
</script>
