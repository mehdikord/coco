
<template>
    <skeleton_product v-if="loading"></skeleton_product>
    <section v-else class="inner-section">
        <div class="container mt-4 mb-3">
             <router-link :to="{name : 'index'}" class="text-muted"> صفحه اصلی </router-link>
            /
            <router-link v-if="product.category && product.category.parent" to="" class="text-muted"> {{product.category.parent.name}} </router-link>
            /
            <router-link v-if="product.category" to=""  class="text-dark"> {{product.category.name}} </router-link>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 no-padding-mobile">
                    <q-carousel
                        swipeable
                        animated
                        v-model="slide"
                        thumbnails
                        infinite
                        class="for-main-slider sm-hide xs-hide"
                    >
                        <q-carousel-slide v-for="(image,index) in product.images" :name="index" :img-src="image.image" />

                    </q-carousel>
                    <q-carousel
                        animated
                        v-model="slide"
                        ref="carousel"
                        infinite
                        :autoplay="true"
                        transition-prev="slide-right"
                        transition-next="slide-left"
                        control-color="black"
                        control-type="outline"
                        class="md-hide lg-hide xl-hide"
                    >
                        <q-carousel-slide v-for="(image,index) in product.images" :name="index" :img-src="image.image" />

                        <template v-slot:control>

                            <q-carousel-control

                                class="q-gutter-sm"
                                position="bottom"
                            >
                                <q-btn class="font-12" glossy  round dense color="success" text-color="white" icon="fas fa-arrow-right" @click="$refs.carousel.next()"/>

                                <q-btn  class="font-12" glossy round dense color="success" text-color="white" icon="fas fa-arrow-left" @click="$refs.carousel.previous()"/>
                            </q-carousel-control>
                        </template>

                    </q-carousel>

                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 no-padding-mobile">
                    <div class="details-content">
                        <h3 class="details-name">
                            {{product.name}}
                        </h3>
                        <div class="">
                            <div class="category">
                                <span>دسته بندی : </span>
                                <strong >
                                    <router-link v-if="product.category" to="" class="text-blue">{{product.category.name}}</router-link>
                                </strong>
                            </div>
                            <div class="mt-2 category">
                                <span>برند : </span>
                                <strong>
                                    <router-link v-if="product.brand" to="" class="text-red">{{product.brand.name}}</router-link>
                                </strong>
                            </div>
                        </div>
                        <div class="details-rating mt-2">
                            <template v-if="product.rate">
                                <i v-for="i in 5" class="icofont-star" :class="{'active' : i <= product.rate}"></i>

                            </template>
                            <a class="rate-review" href="#">({{product.comments_count}} دیدگاه)</a>

                        </div>
                        <h3 class="mt-2">
                            <template v-if="product.sale">
                                <strong class="price me-2 text-success">{{this.$filters.numbers(product.sale)}}</strong>
                                <del class="price-old text-danger">{{this.$filters.numbers(product.price)}}</del>

                            </template>
                            <template v-else>
                                <strong class="price me-2 text-success">185,000</strong>

                            </template>

                            <span class="me-1 curency">تومان</span>
                        </h3>
                        <h5 class="font-16 info-title">توضیحات محصول : </h5>
                        <p class="details-desc mt-1 text-justify">
                            {{product.short_description}} ...
                            <br>
                            <br>
                            <strong class="text-blue">مشاهده کامل توضیحات </strong>
                        </p>
                        <div class="mb-3">
                            <div class="pointer" @click="set_rate=true">
                            <q-icon name="fas fa-star" color="yellow-9" size="18px" />
                            <strong class="me-2 text-yellow-10">به این محصول امتیاز دهید ! </strong>
                            </div>
                            <q-dialog v-model="set_rate" full-width>
                                <div class="row justify-center">
                                    <div class="col-lg-6 col-md-7 col-sm-12 col-xs-12 p-0">
                                        <q-card>
                                            <q-card-section class="bg-yellow-9">
                                                <h6 class="rate_title text-blue-grey-10"> امتیاز به قهوه ترک 500 گرمی لایت</h6>
                                            </q-card-section>
                                            <q-separator />
                                            <q-card-section >
                                                <div class="star-rating">
                                                    <input type="radio" name="rating" id="star-1">
                                                    <label for="star-1"></label>
                                                    <input type="radio" name="rating" id="star-2">
                                                    <label for="star-2"></label>
                                                    <input type="radio" name="rating" id="star-3">
                                                    <label for="star-3"></label>
                                                    <input type="radio" name="rating" id="star-4">
                                                    <label for="star-4"></label>
                                                    <input type="radio" name="rating" id="star-5">
                                                    <label for="star-5"></label>
                                                </div>

                                                <div class="mt-4 mb-4 text-center">
                                                    <q-btn color="yellow-10" class="pe-4" text-color="white" icon-right="fas fa-check font-16">ثبت امتیاز</q-btn>
                                                </div>
                                            </q-card-section>
                                        </q-card>
                                    </div>
                                </div>

                            </q-dialog>
                        </div>
                        <div class="details-list-group">
                            <q-icon name="fas fa-thumbs-up" color="success"></q-icon>
                            <small class="me-2">87% کاربران از خرید این محصول راضی هستند !</small>
                        </div>
                        <div class="details-list-group"><label class="details-list-title">اشتراک گذاری : </label>
                            <ul class="details-share-list">
                                <li><a href="#" class="icofont-facebook" title="Facebook"></a></li>
                                <li><a href="#" class="icofont-twitter" title="Twitter"></a></li>
                                <li><a href="#" class="icofont-linkedin" title="Linkedin"></a></li>
                                <li><a href="#" class="icofont-instagram" title="Instagram"></a></li>
                            </ul>
                        </div>
                        <div class="details-add-group">
                            <div class="row text-center">

                                <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11">
                                <q-btn v-if="!this.CartProductCheck(product.id)" @click="this.CartAdd(product,1)"  color="success" icon-right="fas fa-cart-arrow-down" class="w-100 pt-2 pb-2" title="افزودن این محصول به سبد خرید"> افرودن به سبد خرید</q-btn>
                                </div>

                                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                                    <q-icon name="fas fa-heart" class="favorite-icon" color="blue-grey-8 pointer"></q-icon>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <div  v-if="!loading">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 q-px-none">
                    <div class="product-details-frame p-4">
                        <strong class="font-16 info-title">معرفی و توضیحات :</strong>
                        <div class="mt-4 details-desc">
                          <span v-html="product.long_description"></span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 mt-4 q-px-none">
                    <div class="product-details-frame p-4">
                        <strong class=" font-15 info-title">مشخصات محصول :</strong>
                        <div class="mt-1">
                            <div class="row justify-center details-desc">
                                <div class="col-md-9">
                                    <div v-for="i in 1" class="row mt-4">
                                        <div class="col-xl-2 col-lg-2 col-md-3 col-sm-4 col-xs-4 text-left">
                                            <span class="text-muted">وزن محصول </span>
                                        </div>
                                        <div class="col-xl-10 col-lg-10 col-md-9 col-sm-8 col-xs-8 text-left border-bottom pb-3">
                                            <span class="text-dark">1 کیلو گرم</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 mt-4 q-px-none">
                    <div class="product-details-frame p-3">
                        <strong class=" font-16 info-title">دیدگاه های کاربران :</strong>
                        <q-btn @click="set_comment = !set_comment"  rounded color="success" icon="fas fa-comment-dots" class="ps-4 float-right sm-hide xs-hide">ثبت دیدگاه برای این محصول</q-btn>

                        <div class="mt-3 mb-2 lg-hide xl-hide md-hide">
                            <q-btn @click="set_comment = !set_comment" rounded color="success" class="w-100 font-12 pt-2 pb-2" icon="fas fa-comment-dots">ثبت دیدگاه برای این محصول</q-btn>
                        </div>

                        <div class="mt-4">
                            <q-slide-transition>
                                <div v-show="set_comment" class="row justify-center mb-5">
                                <div class="col-md-7">
                                    <div class="card shadow">
                                        <div class="card-body pt-4">
                                            <strong>
                                                تجربه خودتان را درمورد خرید و استفاده از این محصول با ما و کاربران کوکوکافی به اشتراک بگذارید
                                            </strong>
                                            <div class="mt-5">
                                               <textarea rows="7" class="form-control pt-2" placeholder="دیدگاه خود را وارد کنید ..."></textarea>
                                            </div>
                                        </div>
                                        <div class="card-footer text-right">
                                            <q-btn icon-right="fas fa-check" color="success" outline class="pe-4">ثبت دیدگاه</q-btn>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </q-slide-transition>
                             <template v-if="product.comments_count > 0">
                                 <ul class="review-list">
                                     <li v-for="comment in product.comments" class="review-item p-2">
                                         <div class="review-media">
                                             <a class="review-avatar" href="#">
                                                 <img src="/front/images/user.png" alt="review">
                                             </a>
                                             <h5 class="review-meta">
                                                 <strong class="font-14">{{comment.user.name}}</strong>
                                                 <span class="font-12">
                                                     {{this.$filters.date(comment.created_at)}}
                                                 </span>
                                             </h5>
                                         </div>
                                         <ul class="review-rating">
<!--                                             <li class="icofont-ui-rating"></li>-->
<!--                                             <li class="icofont-ui-rating"></li>-->
<!--                                             <li class="icofont-ui-rating"></li>-->
<!--                                             <li class="icofont-ui-rating"></li>-->
<!--                                             <li class="icofont-ui-rate-blank"></li>-->
                                         </ul>
                                         <p class="review-desc text-justify">
                                             {{comment.comment}}
                                         </p>
                                     </li>

                                     <li v-if="product.comments_count > product.comments.length" class="pb-4 text-center">
                                         <strong @click="GetProductComments" v-if="!loading_comment" class="text-success pointer">مشاهده {{product.comments_count - 3}} دیدگاه دیگر </strong>
                                         <i v-else class="fas fa-spinner fa-3x fa-spin text-blue"></i>
                                     </li>
                                 </ul>
                             </template>
                            <template v-else>
                                <div class="text-center mt-5 mb-4">
                                    <span class="text-red-5">
                                        هنوز هیچ دیدگاهی برای این محصول ثبت نشده است
                                    </span>
                                    <br>
                                    <br>
                                    <strong class="text-success">
                                        اولین دیدگاه را شما ثبت کنید !
                                    </strong>

                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="section mt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        محصولات مرتبط
                    </div>
                </div>
            </div>
            <div class="row justify-center">
                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 p-1" v-for="i in 6">
                    <product_single_one></product_single_one>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
.section-heading{
    font-size: 28px;
    font-weight: 600;
}
.for-main-slider{
    height: 600px;
}
.details-name{
    font-size: 16px;
    font-weight: 500;
}
.details-rating > i{
    font-size: 14px;
}
.rate-review{
    font-size: 12px;
}
.price{
    font-size: 22px;
}
.price-old{
    font-size: 20px;
}
.curency{
    font-size: 14px;
}
.details-content{
    padding-top: 18px;
}
.review-avatar img {
    width: 56px;
}
.pointer{
    cursor: pointer;
}
textarea{
    height: 150px;
}

.favorite-icon{
    font-size: 32px;
}
.rate_title{
    font-size: 17px;
}
@media only screen and (max-width: 600px) {

    .section-heading{
        font-size: 22px;
        font-weight: 600;
    }
    .for-link-all{
        font-size: 13px;
    }
    .details-name{
        font-size: 15px;
        font-weight: 500;
    }
    .details-rating > i{
        font-size: 11px;
    }

    .rate-review{
        font-size: 10px;
    }
    .price{
        font-size: 18px;
    }
    .price-old{
        font-size: 17px;
    }
    .curency{
        font-size: 12px;
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
    .review-desc{
        font-size: 13px;
    }
    .pointer{
        cursor: pointer;
    }
    textarea{
        height: 150px;
    }

    .category{
        font-size: 12.5px;
    }
    .info-title{
        font-size: 14px!important;
        font-weight: 450;
    }
    .details-desc{
        font-size: 13px;
    }
    .favorite-icon{
        font-size: 28px;
        float: right!important;
        margin-right: -8px!important;
        margin-top: 5px;
    }
    .no-padding-mobile{
        padding: 5px 0;
    }
    .inner-section{
        margin-bottom: 10px;
    }
    .rate_title{
        font-size: 15px;
    }
}


</style>
<script>
import {defineComponent} from 'vue'
import {mapActions} from 'vuex'
import product_single_one from "./Front_Product_Single_One.vue";
import Front_Skeleton_Product_Page from "../skeletons/Front_Skeleton_Product_Page.vue";

export default defineComponent({
    name: "Front_Product_Page",
    components: {
        product_single_one,
        'skeleton_product' : Front_Skeleton_Product_Page,
    },
    mounted() {
        this.GetProduct();
    },
    data(){
        return {
            slide : 1,
            set_comment:false,
            set_rate:false,
            product:null,
            loading:true,
            loading_comment:false,

        }
    },
    methods : {
        ...mapActions([
            'ProductsFrontShow',
            "ProductsFrontComments"
        ]),
        GetProduct(){
            let item = {
                code : this.$route.params.code,
                name : this.$route.params.name
            }
            this.ProductsFrontShow(item).then(res => {
                this.product = res.data.result;
                this.loading = false;
            }).catch(error => {
                return this.NotifyServerError();

            })
        },
        GetProductComments(){
            this.loading_comment=true;
            this.ProductsFrontComments(this.$route.params.code).then(res => {
                this.product.comments = res.data.result;
                this.loading_comment=false
            }).catch(error => {
                return this.NotifyServerError();
            })
        }

    }
})
</script>
