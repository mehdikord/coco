
<template>
    {{selected}}
    <h6 class="shop-widget-title font-15">براساس دسته ‌بندی</h6>
    <input class="shop-widget-search" type="text" placeholder="دسته بندی ...">
    <global_loading_infinite v-if="loading" />
    <ul v-else class="shop-widget-list shop-widget-scroll">
        <li v-for="item in items">
            <div class="shop-widget-content">
                <input @change="DoFilter" v-model="selected" type="checkbox" :value="item.id">
                <label >
                    {{item.name}}
                </label>
            </div>
        </li>
    </ul>

<!--        <button class="shop-widget-btn sm-hide xs-hide">-->
<!--            <i class="far fa-trash-alt"></i><span>حذف فیلتر</span>-->
<!--        </button>-->
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
    name: "Front_Shop_Filter_Category",
    mounted() {
        this.GetItems();
    },
    data(){
        return{
            loading:true,
            items:[],
            selected:[]
        }
    },
    methods:{
        ...mapActions([
            "CategoriesFrontIndex"
        ]),
        GetItems(){
            this.CategoriesFrontIndex().then(res =>{
                this.loading=false;
                this.items = res.data.result;
            }).catch(error => {
                return this.NotifyServerError()
            })
        },
        DoFilter(){
            this.$emit('Filter',this.selected)
        }
    }
})
</script>
