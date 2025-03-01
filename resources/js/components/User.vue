<template>
    <div id="user_content" class="margin_top">

            <div class="modal" id="user" tabindex="-1" role="dialog">
                <div class="modal-dialog text-right" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add new user</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                <i class="tim-icons icon-simple-remove"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="control-label">Name</label>
                                <input v-on:keyup="toggleBodyClass()"  :class="['form-control',allerrors.name ? 'is-invalid' : '']" v-model="newUser.name" type="text" class="form-control"
                                       >
                                <span v-if="allerrors.name" :class="['label ']">@{{ allerrors.name[0] }}</span>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Last name</label>
                                <input v-on:keyup="toggleBodyClass()"  :class="['form-control',allerrors.family ? 'is-invalid' : '']" v-model="newUser.family" type="text" class="form-control"
                                >
                                <span v-if="allerrors.family" :class="['label ']">@{{ allerrors.family[0] }}</span>
                            </div>
                            <div   class="form-group">
                                <label class="control-label">Personnel code</label>
                                <input v-on:keyup="toggleBodyClass()" maxlength="4" :class="['form-control',allerrors.code ? 'is-invalid' : '']" v-model="newUser.code" type="text" class="form-control"
                                >
                                <span v-if="allerrors.code" :class="['label ']">@{{ allerrors.code[0] }}</span>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Unit</label>
                                <multiselect v-model="newUser.unit_id" track-by="name" label="name"
                                    placeholder="Select" :options="units" :searchable="true"
                                    :allow-empty="false" :showLabels="false">
                                </multiselect>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Type of user</label>
                                <select  :class="['form-control',allerrors.roles ? 'is-invalid' : '']" id="role_create" v-model="newUser.roles" class="form-control">
                                    <option> </option>
                                    <option v-for="(role ,index) in roles" :value="role.id">{{role.name}}</option>}}
                                </select>
                                <span v-if="allerrors.roles" :class="['label ']">@{{ allerrors.roles[0] }}</span>

                            </div>
                            <div class="form-group">
                            <label class="control-label">Password</label>
                            <input v-on:keyup="toggleBodyClass()" :class="['form-control',allerrors.password ? 'is-invalid' : '']" v-model="newUser.password" type="password" class="form-control"
                            >
                                <span v-if="allerrors.password" :class="['label ']">@{{ allerrors.password[0] }}</span>
                        </div>
                            <div class="form-group">
                                <label class="control-label">Repeat the password</label>
                                <input v-on:keyup="toggleBodyClass()" :class="['form-control',allerrors.password_confirmation ? 'is-invalid' : '']" v-model="newUser.password_confirmation" type="password" class="form-control"
                                >
                                <span v-if="allerrors.password_confirmation" :class="['label ']">@{{ allerrors.password_confirmation[0] }}</span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button @click="createNewUser()" class="btn btn-primary">Add user</button>
                            <button type="button" class="btn btn-secondary"  data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>

                    <div class="text-right">
                        <button data-toggle="modal" data-target="#user"
                                class="btn cyan_color">Add new user
                        </button>
                        <div class="search-box mr-5">
                            <h5 id="text_search" class="d-inline-flex">Search:</h5>
                            <button class="btn-search"><i class="fas fa-search"></i></button>
                            <input type="text" class="input-search" v-model="searchQuery"
                                   placeholder="Search...">
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table id="table_personels" class="table border style_table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Last name</th>
                                    <th>Personnel code</th>
                                    <th>Unit name</th>
                                    <th>Type of user</th>
                                    <th>Actions</th>

                                </tr>
                                </thead>
                                <tr v-for="(user,index) in resultQuery" :class="{editing: user == editedUser}" v-cloak>
                                    <td>
                                            {{index + 1}}

                                    </td>
                                    <td>

                                            <input type="text" class="form-control" :value="user.first_name" :id="index"
                                                   readonly>


                                    </td>
                                    <td>

                                            <input type="text" class="form-control" v-model="user.last_name" :id="index"
                                                   readonly>

                                    </td>
                                    <td>

                                            <input type="text" class="form-control" :value="user.personnel_code" :id="index"
                                                   readonly>


                                    </td>
                                    <td>
                                        <input v-if="user.users_unit!=''" type="text" :class="['form-control',allerrors.users_unit ? 'is-invalid' : '']" :value="user.users_unit[0].unit.name" :id="index" readonly>
                                    </td>
                                    <td>
                                        <div class="view">
                                            <input v-if="user.roles!=''" type="text"  class="form-control" :value="user.roles[0].name" :id="index"
                                                   readonly>

                                        </div>
                                        <div class="edit">
                                            <select v-if="user.roles!=''"  id="role_edit" required v-model="user.roles[0].name" class="form-control">
                                                <option  v-for="role in roles"  :value="role.name">{{role.name}}</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="view">
                                           <span
                                               class="badge badge-info even-larger-badge"
                                               @click="editUser(user)">Edit</span>
                                            <button v-if="user.active==1" value="Inactivate" type="button" class="badge badge-danger" @click="userStatus(0,user.personnel_code,$event)">To deactivate</button>
                                            <button v-if="user.active!=1" value="Activate" type="button" class="badge badge-success" @click="userStatus(1,user.personnel_code,$event)">To activate</button>
                                        </div>
                                        <div class="edit">
                                        <span @click="updateUser(user)"
                                            class="badge badge-warning even-larger-badge">Update</span></div>
                                    </td>
                                </tr>

                            </table>
                        </div>
                    </div>



        </div>

</template>

<script>
import Swal from "sweetalert2";
import Multiselect from 'vue-multiselect'
import VuePersianDatetimePicker from "vue-persian-datetime-picker";
export default {
    data() {
        return {
            searchQuery: null,
            editMode: false,
            editedUser: null,
            users: {},
            user2: {
                name:'',
                family:'',
                code:'',
                roles:''
            },//selected users for edit
            newUser:{
                name:'',
                family:'',
                code:'',
                password:'',
                password_confirmation:'',
                roles:'',
                unit_id:''
            },

            units: [],
            request_id:'',

            allerrors:[],
            roles:'',
            role_name:''


        }
    }, methods:{
        getUsers() {
            axios.get('api/user/all').then(({data}) => (this.users = data.data
            ));


        },

        editUser(user) {

          //  axios.get('api/users/edit/' + user_id ).then(({data}) => (this.isReadonly = false,this.user = data.user));
            this.allerrors = []
            this.editedUser = user

        },

        updateUser(user) {
         if($("select option:selected").text() == '') {
             Swal.fire({
                 icon: 'error',
                 title: 'Error',
                 text: 'Please choose the role of user',
             })
             return false
         }
            axios.put('api/role/addRoleToUser', {
                userId:user.id,
                role: user.roles[0].name

            }).then((response) => {
                this.allerrors = [];
                this.editedUser = false;
                this.getUsers()
                Swal.fire({
                    icon: 'success',
                    title: response.data.message,
                    showConfirmButton: false,
                    timer: 1000
                })

                this.cleanForm()

            }).catch(error => {
                this.allerrors = error.response.data
                Swal.fire({
                    icon: 'error',
                    title: 'Error . . .',
                    text: error.response.data.message
                })

            })
    },
        createNewUser() {
                axios.post('api/user/store' , {
                    first_name:this.newUser.name,
                    last_name:this.newUser.family,
                    personnel_code:this.newUser.code,
                    password:this.newUser.password,
                    password_confirmation:this.newUser.password_confirmation,
                    roles:this.newUser.roles,
                    unit_id:this.newUser.unit_id.id
                }).then((response) => {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'New user added!',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    this.getUsers()
                    this.cleanForm()
                    $('#user .close').click()
                }).catch(error => {
                    if (error.response.data.status == '406') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error . . .',
                            text: error.response.data.message
                        })
                    }
                    console.log(error)
                    this.allerrors = error.response.data;

                })
        },
        cleanForm() {
            this.$data.newUser.name = '',
                this.$data.newUser.family = '',
                this.$data.newUser.code = '',
                this.$data.newUser.password = '',
                this.$data.newUser.password_confirmation = '',
                this.allerrors = []
                $('#user').hide();
        },
        getRoles() {
            axios.get('api/roles/all').then(({data}) => (this.roles = data.data));
        },
        toggleBodyClass() {
            this.allerrors = []

        },
        getUnits() {
            axios.get('api/unit/all').then(({data}) => (this.units = data.data))
        },
        userStatus(val,personnel_code,event){
            Swal.fire({
                position: 'center',
                heightAuto: false,
                icon: 'question',
                title: "Are you sure you want to " + event.target.value + " the personnel?",
                showConfirmButton: true,
                showCancelButton: true,
                confirmButtonText: "Yes",
                cancelButtonText: "Opt out",
                confirmButtonColor: "#58c03e"

            }).then((response) => {
                if (response.isConfirmed) {
                    axios.post('api/user/change/status',{personnel_code:personnel_code})
                        .then((response) => {

                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: response.data.message,
                                showConfirmButton: false,
                                timer: 2000
                            })
                            this.getUsers()

                        })
                        .catch((response) => {
                            alert("The operation failed");
                            console.log(response)
                        });
                }

            })
        }
    },

    created() {
        this.getUsers()
        this.getRoles()
        this.getUnits()


    },
    computed: {
        resultQuery() {
            if (this.searchQuery) {
                return this.users.filter(item => {
                    const filter = this.searchQuery;
                    const name = String(item.first_name).includes(filter);
                    const family = String(item.last_name).includes(filter);
                    const code = String(item.personnel_code).includes(filter);

                    return family || name || code
                });
            } else {
                return this.users;
            }
        }
    },
    components: {
        Multiselect
    },

    name: "User",

}
</script>

<style scoped>

#user_content {
    text-align: center;
    margin: 2% ;
    padding: 1%;
    overflow-y: auto;
    height: 80%;
}

th {color: #0a0c0d}
.even-larger-badge {
    font-size: 13px;
}
.custom-table {background: rgb(50 50 93 / 3%);}
[v-cloak] {
    display: none;
}
.edit {
    display: none;
}
.editing .edit {
    display: block
}
.editing .view {
    display: none;
}
span {
    cursor: pointer;
}

@media only screen and (max-width: 600px) {

    #table_personels {
        font-size: 18px;
    }
    td, tr {
        display: block;
    }
.search-box{
    margin-right: 5px!important;
}
#text_search{
    display: none!important;
}
    thead tr {
        position: absolute;
        /*top: -9999px;*/
        right: -9999px;
    }

    tr {
        margin: 0 0 1rem 0;
        border-radius: 10px;
        border: 1px solid gray;
    }

    tr:nth-child(odd) {
        background: #bab8b8;
    }

    td {
        border: none;
        border-bottom: 1px solid #eee;
        position: relative;
        padding-right: 50%;
    }

    td:before {
        position: absolute;
        right: 6px;
        width: 45%;
        padding-right: 10px;
        white-space: nowrap;
    }

    #table_personels td:nth-of-type(1):before {
        content: "Row";
    }

    #table_personels td:nth-of-type(2):before {
        content: "Name";
    }

    #table_personels td:nth-of-type(3):before {
        content: "Last name";
    }

    #table_personels td:nth-of-type(4):before {
        content: "Personnel code";
    }
    #table_personels td:nth-of-type(5):before {
        content: "Type of user";
    }
    #table_personels td:nth-of-type(6):before {
        content: "Actions";
    }

   }
</style>
