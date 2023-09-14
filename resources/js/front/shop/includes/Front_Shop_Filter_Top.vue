
<template>
    <div>
        <strong class="font-16">مرتب سازی : </strong>
        <div class="row mt-1">
            <div class="col" @click="$emit('SortingFilter',{sort_by:'id',sort_type: 'desc'})">
                <q-chip class="font-13 bg-grey-4 pointer" size="md" :class="{'chip-active' : active === 'new'}">جدید‌‌ترین</q-chip>
            </div>
            <div class="col" @click="$emit('SortingFilter',{sort_by:'price',sort_type: 'desc'})">
                <q-chip class="font-14 bg-grey-4 pointer" size="md">گران‌ترین</q-chip>
            </div>
            <div class="col" @click="$emit('SortingFilter',{sort_by:'price',sort_type: 'asc'})">
                <q-chip class="font-13 bg-grey-4 pointer" size="md">ارزان‌ترین</q-chip>
            </div>
            <div class="col">
                <q-chip class="font-13 bg-grey-4 pointer" size="md">پرفروش‌ترین</q-chip>
            </div>
            <div class="col">
                <q-chip class="font-13 bg-grey-4 pointer" size="md">پرفروش‌ترین</q-chip>
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
