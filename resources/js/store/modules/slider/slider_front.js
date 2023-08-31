import "../../../bootstrap-front";

export default {

    state : {},
    mutations: {},
    actions:{
        SliderIndex(){
            return new Promise((resolve,reject) => {
                axios.get('slider').then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },


    }

}
