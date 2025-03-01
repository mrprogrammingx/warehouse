<template>
    <div class="containe  r1 p-5 p-md-5 pt-4 height-100 w-100">

        <div id="printMe">
            <div class="modal p-2" tabindex="-1" id="modal-print" role="dialog" aria-labelledby="modal-print"
                 aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <div class="modal-header">
                            <div class="row w-100">
                                <div class="col-4 d-flex">
                                    <!--                                    <h5 v-if="request_all">-->
                                    <!--                                        {{ request_all[request_id].request_detail[0].warehouse.name }}</h5>-->

                                    <div class="img_print">
                                        <span><img src="/images/ardakan.png"></span>
                                        <span class="img-font">
                                                    					Warehouse Software
                                                    					</span>
                                        <span class="img-font">Warehouse Software</span>
                                    </div>

                                </div>
                                <div class="col-4">
                                    <h2 class="print-head">Delivery receipt</h2>
                                </div>
                                <div class="col-4 text-center">
                                    <h5 class="inline">Date:</h5>
                                    <h5 v-if="request_all!=''" class="inline">
                                        {{ convertDate(request_all[request_id].created_at) }}</h5>
                                    <h5 v-if="request_all!=''" class="d-block">
                                        {{ request_all[request_id].request_detail[0].warehouse.name }}</h5>
                                </div>
                            </div>

                            <button type="button" class="close ml-0" data-dismiss="modal" aria-label="Close">
                                <!--                                <span aria-hidden="true">&times;</span>-->
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table table-bordered style_table">
                                    <thead>
                                    <tr>
                                        <th>
                                           Row
                                        </th>
                                        <th>Products name</th>
                                        <th>Count</th>
                                        <th>Requested unit</th>
                                        <th>Cost center</th>
                                        <th>Confirmation status</th>
                                        <th>Descriptions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <template v-if="request_all!=''">
                                        <tr v-for="(print,index) in request_all[this.request_id].request_detail"
                                            :key="index">
                                            <td label="Row">
                                                {{ index + 1 }}
                                            </td>
                                            <td label="Products name">
                                                {{ print.product.name }}
                                            </td>
                                            <td label="Count">
                                                {{ print.amount }}
                                            </td>
                                            <td label="Requested unit">
                                                {{ request_all[request_id].unit.name }}
                                            </td>
                                            <td label="Cost center">
                                                <label v-if="print.center"> {{ print.center.name }}</label>

                                            </td>
                                            <td label="Confirmation status">
                                                <i v-if="print.confirmed==null">Awaiting confirmation</i>
                                                <i v-if="print.confirmed==0">Not approved</i>
                                                <i v-if="print.confirmed==1" >approved</i>
                                            </td>
                                            <td label="Descriptions">
                                                {{ print.descriptions }}
                                            </td>
                                        </tr>
                                    </template>

                                    </tbody>
                                </table>
                            </div>

                            <div class="row text-right p-3">
                                <p class="inline">Delivery address:</p>
                                <p class="inline"></p>
                            </div>

                            <div class="row m-0 mt-xl-3 text-center">
                                <div class="col-4 border">

                                    <div class="signature">
                                        <p>Warehouse manager</p>
                                    </div>
                                </div>

                                <div class="col-4 border">

                                    <div class="signature">
                                        <p>Courier in charge</p>
                                    </div>
                                </div>

                                <div class="col-4 border">

                                    <div class="signature">
                                        <p>Receiver</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button v-print="printObj" type="button" id="btnPrint"
                                    class="btn btn-primary">Print
                            </button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


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
                                                :disabled="disable_btn(details)">Show
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
                                        <td label="Name of the approver" v-if="confirm.user!=null">
                                            {{ confirm.user.first_name }} {{ confirm.user.last_name }}
                                        </td>
                                        <td label="Name of the approver" v-if="confirm.user==null">
                                            Unknown
                                        </td>
                                        <td label="Confirmation name" v-if="confirm.confirm.name!=null">
                                            {{ confirm.confirm.name }}
                                        </td>
                                        <td label="Confirmation status">
                                            <i v-if="confirm.confirmed==null" class="badge badge-warning">Awaiting confirmation
                                                approved</i>
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
<!--        //////////////////////////////-->
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

        <h4 class="mb-4">Canceled requests</h4>
        <div class="text-center scroll">
            <table id="table_status" class="table table-bordered text-center style_table">
                <thead>
                <tr>
                    <th>Row</th>
                    <th>Requested unit</th>
                    <th>Request number</th>
                    <th>Date</th>
                    <th>Request Status</th>
                    <th>Descriptions</th>
                    <th>Delivery receipt print</th>
                    <th>Show details</th>
                </tr>
                </thead>
                <tbody id="tbody_status">
                <tr v-for="(request,index) in request_all" :key="index">
                    <td label="Row">{{ index + 1 }}</td>
                    <td label="Requested unit">{{ request.unit.name }}</td>
                    <td label="Request number">{{ request.request_number }}</td>
                    <td label="Date">{{convertDate(request.created_at)}}</td>
                    <td label="Request Status">
                        <i v-if="request.confirmed==null" class="badge badge-warning">Awaiting confirmation</i>
                        <i v-if="request.confirmed==0" class="badge badge-danger">Not approved</i>
                        <i v-if="request.confirmed==1" class="badge badge-success">approved</i>
                    </td>
                    <td label="Descriptions">
                        <textarea class="form-control" disabled>{{request.descriptions}}</textarea>
                    </td>
                    <td label="Delivery receipt print">
                        <button type="button" class="btn btn-primary btn-table" data-toggle="modal"
                                data-target="#modal-print" @click="request_info(index)">
                            <i class="fas fa-print"></i>
                        </button>

                    </td>
                    <td label="Show details">

                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#modal-details" @click="request_info(index)"><i
                            class="fas fa-info-circle"></i> Show details
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
import moment from "moment-jalaali";

export default {
    name: "cancel",
    data() {
        return {
            request_all: '',
            printObj: {
                id: "printMe",
            },
            request_id: 0,
            details_id_array: [],
            count_details_array: 0,
            file_array: null,
            item_array:[],
            details_confirm:''
        }
    }, methods: {
        convertDate(date){
            return  moment(date).utc("jYYYY-jMM-jDDTHH:mm:ss.SSZ").format("jYYYY-jMM-jDD HH:mm:ss")
        },
        loadRequest() {
            axios.get('api/requests/getAllCancelStatus').then(({data}) => (this.request_all = data.data))
        },
        request_info(index) {
            this.request_id = index;
        },

        close_modal() {
            $("#modal-details .close").click()
        },
        getLoadConfirm(detailsID) {

            axios.get('api/requestDetailsConfirms/confirmsOfRequestDetail', {
                params: {
                    'requests_detail_id': detailsID,
                }
            }).then(({data}) => (this.details_confirm = data.data));

        },
        showFile(details) {
            this.file_array = details.file_request_detail;
        },
        downloadFile(file_id){
            axios.get('/file-download',{params:{ 'fileId':file_id}
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
        },

        clearForm(){
            this.item_array=[]
        },
    }, components: {
        Multiselect
    },
    created() {
        this.loadRequest()
    }
}

</script>


<style scoped>

#printMe {
    direction: rtl;
    text-align: center;
}

.badge {
    font-weight: 400;
    font-size: 14px;
}

.scroll{
    height: 90%;
    overflow-y: scroll;
}
textarea{
    height: 40px;
}
</style>

