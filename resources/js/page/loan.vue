<template>
    <div>
        <div class="row mt-3">
            <div class="col">
                <div class="form-group text-right">
                    <button class="btn btn-primary" @click="btnCreate_Click">Create</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td style="min-width: 110px">Date</td>
                                <td>Name</td>
                                <td>Type</td>
                                <td>Amount</td>
                                <td>Duration (months)</td>
                                <td>Status</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-if="loans.data ==''">
                                <td colspan="8" class="text-center text-danger">NO DATA</td>
                            </tr>
                            <tr v-else v-for="(item, index) in loans.data" :key="index">
                                <td>{{item.id}}</td>
                                <td>{{item.date}}</td>
                                <td>{{item.name}}</td>
                                <td>{{item.type}}</td>
                                <td>{{item.amount}}</td>
                                <td>{{item.duration}}</td>
                                <td>{{item.status}}</td>
                                                          
                                <td>
                                    <button class="btn btn-info btn-sm" @click="btnDetails_Click(item.id)">Details</button>
                                    <button class="btn btn-warning btn-sm" @click="btnEdit_Click(item.id)">Edit</button>
                                    <button class="btn btn-danger btn-sm" @click="btnDelete_Click(item.id)">Delete</button>
                                </td>

                            </tr>
                        </tbody>
                        <tfoot v-if="total_page > 1">

                            <tr class="text-center justify-content-center">
                                <td colspan="8" >
                                    <nav aria-label="Page navigation example">
                                    <ul class="pagination">
                                        <li class="page-item" @click="getLoanList(1)">
                                            <router-link :to="{ name : 'loan', query: { page: 1 } }" class="page-link">                                                
                                                <span aria-hidden="true">&laquo;</span>
                                                <span class="sr-only">First</span>
                                            </router-link>
                                        </li>
                                        <li  v-for="(item, index) in total_page" :key="index" class="page-item" @click="getLoanList(item)" >
                                            <router-link class="page-link" :to="{ name : 'loan', query: { page: item } }">{{item}}</router-link>
                                        </li>
                                        <li class="page-item" @click="getLoanList(total_page)">
                                            <router-link :to="{ name : 'loan', query: { page: total_page } }" class="page-link">                                                
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
        
        <!-- Modal create Loan -->
        <div class="modal fade" id="modalCreateLoan" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create New Loan</h5>
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
                                <input type="date" v-model="loan.date" class="form-control">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-12 col-sm-4">
                                <label for="">Name</label>
                            </div>
                            <div class="col">
                                <input type="text" v-model="loan.name" class="form-control">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-12 col-sm-4">
                                <label for="">Amount</label>
                            </div>
                            <div class="col">
                                <input type="number" v-model="loan.amount" class="form-control">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-12 col-sm-4">
                                <label for="">Type</label>
                            </div>
                            <div class="col">
                                <select v-model="loan.is_loan" class="form-control">
                                    <option value="0">Loan</option>
                                    <option value="1">Lend</option>
                                </select>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-12 col-sm-4">
                                <label for="">Duration</label>
                            </div>
                            <div class="col">
                                <input type="number" v-model="loan.duration" class="form-control">
                                
                            </div>
                        </div>

                        
                        <div class="row form-group">
                            <div class="col-12 col-sm-4">
                                <label for="">Description</label>
                            </div>
                            <div class="col">
                                <textarea type="number" v-model="loan.description" class="form-control"></textarea>
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

        <!-- Modal update Loan -->
        <div class="modal fade" id="modalUpdateLoan" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Loan</h5>
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
                                <input type="date" v-model="loan.date" class="form-control">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-12 col-sm-4">
                                <label for="">Name</label>
                            </div>
                            <div class="col">
                                <input type="text" v-model="loan.name" class="form-control">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-12 col-sm-4">
                                <label for="">Amount</label>
                            </div>
                            <div class="col">
                                <input type="number" v-model="loan.amount" class="form-control">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-12 col-sm-4">
                                <label for="">Type</label>
                            </div>
                            <div class="col">
                                <select v-model="loan.is_loan" class="form-control">
                                    <option value="0">Loan</option>
                                    <option value="1">Lend</option>
                                </select>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-12 col-sm-4">
                                <label for="">Duration</label>
                            </div>
                            <div class="col">
                                <input type="number" v-model="loan.duration" class="form-control">
                                
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-12 col-sm-4">
                                <label for="">Status</label>
                            </div>
                            <div class="col">
                                <select v-model="loan.status_id" class="form-control">
                                    <option v-for="(item, index) in status" :key="index" :value="item.id">{{item.name}}</option>
                                </select>                                
                            </div>
                        </div>

                        
                        <div class="row form-group">
                            <div class="col-12 col-sm-4">
                                <label for="">Description</label>
                            </div>
                            <div class="col">
                                <textarea type="number" v-model="loan.description" class="form-control"></textarea>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="btnUpdate_Click(loan.id)">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal show Loan -->
        <div class="modal fade" id="modalShowLoan" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Details of {{loan.name}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 col-sm-3 font-weight-bold">Date</div>
                            <div class="col pl-5">{{loan.date}}</div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-3 font-weight-bold">Name</div>
                            <div class="col pl-5">{{loan.name}}</div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-3 font-weight-bold">Type</div>
                            <div class="col pl-5">{{loan.type}}</div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-3 font-weight-bold">Amount</div>
                            <div class="col pl-5">{{loan.amount}}</div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-3 font-weight-bold">Duration</div>
                            <div class="col pl-5">{{loan.duration}}</div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-3 font-weight-bold">Status</div>
                            <div class="col pl-5">{{loan.status}}</div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-3 font-weight-bold">Description</div>
                            <div class="col pl-5">{{loan.description}}</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
                loans : {},
                loan : {},
                status : {},
                total_item: 0,
                per_page : 0,
                total_page : 0,
                current_page : this.$route.query.page,
            }
        },
        mounted() {
            this.getLoanList(this.current_page);
            this.getStatusList();
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
            getLoanList(page){
                this.$parent.loading = true
                axios.get(url+"/loan?page="+page)
                .then(res => {
                    this.loans = res.data;
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
                    console.error(err.response); 
                })
            },
            btnCreate_Click(){
                this.loan = { date : todayDate };
                $("#modalCreateLoan").modal();
            },
            btnSave_Click(){
                let data = new FormData();
                data.append('date', this.loan.date);
                data.append('name', this.loan.name);
                data.append('amount', this.loan.amount);
                data.append('is_loan', this.loan.is_loan);
                data.append('duration', this.loan.duration);                
                data.append('description', this.loan.description);
                this.$parent.loading = true
                axios.post(url+"/loan",data)
                .then(res => {
                    console.log(res)
                    if(res.status == 201){
                        
                        this.$parent.loading = false;
                        Swal.fire("Message", "Your data was created successfully!!!", 'success');
                        $("#modalCreateLoan").modal('hide');
                        this.current_page = this.$route.query.page;
                        this.getLoanList(this.current_page)
                    }
                })
                .catch(err => {
                    console.error(err.response); 
                })
            },
            btnEdit_Click(id){
                this.$parent.loading = true;
                axios.get(url+'/loan/'+id)
                .then(res => {
                    console.log(res)
                    this.$parent.loading = false;
                    this.loan = res.data.data;
                    $("#modalUpdateLoan").modal();
                })
                .catch(err => {
                    console.error(err); 
                })
            },
            btnUpdate_Click(id){
                let data = new FormData();
                data.append('_method', "PUT");
                data.append('date', this.loan.date);
                data.append('name', this.loan.name);
                data.append('amount', this.loan.amount);
                data.append('is_loan', this.loan.is_loan);
                data.append('duration', this.loan.duration);                
                data.append('status_id', this.loan.status_id);                
                data.append('description', this.loan.description);
                this.$parent.loading = true
                axios.post(url+"/loan/"+id ,data)
                .then(res => {
                    console.log(res)
                    if(res.status == 200){
                        
                        this.$parent.loading = false;
                        Swal.fire("Message", "Your data was update successfully!!!", 'success');
                        $("#modalUpdateLoan").modal('hide');
                        this.current_page = this.$route.query.page;
                        this.getLoanList(this.current_page)
                    }
                })
                .catch(err => {
                    console.error(err.response.data); 
                })
            },
            btnDetails_Click(id){

                this.$parent.loading = true
                axios.get(url+"/loan/"+id)
                .then(res => {
                    console.log(res)
                    this.loan = res.data.data;
                    this.$parent.loading = false;
                    $('#modalShowLoan').modal();
                })
                .catch(err => {
                    console.error(err); 
                })
                
            },
            btnDelete_Click (id){
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
                            let data = new FormData();
                            data.append('_method', 'DELETE');
                            

                            axios.post(url+'/loan/'+id ,data)
                            .then(res => {
                                this.$parent.loading = false;
                                Swal.fire("Message", "You data was deleted successfully", 'success');
                                this.current_page = this.$route.query.page,
                                this.getLoanList(this.current_page);
                            })
                            .catch(err => {
                                console.error(err); 
                            })
                        }
                    })

            },
        },
    }
</script>

<style>
    thead>tr>td:last-child{
        min-width: 185px;
    }
</style>