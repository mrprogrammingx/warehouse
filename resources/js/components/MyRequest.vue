<template>
    <div class="containe  r1 p-5 p-md-5 pt-4 height-100 w-100">


        <div class="modal" tabindex="-1" id="modal-details">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header float-left text-left">
                        <button type="button" class="close ml-0" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body form-group text-right">
                        <table id="table-information" class="table table-striped table-bordered text-center style_table">
                            <thead>
                            <tr>
                                <th colspan="10"><h4>Show details</h4></th>

                            </tr>
                            <tr>
                                <th>Row</th>
                                <th>Products name</th>
                                <!--                                <th>Products specification</th>-->
                                <th>Count</th>
                                <th>Requested unit</th>
                                <th>Cost center</th>
                                <th>Warehouse</th>
                                <th>Request Status</th>
                                <th>Show confirmations</th>
                                <th>Descriptions</th>
                                <th>File</th>
                            </tr>
                            </thead>
                            <tbody>
                            <template v-if="request_all!=''">
                                <tr v-if="request_all[request_id].request_detail!=''"
                                    v-for="(details,index) in request_all[request_id].request_detail" :key="index">
                                    <td label="Row">{{ index + 1 }}</td>
                                    <td label="Products name">{{ details.product.name }}</td>
                                    <td label="Count">{{ details.amount }}</td>
                                    <td label="Requested unit">{{ request_all[request_id].unit.name }}</td>
                                    <td label="Cost center">
                                        <label v-if="details.center">
                                            {{ details.center.name}}
                                        </label>

                                    </td>
                                    <td label="Warehouse">{{ details.warehouse.name }}</td>
                                    <td label="Request Status"><i v-if="details.confirmed==null" class="badge badge-warning">Awaiting confirmation</i>
                                        <i v-if="details.confirmed==0" class="badge badge-danger">Not approved</i>
                                        <i v-if="details.confirmed==1" class="badge badge-success">approved</i></td>

                                    <td label="Show confirmations">
                                        <i class="fa fa-info-circle fa-2x" data-toggle="modal"
                                           data-target="#show_confirm" @click="getLoadConfirm(details.id)"></i>
                                    </td>
                                    <td label="Descriptions">
                                        <textarea class="form-control" rows="4" cols="50" disabled>{{details.descriptions}}</textarea>

                                    </td>
                                    <td label="File">
                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                                data-target="#modal_file" @click="showFile(details)"
                                                :disabled="disable_btn(details)">show
                                        </button>
                                    </td>
                                </tr>
                            </template>
                            </tbody>
                        </table>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!--        /////////////////////////////////////////////////////////////-->


        <!--        //////////////////////////// modal file-->
        <div class="modal fade" id="modal_file" tabindex="-1" role="dialog" aria-labelledby="modal_file"
             aria-hidden="true">
            <div class="modal-dialog d-flex" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Files list</h5>
                    </div>
                    <div class="modal-body">

                        <div>
                            <table id="file_table" class="table table-bordered style_table">
                                <thead>
                                <tr>
                                    <th>
                                        Row
                                    </th>
                                    <th>
                                       File name
                                    </th>
                                    <th>
                                        Descriptions
                                    </th>
                                    <th>
                                       Preshow
                                    </th>
                                    <th>
                                        Download
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-if="file_array!=null" v-for="(file,index) in file_array" :key="index">
                                    <td label="Row">
                                        {{ index + 1 }}
                                    </td>
                                    <td label="File name">
                                        {{ file.file.name }}
                                    </td>
                                    <td label="Descriptions">
                                        {{ file.file.description }}
                                    </td>
                                    <td label="Preshow">

                                        <div class="preview">

                                            <a :href="'/file-show?fileId='+ file.file_id" target="_blank">
                                                <img class="size_img" :src="'/file-show?fileId='+ file.file_id"
                                                     alt="Open"/>
                                            </a>
                                        </div>
                                    </td>
                                    <td label="Download">
                                        <a :href="'/file-download?fileId='+ file.file_id"
                                           class="btn btn-sm btn-primary">Download</a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Show confirmations Modal   ///////////////////////////// -->
        <div class="modal fade" id="show_confirm" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Show confirmations</h5>
                        <button type="button" class="close ml-0" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <table class="table table-bordered style_table">
                                <thead>
                                <tr>
                                    <th>
                                        Row
                                    </th>
                                    <th>
                                        Name of the approver
                                    </th>
                                    <th>
                                        Confirmation name
                                    </th>
                                    <th>
                                        Confirmation status
                                    </th>
                                    <th>
                                        Descriptions
                                    </th>
                                    <th>
                                        Date
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <template v-if="details_confirm!=''">
                                    <tr v-for="(confirm,index) in details_confirm" :key="index">
                                        <td label="Row">
                                            {{ index + 1 }}
                                        </td>
                                        <td label="Name of the approver v-if="confirm.user!=null">
                                            {{ confirm.user.first_name }} {{ confirm.user.last_name }}
                                        </td>
                                        <td label="Name of the approver v-if="confirm.user==null">
                                            Unknown
                                        </td>
                                        <td label="Confirmation name" v-if="confirm.confirm.name!=null">
                                            {{ confirm.confirm.name }}
                                        </td>
                                        <td label="Confirmation status">
                                            <i v-if="confirm.confirmed==null" class="badge badge-warning">Awaiting confirmation</i>
                                            <i v-if="confirm.confirmed==0" class="badge badge-danger">Not approved</i>
                                            <i v-if="confirm.confirmed==1" class="badge badge-success">approved</i>
                                        </td>
                                        <td label="Descriptions">
                                            <textarea class="form-control" rows="4" cols="50" disabled>{{confirm.description}}</textarea>

                                        </td>
                                        <td label="Date">
                                            {{ confirm.updated_at }}
                                        </td>
                                    </tr>
                                </template>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!--/////////////////////////////////////////////////////-->
<div>
        <div class="radio">
            <input v-model="searchQuery" label="In process" type="radio" name="filter" value="1" checked
                   @click="progress">
            <input v-model="searchQuery" label="Canceled" type="radio" name="filter" value="5" @click="progress">
            <input label="Archive" type="radio" name="filter" @click="archive">
        </div>
        <div>
            <h4 class="mb-4 my-font-size">My requests</h4>
        </div>
</div>
        <div class="text-center scroll">
            <table id="table_status" class="table table-bordered style_table">
                <thead>
                <tr>

                    <th>Request number</th>
                    <th>Requested unit</th>
                    <th>Date</th>
                    <th>Confirmation status</th>
                    <th>Request stage</th>
                    <th>Descriptions</th>
                    <th>Delivery code</th>
                    <th>Show details</th>
                </tr>
                </thead>
                <tbody id="tbody_status">
                <tr v-for="(request,index) in resultQuery" :key="index">

                    <td label="Request number">{{ request.request_number }}</td>
                    <td label="Requested unit">{{ request.unit.name }}</td>
                    <td label="Date">
                        {{convertDate(request.created_at)}}
                    </td>

                    <td label="Confirmation status">
                        <i v-if="request.confirmed==null" class="badge badge-warning">Awaiting confirmation</i>
                        <i v-if="request.confirmed==0" class="badge badge-danger">Not approved</i>
                        <i v-if="request.confirmed==1" class="badge badge-success">approved</i>
                    </td>
                    <td label="Request stage">
                        <i class="badge badge-info"
                           :class="{ 'badge-danger': request.status.id==5 , 'badge-warning': request.status.id==1}">{{ request.status.name }}</i>
                    </td>
                    <td label="Descriptions">
                        <textarea class="form-control" disabled>{{request.descriptions}}</textarea>
                    </td>
                    <td label="Delivery code">
                        {{ request.validated_code }}
                    </td>
                    <td label="Show details">

                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#modal-details" @click="request_info(request.id)"> Show details
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

    </div>
</template>

<script>
import Multiselect from 'vue-multiselect'
import Swal from "sweetalert2";
import moment from 'moment-jalaali'
export default {
    name: "myrequest",
    data() {
        return {
            request_all: '',
            details_confirm: [],
            request_id: 0,
            details_id_array: [],
            file_array: null,
            searchQuery: 1,
        }
    }, methods: {
        // loadRequest() {
        //     axios.get('api/requests/user').then(({data}) => (this.request_all = data.data))
        // },
        request_info(request_id) {
            for (let i = 0; i < this.request_all.length; i++) {
                if (this.request_all[i].id == request_id) {
                    this.request_id = i;
                }
            }
        },
        showFile(details) {
            this.file_array = details.file_request_detail;
        },
        downloadFile(file_id) {
            axios.get('/file-download', {
                params: {'fileId': file_id}
            }).then((response) => {
                if (response.data.success) {
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
                        text: error.response.data.message
                    })
                }

            })
        }
        ,
        disable_btn(details) {
            if (details.file_request_detail != '') {
                return false
            } else {
                return true
            }
        },
        getLoadConfirm(detailsID) {
            axios.get('api/requestDetailsConfirms/confirmsOfRequestDetail', {
                params: {
                    'requests_detail_id': detailsID,
                }
            }).then(({data}) => (this.details_confirm = data.data));

        },
        progress() {
            axios.get('api/requests/notArchivedRequestsOfUserId').then(({data}) => (this.request_all = data.data.data))
        },
        archive() {
            axios.get('api/requests/archivedRequestsOfUserId').then(({data}) => (this.request_all = data.data))
        },
        convertDate(date){
        return  moment(date).utc("jYYYY-jMM-jDDTHH:mm:ss.SSZ").format("jYYYY-jMM-jDD HH:mm:ss")
        }
    }, components: {
        Multiselect
    },
    computed: {
        resultQuery() {
            if (this.request_all) {
                return this.request_all.filter(item => {
                    const filter = this.searchQuery;
                    const progress = String(item.status.id).includes(1) || String(item.status.id).includes(2) || String(item.status.id).includes(3) || String(item.status.id).includes(4);
                    const cancel = String(item.status.id).includes(filter);
                    if (this.searchQuery == 1) {
                        return progress
                    }
                    else if (this.searchQuery == 5)
                    {
                        return cancel
                    }
                });

            }

        }
    },
    created() {
        this.progress()
    }

}
$(window).on('popstate', function() {
    $('.modal').click();
});
</script>


<style scoped>
.container {
    display: flex;
    flex-direction: column;
    align-items: center;
}

#table_status {
    font-size: 13px;
}

.badge {
    font-weight: 400;
    font-size: 14px;
}

.fa-info-circle {
    color: #69a3c5;
}

.fa-info-circle:hover {
    color: #007cc5;
}

.scroll {
    height: 90%;
    overflow-y: scroll;
}

.radio {
    float: left;
    background: #454857;
    padding: 4px;
    border-radius: 3px;
    box-shadow: inset 0 0 0 3px rgba(35, 33, 45, 0.3),
    0 0 0 3px rgba(185, 185, 185, 0.3);
    position: relative;
}

.radio input {
    width: auto;
    height: 100%;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    outline: none;
    cursor: pointer;
    border-radius: 2px;
    padding: 4px 8px;
    background: #454857;
    color: #bdbdbdbd;
    font-size: 14px;
    transition: all 100ms linear;
}

.radio input:checked {
    background-image: linear-gradient(180deg, #91a7d8, #7482bb);
    color: #fff;
    box-shadow: 0 1px 1px #0000002e;
    text-shadow: 0 1px 0px #79485f7a;
}

.radio input:before {
    content: attr(label);
    display: inline-block;
    text-align: center;
    width: 100%;
}

textarea {
    height: 40px;
}
#table-information{
    font-size: 13px;
}
</style>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

