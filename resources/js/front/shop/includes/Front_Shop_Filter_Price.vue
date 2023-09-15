
<template>
    <h6 class="shop-widget-title font-15">تعیین بازه قیمت</h6>
    <div class="shop-widget-group">
        <input v-model="min_price" type="number" placeholder="از مبلغ">
        <input v-model="max_price" type="number" placeholder="تا مبلغ">
    </div>
    <button @click="DoFilter" class="shop-widget-btn sm-hide xs-hide">
        <i class="fas fa-search"></i><span>ثبت قیمت </span>
    </button>

</template>

<style scoped>
@media only screen and (max-width: 600px) {
    .shop-widget-title{
        font-size: 13px!important;
    }
}


</style>
<script>
import {defineComponent} from 'vue'

export default defineComponent({
    name: "Front_Shop_Filter_Price",
    data(){
        return {
            min_price:null,
            max_price:null
        }
    },
    methods:{
        DoFilter(){

            this.$emit('PriceFilter',{min_price : this.min_price , max_price : this.max_price})
        }

    }
})
</script>
