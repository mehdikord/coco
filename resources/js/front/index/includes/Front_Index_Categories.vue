<template>
    <section class="section q-mt-md">
        <div class="container">
            <div class="row justify-center">
                <div v-for="item in items" class="col-lg-2 col-md-2 col-sm-3 col-xs-4 p-1">
                    <a class="suggest-card" href="">
                        <img src="https://fooda.ir/wp-content/uploads/2015/02/chocolat.png" alt="suggest">
                        <h5 class="cat-title">{{ item.name }}  </h5>
                    </a>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
.suggest-card::before{
    background: rgba(0,0,0,0.62);
}
.cat-title{
    font-size: 16px;
}
@media only screen and (max-width: 600px) {
    .cat-title{
        font-size: 13px;
    }
}
</style>
<script>
import {defineComponent} from 'vue'
import {mapActions} from "vuex";

export default defineComponent({
    name: "Front_Index_Categories",
    mounted() {
        this.GetItems();
    },
    data(){
        return {
            items:[],
        }
    },
    methods:{
        ...mapActions([
            "CategoriesIndex"
        ]),
        GetItems(){
            this.CategoriesIndex().then(res => {
                this.items = res.data.result;
            }).catch(error =>{
                return this.NotifyServerError();
            })
        }
    }

})
</script>
