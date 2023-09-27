<template>

    <nav class="navbar-part">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="navbar-content">
                        <ul class="navbar-list">
                            <li class="navbar-item"><router-link :to="{name:'index'}" class="navbar-link" :class="{'text-green-7' : this.$route.name === 'index'}">صفحه اصلی</router-link></li>
                            <li class="navbar-item"><router-link :to="{name:'shop'}" class="navbar-link" :class="{'text-green-7' : this.$route.name === 'shop'}">فروشگاه کوکو</router-link></li>
                        </ul>
                        <div class="navbar-info-group">
                            <div class="navbar-info" dir="ltr"><i class="icofont-ui-touch-phone"></i>
                                <p><small class="text-danger">تماس باما</small><span>0911 792 6950</span></p>
                            </div>
                            <div class="navbar-info"><i class="icofont-ui-email"></i>
                                <p><small class="text-danger">ایمیل</small><span>support@cococoffee.ir</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>

<style scoped>

</style>
<script>
import {defineComponent} from 'vue'

export default defineComponent({
    name: "Front_Template_Header_Top"
})
</script>

