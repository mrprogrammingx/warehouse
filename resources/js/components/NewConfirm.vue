<template>
    <div id="confirm_content" >


        <!--           ///////////////////////////////////// modal confirm-->
        <div class="modal" tabindex="-1" id="modal-confirm">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add confirmation</h5>
                        <button type="button" class="close ml-0" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body form-group text-right">
                        <div>
                            <label>Confirmation name:</label>

                            <input v-model="confirm_val" type="text" class="form-control">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary " data-dismiss="modal">
                            Cancel
                        </button>
                        <button type="button" class="btn btn-primary" @click="save_confirm(confirm_val)">Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!--           ///////////////////////////////////// modal product-->
        <div class="modal" tabindex="-1" id="modal-product">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add confirmation</h5>
                        <button type="button" class="close ml-0" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body form-group text-right">
                        <div>
                            <label>Product name:</label>

                            <multiselect v-if="products!=''" v-model="product_temp.product_id"
                                         :options="products"
                                         :custom-label="nameWithLang"
                                         :showLabels="false"
                                         placeholder="Product name"></multiselect>

                        </div>

                        <div class="mt-4">
                            <label>Confirmation name:</label>
                            <multiselect v-if="confirms!=''" v-model="product_temp.confirm_id"
                                         :options="confirms.map(type => type.id)"
                                         :custom-label="opt => confirms.find(x => x.id == opt).name" :showLabels="false"
                                         placeholder="Confirmation name"></multiselect>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary " data-dismiss="modal">
                            Cancel
                        </button>
                        <button type="button" class="btn btn-primary" @click="saveProduct(product_temp)">Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!--           ///////////////////////////////////// modal categoris-->
        <div class="modal" tabindex="-1" id="modal-categoris">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add confirmation</h5>
                        <button type="button" class="close ml-0" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body form-group text-right">
                        <div>
                            <label>Category name:</label>

                            <multiselect v-if="categoris!=''" v-model="category_temp.category_id"
                                         :options="categoris.map(type => type.id)"
                                         :custom-label="opt => categoris.find(x => x.id == opt).name"
                                         :showLabels="false" placeholder="Category name"></multiselect>

                        </div>

                        <div class="mt-4">
                            <label>Confirmation name:</label>
                            <multiselect v-if="confirms!=''" v-model="category_temp.confirm_id"
                                         :options="confirms.map(type => type.id)"
                                         :custom-label="opt => confirms.find(x => x.id == opt).name" :showLabels="false"
                                         placeholder="Confirmation name"></multiselect>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary " data-dismiss="modal">
                            Cancel
                        </button>
                        <button type="button" class="btn btn-primary" @click="saveCategories(category_temp)">Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!--           /////////////////////////////////////-->
        <div class="row margin_top my_scroll">
            <div class="col-sm col-md-4">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Add new confirmation</h3>
                        <button type="button" class="btn btn-sm btn-success float-left" data-toggle="modal"
                                data-target="#modal-confirm">Add
                        </button>
                    </div>

                    <div class="box-body no-padding">
                        <table id="confirm" class="table table-condensed style_table">
                            <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Confirmation name</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(confirm,index) in confirms">
                                <td>
                                    {{ index + 1 }}.
                                </td>
                                <td>
                                    {{ confirm.name }}
                                </td>
                                <td>
                                    <i class="badge badge-info">Inactive</i>
                                    <i class="badge badge-danger">Delete</i>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

            <div class="col-sm col-md-4">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Products confirmation</h3>
                        <button type="button" class="btn btn-sm btn-success float-left" data-toggle="modal"
                                data-target="#modal-product">Add
                        </button>
                    </div>

                    <div class="box-body no-padding">
                        <table id="products" class="table table-condensed style_table">

                            <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Product name</th>
                                <th>Confirmation name</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr v-for="(product_confirm,index) in product_list">
                                <td>
                                    {{ index + 1 }}.
                                </td>
                                <td>
                                    {{ product_confirm.product.name }}
                                </td>
                                <td>
                                    {{ product_confirm.confirm.name }}
                                </td>

                                <td>
                                    <i class="badge badge-info">Inactive</i>
                                    <i class="badge badge-danger">Delete</i>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <div class="col-sm col-md-4">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Confirmation of category</h3>
                        <button type="button" class="btn btn-sm btn-success float-left" data-toggle="modal"
                                data-target="#modal-categoris">Add
                        </button>
                    </div>

                    <div class="box-body no-padding">
                        <table id="categoris" class="table table-condensed style_table">
                            <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Category name</th>
                                <th>Confirmation name</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr v-for="(category_confirm,index) in category_list">
                                <td>
                                    {{ index + 1 }}.
                                </td>
                                <td>
                                    {{ category_confirm.category.name }}
                                </td>
                                <td>
                                    {{ category_confirm.confirm.name }}
                                </td>

                                <td>
                                    <i class="badge badge-info">Inactive</i>
                                    <i class="badge badge-danger">Delete</i>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

    </div>

</template>

<script>
import Swal from "sweetalert2";
import Multiselect from 'vue-multiselect'

export default {
    name: "confirm_content",
    data() {
        return {
            confirms: '',
            confirm_val: '',
            products: '',
            users: '',
            categoris: '',
            users_list: '',
            product_list: '',
            category_list: '',
            product_temp: {product_id: '', confirm_id: ''},
            category_temp: {category_id: '', confirm_id: ''},
            user_temp: {user_id: '', confirm_id: ''},

        }
    },

    methods: {
        nameWithLang({name, itemDataId}) {
            return `${name} - ${itemDataId}`
        },
        loadConfirm() {
            axios.get('api/confirms/all').then(({data}) => (this.confirms = data.data))
        },
        loadProducts() {
            axios.get('api/products/all').then(({data}) => (this.products = data.data))
        },
        loadCategory() {
            axios.get('api/category/all').then(({data}) => (this.categoris = data.data))
        },
        loadUser() {
            axios.get('api/user/all').then(({data}) => (this.users = data.data));
        },
        loadProductList() {
            axios.get('api/productsConfirm/all').then(({data}) => (this.product_list = data.data));
        },
        loadCategoryList() {
            axios.get('api/categoryConfirm/all').then(({data}) => (this.category_list = data.data));
        },
        save_confirm(confirm_val) {
            axios.post('api/confirms/store', {
                    name: confirm_val
                }
            ).then((response) => {
                if (response.data.success) {
                    this.confirm_val = ''
                    this.loadConfirm()
                    $("#modal-confirm .close").click()
                    Swal.fire({
                        heightAuto: false,
                        position: 'center',
                        icon: 'success',
                        title: 'Saved successfully',
                        showConfirmButton: false,
                        timer: 2000
                    })
                }

            }).catch(error => {
                if (!error.response.data.success) {
                    Swal.fire({
                        heightAuto: false,
                        icon: 'error',
                        title: 'Error . . .',
                        text: error.response.data.message
                    })
                }

            })
        },
        saveProduct(product) {
            axios.post('api/productsConfirm/store', {
                    product_id: product.product_id.id,
                    confirm_id: product.confirm_id
                }
            ).then((response) => {
                if (response.data.success) {
                    this.product_temp = {product_id: '', confirm_id: ''}
                    this.loadConfirm()
                    this.loadProductList()
                    $("#modal-product .close").click()
                    Swal.fire({
                        heightAuto: false,
                        position: 'center',
                        icon: 'success',
                        title: 'Saved successfully',
                        showConfirmButton: false,
                        timer: 2000
                    })
                }
            }).catch(error => {
                if (!error.response.data.success) {
                    Swal.fire({
                        heightAuto: false,
                        icon: 'error',
                        title: 'Error . . .',
                        text: error.response.data.message
                    })
                }

            })
        },
        saveCategories(category) {
            axios.post('api/categoryConfirm/store', {
                    category_id: category.category_id,
                    confirm_id: category.confirm_id
                }
            ).then((response) => {
                if (response.data.success) {
                    this.category_temp = {category_id: '', confirm_id: ''}
                    this.loadConfirm()
                    this.loadCategoryList()
                    $("#modal-categoris .close").click()
                    Swal.fire({
                        heightAuto: false,
                        position: 'center',
                        icon: 'success',
                        title: 'Saved successfully',
                        showConfirmButton: false,
                        timer: 2000
                    })
                }
            }).catch(error => {
                if (!error.response.data.success) {
                    Swal.fire({
                        heightAuto: false,
                        icon: 'error',
                        title: 'Error . . .',
                        text: error.response.data.message
                    })
                }

            })
        },
    },
    computed: {},
    created() {
        this.loadConfirm()
        this.loadProducts()
        this.loadUser()
        this.loadProductList()
        this.loadCategory()
        this.loadCategoryList()
    },
    components: {
        Multiselect
    }

}
</script>

<style scoped>
#confirm_content {
    text-align: center;
    /*width: 100%;*/
    margin: 2%;
    padding: 1%;
    overflow-y: clip;
}
.my_scroll{
    overflow-y: auto;
    max-height: 90vh;
}
.box {
    position: relative;
    border-radius: 3px;
    background: #f7f7f7;
    border-top: 3px solid #d2d6de;
    margin-bottom: 20px;
    width: 100%;
    box-shadow: 0 1px 1px rgb(0 0 0 / 10%);
    /*height: 100vh;*/
    overflow-y: auto;
    border-bottom: 1px solid black;
}

.box-title {
    display: inline-block;
    font-size: 18px;
    margin: 0;
    line-height: 1;
}

.box-header {
    color: #444;
    display: block;
    padding: 10px;
    position: relative;
    text-align: right;
}

@media only screen
and (max-width: 760px), (min-device-width: 768px)
and (max-device-width: 1024px) {
    .containe h4{
        margin-top: 5%;
    }
    table td, tr {
        display: block;
    }


    table thead tr {
        position: absolute;
        top: -9999px;
        right: -9999px;
    }

    table tr {
        margin: 0 0 1rem 0;
        border-radius: 10px;
        border: 1px solid gray;
    }

    table tr:nth-child(odd) {
        background: #bab8b8;
    }

    table td {
        border: none;
        border-bottom: 1px solid #eee;
        position: relative;
        padding-right: 58%;
    }

    table td:before {
        position: absolute;
        right: 0px;
        width: 50%;
        padding-right: 10px;
        white-space: nowrap;
    }

    #confirm td:nth-of-type(1):before {
        content: "Row";
    }

    #confirm td:nth-of-type(2):before {
        content: "Confirmation name";
    }

    #confirm td:nth-of-type(3):before {
        content: "Actions";
    }

    #products td:nth-of-type(1):before {
        content: "Row";
    }

    #products td:nth-of-type(2):before {
        content: "Product name";
    }
    #products td:nth-of-type(3):before {
        content: "Confirmation name";
    }

    #products td:nth-of-type(4):before {
        content: "Actions";
    }
    #categoris td:nth-of-type(1):before {
        content: "Row";
    }

    #categoris td:nth-of-type(2):before {
        content: "Category name";
    }
    #categoris td:nth-of-type(3):before {
        content: "Confirmation name";
    }

    #categoris td:nth-of-type(4):before {
        content: "Actions";
    }
}
</style>

