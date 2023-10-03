<script>


import Front_Cart_Single_Two from "../cart/Front_Cart_Single_Two.vue";
import {mapGetters} from "vuex";

export default {
    name: "Front_Shop_Checkout",
    components: {
        'cart_single_two' : Front_Cart_Single_Two,

    },
    mounted() {
      if (!this.AuthUserCheck){
          localStorage.setItem('back_url','checkout');
      }else {
          localStorage.removeItem('back_url');
      }
      this.GetProvinces();
    },
    data(){
        return{
            DialogAddAddress : false,
            provinces:[],
            provinces_select:[],
            cities_select:[],
            add_address:{
                province_id:null,
                city_id:null,
                title:null,
                postal_code:null,
                address:null,
            }
        }
    },
    methods : {
        GetProvinces(){
            axios.get('/helper/provinces').then(res =>{
                this.provinces = res.data.result;
                this.provinces.forEach(province => {
                    this.provinces_select.push({label : province.name , value : province.id})
                })
            })
        },

    },

    computed : {
        ...mapGetters([
            "AuthUserCheck",
            "AuthUserUser"
        ]),
        GetCities(){
            if (this.add_address.province_id){
                let cities;
                this.provinces.forEach(province =>{
                    if (province.id === this.add_address.province_id){
                        cities = province.cities;
                    }
                })
                this.cities_select=[];
                cities.forEach(city => {
                    this.cities_select.push({label : city.name , value : city.id})
                })
            }
        }

    }
}
</script>

<template>
    <section class="inner-section checkout-part">
        <div class="container">
            <div class="mt-4 mb-3">
                <q-icon name="fas fa-check-circle font-20" color="positive" class="ms-2"/>
                <strong class="title text-green-8">ثبت نهایی سفارشات</strong>
                <q-icon name="fas fa-long-arrow-alt-left font-20" class="me-2 ms-2" color="dark"/>
                <q-icon name="fas fa-truck fa-flip-horizontal font-20"  class="ms-2 text-grey-7" :class="{'shipping_head' : this.$route.name === 'checkout_shipping'}"/>
                <strong class="title text-grey-7" :class="{'shipping_head' : this.$route.name === 'checkout_shipping'}">انتخاب نحوه ارسال</strong>

            </div>
            <template v-if="this.CartTotalProducts > 0">
                <div class="row">
                    <div v-if="!AuthUserCheck" class="col-md-12 q-px-md q-mb-md">
                        <q-banner class="bg-deep-orange rounded text-center text-white">
                            <strong>برای تکمیل و ثبت سفارش شما باید ابتدا وارد حساب کاربری خود شوید، برای ورود یا ثبت نام
                            <router-link :to="{name : 'auth'}" class="text-white">اینجا را کلیک کنید</router-link>
                            </strong>
                        </q-banner>
                    </div>
                    <div class="col-md-9 q-px-xs">
                        <div v-if="this.$route.name === 'checkout_cart'" class="card">
                            <div class="card-body">
                                <div>
                                    <strong class="font-16 text-dark">سبد خرید شما</strong>
                                    <q-btn class="float-start" color="red" flat>خالی کردن سبد خرید</q-btn>
                                </div>
                                <div class="mt-4">
                                    <template v-for="item in this.CartItemGet">
                                        <cart_single_two :product="item"></cart_single_two>
                                        <q-separator color="grey-6" class="mt-3 mb-4"/>
                                    </template>

                                </div>
                            </div>
                        </div>
                        <div v-if="this.$route.name === 'checkout_shipping' && AuthUserCheck" class="card">
                            <div class="card-body">
                                <div>
                                    <strong class="text-indigo">اطلاعات دریافت کننده : </strong>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-4">
                                        <span class="info-title">نام کامل : </span>
                                        <span class="info-value text-dark"> {{AuthUserUser.name}}</span>
                                    </div>
                                    <div class="col-md-4">
                                        <span class="info-title">شماره موبایل : </span>
                                        <span class="info-value text-dark"> {{AuthUserUser.phone}}</span>
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <q-icon name="fas fa-edit font-15" color="blue-8"></q-icon>
                                        <router-link :to="{name:'profile'}" class="me-2 text-dark">ویرایش اطلاعات</router-link>
                                    </div>
                                </div>
                                <q-separator class="mt-4 mb-4" color="grey-5" />
                                <div>
                                    <strong class="text-indigo">انتخاب آدرس ارسال : </strong>
                                    <q-btn @click="DialogAddAddress = true" glossy color="indigo" icon="fas fa-plus" class="float-start font-13">افزودن آدرس</q-btn>
                                    <q-dialog v-model="DialogAddAddress">
                                        <q-card class="dialog-width">
                                            <q-card-section>
                                                <strong class="text-indigo font-15">افزودن آدرس جدید برای ارسال </strong>
                                            </q-card-section>
                                            <q-card-section>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label class="form-label text-teal-8">انتخاب استان</label>
                                                        <select class="form-control" v-model="add_address.province_id" @change="GetCities">
                                                            <option v-for="province in provinces_select" :value="province.value">{{province.label}}</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label text-teal-8">انتخاب شهر</label>
                                                        <select class="form-control" v-model="add_address.city_id" :disabled="!add_address.province_id" >
                                                            <option v-for="city in cities_select" :value="city.value">{{city.label}}</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 mt-3">
                                                        <label class="form-label text-teal-8">عنوان آدرس</label>
                                                        <input class="form-control" type="text" v-model="add_address.title" placeholder="مثال : محل کارم">
                                                    </div>
                                                    <div class="col-md-6 mt-3">
                                                        <label class="form-label text-teal-8"> کد پستی</label>
                                                        <input class="form-control" type="text" v-model="add_address.postal_code" placeholder="کد پستی ده رقمی">
                                                    </div>
                                                    <div class="col-md-12 mt-4">
                                                        <label class="form-label text-teal-8"> آدرس کامل</label>
                                                        <textarea style="height: 100px" class="form-control" rows="7" v-model="add_address.address" placeholder="مثال : بلوار ولیعصر - کوچه عدالت 14 ساختمان ...">
                                                        </textarea>
                                                    </div>

                                                </div>
                                                <div class="mt-4 mb-1 text-right">
                                                    <q-btn v-close-popup color="red" glossy class="font-13">بستن</q-btn>
                                                    <q-btn color="teal" glossy class="font-13 me-2">افزودن آدرس جدید</q-btn>
                                                </div>
                                            </q-card-section>
                                        </q-card>
                                    </q-dialog>

                                </div>
                                <div class="row mt-4">

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-3 q-px-xs">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <span class="font-14 text-grey-8">قیمت کالاها <strong class="text-indigo-5">({{CartTotalProducts}})</strong></span>
                                    <strong class="float-right text-grey-8">{{this.$filters.numbers(this.CartTotalPrice) }}</strong>
                                </div>
                                <q-separator class="mt-3 mb-3" />
                                <div>
                                    <strong class="font-14 text-dark">جمع سبد خرید</strong>
                                    <span class="float-right me-1 text-grey-7">تومان</span>
                                    <strong class="float-right font-16 text-success">{{this.$filters.numbers(this.CartTotalPrice) }}</strong>
                                </div>
                                <q-separator class="mt-3 mb-3" />
                                <div class="text-center">
                                    <div v-if="!AuthUserCheck" class="text-danger mb-2">برای ادامه وارد حساب کاربری خود شوید</div>
                                    <q-btn v-if="this.$route.name === 'checkout_cart'" :to="{name:'checkout_shipping'}" color="green-7" class="w-100 font-16"  glossy :disable="!AuthUserCheck">ثبت سفارشات </q-btn>
                                    <q-btn v-if="this.$route.name === 'checkout_shipping'" color="green-7" class="w-100 font-16"  glossy :disable="!AuthUserCheck">ثبت نهایی و پرداخت </q-btn>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </template>
            <template v-else>
                <div class="text-center mt-5">
                    <img src="/front/images/cart-empty.png" alt="" width="200">
                    <div class="mt-4 font-15">
                        <strong>سبد خرید شما خالی است برای مشاهده محصولات به فروشگاه بروید</strong>
                    </div>
                </div>
            </template>
        </div>
    </section>

</template>

<style scoped>
.dialog-width{
    max-width: 1024px;
    width: 900px;
}
.title{
    font-size: 17px;
    font-weight: 600;
}
.shipping_head{
    color: #cf1b27!important;
}
.info-title{
    font-size: 13px;
    font-weight: 500;
}
.info-value{
    font-size: 14px;
    font-weight: 600;
}
@media only screen and (max-width: 600px) {
    .title{
        font-size: 15px;
        font-weight: 600;
    }
}
</style>
