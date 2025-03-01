<template>
    <div id="confirm_content">


        <!--           ///////////////////////////////////// modal user confirm-->
        <div class="modal" tabindex="-1" id="modal-userConfirm">
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
                            <label>Name:</label>

                            <multiselect v-if="users!=''" v-model="user_temp.user_id"
                                         :options="users.map(type => type.id)"
                                         :custom-label="opt => users.find(x => x.id == opt).first_name+' '+users.find(x => x.id == opt).last_name+' '+users.find(x => x.id == opt).personnel_code"
                                         :showLabels="false" placeholder="User name"></multiselect>

                        </div>

                        <div class="mt-4">
                            <label>Confirmation name:</label>
                            <multiselect v-if="confirms!=''" v-model="user_temp.confirm_id"
                                         :options="confirms.map(type => type.id)"
                                         :custom-label="opt => confirms.find(x => x.id == opt).name" :showLabels="false"
                                         placeholder="Confirmation name"></multiselect>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary " data-dismiss="modal">
                            Cancel
                        </button>
                        <button type="button" class="btn btn-primary" @click="saveUserConfirm(user_temp)">Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!--           /////////////////////////////////////-->


        <div class="row margin_top">
            <div class="col-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Confirmation of People</h3>
                        <button type="button" class="btn btn-sm btn-success float-left" data-toggle="modal"
                                data-target="#modal-userConfirm">Add
                        </button>
                    </div>

                    <div class="box-body no-padding">
                        <table id="user_confirm" class="table table-condensed style_table">
                            <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Name</th>
                                <th>Last name</th>
                                <th>Confirmation name</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(user_confirm,index) in users_list">
                                <td>
                                    {{ index + 1 }}
                                </td>
                                <td>
                                    {{ user_confirm.user.first_name }}
                                </td>
                                <td>
                                    {{ user_confirm.user.last_name }}
                                </td>
                                <td>
                                    {{ user_confirm.confirm.name }}
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
            users: '',
            users_list: '',
            user_temp: {user_id: '', confirm_id: ''},

        }
    },

    methods: {
        loadConfirm() {
            axios.get('api/confirms/all').then(({data}) => (this.confirms = data.data))
        },
        loadUser() {
            axios.get('api/user/all').then(({data}) => (this.users = data.data));
        },
        loadUserConfirms() {
            axios.get('api/usersConfirms/all').then(({data}) => (this.users_list = data.data));
        },
        saveUserConfirm(user_confirm) {
            axios.post('api/usersConfirms/store', {
                    user_id: user_confirm.user_id,
                    confirm_id: user_confirm.confirm_id
                }
            ).then((response) => {
                if (response.data.success) {
                    this.user_temp = {user_id: '', confirm_id: ''},
                        this.loadConfirm()
                    this.loadUserConfirms()
                    $("#modal-userConfirm .close").click()
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
                if (!error.response.data.status) {
                    Swal.fire({
                        heightAuto: false,
                        icon: 'error',
                        title: 'Error . . .',
                        text: 'Confirmation name is required'
                    })
                }

            })
        }
    },
    computed: {},
    created() {
        this.loadConfirm()
        this.loadUser()
        this.loadUserConfirms()
    },
    components: {
        Multiselect
    }

}
</script>

<style scoped>
#confirm_content {
    text-align: center;
    margin: 2%;
    padding: 1%;
    overflow-y: clip;
}

.box {
    position: relative;
    border-radius: 3px;
    background: #f7f7f7;
    border-top: 3px solid #d2d6de;
    margin-bottom: 20px;
    width: 100%;
    box-shadow: 0 1px 1px rgb(0 0 0 / 10%);
    height: 100vh;
    overflow-y: auto;
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
        display: none;
        /*position: absolute;*/
        /*top: -9999px;*/
        /*right: -9999px;*/
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

    #user_confirm td:nth-of-type(1):before {
        content: "Row";
    }

    #user_confirm td:nth-of-type(2):before {
        content: "Name";
    }

    #user_confirm td:nth-of-type(3):before {
        content: "Last name";
    }

    #user_confirm td:nth-of-type(4):before {
        content: "Confirmation name";
    }

    #user_confirm td:nth-of-type(5):before {
        content: "Actions";
    }
}
</style>

