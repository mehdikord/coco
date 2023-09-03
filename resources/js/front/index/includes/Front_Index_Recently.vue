<template>

    <section class="section recent-part">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        پرطرفدار های کوکو
                    </div>
                </div>
            </div>
            <div class="row justify-center">
                <div v-if="loading" class="col-lg-2 col-md-3 col-sm-4 col-xs-6 p-1" v-for="i in 6">
                    <skeleton_product></skeleton_product>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-btn-25">
                        <a href="" class="btn btn-outline for-link-all">
                            <i class="fas fa-eye"></i><span>مشاهده همه محصولات</span>
                        </a>
                    </div>
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
    .for-link-all{
        font-size: 13px;
    }
}

</style>
<script>
import {defineComponent} from 'vue'
import {mapActions} from "vuex";
import Front_Product_Single_One from "../../products/Front_Product_Single_One.vue";
import Front_Skeleton_Product_Single_One from "../../skeletons/Front_Skeleton_Product_Single_One.vue";

export default defineComponent({
    name: "Front_Index_Recently",
    components : {
        'product_single_one' : Front_Product_Single_One,
        'skeleton_product':Front_Skeleton_Product_Single_One,
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



        }


    }
})
</script>

