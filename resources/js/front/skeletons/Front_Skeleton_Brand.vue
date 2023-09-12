<script>
export default {
    name: "Front_Skeleton_Brand"
}
</script>

<template>
    <div class="text-center">
        <div class="brand-media text-center">
            <img src="/front/images/coffee3.png" alt="brand">
            <div class="brand-overlay">
                <a href="">
                    <i class="fas fa-link"></i>
                </a>
            </div>
        </div>
        <div class="brand-meta mt-1 text-center">
            <h6 class="title pe-3 ps-3"> <q-skeleton type="QBadge" class="w-100"/></h6>
            <div class="mt-3 pe-5 ps-5">
                <q-skeleton type="text"  />
            </div>

        </div>
    </div>

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
