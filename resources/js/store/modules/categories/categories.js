import "../../../bootstrap";

export default {

    state : {},
    mutations: {},
    actions:{
        CategoriesIndex(){
            return new Promise((resolve,reject) => {
                axios.get('categories').then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        CategoriesStore(_,item){
            return new Promise((resolve,reject) => {
                var data = new  FormData();
                if (item.name){data.append('name',item.name)};
                if (item.parent_id){data.append('parent_id',item.parent_id)};
                if (item.image){data.append('image',item.image,item.image.name)};
                if (item.description){data.append('description',item.description)};
                axios.post('categories',data,{headers: {'Content-Type': 'multipart/form-data'}}).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        CategoriesEdit(_,item){
            return new Promise((resolve,reject) => {
                axios.post('categories/'+item.id,item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        CategoriesDelete(_,item){
            return new Promise((resolve,reject) => {
                axios.delete('categories/'+item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        CategoriesDeleteImage(_,item){
            return new Promise((resolve,reject) => {
                axios.post('categories/image/'+item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        CategoriesEditImage(_,item){
            return new Promise((resolve,reject) => {
                var data = new  FormData();
                if (item.image){data.append('image',item.image,item.image.name)};
                axios.post('categories/image/'+item.id,data,{headers: {'Content-Type': 'multipart/form-data'}}).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        CategoriesSelectNoParent(){
            return new Promise((resolve,reject) => {
                axios.get('categories?with_parent=false').then((result) => {
                    let data = [];
                    result.data.result.forEach(item => {
                        data.push({label : item.name , image:item.image , value : item.id})
                    })
                    resolve(data);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        CategoriesSelectWithParent(){
            return new Promise((resolve,reject) => {
                axios.get('categories?with_parent=true').then((result) => {
                    let data = [];
                    result.data.result.forEach(item => {
                        data.push({label : item.name , image:item.image , value : item.id})
                    })
                    resolve(data);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        CategoriesFrontIndex(){
            return new Promise((resolve,reject) => {
                axios.get('categories').then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        }

    }

}
