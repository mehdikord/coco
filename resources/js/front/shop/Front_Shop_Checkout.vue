<script>


import Front_Cart_Single_Two from "../cart/Front_Cart_Single_Two.vue";
import {mapActions, mapGetters} from "vuex";

export default {
    name: "Front_Shop_Checkout",
    components: {
        'cart_single_two' : Front_Cart_Single_Two,

    },
    watch :{
        $route(to , from){
            if (to.name !== from.name){
                if (this.AuthUserCheck){
                    this.GetAddresses();
                }
                this.GetShipping();
            }
        }
    },
    mounted() {
      if (!this.AuthUserCheck){
          localStorage.setItem('back_url','checkout');
      }else {
          this.GetAddresses();
          localStorage.removeItem('back_url');
      }
      this.GetProvinces();
      this.GetShipping();
    },
    data(){
        return{
            DialogAddAddress : false,
            addresses:[],
            shipping:[],
            address_selected:null,
            shipping_selected:null,
            addresses_loading:true,
            addresses_add_loading:false,
            provinces:[],
            provinces_select:[],
            cities_select:[],
            add_address:{
                province_id:null,
                city_id:null,
                title:null,
                postal_code:null,
                address:null,
            },
            errors:[],
            shopping_loading:false,

        }
    },
    methods : {
        ...mapActions([
            "UserAddressIndex",
            "UserAddressStore",
            "ShoppingUserStart"
        ]),
        GetAddresses(){
            this.UserAddressIndex().then(res => {
                this.addresses = res.data.result;
                if (res.data.result.length){
                    this.address_selected = res.data.result[0];
                }
                this.addresses_loading=false;
            }).catch(error => {
                return this.NotifyServerError();
            })

        },
        AddAddress(){
            this.addresses_add_loading=true;
            this.UserAddressStore(this.add_address).then(res =>{
                this.addresses.unshift(res.data.result);
                this.addresses_add_loading=false;
                this.DialogAddAddress=false;
                return this.NotifySuccess(res.data.message)
            }).catch(error => {
                this.addresses_add_loading=false;
                if (error.response.status === 422) {
                    return this.errors = error.response.data
                }
                return this.NotifyServerError();
            });

        },
        GetProvinces(){
            axios.get('/helper/provinces').then(res =>{
                this.provinces = res.data.result;
                this.provinces.forEach(province => {
                    this.provinces_select.push({label : province.name , value : province.id})
                })
            })
        },
        GetShipping(){
            axios.get('/helper/shopping/shipping').then(res =>{
                this.shipping = res.data.result;
                if (res.data.result.length){
                    this.shipping_selected = res.data.result[0];
                }
            }).catch(error => {
                return this.NotifyServerError();
            })
        },
        ShoppingStart(){
            if (!this.address_selected){
                return this.NotifyError("آدرس ارسال را انتخاب کنید");
            }
            if (!this.shipping_selected){
                return this.NotifyError("روش ارسال را انتخاب کنید");
            }
            let items = {
                'address_id' : this.address_selected.id,
                'shipping_id' : this.shipping_selected.id,
                'cart' : this.CartItemGet
            }
            this.shopping_loading=true;
            this.ShoppingUserStart(items).then(res => {
                if (res.data.result.url){
                    window.open(res.data.result.url,'_self')
                }
            }).catch(error => {
                this.shopping_loading=false;

                return this.NotifyServerError();


            })


        }

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
                                    <strong class="text-indigo font-15">اطلاعات دریافت کننده : </strong>
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
                                    <strong class="text-indigo font-15">انتخاب آدرس ارسال : </strong>
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
                                                        <select class="form-control" v-model="add_address.province_id" @change="GetCities" :class="{'is-invalid' : this.MixinValidationCheck(errors,'province_id')}">
                                                            <option v-for="province in provinces_select" :value="province.value">{{province.label}}</option>
                                                        </select>
                                                        <errors_validation :errors="this.MixinValidation(errors,'province_id')"></errors_validation>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label text-teal-8">انتخاب شهر</label>
                                                        <select class="form-control" v-model="add_address.city_id" :disabled="!add_address.province_id" :class="{'is-invalid' : this.MixinValidationCheck(errors,'city_id')}">
                                                            <option v-for="city in cities_select" :value="city.value">{{city.label}}</option>
                                                        </select>
                                                        <errors_validation :errors="this.MixinValidation(errors,'city_id')"></errors_validation>
                                                    </div>
                                                    <div class="col-md-6 mt-3">
                                                        <label class="form-label text-teal-8">عنوان آدرس</label>
                                                        <input class="form-control" type="text" v-model="add_address.title" placeholder="مثال : محل کارم" :class="{'is-invalid' : this.MixinValidationCheck(errors,'title')}">
                                                        <errors_validation :errors="this.MixinValidation(errors,'title')"></errors_validation>

                                                    </div>
                                                    <div class="col-md-6 mt-3">
                                                        <label class="form-label text-teal-8"> کد پستی</label>
                                                        <input class="form-control " type="text" v-model="add_address.postal_code" placeholder="کد پستی ده رقمی" :class="{'is-invalid' : this.MixinValidationCheck(errors,'postal_code')}">
                                                        <errors_validation :errors="this.MixinValidation(errors,'postal_code')"></errors_validation>

                                                    </div>
                                                    <div class="col-md-12 mt-4">
                                                        <label class="form-label text-teal-8"> آدرس کامل</label>
                                                        <textarea style="height: 100px" class="form-control" rows="7" v-model="add_address.address" placeholder="مثال : بلوار ولیعصر - کوچه عدالت 14 ساختمان ..." :class="{'is-invalid' : this.MixinValidationCheck(errors,'address')}">
                                                        </textarea>
                                                        <errors_validation :errors="this.MixinValidation(errors,'address')"></errors_validation>
                                                    </div>

                                                </div>
                                                <div class="mt-4 mb-1 text-right">
                                                    <q-btn v-close-popup color="red" glossy class="font-13">بستن</q-btn>
                                                    <q-btn @click="AddAddress" :loading="addresses_add_loading" color="teal" glossy class="font-13 me-2">افزودن آدرس جدید</q-btn>
                                                </div>
                                            </q-card-section>
                                        </q-card>
                                    </q-dialog>
                                </div>
                                <global_loading_address class="mt-3" v-if="addresses_loading"></global_loading_address>
                                <div v-else class="row mt-4">
                                    <div v-if="!addresses.length" class="col-12">
                                        <div class="text-center">
                                            <q-img src="/front/images/folder-empty.png" width="75px" />
                                            <div class="mt-1">
                                                <strong class="text-red-5">شما هنوز هیچ آدرسی ثبت نکرده اید</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <template v-else>
                                        <div v-for="address in addresses" class="col-md-12 mb-3 pointer" @click="address_selected=address">
                                            <div class="card" :class="{'shadow-8 border-success' : address_selected.id === address.id}">
                                                <div class="card-body">
                                                    <q-icon name="fas fa-city" class="ms-2"></q-icon>
                                                    <span v-if="address.city">{{address.city.name}}</span>
                                                    <strong v-if="address_selected.id === address.id" class="float-start text-indigo">
                                                        <q-icon name="fas fa-check-circle font-18"></q-icon>
                                                    </strong>
                                                    <div class="mt-1">
                                                        <strong class="text-red-5">{{address.title}}</strong>
                                                    </div>
                                                    <div class="mt-1">
                                                        {{address.address}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                                <q-separator class="mt-4 mb-4" color="grey-5" />
                                <div>
                                    <q-img src="/front/images/truck.png" width="50px" class="ms-2"></q-img>
                                    <strong class="text-indigo font-15">انتخاب روش ارسال : </strong>
                                </div>
                                <div class="mt-3">
                                    <div v-for="item in shipping">
                                        <div>
                                            <input type="checkbox" style="transform: scale(1.3);" checked>
                                            <span class="me-2">ارسال از طریق : </span>
                                            <strong class="text-dark">{{item.title}}</strong>
                                            <span class="float-start me-1" >تومان</span>
                                            <strong v-if="item.cost" class="float-start text-red-7">{{this.$filters.numbers(item.cost)}}</strong>
                                        </div>
                                        <q-separator color="grey-7" class="mt-2"/>
                                    </div>


                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-3 q-px-xs">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <span class="font-14 text-grey-8">قیمت کالاها <strong class="text-indigo-5">({{CartTotalProducts}})</strong></span>
                                    <strong class="float-right text-dark">{{this.$filters.numbers(this.CartTotalPrice) }}</strong>
                                </div>
                                <q-separator class="mt-3 mb-3" />
                                 <template v-if="this.$route.name === 'checkout_cart'">
                                  <div>
                                      <strong class="font-14 text-dark">جمع سبد خرید</strong>
                                      <span class="float-right me-1 text-grey-7">تومان</span>
                                      <strong class="float-right font-16 text-success">{{this.$filters.numbers(this.CartTotalPrice) }}</strong>
                                  </div>
                                  <q-separator class="mt-3 mb-3" />
                              </template>
                                <template v-if="address_selected">
                                    <div>
                                        <span class="font-14 text-grey-8">ارسال به :</span>
                                        <strong class="float-right text-grey-8">{{address_selected.title}}</strong>
                                    </div>
                                    <q-separator class="mt-3 mb-3" />
                                </template>
                                <template v-if="shipping_selected">
                                    <div>
                                        <span class="font-14 text-grey-8">هزینه ارسال :</span>
                                        <strong class="float-right text-dark">{{this.$filters.numbers(shipping_selected.cost) }}</strong>
                                    </div>
                                    <q-separator class="mt-3 mb-3" />
                                </template>
                                <div>
                                    <span class="font-15 text-grey-8">مبلغ قابل پرداخت :</span>
                                    <span class="me-1 float-right">تومان</span>

                                    <strong v-if="shipping_selected" class="float-right text-green-8 font-16">
                                        {{this.$filters.numbers(this.CartTotalPrice + shipping_selected.cost)}}
                                    </strong>
                                </div>
                                <q-separator class="mt-3 mb-3" />
                                <div class="text-center">
                                    <div v-if="!AuthUserCheck" class="text-danger mb-2">برای ادامه وارد حساب کاربری خود شوید</div>
                                    <q-btn v-if="this.$route.name === 'checkout_cart'" :to="{name:'checkout_shipping'}" color="green-7" class="w-100 font-16"  glossy :disable="!AuthUserCheck">ثبت سفارشات </q-btn>
                                    <q-btn v-if="this.$route.name === 'checkout_shipping'" color="green-7" class="w-100 font-16"  glossy :disable="!AuthUserCheck" @click="ShoppingStart">ثبت نهایی و پرداخت </q-btn>
                                </div>
                            </div>
                        </div>

                        <q-dialog v-model="shopping_loading" persistent>
                            <q-card style="width: 500px;max-width: 700px">
                               <q-card-section>
                                   <div class="text-center">
                                       <q-img src="/front/images/payment-loading.svg" width="260px"></q-img>
                                       <br>
                                       <strong class="text-indigo">در حال اتصال به درگاه پرداخت ...</strong>
                                   </div>
                               </q-card-section>
                            </q-card>
                        </q-dialog>

                    </div>

                </div>
            </template>
            <template v-else>
                <div class="text-center mt-5">
                    <img src="/front/images/cart-empty.png"  alt="" width="200">
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
