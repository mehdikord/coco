<script>
import {mapActions} from "vuex";

export default {
    name: "Front_Auth",
    mounted() {
        if (localStorage.getItem('coco_login_phone')){
            this.login_form=false;
            this.countDownTimer();
        }
    },
    data(){
        return {
            login_form :true,
            login_loading :false,
            errors:[],
            countDown:120,
            login:{
                phone:null,
            },
            code:null
        }

    },
    methods : {
        ...mapActions([
            'Auth_User_Login'
        ]),
        Login(){

            if (!this.login.phone){
                return this.NotifyError("شماره موبایل خود را وارد کنید")
            }
            this.login_loading=true;
            this.login.phone = this.$filters.persianDigitsToEnglish(this.login.phone)
            this.login.referral = this.$filters.persianDigitsToEnglish(this.login.referral)
            axios.post('users/auth',this.login).then(res => {
                localStorage.setItem('coco_login_phone',res.data.result.phone)
                this.login_loading=false;
                this.login_form=false;
                this.countDownTimer();
                return this.NotifySuccess(res.data.message);
            }).catch(error => {
                this.login_loading = false;
                if (error.response.status === 422) {
                    this.errors = error.response.data
                }

            })

        },
        countDownTimer () {
            if (this.countDown > 0) {
                setTimeout(() => {
                    this.countDown -= 1
                    this.countDownTimer()
                }, 1000)
            }
        },
        ChangNumber(){
            localStorage.removeItem('coco_login_phone');
            this.login_form=true;
        },
        ReSendCode(){
            if (localStorage.getItem('coco_login_phone')){
                this.login_loading = true;
                let data = {phone : localStorage.getItem('coco_login_phone')};
                axios.post('users/auth',data).then(res => {
                    this.countDown=120;
                    this.countDownTimer();
                    this.login_loading = false;
                    return this.NotifySuccess(res.data.message);
                }).catch(error => {
                    this.login_loading = false;
                    if (error.response.status === 422) {
                        return this.errors = error.response.data
                    }
                    return this.NotifyServerError();


                })
            }
        },
        SendCode(){
            if (!this.code){
                return this.NotifyError("کد را وارد کنید")
            }
            if (!localStorage.getItem('coco_login_phone')){
                this.login_form=true;
                return this.NotifyError('شماره موبایل یافت نشد ، دوباره وارد شوید')
            }
            let data = {phone:localStorage.getItem('coco_login_phone'),code:this.code}
            axios.post('users/auth/check',data).then(res => {
                this.Auth_User_Login(res.data.result)
                localStorage.removeItem('coco_login_phone')
                this.NotifySuccess('باموفقیت وارد حساب کاربریتان شدید');
                let back = localStorage.getItem('back_url')
                // if (back){
                //     this.$router.push({name:back})
                // }
                this.$router.push({name:'index'})

            }).catch(error => {
                if (error.response.status === 422) {
                    return this.errors = error.response.data
                }
                if (error.response.status === 409){
                    return this.NotifyError(error.response.data.error)
                }
                return this.NotifyServerError();

            })



        }
    },
}
</script>

<template>
 <div class="container mt-5">
     <div class="row justify-center">
         <div class="col-md-6 col-sm-10 col-xs-12">
             <div class="card">
                 <div class="card-header p-3">
                     <strong class="text-success font-16">
                         ثبت نام / ورود به حساب کاربری
                     </strong>
                 </div>
                 <q-slide-transition>
                    <div v-if="login_form" class="card-body">
                     <div class="text-dark">
                         برای ثبت نام یا ورود به حساب کاربری خود در کوکو کافیست شماره موبایل خود را وارد کنید
                     </div>
                     <div class="mt-5">
                         <img src="/front/images/mobile-phone.png" width="50" alt="">
                         <strong for="">شماره موبایل خود را وارد کنید</strong>
                         <input v-model="login.phone" class="form-control mt-2" placeholder="09XX XXX XXXX" dir="ltr" type="text">
                         <q-btn @keyup.enter="Login" @click="Login" :loading="login_loading" glossy color="success" class="mt-3 float-right mb-3"> ثبت شماره موبایل</q-btn>
                     </div>
                    </div>
                    <div v-else class="card-body">
                     <div class="text-dark">
                         برای تکمیل احراز هویت کد پیامک شده به شماره موبایل خود را وارد کنید
                     </div>
                     <div class="mt-5">
                         <img src="/front/images/mobile-sms.png" width="50" alt="">
                         <strong class="me-2" for="">کد ارسال شده را کنید</strong>
                         <input v-model="code" class="form-control mt-2" placeholder="X X X X X X" dir="ltr" type="number">
                         <q-btn class="mt-2" flat color="red" :disable="countDown > 0" :loading="login_loading" @click="ReSendCode"><template v-if="countDown>0">{{countDown}} -</template> ارسال مجدد کد تایید </q-btn>

                         <q-btn @keyup.enter="SendCode" @click="SendCode" glossy color="success" class="mt-3 float-right mb-3"> ارسال کد و ورود به حساب</q-btn>
                         <div class="text-center mt-5">
                             <strong @click="ChangNumber" class="text-blue-7 pointer">تغییر شماره موبایل </strong>
                         </div>
                     </div>
                 </div>
                 </q-slide-transition>

             </div>


         </div>
     </div>
 </div>
</template>

<style scoped>

</style>
