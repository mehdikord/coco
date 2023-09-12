
<template>
    <section class="section niche-part">
        <div class="container">
            <div class="row m-0">
                <div class="col-lg-12">
                    <div class="section-heading text-green-8">
                        محصولات جدید کوکو رو از دست نده
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row justify-center">
                <div v-for="item in items" class="col-lg-2 col-md-3 col-sm-4 col-xs-6 p-1">
                    <product_single_one :product="item"></product_single_one>
                </div>
            </div>
        </div>

    </section>
</template>

<style scoped>
.cat-box{
    font-size: 13px;
    padding: 8px 18px;
}
.tab-link-title{
    font-size: 15px;
}
.section-heading{
    font-size: 28px;
    font-weight: 600;
}
@media only screen and (max-width: 600px) {
    .section-heading{
        font-size: 22px;
        font-weight: 600;
    }
    .for-link-all{
        font-size: 13px;
    }
    .tab-link-title{
        font-size: 12px;
    }
}
</style>
<script>
import {defineComponent} from 'vue'
import Front_Product_Single_One from "../../products/Front_Product_Single_One.vue";
import {mapActions} from "vuex";

export default defineComponent({
    name: "Front_Index_New",
    components : {
        'product_single_one' : Front_Product_Single_One
    },
    mounted() {
        this.GetItems();
    },
    data(){
        return{
            items:[],
            loading:true,
        }
    },
    methods :{
        ...mapActions([
            "ProductsFront",
        ]),
        GetItems(){
            let params = {
                per_page:12,
                sort_by:'id',
                sort_type:'DESC',
            }
            this.ProductsFront(params).then(res => {
                this.loading=false;
                this.items = res.data.result.data;
            }).catch(error => {
                this.loading=false;
                this.NotifyServerError();

            })

        }
    }
})
</script>
