
<template>
    <div class="mobile-menu">
        <a href="compare.html" title="Compare List" class="pt-3">
            <i class="fas fa-user font-20"></i><span>پروفایل</span>
        </a>
        <a href="wishlist.html" title="Wishlist" class="pt-3">
            <i class="fas fa-heart font-20"></i><span>برگزیده</span><sup>0</sup>
        </a>
        <router-link :to="{name : 'index'}" title="صفحه اصلی" class="pt-3" :class="{'bg-grey-3' : this.$route.name === 'index'}">
            <i class="fas fa-home font-20 " :class="{'text-success' : this.$route.name === 'index'}"></i><span :class="{'text-success' : this.$route.name === 'index'}">کوکوکافی</span>
        </router-link>
        <router-link :to="{name : 'shop'}" class="cate-btn pt-3" title="محصولات فروشگاه" :class="{'bg-grey-3' : this.$route.name === 'shop'}">
            <i class="fas fa-shopping-cart font-20" :class="{'text-success' : this.$route.name === 'shop'}"></i><span :class="{'text-success' : this.$route.name === 'shop'}">محصولات</span>
        </router-link>
        <button class="cart-btn pt-3" title="سبد خرید شما">
            <i class="fas fa-shopping-basket font-20"></i><span>سبد‌خرید</span><sup>{{this.CartItemCount}}</sup>
        </button>
    </div>
</template>

<style scoped>

</style>
<script>
import {defineComponent} from 'vue'

export default defineComponent({
    name: "Front_Template_Footer_Mobile"
})
</script>
