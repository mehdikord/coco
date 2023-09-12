export default {

    state () {
        return{
            Cart: []
        }
    },
    mutations: {
        AddToCart(state,item){
            if (state.Cart.length){
                let check=false;

                state.Cart = state.Cart.filter(cart => {
                    if (cart.product.id === item.product.id){
                        cart.quantity = cart.quantity + item.quantity;
                        check=true;
                    }
                    return cart;
                })
                if (!check){
                    state.Cart.push(item)
                }
            }else {
                state.Cart.push(item)
            }

            localStorage.setItem('coco_cart',JSON.stringify(state.Cart))
        },
        RemoveFromCart(state,id){
            state.Cart = state.Cart.filter(item => {
                return item.product.id !== id
            })
            localStorage.setItem('coco_cart',JSON.stringify(state.Cart))
        },
        ReduceFromCart(state,id){
            let remove=false;
            state.Cart.forEach(cart => {
                if (cart.product.id === id){
                    let new_quantity = cart.quantity - 1;
                    if (new_quantity < 1){
                        remove = true;
                    }
                    cart.quantity = new_quantity;
                }

            })
            if (remove){
                state.Cart = state.Cart.filter(item => {
                    return item.product.id !== id
                })
            }
            localStorage.setItem('coco_cart',JSON.stringify(state.Cart))
        },
        SetEmpty(state){
            state.Cart=[];
            localStorage.removeItem('coco_cart');
        },
        CartGetFromStorage(state){
            if (localStorage.getItem('coco_cart')){
                state.Cart = JSON.parse(localStorage.getItem('coco_cart'));
            }else {

            }
        },

    },
    getters:{

        CartItemCount: (state) => state.Cart.length,
        CartItemGet: (state) => state.Cart,
        CartTotalPrice : (state) => {
            let total=0;
            state.Cart.forEach(item => {
                if (item.product.sale !== null){
                    total+=parseInt(item.product.sale) * item.quantity;
                }else{
                    total+=parseInt(item.product.price) * item.quantity;
                }
            })
            return total;
        },
        CartTotalProducts : (state) => {
            let total=0;
            state.Cart.forEach(item => {
                total+=parseInt(item.quantity);
            })
            return total;
        },
        CartProductCheck : (state) => (id) =>{
            let check = false;
            state.Cart.forEach(cart => {
                if (cart.product.id === id){
                    check=true;
                }
            })
            return check;
        },
        CartProductQuantity : (state) => (id) =>{
            let quantity = 0;
            state.Cart.forEach(cart => {
                if (cart.product.id === id){
                   quantity = cart.quantity;
                }
            })
            return quantity;
        }

    },
    actions:{

    }



}
