<template>
    <div>
        <div class="row">
            <div class="col">
                <div class="form-group mt-3">
                    <div class="text-right">
                        <button class="btn btn-primary" @click="btnCreate_Click"> Create</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th style="min-width: 110px">Date</th>
                                <th>Tongtin</th>
                                <th>Number Of Play</th>
                                <th>Number Of Claimed</th>
                                <th>Amount</th>
                                <th>Total Amount</th>
                                <th style="min-width: 185px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in pays" :key="index">
                                <td>{{item.id}}</td>
                                <td>{{item.date}}</td>
                                <td>{{item.tongtin.name}}</td>
                                <td>{{item.tongtin.number_of_play}}</td>
                                <td>{{item.number_of_claim}}</td>
                                <td>{{item.amount}}</td>
                                <td>{{item.total_amount}}</td>
                                <td>
                                    <button class="btn btn-info btn-sm" @click="btnDetails_Click(item.id)">Details</button>
                                    <button class="btn btn-warning btn-sm" @click="btnEdit_Click(item.id)">Edit</button>
                                    <button class="btn btn-danger btn-sm" @click="btnDelete_Click(item.id)">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Modal Create Tongtin Pay -->
        <div class="modal fade" id="modalCreateTongtinPay" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">New</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        <div class="row form-group">
                            <div class="col-12 col-sm-4">
                                <label for="">Date</label>
                            </div>
                            <div class="col">
                                <input v-model="pay.date" type="date" class="form-control">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-12 col-sm-4">
                                <label for="">Tongtin</label>
                            </div>
                            <div class="col">
                                <select v-model="pay.tongtin_id" class="form-control" @change="getTogtinDetails(pay.tongtin_id)">
                                    <option v-for="(item, index) in tongtins" :key="index" :value="item.id">{{item.name}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-12 col-sm-4">
                                <label for="">Number Of Play</label>
                            </div>
                            <div class="col">
                                <input v-model="tongtin.number_of_play" type="number" class="form-control" disabled>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-12 col-sm-4">
                                <label for="">Number Of Claim</label>
                            </div>
                            <div class="col">
                                <input v-model="pay.number_of_claim" type="number" class="form-control">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-12 col-sm-4">
                                <label for="">Amount</label>
                            </div>
                            <div class="col">
                                <input v-model="pay.amount" type="number" class="form-control">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-12 col-sm-4">
                                <label for="">Number Of Play</label>
                            </div>
                            <div class="col">
                                <input v-model="GetTotalAmount" type="number" class="form-control" readonly>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button @click="btnSave_Click" type="button" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                pays : {},
                pay:{},
                tongtins :{},
                tongtin :0,
                current_page : this.$route.query.page,
            }
        },
        mounted() {
            this.getTongtinPayList(this.current_page);
            this.getTongtinList();
        },
        methods: {
            getTongtinPayList(page){
                this.$parent.loading = true;
                axios.get(url+"/tongtin_pay?page="+page)
                .then(res => {
                    
                    this.$parent.loading = false;
                    this.pays = res.data.data;
                })
                .catch(err => {
                    console.error(err); 
                })

            },
            getTongtinList(){
                this.$parent.loading = true
                axios.get(url+"/tongtinall/")
                .then(res => {
                    this.tongtins = res.data.data;
                    this.$parent.loading = false
                })
                .catch(err => {
                    console.error(err.response.data); 
                })
            },
            getTogtinDetails(id){                
                this.$parent.loading = true;
                axios.get(url+'/tongtin/'+id)
                .then(res => {
                    console.log(res)
                    this.tongtin = res.data.data;
                    this.$parent.loading = false;
                })
                .catch(err => {
                    console.error(err); 
                })
            },  
            btnCreate_Click(){
                this.pay = {date : todayDate};
                $("#modalCreateTongtinPay").modal();
            },
            btnSave_Click(){

            },
        },
        computed: {
            GetTotalAmount : function(){
                return this.pay.total_amount = this.tongtin.number_of_play * this.pay.number_of_claim * this.pay.amount;
            }
        },
    }
</script>

<style>

</style>