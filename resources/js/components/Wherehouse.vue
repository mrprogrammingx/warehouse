<template>
    <div class="containe  r1 p-5 p-md-5 pt-4 height-100 w-100">


        <!-- Send by courier Modal//////////////////////////////-->
        <div class="modal" tabindex="-1" id="modal_peyk">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Send by courier</h5>
                        <button type="button" class="close ml-0" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body form-group text-right">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <input v-model="peyk_temp.type_send" type="radio" name="select_send"
                                       class="option-input radio ml-2" value="manual">
                                <label class="my-auto"> Manual selection </label>
                            </div>
                            <div class="col-6 d-flex align-items-center">
                                <input v-model="peyk_temp.type_send" type="radio" name="select_send"
                                       class="option-input radio ml-2" value="auto">
                                <label class="my-auto"> Automatic selection </label>
                            </div>
                            <div v-if="peyk_temp.type_send=='manual'" class="col-10 mt-3">
                                <multiselect v-model="peyk_id" :options="peyks.map(type => type.id)"
                                             :custom-label="opt => peyks.find(x => x.id == opt).first_name+' '+peyks.find(x => x.id == opt).last_name+' '+peyks.find(x => x.id == opt).personnel_code"
                                             :showLabels="false" placeholder="Courier name" @input="SetObj"></multiselect>

                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Cancel
                        </button>
                        <button type="button" class="btn btn-primary" @click="sendPeyk">Send</button>
                    </div>
                </div>
            </div>
        </div>


        <!--    The print modal    ////////////////////////////////-->
        <div id="printMe" dir="rtl">
            <div class="modal p-2" tabindex="-1" id="modal-print" role="dialog" aria-labelledby="modal-print"
                 aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <div class="modal-header">
                            <div class="row w-100 justify-content-center align-items-center">
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


        <!-- Show details Modal   ///////////////////////////////////////-->
        <div class="modal" tabindex="-1" id="modal-details">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header float-left text-left">
                        <!--                        <h5 class="modal-title">Show details</h5>-->
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
                                        <i v-if="details.confirmed==1" class="badge badge-success">Approved</i></td>

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


        <!--    Referring the request Modal  //////////////////////////////  -->
        <div class="modal" tabindex="-1" id="reference">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Referring the request</h5>
                        <button type="button" class="close ml-0" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body form-group text-right">
                        <label>Choose the type of confirmation</label>
                        <multiselect v-model="reference_temp" track-by="name"
                                     placeholder="Select" :options="option_reference" :searchable="true"
                                     :custom-label="nameWithLang"
                                     :showLabels="false" @input="pushArrayReference">
                        </multiselect>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Cancel
                        </button>
                        <button type="button" class="btn btn-primary" @click="sendReference">Send</button>
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

        <div>
            <div class="radio">
                <input v-model="searchQuery" label="Cartable warehouse" type="radio" name="filter" value="1" checked>
                <input v-model="searchQuery" label="Cartable Courier" type="radio" name="filter" value="3">
                <input v-model="searchQuery" label="Courier delivery" type="radio" name="filter" value="4">
                <input v-model="searchQuery" label="All" type="radio" name="filter" value="">
            </div>
            <div>
                <h4 class="mb-4  my-font-size">Cartable warehouse</h4>
                <div class="search-box mr-5">
                    <h5 class="d-inline-flex">Search:</h5>
                    <button class="btn-search"><i class="fas fa-search"></i></button>
                    <input type="text" class="input-search" v-model="searchQuery2"
                           placeholder="Search...">
                </div>
            </div>
        </div>
        <div class="text-center scroll">
            <table id="table_status" class="table table-bordered style_table">
                <thead>
                <tr>
                    <th>Row</th>
                    <th>Requested unit</th>
                    <th>Request number</th>
                    <th>Date</th>
                    <th>Confirmation status</th>
                    <th>Request stage</th>
                    <th>Descriptions</th>
                    <th>referral</th>
                    <th>Send by courier</th>
                    <th>Delivery receipt print</th>
                    <th>Show details</th>
                    <th v-if="searchQuery==1 || searchQuery==2">Actions</th>
                </tr>
                </thead>
                <tbody id="tbody_status">
                <tr v-if="request_all!=''" v-for="(request,index) in resultQuery" :key="index">
                    <td label="Row">{{ index + 1 }}</td>
                    <td label="Requested unit">{{ request.unit.name }}</td>
                    <td label="Request number">{{ request.request_number }}</td>
                    <td label="Date">
                        {{ convertDate(request.created_at) }}
                    </td>
                    <td label="Confirmation status">
                        <i v-if="request.confirmed==null" class="badge badge-warning">Awaiting confirmation</i>
                        <i v-if="request.confirmed==0" class="badge badge-danger">Not approved</i>
                        <i v-if="request.confirmed==1" class="badge badge-success">approved</i>
                    </td>

                    <td label="Request stage">
                        <i class="badge badge-info"
                           :class="{ 'badge-danger': request.status.id==5 , 'badge-warning': request.status.id==1}">{{
                                request.status.name
                            }}</i>
                    </td>
                    <td label="Descriptions">
                        <textarea class="form-control" disabled>{{request.descriptions}}</textarea>
                    </td>
                    <td label="referral">
                        <button type="button" class="btn btn-primary btn-table" data-toggle="modal"
                                data-target="#reference" @click="sendAll(request.id)"
                                :disabled="request.status.id!=1 && request.status.id!=2">
                            <i class="fas fa-share-square"></i>
                        </button>
                    </td>
                    <td label="Send by courier">
                        <button v-if="request.request_detail[0].delivery==''" type="button"
                                class="btn btn-primary btn-table" @click="sendDelivery(request.id)"
                                :disabled="!request.confirmed || request.status.id!=1 && request.status.id!=2">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                        <label v-else-if="request.request_detail[0].delivery!=''"
                               class="badge badge-info">{{
                                request.request_detail[0].delivery[0].user.first_name + " " + request.request_detail[0].delivery[0].user.last_name
                            }}</label>

                    </td>
                    <td label="Delivery receipt print">
                        <button type="button" class="btn btn-primary btn-table" data-toggle="modal"
                                data-target="#modal-print" @click="request_info(request.id)">
                            <i class="fas fa-print"></i>
                        </button>

                    </td>
                    <td label="Show details">

                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#modal-details" @click="request_info(request.id)"> Show details
                        </button>
                    </td>
                    <td label="Actions" v-if="searchQuery==1 || searchQuery==2">
                        <div>
                            <button type="button" class="btn btn-sm btn-danger inline-block" @click="cancel(request.id)"> Cancel
                            </button>
                            <router-link :to="{name:'edit_request',params:{id:request.id}}" class="btn btn-sm btn-warning inline-block mb-1 pr-2 py-1">
                                <span>Edit</span>
                            </router-link>
                        </div>

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
import moment from 'moment-jalaali';
import request from "./Request";

export default {
    name: "wherehouse",
    data() {
        return {
            request_all: '',
            printObj: {
                id: "printMe",
            },
            request_id: 0,
            reference_temp: '',
            option_reference: [],
            peyk_temp: {peyk_id: '', type_send: ''},
            details_id_array: [],
            allSelected: false,
            temp_request: [],
            peyks: [],
            peyk_id: '',
            count_details_array: 0,
            reference_array: [],
            file_array: null,
            details_confirm: [],
            searchQuery: 1,
            searchQuery2: '',
        }
    }, methods: {

        loadRequest() {
            axios.get('api/requests/getAllIsNotArchiveAndCancelStatus').then(({data}) => (this.request_all = data.data))
        },
        convertDate(date) {
            return moment(date).utc("jYYYY-jMM-jDDTHH:mm:ss.SSZ").format("jYYYY-jMM-jDD HH:mm:ss")
        },
        request_info(request_id) {

            for (let i = 0; i < this.request_all.length; i++) {
                if (this.request_all[i].id == request_id) {
                    this.request_id = i;
                }
            }
        },
        sendPeyk() {
            if (this.temp_request != null) {
                axios.put('api/requestdetails/updateDeliveryId', this.temp_request
                ).then((response) => {
                    if (response.data.success) {
                        this.loadRequest()
                        $("#modal_peyk .close").click()
                        Swal.fire({
                            heightAuto: false,
                            position: 'center',
                            icon: 'success',
                            title: 'Saved succussfully',
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
        },
        SetObj() {
            this.temp_request = []
            for (let i = 0; i < this.details_id_array.length; i++) {
                this.temp_request.push({
                    id: this.details_id_array[i],
                    delivery_id: this.peyk_id
                })
            }
        },
        close_modal() {
            $("#modal-details .close").click()
        },
        loadPeyk() {
            axios.get('api/user/all').then(({data}) => (this.peyks = data.data));
        },
        saveConfirme() {
            axios.put('/api/requestDetailsConfirms/updateByRequestDetailUserConfirmId', this.confirm_temp
            ).then((response) => {
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
        loadUserConfirm() {
            axios.get('api/usersConfirms/userId').then(({data}) => (this.user_confirm = data.data));
        },
        selectAll() {
            if (this.allSelected) {
                for (let i = 0; i < this.request_all[this.request_id].request_detail.length; i++) {
                    this.details_id_array.push(this.request_all[this.request_id].request_detail[i].id)
                }
            } else {
                this.details_id_array = []
            }
        },
        nameWithLang({confirm, user}) {
            return `${confirm.name} - ${user.first_name} ${user.last_name}`
        },
        getLoadConfirmAll() {

            axios.get('api/usersConfirms/all').then(({data}) => (this.option_reference = data.data));

        },
        pushArrayReference() {
            this.reference_array = []
            for (let i = 0; i < this.details_id_array.length; i++) {
                this.reference_array.push({
                    requests_detail_id: this.details_id_array[i],
                    confirm_id: this.reference_temp.confirm_id,
                    user_id: this.reference_temp.user_id
                })
            }
        },
        sendReference() {
            if (this.reference_temp == '') {
                Swal.fire({
                    heightAuto: false,
                    icon: 'error',
                    title: 'Error . . .',
                    text: "Please select a confirmation type first"
                })
            } else {
                axios.post('api/requestDetailsConfirms/store', this.reference_array).then((response) => {
                    if (response.data.success) {
                        this.loadRequest()
                        $("#reference .close").click()
                        Swal.fire({
                            heightAuto: false,
                            position: 'center',
                            icon: 'success',
                            title: response.data.message,
                            showConfirmButton: false,
                            timer: 1500
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
            }

        },
        sendAll(request_id) {
            this.request_info(request_id)
            this.details_id_array = []
            this.reference_temp = ''
            for (let i = 0; i < this.request_all[this.request_id].request_detail.length; i++) {
                this.details_id_array.push(this.request_all[this.request_id].request_detail[i].id)
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
        },
        disable_btn(details) {
            if (details.file_request_detail != '') {
                return false
            } else {
                return true
            }
        },
        sendDelivery(requestID) {
            Swal.fire({
                title: 'Are you sure about sending by courier?',
                text: "Confirmation of sending means warehouse confirmation of inventory",
                icon: 'warning',
                confirmButtonColor: '#28a745',
                showCancelButton: true,
                confirmButtonText: 'Confirmation',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.put('api/requests/statusRequestAndItsRequestDetails/3', {requestId: requestID}
                    ).then((response) => {
                        if (response.data.success) {
                            this.loadRequest()
                            Swal.fire({
                                heightAuto: false,
                                position: 'center',
                                icon: 'success',
                                title: 'Submitted successfully',
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
                }
            })
        },
        getLoadConfirm(detailsID) {

            axios.get('api/requestDetailsConfirms/confirmsOfRequestDetail', {
                params: {
                    'requests_detail_id': detailsID,
                }
            }).then(({data}) => (this.details_confirm = data.data));

        },
        cancel(request_id) {
            Swal.fire({
                title: 'Are you sure you want to cancel?',
                icon: 'question',
                confirmButtonColor: '#ea3f3f',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'Close'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.put('api/requests/statusRequestAndItsRequestDetails/5', {requestId: request_id}
                    ).then((response) => {
                        if (response.data.success) {
                            this.loadRequest()
                            Swal.fire({
                                heightAuto: false,
                                position: 'center',
                                icon: 'success',
                                title: 'Canceled succussfully',
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
                }
            })
        }
    }
    ,
    components: {
        Multiselect
    },
    computed: {
        resultQuery() {
            if ((this.searchQuery != '' || this.searchQuery2 != '') && this.request_all) {
                return this.request_all.filter(item => {
                    const filter = this.searchQuery;
                    const filter2 = this.searchQuery2;
                    var status = '';
                    if (this.searchQuery == 1) {
                        status = String(item.status.id).includes(1) || String(item.status.id).includes(2);
                    } else {
                        status = String(item.status.id).includes(filter);
                    }
                    const request_number = String(item.request_number).includes(filter2);
                    const date = String(item.date).includes(filter2);
                    const unit = String(item.unit.name).includes(filter2);
                    if (this.searchQuery2 != '') {
                        return request_number || date || unit
                    } else {

                        return status

                    }
                });
            } else if (this.searchQuery == '' && this.searchQuery2 == '' && this.request_all) {
                return this.request_all;
            }
        }
    },
    created() {
        this.loadRequest()
        this.loadPeyk()
        this.getLoadConfirmAll()
    }
}

</script>


<style scoped>

#table_status {
    font-size: 13px;
}
.my-font-size{
    display: inline-block;
}
#printMe {
    direction: rtl;
    text-align: center;
}

.badge {
    font-weight: 400;
    font-size: 14px;
}

.scroll {
    height: 90%;
    overflow-y: scroll;
}

.fa-info-circle {
    color: #69a3c5;
}

.fa-info-circle:hover {
    color: #007cc5;
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

</style>

