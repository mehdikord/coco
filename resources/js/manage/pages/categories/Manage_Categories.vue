<template>
    <q-card flat bordered>

        <q-card-section class="bg-blue-grey-14 text-white q-pb-lg">
            <q-btn @click="dialog_add=true" color="deep-orange-7" icon="mdi-plus" push class="float-right" label="افزودن آیتم"></q-btn>
            <q-dialog
                v-model="dialog_add"
                transition-show="scale"
                transition-hide="scale"
                position="top"
            >
                <q-card style="max-width: 700px;width: 700px">
                    <q-card-section class="bg-deep-orange-9 text-white">
                        <div class="text-h6">افزودن آیتم جدید</div>
                    </q-card-section>
                    <q-card-section >
                        <q-input v-model="add.name"  lazy-rules type="text" outlined label="نام دسته بندی" color="primary" class="q-my-xs" :error="this.MixinValidationCheck(errors,'name')">
                            <template v-slot:error>
                                <Error_Validation :errors="this.MixinValidation(errors,'name')"></Error_Validation>
                            </template>
                        </q-input>

                        <q-select
                            class="q-mb-md"
                            outlined
                            transition-show="flip-up"
                            transition-hide="flip-down"
                            v-model="add.parent_id"
                            use-input
                            label="انتخاب سرگروه"
                            :options="categories_option"
                            emit-value
                            map-options
                            @filter="Filter_Select_Category"
                            :loading="loading_select_category"
                            behavior="menu"
                        >
                            <template v-slot:no-option>
                                <q-item>
                                    <q-item-section class="text-grey">
                                        No results
                                    </q-item-section>
                                </q-item>
                            </template>
                            <template v-slot:option="scope">
                                <q-item v-bind="scope.itemProps">
                                    <q-item-section avatar>
                                        <Global_Show_Image :image="scope.opt.image"></Global_Show_Image>
                                    </q-item-section>
                                    <q-item-section>
                                        <q-item-label>{{ scope.opt.label }}</q-item-label>
                                    </q-item-section>
                                </q-item>
                            </template>
                        </q-select>

                        <q-file class="q-mb-md" outlined bottom-slots v-model="add.image" label="انتخاب تصویر" counter>
                            <template v-slot:prepend>
                                <q-icon name="mdi-image" @click.stop.prevent />
                            </template>
                            <template v-slot:append>
                                <q-icon name="mdi-close" @click.stop.prevent="add.image = null" class="cursor-pointer" />
                            </template>
                        </q-file>

                        <q-input v-model="add.description"  lazy-rules type="textarea" outlined label="توضیحات" color="primary" class="q-my-xs" :error="this.MixinValidationCheck(errors,'description')">
                            <template v-slot:error>
                                <Error_Validation :errors="this.MixinValidation(errors,'description')"></Error_Validation>
                            </template>
                        </q-input>

                    </q-card-section>

                    <q-card-actions align="right">
                        <q-btn  label="بستن" color="red" v-close-popup />
                        <q-btn @click="AddItem" :loading="loading_add" label="افزودن آیتم" color="green-9"/>
                    </q-card-actions>
                </q-card>
            </q-dialog>
            <strong class="font-16">لیست همه دسته بندی ها</strong>
        </q-card-section>

        <q-card-section>

            <q-table
                :rows="items"
                row-key="id"
                :columns="item_columns"
                color="indigo"
                table-header-class="text-indigo"
                :loading="loading_get"
                :pagination="{rowsPerPage:30}"

            >
                <template v-slot:loading>
                    <Global_Loading></Global_Loading>
                </template>

                <template v-slot:body-cell-image="props">
                    <q-td :props="props">
                        <Global_Show_Image :image="props.row.image"></Global_Show_Image>
                    </q-td>
                </template>
                <template v-slot:body-cell-parent="props">
                    <q-td :props="props">
                        <span v-if="props.row.parent" class="text-red">{{props.row.parent.name}}</span>
                    </q-td>
                </template>
                <template v-slot:body-cell-tools="props">
                    <q-td :props="props">
                        <q-btn @click="dialog_edit[props.row.id] = true;errors=[]" glossy color="primary" size="sm" icon="mdi-pen" class="q-mx-xs">
                            <q-tooltip class="bg-grey-9">ویرایش آیتم</q-tooltip>
                        </q-btn>
                        <q-btn @click="dialog_edit_image[props.row.id] = true;errors=[]" glossy color="deep-orange" size="sm" icon="mdi-image-edit" class="q-mx-xs">
                            <q-tooltip class="bg-grey-9">ویرایش تصویر آیتم</q-tooltip>
                        </q-btn>
                        <q-btn @click="DeleteItem(props.row.id)" glossy color="red-9" size="sm" icon="mdi-delete" class="q-mx-xs">
                            <q-tooltip class="bg-grey-9">حذف آیتم</q-tooltip>
                        </q-btn>
                    </q-td>
                    <q-dialog
                        v-model="dialog_edit[props.row.id]"
                        transition-show="scale"
                        transition-hide="scale"
                        position="top"
                    >
                        <q-card style="max-width: 700px;width: 700px">
                            <q-card-section class="bg-primary text-white">
                                <div class="text-h6">ویرایش آیتم : {{props.row.name}}</div>
                            </q-card-section>
                            <q-card-section >

                                <q-input v-model="props.row.name"  lazy-rules type="text" outlined label="عنوان برند" color="primary" class="q-my-xs" :error="this.MixinValidationCheck(errors,'name')">
                                    <template v-slot:error>
                                        <Error_Validation :errors="this.MixinValidation(errors,'name')"></Error_Validation>
                                    </template>
                                </q-input>

                                <q-select
                                    class="q-mb-md"
                                    outlined
                                    transition-show="flip-up"
                                    transition-hide="flip-down"
                                    v-model="props.row.parent_id"
                                    use-input
                                    label="انتخاب سرگروه"
                                    :options="categories_option"
                                    emit-value
                                    map-options
                                    :option-disable="opt => Object(opt) === opt ? opt.value === props.row.id : true"
                                    @filter="Filter_Select_Category"
                                    :loading="loading_select_category"
                                    behavior="menu"
                                >
                                    <template v-slot:no-option>
                                        <q-item>
                                            <q-item-section class="text-grey">
                                                No results
                                            </q-item-section>
                                        </q-item>
                                    </template>
                                    <template v-slot:option="scope">
                                        <q-item v-bind="scope.itemProps">
                                            <q-item-section avatar>
                                                <Global_Show_Image :image="scope.opt.image"></Global_Show_Image>
                                            </q-item-section>
                                            <q-item-section>
                                                <q-item-label>{{ scope.opt.label }}</q-item-label>
                                            </q-item-section>
                                        </q-item>
                                    </template>
                                </q-select>

                                <q-input v-model="props.row.description"  lazy-rules type="textarea" outlined label="توضیحات" color="primary" class="q-my-xs" :error="this.MixinValidationCheck(errors,'description')">
                                    <template v-slot:error>
                                        <Error_Validation :errors="this.MixinValidation(errors,'description')"></Error_Validation>
                                    </template>
                                </q-input>

                            </q-card-section>

                            <q-card-actions align="right">
                                <q-btn  label="بستن" color="red" v-close-popup />
                                <q-btn @click="EditItem(props.row)" :loading="loading_add" label="ویرایش آیتم" color="indigo"/>
                            </q-card-actions>
                        </q-card>

                    </q-dialog>
                    <q-dialog
                        v-model="dialog_edit_image[props.row.id]"
                        transition-show="scale"
                        transition-hide="scale"
                        position="top"
                    >
                        <q-card style="max-width: 700px;width: 700px">
                            <q-card-section class="bg-deep-orange text-white">
                                <div class="text-h6">ویرایش تصویر : {{props.row.name}}</div>
                            </q-card-section>
                            <q-card-section>
                                <div>
                                    برای ویرایش تصویر ، فایل جدید را انتخاب کنید و دکمه ویرایش تصویر را کلیک کنید و برای حذف تصویر دکمه حذف تصویر را کلیک کنید
                                </div>
                                <div class="q-mt-lg">
                                    <q-file class="q-mb-md" outlined bottom-slots v-model="edit_image[props.row.id]" label="انتخاب تصویر" counter>
                                        <template v-slot:prepend>
                                            <q-icon name="mdi-image" @click.stop.prevent />
                                        </template>
                                        <template v-slot:append>
                                            <q-icon name="mdi-close" @click.stop.prevent="edit_image[props.row.id] = null" class="cursor-pointer" />
                                        </template>
                                        <template v-slot:error>
                                            <Error_Validation :errors="this.MixinValidation(errors,'image')"></Error_Validation>
                                        </template>
                                    </q-file>
                                </div>
                                <div class="q-mt-sm q-gutter-sm">
                                    <q-btn glossy icon="mdi-pen" color="indigo" @click="EditImage(props.row.id)">ویرایش تصویر</q-btn>
                                    <q-btn  glossy icon="mdi-delete-forever" @click="DeleteItemImage(props.row.id)" color="red" :disable="!props.row.image">حذف تصویر</q-btn>
                                </div>

                            </q-card-section>
                            <q-card-actions align="right">
                                <q-btn  label="بستن" color="dark" v-close-popup />
                            </q-card-actions>
                        </q-card>

                    </q-dialog>

                </template>


            </q-table>

        </q-card-section>


    </q-card>

</template>

<script>
import {mapActions} from "vuex";

export default {
    name: "Manage_Categories",
    created() {
        this.GetItems();

    },
    mounted() {
        this.Categories_Select();
    },
    data(){
        return{
            items:[],
            loading_get:true,
            loading_add:false,
            loading_image:false,
            loading_select_category:false,
            errors:[],
            dialog_add:false,
            dialog_edit:[],
            dialog_edit_image:[],
            categories_option:[],
            add:{
                name:null,
                parent_id:null,
                image:null,
                description:null,

            },
            edit_image:[],
            item_columns:[
                {
                    name:'id',
                    required: true,
                    label: 'ID',
                    align: 'left',
                    field: row => row.id,
                    sortable: true
                },
                {
                    name:'image',
                    required: true,
                    label: 'تصویر',
                    align: 'left',
                    field: row => row.image,
                    sortable: false
                },
                {
                    name:'name',
                    required: true,
                    label: 'عنوان برند',
                    align: 'left',
                    field: row => row.name,
                    sortable: true
                },
                {
                    name:'parent',
                    required: true,
                    label: 'سر گروه',
                    align: 'left',
                    field: row => row.parent,
                    sortable: true
                },
                {
                    name:'description',
                    required: true,
                    label: 'توضیحات',
                    align: 'left',
                    field: row => row.description,
                    sortable: true
                },
                {
                    name:'tools',
                    required: true,
                    label: 'تنظیمات',
                    align: 'left',

                },
            ]
        }
    },
    methods:{
        ...mapActions([
            "CategoriesIndex",
            "CategoriesStore",
            "CategoriesDelete",
            "CategoriesDeleteImage",
            "CategoriesEdit",
            "CategoriesEditImage",
            "CategoriesSelectNoParent"

        ]),
        GetItems(){
            this.CategoriesIndex().then(res => {
                this.items = res.data.result;
                this.loading_get=false;
            }).catch(error => {
                this.NotifyServerError();
            });
        },
        AddItem(){
            this.loading_add=true;
            this.CategoriesStore(this.add).then(res => {
                this.items.unshift(res.data.result);
                this.loading_add=false;
                this.dialog_add=false;
                this.add=[];
                return this.NotifyCreate();
            }).catch(error => {
                this.loading_add=false;
                if (error.response.status === 422) {
                    return this.errors = error.response.data
                }
                return  this.NotifyServerError();
            })
        },
        EditItem(item){
            this.loading_add=true;
            this.CategoriesEdit(item).then(res => {
                this.loading_add=false;
                this.items = this.items.filter(item_get =>{
                    if (item_get.id === item.id){
                        item_get=res.data.result
                    }
                    return item_get;
                })
                this.dialog_edit[item.id]=false;
                return this.NotifyUpdate();
            }).catch(error => {
                this.loading_add=false;
                if (error.response.status === 422) {
                    return this.errors = error.response.data
                }
                return  this.NotifyServerError();
            })
        },
        EditImage(id){
            this.loading_image=true;
            this.CategoriesEditImage({id:id,image:this.edit_image[id]}).then(res => {
                this.items = this.items.filter(item_get =>{
                    if (item_get.id === id){
                        item_get.image=res.data.result.image
                    }
                    return item_get;
                })
                this.loading_image=false;
                this.dialog_edit_image[id]=false;
                this.edit_image[id]=null;
                return this.NotifyUpdate();
            }).catch(error => {
                this.loading_image=false;
                if (error.response.status === 422) {
                    return this.errors = error.response.data
                }
                return  this.NotifyServerError();
            })
        },
        DeleteItem (id) {
            this.$q.dialog({
                title: 'هشدار !',
                message: 'آیا مطمئن هستید آیتم مورد نظر حذف شود ؟',

                ok: {
                    push: true,
                    color:'green-9',
                },
                cancel: {
                    push: true,
                    color: 'negative'
                },
                persistent: true
            }).onOk(() => {
                this.CategoriesDelete(id).then(res => {
                    this.items = this.items.filter(item =>{
                        return item.id !== id;
                    })
                    return this.NotifyDelete();
                }).catch(error => {
                    return  this.NotifyServerError();
                })

            }).onCancel(() => {
                // console.log('>>>> Cancel')
            }).onDismiss(() => {
                // console.log('I am triggered on both OK and Cancel')
            })
        },
        DeleteItemImage (id) {
            this.CategoriesDeleteImage(id).then( res => {
                this.items = this.items.filter(item_get =>{
                    if (item_get.id === id){
                        item_get.image=null
                    }
                    return item_get;
                })
                this.dialog_edit_image[id]=false;
                return this.NotifyDelete();
            }).catch(error => {

                return  this.NotifyServerError();

            })
        },
        Categories_Select(){
            this.loading_select_category = true;
            this.CategoriesSelectNoParent().then(res => {
                this.categories_option = res;
                this.loading_select_category=false;
            }).catch(e => {
                return  this.NotifyServerError();

            })
        },
        Filter_Select_Category (val, update, abort) {
            update(() => {
                if (val){
                    this.categories_option =  this.categories_option.filter(item => {
                        return item.label !== null && item.label.match(val)
                    })
                }else {
                    this.Categories_Select();
                }
            })
        }
    },
}
</script>

<style scoped>

</style>
