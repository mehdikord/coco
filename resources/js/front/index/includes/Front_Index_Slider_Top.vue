<template>
    <section class="q-mt-lg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-3">
                    <div class="">
                        <q-carousel
                            v-show="items.length"
                            class="for-slider rounded"
                            arrows
                            animated
                            v-model="slide"

                        >
                            <q-carousel-slide
                                v-for="item in items"
                                :name="item.id"
                                :img-src="item.image"
                            >
                            </q-carousel-slide>

                        </q-carousel>
                    </div>

                </div>
                <div class="col-lg-4">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                            <div class="home-grid-promo"><a href="#"><img src="/front/images/promo/home/01.jpg" alt="promo"></a></div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                            <div class="home-grid-promo"><a href="#"><img src="/front/images/promo/home/02.jpg" alt="promo"></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</template>

<style scoped>
.for-slider{
    height: 446px;
}
.custom-caption{
    text-align: center;
    padding: 12px;
    color: white;
    background-color: rgba(0, 0, 0, .3);
}
@media only screen and (max-width: 900px) {
    .for-slider{
        height: 300px;
    }
}
@media only screen and (max-width: 800px) {
    .for-slider{
        height: 250px;
    }
}
@media only screen and (max-width: 700px) {
    .for-slider{
        height: 220px;
    }
}


</style>
<script>
import {defineComponent} from 'vue'
import {mapActions} from "vuex";

export default defineComponent({
    name: "Front_Index_Slider_Top",
    mounted() {

      this.GetItems();

    },

    data(){
        return{
            items:[],
            slide:null,
            autoplay:true
        }
    },

    methods:{
        ...mapActions([
            'SliderIndex',
        ]),
        GetItems(){
            this.SliderIndex().then(res =>{
                this.items = res.data.result;
                if (this.items.length){
                    this.slide =this.items[0].id
                }
            }).catch(error =>{
                return this.NotifyServerError();
            })
        }
    }
})
</script>

