
<template>
    <div>
        <strong class="font-16">مرتب سازی : </strong>
        <div class="row mt-1">
            <div class="col" @click="active='new' ; $emit('SortingFilter',{sort_by:'id',sort_type: 'desc'})">
                <q-chip class="font-13 bg-grey-4 pointer" size="md" :class="{'chip-active' : active === 'new'}">جدید‌‌ترین</q-chip>
            </div>
            <div class="col" @click="active='max_price' ;$emit('SortingFilter',{sort_by:'price',sort_type: 'desc'})">
                <q-chip class="font-13 bg-grey-4 pointer" size="md" :class="{'chip-active' : active === 'max_price'}">گران‌ترین</q-chip>
            </div>
            <div class="col" @click="active='min_price' ;$emit('SortingFilter',{sort_by:'price',sort_type: 'asc'})">
                <q-chip class="font-13 bg-grey-4 pointer" size="md" :class="{'chip-active' : active === 'min_price'}">ارزان‌ترین</q-chip>
            </div>
            <div class="col" @click="active='orders';$emit('SortingFilter',{sort_by:'orders_count',sort_type: 'desc'})">
                <q-chip class="font-13 bg-grey-4 pointer" size="md" :class="{'chip-active' : active === 'orders'}">پرفروش‌ترین</q-chip>
            </div>
            <div class="col" @click="active='rating' ;$emit('SortingFilter',{sort_by:'rate',sort_type: 'desc'})">
                <q-chip class="font-13 bg-grey-4 pointer" size="md" :class="{'chip-active' : active === 'rating'}">محبوب ترین</q-chip>
            </div>
        </div>
        <hr class="w-100">
    </div>
</template>

<style scoped>

.pointer{
    cursor: pointer;
}
.chip-active{
    background-color: #23B122!important;
    color: white;
    font-size: 14px!important;
}
</style>
<script>
import {defineComponent} from 'vue'

export default defineComponent({
    name: "Front_Shop_Filter_Top",
    data(){
        return {
            active:'new'
        }
    }

})
</script>
