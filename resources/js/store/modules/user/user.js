import "../../../bootstrap";

export default {

    state : {},
    mutations: {},
    actions:{
        UserAddressIndex(){
            return new Promise((resolve,reject) => {
                axios.get('users/address').then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        UserAddressStore(_,item){
            return new Promise((resolve,reject) => {
                axios.post('users/address',item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        UserAddressEdit(_,item){
            return new Promise((resolve,reject) => {
                axios.post('users/address',item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        UserAddressDelete(_,item){
            return new Promise((resolve,reject) => {
                axios.post('users/address',item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },


    }

}
