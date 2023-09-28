import {createApp} from "vue";
import Store from "./store";
import './bootstrap-front';
import Front from "./routes/front";
import Front_Template from "./front/template/Front_Template.vue";
import { Quasar , Notify,Dialog} from 'quasar';
import quasarIconSet from 'quasar/icon-set/mdi-v7';
import quasarLang from 'quasar/lang/fa-IR'
import 'quasar/dist/quasar.css';
import Helper from "./helpers/Helper";
import {mapActions, mapGetters, mapMutations} from "vuex";
import Front_Global_Loading_Infinite from "./front/globals/Front_Global_Loading_Infinite.vue";
import moment from 'moment-jalaali';
import VueSweetalert2 from 'vue-sweetalert2';
import '@sweetalert2/theme-bulma/bulma.css';

const App=createApp(Front_Template);
App.use(Quasar, {
    plugins: {
        Notify,
        Dialog

    }, // import Quasar plugins and add here
    iconSet: quasarIconSet,
    lang: quasarLang,
    config: {

        brand: {

            // primary: '#e46262',
            // ... or all other brand colors
        },
        notify: {}, // default set of options for Notify Quasar plugin

    }
})
App.use(Store)
App.use(Front)
App.use(VueSweetalert2);

window.Helper = Helper

// ++++++++++ Global Functions (Mixin) ++++++++++

App.mixin({
    beforeCreate() {
        this.$store.commit('AuthUserSync');
        this.$store.commit('CartGetFromStorage');
    },
    created() {
        axios.defaults.headers.common['Authorization'] ="Bearer "+this.AuthToken


    },
    //Methods
    methods:{




        NotifyMessage(message=null,type='info'){
            this.$swal({
                toast: true,
                position: 'top',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', this.$swal.stopTimer)
                    toast.addEventListener('mouseleave', this.$swal.resumeTimer)
                },
                icon:type,
                text:message

            });
        },

        NotifyServerError(){
            this.NotifyError('خطای سرور !');
        },
        NotifySuccess(message){
            this.NotifyMessage(message,'success')
        },
        NotifyWarning(message){
            this.NotifyMessage(message,'warning')
        },
        NotifyError(message){
            this.NotifyMessage(message,'error')
        },
        NotifyInfo(message){
            this.NotifyMessage(message,'info')
        },
        MixinValidation(errors,field){
            return Helper.HelperValidationErrors(errors,field);
        },
        MixinValidationCheck(errors,field){
            return Helper.HelperValidationCheck(errors,field);

        },
        CartAdd(product,quantity=1){
            let item = {quantity : quantity , product : product}
            this.$store.commit("AddToCart",item);
            this.NotifySuccess('به سبد اضافه شد');
        },
        CartReduce(id){
            this.$store.commit("ReduceFromCart",id);
            this.NotifySuccess('از سبد حذف شد');

        },
        CartRemove(id){
          this.$store.commit("RemoveFromCart",id);
            this.NotifySuccess('از سبد حذف شد');

        }


    },
    computed : {
        ...mapGetters({
            AuthToken: "AutUserToken",
            CartProductCheck : "CartProductCheck",
            CartProductQuantity : "CartProductQuantity",
            CartItemCount : "CartItemCount",
            CartTotalPrice : "CartTotalPrice",
            CartTotalProducts : "CartTotalProducts",
            CartItemGet : "CartItemGet"
        }),


    }


})
// ++++++++++++++++++++

// ++++++++++ Global Functions (Mixin) ++++++++++

App.component("global_loading_infinite",Front_Global_Loading_Infinite)
// ++++++++++++++++++++

// ++++++++++ Global Filters ++++++++++

App.config.globalProperties.$filters = {
    date(value,format) {
        return moment(value).format(format='jYYYY/jM/jD')
    },
    numbers(number){
        return new Intl.NumberFormat().format(number);
    },
    quantity_color(quantity){
        if (quantity >= 5){
            return "green";
        }else if (quantity < 5 && quantity >=3){
            return "yellow-9";
        }else {
            return "red";
        }
    },
    short_text(text,len = 20){
        var extra='';
        if (text.length > len){
            extra = "..."
        }
        return text.substring(0,len) + extra;
    },
    persianDigitsToEnglish(persianNumber) {
        const persianDigits = ["۰", "۱", "۲", "۳", "۴", "۵", "۶", "۷", "۸", "۹"];
        const englishDigits = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];
        if (!persianNumber){
            return persianNumber;
        }
        const persianNumberStr = persianNumber.toString();
        let englishNumberStr = "";

        for (let i = 0; i < persianNumberStr.length; i++) {
            const digit = persianNumberStr[i];
            const digitIndex = persianDigits.indexOf(digit);

            if (digitIndex !== -1) {
                englishNumberStr += englishDigits[digitIndex];
            } else {
                englishNumberStr += digit;
            }
        }

        return englishNumberStr;
    }
}

// ++++++++++++++++++++

App.mount('#app')
