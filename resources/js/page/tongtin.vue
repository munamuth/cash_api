<template>
    <div>
        <div class="row">
            <div class="col mt-3">
                <div class="form-group text-right">
                    <button class="btn btn-primary" @click="btnCreate_Click">Create</button>
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
                                <th style="min-width: 110px;">Start Date</th>
                                <th style="min-width: 150px;">Name</th>
                                <th>Amount</th>
                                <th>Number Of Play</th>
                                <th>Number Of Players</th>
                                <th>Status</th>
                                <th style="min-width: 240px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-if="tongtins.data == ''">
                                <td class="text-center text-danger" colspan="8">NO DATA</td>
                            </tr>
                            <tr v-else v-for="(item, index) in tongtins.data" :key="index">
                                <td class="pt-0">{{item.id}}</td>
                                <td>{{item.start_date}}</td>
                                <td>{{item.name}}</td>
                                <td>{{item.amount}}</td>
                                <td>{{item.number_of_play}}</td>
                                <td>{{item.number_of_player}}</td>
                                <td>{{item.status}}</td>                                
                                <td>
                                    <button class="btn btn-info btn-sm" @click="btnDetails_Click(item.id)">Details</button>
                                    <button class="btn btn-warning btn-sm" @click="btnEdit_Click(item.id)">Edit</button>
                                    <button class="btn btn-primary btn-sm" @click="btnPayit_Click(item.id)">Pay It</button>
                                    <button class="btn btn-danger btn-sm" @click="btnDelete_Click(item.id)">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot v-if="total_page > 1">

                            <tr class="text-center justify-content-center">
                                <td colspan="8" >
                                    <nav aria-label="Page navigation example" class="text-center">
                                    <ul class="pagination">
                                        <li class="page-item" @click="getTongtinList(1)">
                                            <router-link :to="{ name : 'tongtin', query: { page: 1 } }" class="page-link">                                                
                                                <span aria-hidden="true">&laquo;</span>
                                                <span class="sr-only">First</span>
                                            </router-link>
                                        </li>
                                        <li  v-for="(item, index) in total_page" :key="index" class="page-item" @click="getTongtinList(item)" >
                                            <router-link class="page-link" :to="{ name : 'tongtin', query: { page: item } }">{{item}}</router-link>
                                        </li>
                                        <li class="page-item" @click="getTongtinList(total_page)">
                                            <router-link :to="{ name : 'tongtin', query: { page: total_page } }" class="page-link">                                                
                                                <span aria-hidden="true">&raquo;</span>
                                                <span class="sr-only">Next</span>
                                            </router-link>
                                        </li>
                                    </ul>
                                    </nav>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <!-- CREATE TONGTIN MODAL -->
        <div class="modal fade" id="modalCreateTongtin" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create New Tongtin</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-12 col-sm-4">
                                <label for="">Start Date</label>
                            </div>
                            <div class="col">
                                <input type="date" class="form-control" v-model="tongtin.start_date">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-12 col-sm-4">
                                <label for="">Name</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" v-model="tongtin.name">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-12 col-sm-4">
                                <label for="">Amount</label>
                            </div>
                            <div class="col">
                                <input type="number" class="form-control" v-model="tongtin.amount">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-12 col-sm-4">
                                <label for="">Number Of Plays</label>
                            </div>
                            <div class="col">
                                <input type="number" class="form-control" v-model="tongtin.number_of_play">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12 col-sm-4">
                                <label for="">Number Of Players</label>
                            </div>
                            <div class="col">
                                <input type="number" class="form-control" v-model="tongtin.number_of_player">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12 col-sm-4">
                                <label for="">Description</label>
                            </div>
                            <div class="col">
                                <textarea class="form-control" v-model="tongtin.description"></textarea>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="btnSave_Click">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- UPDATE TONGTIN MODAL -->
        <div class="modal fade" id="modalUpdateTongtin" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Tongtin</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-12 col-sm-4">
                                <label for="">Start Date</label>
                            </div>
                            <div class="col">
                                <input type="date" class="form-control" v-model="tongtin.start_date">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-12 col-sm-4">
                                <label for="">Name</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" v-model="tongtin.name">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-12 col-sm-4">
                                <label for="">Amount</label>
                            </div>
                            <div class="col">
                                <input type="number" class="form-control" v-model="tongtin.amount">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-12 col-sm-4">
                                <label for="">Number Of Plays</label>
                            </div>
                            <div class="col">
                                <input type="number" class="form-control" v-model="tongtin.number_of_play">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12 col-sm-4">
                                <label for="">Number Of Players</label>
                            </div>
                            <div class="col">
                                <input type="number" class="form-control" v-model="tongtin.number_of_player">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12 col-sm-4">
                                <label for="">Status</label>
                            </div>
                            <div class="col">
                                <select v-model="tongtin.status_id" class="form-control">
                                    <option v-for="(item, index) in status" :key="index" :value="item.id">{{item.name}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12 col-sm-4">
                                <label for="">Description</label>
                            </div>
                            <div class="col">
                                <textarea class="form-control" v-model="tongtin.description"></textarea>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="btnUpdate_Click(tongtin.id)">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal tongtin details -->
        <div class="modal fade" id="modalDetailTongtin" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                                <h5 class="modal-title">Details of {{tongtin.name}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-12 col-sm-4 font-weight-bold">Start Date</div>
                            <div class="col pl-5">{{tongtin.start_date}}</div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-sm-4 font-weight-bold">Name</div>
                            <div class="col pl-5">{{tongtin.name}}</div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-sm-4 font-weight-bold">Amount</div>
                            <div class="col pl-5">{{tongtin.amount}}</div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-sm-4 font-weight-bold">Number Of Play</div>
                            <div class="col pl-5">{{tongtin.number_of_play}}</div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-sm-4 font-weight-bold">Number of Players</div>
                            <div class="col pl-5">{{tongtin.number_of_player}}</div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-sm-4 font-weight-bold">Status</div>
                            <div class="col pl-5">{{tongtin.status}}</div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-sm-4 font-weight-bold">Description</div>
                            <div class="col pl-5">{{tongtin.description}}</div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        
                    </div>
                </div>
            </div>
        </div>        
        <!-- Modal Pay It -->
        <div class="modal fade" id="modalPayit" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
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
                                <input v-model="tongtin_pay.date" type="date" class="form-control">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-12 col-sm-4">
                                <label for="">Tongtin</label>
                            </div>
                            <div class="col">
                                <input v-model="tongtin.name" type="text" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-12 col-sm-4">
                                <label for="">Number Of Play</label>
                            </div>
                            <div class="col">
                                <input v-model="tongtin.number_of_play" type="number" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-12 col-sm-4">
                                <label for="">Amount</label>
                            </div>
                            <div class="col">
                                <input v-model="tongtin_pay.amount" type="number" class="form-control">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-12 col-sm-4">
                                <label for="">Number of claimed</label>
                            </div>
                            <div class="col">
                                <input v-model="tongtin_pay.number_of_claim" type="number" class="form-control">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-12 col-sm-4">
                                <label for="">Total Amount</label>
                            </div>
                            <div class="col">
                                
                                <input v-model="total_amount" type="number" class="form-control" readonly>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="btnPay_Click(tongtin.id)"> Pay Now</button>
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
                tongtins : {},
                tongtin : {},
                status : {},
                tongtin_pays : {},
                tongtin_pay : {},
                total_item: 0,
                per_page : 0,
                total_page : 0,
                current_page : this.$route.query.page,
            }
        },
        mounted() {
            this.getTongtinList(this.current_page);
            this.getStatusList();
            console.log(this.current_page)
        },
        methods: {
            getStatusList(){
                this.$parent.loading = true
                axios.get(url+'/status')
                .then(res => {
                    this.status = res.data.data;
                    this.$parent.loading = false
                })
                .catch(err => {
                    console.error(err.response.data.message); 
                })
            },
            getTongtinList(page){
                this.$parent.loading = true
                let query = '?page='+page;
                axios.get(url+"/tongtin/" + query)
                .then(res => {
                    this.tongtins = res.data;                    
                    this.total_item = res.data.meta.total;
                    this.per_page = res.data.meta.per_page;
                    if( this.total_item % this.per_page == 0 )
                    {
                        this.total_page = this.total_item / this.per_page;
                    }
                    else
                    {
                        this.total_page = parseInt(this.total_item / this.per_page) + 1;
                    }

                    this.$parent.loading = false
                })
                .catch(err => {
                    console.error(err.response.data); 
                })
            },
            btnCreate_Click(){
                
                this.tongtin = { start_date : todayDate };
                $("#modalCreateTongtin").modal();
            },
            btnSave_Click(){
                let data = new FormData();
                data.append("start_date", this.tongtin.start_date);
                data.append("name", this.tongtin.name);
                data.append("amount", this.tongtin.amount);
                data.append("number_of_play", this.tongtin.number_of_play);
                data.append("number_of_player", this.tongtin.number_of_player);
                data.append("description", this.tongtin.description);

                axios.post(url+"/tongtin", data)
                .then(res => {
                    if(res.status == 201)
                    {
                        Swal.fire('Message', "Your data was saved successfully!!!", 'success');
                        this.tongtin = {};                        
                        $("#modalCreateTongtin").modal('hide');
                    }
                    else
                    {
                        Swal.fire('Message', res.data, 'error');
                    }
                    this.getTongtinList();
                })
                .catch(err => {
                    console.error(err.response.data); 
                })
            },
            btnEdit_Click(id){
                this.$parent.loading = true;
                axios.get(url+"/tongtin/"+id)
                .then(res => {
                    console.log(res)
                    this.tongtin = res.data.data;
                    this.$parent.loading = false;
                    $("#modalUpdateTongtin").modal();
                })
                .catch(err => {
                    console.error(err); 
                })
            },
            btnUpdate_Click(id){
                let data = new FormData();
                data.append("_method", "PUT");
                data.append("start_date", this.tongtin.start_date);
                data.append("name", this.tongtin.name);
                data.append("amount", this.tongtin.amount);
                data.append("number_of_play", this.tongtin.number_of_play);
                data.append("number_of_player", this.tongtin.number_of_player);
                data.append("description", this.tongtin.description);
                data.append("status_id", this.tongtin.status_id);

                axios.post(url+"/tongtin/"+id, data)
                .then(res => {
                    if(res.status == 200)
                    {
                        Swal.fire('Message', "Your data was saved successfully!!!", 'success');
                        this.tongtin = {};                       
                        this.current_page = this.$route.query.page;                        
                        this.getTongtinList(this.current_page);
                         
                        $("#modalUpdateTongtin").modal('hide');
                    }
                    else
                    {
                        Swal.fire('Message', res.data, 'error');
                    }
                })
                .catch(err => {
                    console.error(err.response.data); 
                })
            },
            btnDetails_Click(id){
                this.$parent.loading = true;
                axios.get(url+"/tongtin/"+id)
                .then(res => {

                    this.tongtin = res.data.data;
                    this.$parent.loading = false;
                    $("#modalDetailTongtin").modal();

                })
                .catch(err => {
                    console.error(err); 
                })
            },
            btnDelete_Click(id){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.value) {
                        this.$parent.loading = true;
                        var data = new FormData();
                        data.append("_method", 'DELETE');
                        axios.post(url+"/tongtin/"+id, data)
                        .then(res => {
                            this.$parent.loading = false;
                            Swal.fire("Message", "Your data was deleted successfully!!!", 'success');
                            this.getTongtinList(this.$route.query.page);
                        })
                        .catch(err => {
                            console.error(err); 
                        })
                    }
                });
                
            },
            btnPayit_Click(id){
                this.tongtin_pay = { date : todayDate };
                this.$parent.loading = true
                
                axios.get(url+"/tongtin/"+id)
                .then(res => {
                    this.tongtin = res.data.data
                    this.$parent.loading = false;
                    
                    $("#modalPayit").modal();
                })
                .catch(err => {
                    console.error(err); 
                })
            },
            btnPay_Click(tongtin_id){
                let data = new FormData();
                data.append('date', this.tongtin_pay.date);
                data.append('tongtin_id', this.tongtin.id);
                data.append('amount', this.tongtin_pay.amount);
                data.append('total_amount', this.tongtin_pay.total_amount);
                data.append('number_of_claim', this.tongtin_pay.number_of_claim);
                this.$parent.loading = true;
                axios.post(url+"/tongtin_pay", data)
                .then(res => {
                    console.log(res)
                    this.$parent.loading = false;
                    Swal.fire("Message", 'Your data was create successfully!!!', "success");
                    
                })
                .catch(err => {
                    console.error(err.response.data.message); 
                })
            },
        },
        computed: {
           total_amount : {
               get : function(){
                    return this.tongtin_pay.total_amount = this.tongtin_pay.amount * this.tongtin_pay.number_of_claim * this.tongtin.number_of_play;
                },
               set : function(){
                    this.tongtin_pay.total_amount = this.tongtin_pay.amount * this.tongtin_pay.number_of_claim  * this.tongtin.number_of_play;
                }
            }
        },
    }
</script>

<style>
    
</style>