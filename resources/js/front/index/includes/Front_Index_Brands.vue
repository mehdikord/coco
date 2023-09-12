
<template>
    <section class="section brand-part">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading">
                        برند های محبوب در کوکو
                    </div>
                </div>
            </div>
            <div class="row justify-center mt-2 mb-2">
                <div v-if="loading" v-for="i in 6" class="col-lg-2 col-md-2 col-sm-3 col-xs-4 mt-2 p-1">
                    <brand_skeleton></brand_skeleton>
                </div>
                <div v-else v-for="item in items" class="col-lg-2 col-md-2 col-sm-3 col-xs-4 mt-2 p-1">
                    <brands_one :brand=item></brands_one>
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
@media only screen and (max-width: 600px) {
    .section-heading{
        font-size: 22px;
        font-weight: 600;
    }

}
</style>
<script>
import {defineComponent} from 'vue'
import Front_Brand_One from "../../brands/Front_Brand_One.vue";
import {mapActions} from "vuex";
import Front_Skeleton_Brand from "../../skeletons/Front_Skeleton_Brand.vue";

export default defineComponent({
    name: "Front_Index_Brands",
    components:{
        'brands_one' : Front_Brand_One,
        'brand_skeleton' : Front_Skeleton_Brand,
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
            "BrandsFront",
        ]),
        GetItems(){
            let params = {
                per_page:6,
                sort_by:'products_count',
                sort_type:'DESC',
            }
            this.BrandsFront(params).then(res => {
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
