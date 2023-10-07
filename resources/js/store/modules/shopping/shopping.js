import "../../../bootstrap";

export default {

    state : {},
    mutations: {},
    actions:{
        ShoppingUserStart(_,item){
            return new Promise((resolve,reject) => {
                axios.post('users/shopping/start',item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },

    }

}
