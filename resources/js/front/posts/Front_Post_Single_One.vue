<script>
import {defineComponent} from 'vue'

export default defineComponent({
    name: "Front_Post_Single_One"
})
</script>

<template>

    <div class="blog-card">
        <div class="blog-media">
            <a class="blog-img" href="#">
                <img src="/front/images/blog/01.jpg" alt="blog">
            </a>
        </div>
        <div class="blog-content">
            <ul class="blog-meta">
                <li><i class="fas fa-user"></i><span class="own-text">مدیر</span></li>
                <li><i class="fas fa-calendar-alt"></i><span class="own-text">جمعه 5 بهمن</span></li>
            </ul>
            <h4 class="blog-title">
                <a href="">
                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ
                </a>
            </h4>
            <p class="blog-desc">
                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است
            </p>
            <a class="blog-btn" href="#">
                <span class="show-text">مشاهده مطلب</span>
                <i class="icofont-arrow-left"></i>
            </a>
        </div>
    </div>

</template>

<style scoped>
.blog-title{
    font-size: 16px;
}
.blog-desc{
    font-size: 14px;
}
.own-text{
    font-size: 13px;
}
@media only screen and (max-width: 600px) {
    .blog-title{
        font-size: 14px;
    }
    .blog-desc{
        font-size: 12px;
    }
    .own-text{
        font-size: 12px;
    }
    .show-text{
        font-size: 15px;
    }
}

</style>
