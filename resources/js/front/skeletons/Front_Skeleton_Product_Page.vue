<script>
export default {
    name: "Front_Skeleton_Product_Page"
}
</script>

<template>

    <section class="inner-section">
        <div class="container mt-4 mb-3 ">
            <div class="row">
                <q-skeleton type="text" width="50px"></q-skeleton>
                /
                <q-skeleton type="text" width="50px"></q-skeleton>
                /
                <q-skeleton type="text" width="50px"></q-skeleton>
            </div>

        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 no-padding-mobile">
                    <q-skeleton type="QAvatar" square class="for-main-slider"/>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 no-padding-mobile">
                    <div class="details-content">
                        <h3 class="details-name">
                            <q-skeleton width="280px"/>
                        </h3>
                        <div class="">
                            <div class="category">
                                <q-skeleton width="200px"/>
                            </div>
                            <div class="mt-2 category">
                                <q-skeleton width="175px"/>

                            </div>
                        </div>

                        <h3 class="mt-2">
                           <q-skeleton width="190px"/>
                        </h3>
                        <p class="details-desc mt-3 text-justify">
                            <q-skeleton v-for="i in 4" class="mt-1"/>
                        </p>
                        <div class="mb-3">
                            <q-skeleton width="165px" height="35px"/>
                        </div>
                        <div class="details-add-group">
                            <div class="row text-center">
                             <q-skeleton type="QBtn" width="90%" />
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>


</template>

<style scoped>

.for-main-slider{
    height: 600px;
    width: 100%;
}
.details-name{
    font-size: 16px;
    font-weight: 500;
}
.details-rating > i{
    font-size: 14px;
}

.details-content{
    padding-top: 18px;
}
.review-avatar img {
    width: 56px;
}


@media only screen and (max-width: 600px) {

    .for-main-slider{
        height: 260px;
        width: 100%;
    }

    .details-name{
        font-size: 15px;
        font-weight: 500;
    }
    .details-rating > i{
        font-size: 11px;
    }

    .details-content{
        padding-top: 18px;
    }
    .review-avatar > img {
        width: 40px;
    }
    .review-meta > strong{
        font-size: 13px!important;
    }
    .review-meta > span{
        font-size: 10px!important;
    }
    .review-rating > li{
        font-size: 12px!important;
    }
    textarea{
        height: 150px;
    }

    .category{
        font-size: 12.5px;
    }

    .details-desc{
        font-size: 13px;
    }
    .no-padding-mobile{
        padding: 5px 0;
    }
    .inner-section{
        margin-bottom: 10px;
    }

}


</style>
