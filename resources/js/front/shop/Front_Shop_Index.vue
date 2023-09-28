<template>
    <section class="">
        <div class="container">
            <div class="">
                <h1 class="title">لیست محصولات کوکوکافی</h1>
            </div>
            <div class="row content-reverse mt-3 sm-hide xs-hide">

                <div class="col-lg-3">
                    <div class="shop-widget-promo">
                        <a href="#">
                        <img src="/front/images/promo/shop/01.jpg" alt="promo">
                        </a>
                    </div>
                    <div class="shop-widget">
                        <filter_price @PriceFilter="(val) => PricesFilter(val)"></filter_price>
                    </div>
                    <div class="shop-widget">
                        <filter_category @Filter="(val) => CatFilter(val)"></filter_category>
                    </div>

                    <div class="shop-widget">
                        <filter_brand></filter_brand>
                    </div>
                    <div class="shop-widget">
                        <filter_rating></filter_rating>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="top-filter">
                                <filter_top @SortingFilter="(val) => UpdateFilter(val)"></filter_top>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div v-if="loading" v-for="i in 16" class="col-xl-3 col-lg-3 col-md-4 p-1">
                            <skeleton_product_one></skeleton_product_one>
                        </div>

                        <div v-else v-for="item in items" class="col-xl-3 col-lg-3 col-md-4 p-1">
                            <product_single_one :product="item"></product_single_one>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div v-if="links.length" class="bottom-paginate">

                                <ul class="pagination">
                                    <li class="page-item">
                                        <router-link to="" class="page-link disabled" >
                                            <i class="fas fa-long-arrow-alt-right"></i>
                                        </router-link>
                                    </li>

                                    <li v-for="link in links" class="page-item" >
                                        <a @click="UpdateQueryPage('page',link.label)" class="page-link" :class="{'active' : link.active}" href="#">{{link.label}}</a>
                                    </li>


                                    <li class="page-item">
                                        <router-link to="" class="page-link" href="#">
                                            <i class="fas fa-long-arrow-alt-left"></i>
                                        </router-link>
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row xl-hide lg-hide md-hide">
                <div class="col-12">
                    <q-btn @click="filter_dialog = true" color="blue-grey-9" icon="fas fa-list" class="font-13" flat>فیلتر ها</q-btn>
                    <q-dialog persistent v-model="filter_dialog">
                        <q-card>
                            <q-card-section >
                                <h6 class="font-16 ">فیلتر ها</h6>
                            </q-card-section>
                            <q-separator />

                            <q-card-section style="max-height: 65vh" class="scroll">
                                <filter_price></filter_price>
                                <q-separator />
                                <filter_category @Filter="(val) => CatFilter(val)"></filter_category>
                                <q-separator />
                                <filter_brand></filter_brand>
                                <q-separator/>
                                <filter_rating></filter_rating>
                            </q-card-section>
                            <q-separator />
                            <q-card-section class="text-center">
                                <q-btn flat color="dark" size="sm" @click="filter_dialog=false"  class="font-12" icon-right="fas fa-times">بستن</q-btn>

                            </q-card-section>
                        </q-card>
                    </q-dialog>
                    <q-btn @click="sort_dialog = true" color="blue-grey-9" icon="fas fa-sort" class="font-13" flat> پرفروش ترین</q-btn>
                    <q-dialog v-model="sort_dialog" full-width>
                        <q-card>
                            <q-card-section>
                                <h6 class="font-16">مشاهده بر اساس </h6>
                            </q-card-section>
                            <q-separator />

                            <q-card-section >
                                <select class="form-control">
                                    <option>مرتبط ترین</option>
                                    <option>جدید ترین</option>
                                    <option>پرفروش ترین</option>
                                    <option>پربازدید ترین</option>
                                    <option>گران ترین</option>
                                    <option>ارزان ترین</option>
                                </select>
                            </q-card-section>
                        </q-card>
                    </q-dialog>

                    <hr>

                </div>
                <div v-for="item in items" class="col-12">
                    <product_single_two :product="item"></product_single_two>
                </div>

            </div>



        </div>
    </section>
</template>

<style scoped>
.title{
    font-size: 18px;
    font-weight: 500;
}
@media only screen and (max-width: 600px) {
    .title{
        font-size: 15px;
        font-weight: 500;
    }
}
</style>
<script>
import {defineComponent} from 'vue'
import {mapActions} from "vuex";
import Front_Shop_Filter_Price from "./includes/Front_Shop_Filter_Price.vue";
import Front_Shop_Filter_Category from "./includes/Front_Shop_Filter_Category.vue";
import Front_Shop_Filter_Brand from "./includes/Front_Shop_Filter_Brand.vue";
import Front_Shop_Filter_Rating from "./includes/Front_Shop_Filter_Rating.vue";
import Front_Shop_Filter_Top from "./includes/Front_Shop_Filter_Top.vue";
import Front_Product_Single_One from "../products/Front_Product_Single_One.vue";
import Front_Product_Single_Two from "../products/Front_Product_Single_Two.vue";
import Front_Skeleton_Product_Single_One from "../skeletons/Front_Skeleton_Product_Single_One.vue";


export default defineComponent({
    name: "Front_Shop_Index",
    components:{
        'filter_price' : Front_Shop_Filter_Price,
        'filter_category' : Front_Shop_Filter_Category,
        'filter_brand' : Front_Shop_Filter_Brand,
        'filter_rating' : Front_Shop_Filter_Rating,
        'filter_top' : Front_Shop_Filter_Top,
        'product_single_one' : Front_Product_Single_One,
        'product_single_two' : Front_Product_Single_Two,
        'skeleton_product_one':Front_Skeleton_Product_Single_One,
    },
    mounted() {
      this.GetItems();
    },

    data(){
        return{
            filter_dialog : false,
            sort_dialog : false,
            options: [
                'Google', 'Facebook', 'Twitter', 'Apple', 'Oracle'
            ],
            loading:true,
            params:[],
            links:[],
            items:[],
            filters:false,
        }
    },
    watch: {
        $route(to, from) {
            // Check if the query parameters have changed
            if (to.query !== from.query) {
                // Call your function here
                this.loading=true;
                this.GetItems();
            }
        },
    },
    methods:{
        ...mapActions([
            "ProductsFront"
        ]),
        GetItems(){
            let params = this.$route.query;
            this.ProductsFront(params).then(res => {
                this.items = res.data.result.data;
                this.links=[];
                this.links = res.data.result.links;
                this.links.shift();
                this.links.pop();
                this.loading=false;
            }).catch(error => {
                return this.NotifyServerError();
            })

        },
        UpdateQueryPage(key,val){
            this.params[key] = val;
            this.$router.push({name : 'shop' , query : this.params})
        },
        UpdateFilter(filter){
            this.params['sort_by'] = filter.sort_by;
            this.params['sort_type'] = filter.sort_type;
            this.$router.push({name : 'shop' , query : this.params})

        },
        PricesFilter(val){
            this.params['min_price'] = val.min_price;
            this.params['max_price'] = val.max_price;
            this.$router.push({name : 'shop' , query : this.params})
        },
        CatFilter(val){
            this.params['category'] = JSON.stringify(val);
            this.$router.push({name : 'shop' , query : this.params})

            console.log(val)
        },
        RemoveFilters(){
            let page = this.params.page
            this.params=[];
            if (page){
                this.params['page'] = page;
            }
            this.$router.push({name : 'shop' , query : this.params})

        }


    },
})
</script>

