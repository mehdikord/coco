<script>
export default {
    name: "Front_Payment_Result_Success"
}
</script>

<template>
    <div class="mt-5">
        <div class="container text-center">
            <q-img class="image" src="/front/images/payment-success.png"/>
            <div class="text-center mt-2">
                <strong class="text-success text-font">
                    پرداخت شما باموفقیت انجام شد و سفارشات شما ثبت گردید.
                    <br>
                    میتوانید از قسمت سفارشات در پروفایل خود وضعیت سفارش خود را مشاهده کنید
                    <br>
                    <br>
                    با تشکر از خرید شما
                </strong>
                <div class="mt-5">
                    <q-btn :to="{name : 'shop'}" color="indigo" glossy class="back-btn">بازگشت به فروشگاه</q-btn>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.image{
    width: 180px;
}
.text-font{
    font-size: 15px;
}
.back-btn{
    font-size: 15px;
    padding-left: 40px;
    padding-right: 40px;
}
@media only screen and (max-width: 600px) {

    .image{
        width: 150px;
    }
    .text-font{
        font-size: 13px;
    }
    .back-btn{
        font-size: 13px;
        padding-left: 30px;
        padding-right: 30px;
    }

}

</style>
