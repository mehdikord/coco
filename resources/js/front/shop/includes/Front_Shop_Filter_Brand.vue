
<template>
    <h6 class="shop-widget-title font-15">براساس برند </h6>
    <form>
        <input class="shop-widget-search" type="text" placeholder="برند محصولات ...">
        <global_loading_infinite v-if="loading" />

        <ul v-else class="shop-widget-list shop-widget-scroll">
            <li v-for="item in items">
                <div class="shop-widget-content">
                    <input type="checkbox" id="brand1">
                    <label for="brand1">{{ item.name }}</label>
                </div>

            </li>

        </ul>


    </form>
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
import {mapActions} from "vuex";

export default defineComponent({
    name: "Front_Shop_Filter_Brand",
    mounted() {
        this.GetItems();
    },
    data(){
        return{
            loading:true,
            items:[],
        }
    },
    methods:{
        ...mapActions([
            "BrandsFront"
        ]),
        GetItems(){
            let params = {
                per_page : 1000
            }
            this.BrandsFront(params).then(res =>{
                this.loading=false;
                this.items = res.data.result.data;
            }).catch(error => {
                return this.NotifyServerError()
            })
        }

    }
})
</script>
