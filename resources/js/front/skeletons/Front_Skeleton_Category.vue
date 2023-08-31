<script>
export default {
    name: "Front_Skeleton_Category"
}
</script>

<template>
    <a class="suggest-card" href="">
        <img src="https://fooda.ir/wp-content/uploads/2015/02/chocolat.png" alt="suggest">
        <h5 class="cat-title">{{ item.name }}  </h5>
    </a>
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
