<template>
    <div class="containe  r1 p-5 p-md-5 pt-4 height-100 w-100">

        <div class="radio">
            <input v-model="searchQuery" label="Awaiting confirmation" type="radio" name="filter" value="null" checked>
            <input v-model="searchQuery" label="Archive" type="radio" id="send" name="filter" value="">
        </div>
        <h4 class="mb-4 my-font-size">Request Status</h4>
        <div class="text-center scroll">
            <table id="table_status" class="table table-bordered style_table">
                <thead>
                <tr>
                    <th>Row</th>
                    <th>Requested unit</th>
                    <th>Request number</th>
                    <th>Date</th>
                    <th>Request Status</th>
                    <th>Descriptions</th>
                    <th>Show details</th>
                </tr>
                </thead>
                <tbody id="tbody_status">
                <tr v-if="request_all!=null" v-for="(request,index) in resultQuery" :key="index">
                    <td label="Row">{{ index + 1 }}</td>
                    <td label="Requested unit">{{ request.unit.name }}</td>
                    <td label="Request number">
                        <label>{{request.request_number}}</label>
                    </td>
                    <td label="Date">{{convertDate(request.created_at)}}</td>

                    <td label="Request Status">
                        <i v-if="request.confirmed==null" class="badge badge-warning">Awaiting confirmation</i>
                        <i v-if="request.confirmed==0" class="badge badge-danger">Not approved</i>
                        <i v-if="request.confirmed==1" class="badge badge-success">approved</i>
                    </td>
                    <td label="Descriptions">
                        <textarea class="form-control" disabled>{{request.description}}</textarea>
                    </td>
                    <td label="Show details">

                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#modal-details" @click="request_info2(request.id)"> Show details
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>






        <!-- Show details Modal   ///////////////////////////////////////-->
        <div class="modal" id="modal-details" aria-labelledby="modal-details">
            <div class="modal-dialog modal-xl" role="dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Show details</h5>
                        <button type="button" class="close ml-0" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body form-group text-right">
                        <table id="table-information" class="table  table-bordered style_table">
                            <thead class="text-center">
                            <tr>
                                <th colspan="100"><h4>Show details</h4></th>

                            </tr>
                            <tr>

                                <th>Row</th>
                                <th>Products name</th>
                                <th>Count</th>
                                <th>Requested unit</th>
                                <th>Cost center</th>
                                <th>Warehouse</th>
                                <th>Request Status</th>
                                <th>Show confirmations</th>
                                <template v-for="(confirm,index) in user_confirm">
                                    <th class="text-nowrap">
                                        {{ confirm.confirm.name }}
                                        <br>
                                        <label class="contract_toggle">
                                            <input v-model="select_val[index]" type="checkbox" name="contract_toggle"
                                                   @change="selectAll(confirm,select_val[index],index)"/>
                                            <span class="toggle_bar">
                                            <span class="toggle_square"></span>
                                              </span>
                                        </label>

                                    </th>
                                </template>
                                <th data-label="referral">
                                    referral
                                </th>

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

                                        <label v-if="details.center">{{ details.center.name}}</label>
                                    </td>
                                    <td label="Warehouse">{{ details.warehouse.name }}</td>
                                    <td label="Request Status"><i v-if="details.confirmed==null" class="badge badge-warning">Awaiting confirmation</i>
                                        <i v-if="details.confirmed==0" class="badge badge-danger">Not approved</i>
                                        <i v-if="details.confirmed==1" class="badge badge-success">approved</i></td>
                                    <td label="Show confirmations">
                                        <i class="fa fa-info-circle fa-2x" data-toggle="modal"
                                           data-target="#show_confirm" @click="getLoadConfirm(details.id)"></i>
                                    </td>
                                    <template v-for="(confirm,num) in user_confirm">
                                        <td :label="confirm.confirm.name" class="text-nowrap">
                                            <div>
                                                <div v-if="findInRequestDetails(details,confirm.confirm.id)"
                                                     class="checkbox-custom">
                                                    <label v-if="confirm_temp!=''" class="d-flex justify-content-start align-items-center">
                                                        <input
                                                            v-model="confirm_temp[findModel(details,confirm.confirm.id)].confirmed"
                                                            type="radio" :name="'select_send'+index+num"
                                                            class="option-not ml-2" :value="0"
                                                            @click="enterDescription(findModel(details,confirm.confirm.id))">
                                                        <b></b>
                                                        <small>Not approved</small>
                                                    </label>
                                                </div>
                                                <div v-if="findInRequestDetails(details,confirm.confirm.id)"
                                                     class="checkbox-custom">
                                                    <label v-if="confirm_temp!=''" class="d-flex justify-content-start align-items-center">
                                                        <input
                                                            v-model="confirm_temp[findModel(details,confirm.confirm.id)].confirmed"
                                                            type="radio" :name="'select_send'+index+num"
                                                            class="option-input ml-2" :value="1">
                                                        <b></b>
                                                        <small>approved</small>
                                                    </label>
                                                </div>

                                            </div>
                                        </td>
                                    </template>
                                    <td label="referral">
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#reference" @click="request_info(details.id)">
                                            <i class="fas fa-share-square"></i>
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
                        <button type="button" class="btn btn-success" @click="saveConfirme">
                            Submit confirmation
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!--        /////////////////////////////////////////////////////////////-->

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
                                            <i v-if="confirm.confirmed==1" class="badge badge-success">Approved</i>
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


        <!--    Referring the request Modal  //////////////////////////////  -->
        <div class="modal fade" id="reference">
            <div class="modal-dialog modal-dialog-centered">
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
                                     placeholder="Select" :options="option_reference" :searchable="true"  :custom-label="nameWithLang"
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



    </div>
</template>

<script>
import Multiselect from 'vue-multiselect'
import Swal from "sweetalert2";
import moment from "moment-jalaali";

export default {
    name: "status",
    data() {
        return {
            request_all: '',
            option_reference: [],
            printObj: {
                id: "printMe",
            },
            request_id: 0,
            reference_temp:'',
            details_id_array: [],
            allSelected: false,
            temp_request: [],
            user_confirm: [],
            confirm_temp: [],
            count_details_array: 0,
            select_val: [],
            details_confirm:[],
            request_confirm:[],
            reference_array:[],
            searchQuery: 'null',

        }
    }, methods: {
        convertDate(date){
            return  moment(date).utc("jYYYY-jMM-jDDTHH:mm:ss.SSZ").format("jYYYY-jMM-jDD HH:mm:ss")
        },
        loadRequest() {
            axios.get('api/requests/confirms/user').then(({data}) => (this.request_all = data.data))
        },
        request_info(requestDetailsID) {
            this.request_details_id = requestDetailsID;
            this.getLoadConfirmAll()
        },
        request_info2(request_id) {
            for(let i=0;i<this.request_all.length;i++)
            {
                if(this.request_all[i].id==request_id)
                {
                    this.request_id=i;
                }
            }
            this.confirm_temp=[];
            this.loadUserConfirm();

        },
        SetObj() {
            this.temp_request = []
            for (let i = 0; i < this.details_id_array.length; i++) {
                this.temp_request.push({
                    peyk_id: this.request_all[this.request_id].user_id,
                    details_id: this.details_id_array[i]
                })
            }
        },
        selectAll(confirm, val,index) {

            for (let i = 0; i < this.confirm_temp.length; i++) {
                if (confirm.confirm.id == this.confirm_temp[i].confirm_id) {
                    if (val) {
                        this.confirm_temp[i].confirmed = 1;
                    } else {
                       this.enterDescriptionForAll(confirm.confirm.id,index)
                    }

                }
            }
        },
        findInRequestDetails(details, val) {
            // this.confirm_temp=[]
            for (let i = 0; i < details.request_detail_confirm.length; i++) {
                if (val == details.request_detail_confirm[i].confirm_id) {
                    // this.confirm_temp.push({details_id:details.id,confirm_id:val,value:details.request_detail_confirm[i].confirmed,description:''})
                    return true;
                }
            }
        },
        createTemp() {

            for (let i = 0; i < this.request_all[this.request_id].request_detail.length; i++) {
                for (let j = 0; j < this.request_all[this.request_id].request_detail[i].request_detail_confirm.length; j++) {

                    for (let k = 0; k < this.user_confirm.length; k++) {

                        if (this.user_confirm[k].confirm_id == this.request_all[this.request_id].request_detail[i].request_detail_confirm[j].confirm_id) {
                            this.confirm_temp.push({
                                requests_detail_id: this.request_all[this.request_id].request_detail[i].id,
                                confirm_id: this.user_confirm[k].confirm_id,
                                confirmed: this.request_all[this.request_id].request_detail[i].request_detail_confirm[j].confirmed,
                                description: this.request_all[this.request_id].request_detail[i].request_detail_confirm[j].description,
                                requests_detail_confirm_id:this.request_all[this.request_id].request_detail[i].request_detail_confirm[j].id
                            });
                        }
                    }

                }


            }

        },
        findModel(details, confirm) {
            for (let i = 0; i < this.confirm_temp.length; i++) {
                if (confirm == this.confirm_temp[i].confirm_id && details.id == this.confirm_temp[i].requests_detail_id) {
                    return i;
                }
            }
        }
        ,
        saveConfirme() {
            for (let i=0;i<this.confirm_temp.length;i++)
            {
                if(this.confirm_temp[i].confirmed==null)
                {
                    this.confirm_temp.splice(i, 1);
                }
            }
            axios.put('/api/requestDetailsConfirms/updateByRequestDetailUserConfirmId', this.confirm_temp
            ).then((response) => {
                if (response.data.success) {
                    this.confirm_temp=[]
                    $("#modal-details .close").click()
                    this.loadRequest()
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
            axios.get('api/usersConfirms/userId').then(({data}) => (this.user_confirm = data.data, this.createTemp()));
        },
        enterDescription(i) {
            Swal.fire({
                icon: 'error',
                title: "Please explain the reason for the disapproval",
                input: 'text',
                inputValue: this.confirm_temp[i].description,
                showCancelButton: true,
                confirmButtonText: 'Submit',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    if(result.value!='') {
                        this.confirm_temp[i].description = result.value
                    }
                    else {
                            this.confirm_temp[i].confirmed=null
                    }
                }
                else {
                    if(result.value!='') {
                        this.confirm_temp[i].confirmed=null
                    }

                }

            });
        },
        enterDescriptionForAll(confirmID,index) {
            Swal.fire({
                icon: 'error',
                title: "Please explain the reason for the disapproval",
                input: 'text',
                inputValue: '',
                showCancelButton: true,
                confirmButtonText: 'Submit',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    if(result.value!='') {
                        for(let i=0;i<this.confirm_temp.length;i++)
                        {
                            if (confirmID == this.confirm_temp[i].confirm_id) {
                                this.confirm_temp[i].description = result.value
                                this.confirm_temp[i].confirmed = 0;
                            }
                        }
                    }
                }
                else {
                      this.select_val[index]=true;

                }
            });
        },
        getLoadConfirm(detailsID)
        {

            axios.get('api/requestDetailsConfirms/confirmsOfRequestDetail',{ params: {
                    'requests_detail_id': detailsID,
                }}).then(({data}) => (this.details_confirm = data.data));

        },
        getLoadConfirmAll()
        {
            axios.get('api/usersConfirms/all').then(({data}) => (this.option_reference = data.data));
        },
        nameWithLang({confirm,user}) {
            return `${confirm.name} - ${user.first_name} ${user.last_name}`
        },
        sendReference()
        {
            axios.post('api/requestDetailsConfirms/store', this.reference_array).then((response) => {
                $("#reference .close").click()
                Swal.fire({
                    heightAuto: false,
                    position: 'center',
                    icon: 'success',
                    title: response.data.message,
                    showConfirmButton: false,
                    timer: 1500
                })
            }).catch(error => {
                if (!error.response.success) {
                    Swal.fire({
                        icon: 'error',
                        text: error.response.data.message
                    })

                }
            })
        },
        pushArrayReference()
        {
            this.reference_array=[]
            this.reference_array.push({
                requests_detail_id:this.request_details_id,
                confirm_id:this.reference_temp.confirm_id,
                user_id:this.reference_temp.user_id
            })
        }
    }, components: {
        Multiselect
    },
    computed: {
        resultQuery() {
            if (this.searchQuery && this.request_all) {
                return this.request_all.filter(item => {
                    const filter = this.searchQuery;
                    const confirm = String(item.confirmed).includes(filter);
                    return confirm
                });
            } else if (this.searchQuery=='' && this.request_all) {
                return this.request_all.filter(item => {

                    const confirm = String(item.confirmed).includes('true')+String(item.confirmed).includes('false');
                    return confirm
                });
            }
        }
    },
    created() {
        this.loadRequest()
    }
}
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

.tree-container > svg, .tree-container .dom-container {
    top: -185px !important;
}


.badge {
    font-weight: 400;
    font-size: 14px;
}




.toggle_bar {
    text-align: center;
    background: rgba(0, 0, 0, .1);
    width: 70px;
    display: block;
    height: 30px;
    position: relative;
    overflow: hidden;
    margin: 1em auto;
    border-radius: 4px;
    cursor: pointer;
}

.toggle_bar .toggle_square {
    border-radius: 4px;
    transition: left 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55), background 0.2s ease;
    background: rgba(218, 68, 83, 1);
    display: block;
    position: absolute;
    top: 0;
    left: 40px;
    width: 30px;
    height: 100%;
    border: 1px solid transparent;
    box-shadow: 0 4px 16px 8px rgba(0, 0, 0, .15);
}

.toggle_bar .toggle_square:before {
    content: "\d7";
    display: block;
    color: white;
    will-change: content;
    transition: content 0.2s ease;
    line-height: 30px;
    text-align: center;
    font-size: 12px;
    text-transform: uppercase;
}

.contract_toggle input[type=checkbox] {
    display: none;
    position: absolute;
    appearance: none;
}

.contract_toggle input[type=checkbox]:checked ~ .toggle_bar .toggle_square {
    background: rgba(55, 188, 155, 1);
    left: 0;
}

.contract_toggle input[type=checkbox]:checked ~ .toggle_bar .toggle_square:before {
    content: "✓";
}
.fa-info-circle{
    color: #69a3c5;
}
.fa-info-circle:hover{
    color: #007cc5;
}
.scroll{
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
textarea{
    height: 40px;
}
#table-information{
    font-size: 13px;
}

</style>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
