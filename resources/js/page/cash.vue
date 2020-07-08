<template>
    <div>
        <div class="row mt-3">
            <div class="col">
                <div class="form-group text-right">
                    <button class="btn btn-primary" @click="btnCreate_Click"> Create</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <p class="card-title">Cash Lists</p>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Date</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in cashs" :key="index">
                                        <td>{{item.id}}</td>
                                        <td>{{item.date}}</td>
                                        <td>{{item.name}}</td>
                                        <td>{{item.type_name}}</td>
                                        <td>{{item.status_name}}</td>
                                        <td>{{item.amount}}</td>
                                        <td>
                                            <button class="btn btn-info btn-sm" @click="btnDetails_Click(item.id)">Details</button>
                                            <button class="btn btn-warning btn-sm" @click="btnEdit_Click(item.id)">Edit</button>
                                            <button class="btn btn-danger btn-sm" @click="btnDelete_Click(item.id)">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="8" >
                                    <nav aria-label="Page navigation example">
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
            </div>
        </div>


        <!-- MODAL CREATE NEW CASH -->
        <div class="modal fade" id="modalCreateCash" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create New Cash</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        <!-- Date -->
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-sm-3">
                                    <label for="date">Date</label>
                                </div>
                                <div class="col">
                                    <input type="date" v-model="cash.date" class="form-control">
                                </div>
                            </div>
                        </div>
                        <!-- Name -->
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-sm-3">
                                    <label for="date">Name</label>
                                </div>
                                <div class="col">
                                    <input type="text" v-model="cash.name" class="form-control">
                                </div>
                            </div>
                        </div>
                        <!-- Name -->
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-sm-3">
                                    <label for="date">Type</label>
                                </div>
                                <div class="col">
                                    <select v-model="cash.type" class="form-control">
                                        <option value="0">Income</option>
                                        <option value="1">Expsense</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- Amount -->
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-sm-3">
                                    <label for="date">Amount</label>
                                </div>
                                <div class="col">
                                    <input type="number" v-model="cash.amount" class="form-control">
                                </div>
                            </div>
                        </div>
                        <!-- Description -->
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-sm-3">
                                    <label for="date">Description</label>
                                </div>
                                <div class="col">
                                    <textarea type="number" v-model="cash.description" class="form-control"></textarea>
                                </div>
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
        <!-- MODAL UPDATE CASH -->
        <div class="modal fade" id="modalUpdateCash" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create New Cash</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        <!-- Date -->
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-sm-3">
                                    <label for="date">Date</label>
                                </div>
                                <div class="col">
                                    <input type="date" v-model="cash.date" class="form-control">
                                </div>
                            </div>
                        </div>
                        <!-- Name -->
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-sm-3">
                                    <label for="date">Name</label>
                                </div>
                                <div class="col">
                                    <input type="text" v-model="cash.name" class="form-control">
                                </div>
                            </div>
                        </div>
                        <!-- Name -->
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-sm-3">
                                    <label for="date">Type</label>
                                </div>
                                <div class="col">
                                    <select v-model="cash.type" class="form-control">
                                        <option value="0">Income</option>
                                        <option value="1">Expsense</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- Amount -->
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-sm-3">
                                    <label for="date">Amount</label>
                                </div>
                                <div class="col">
                                    <input type="number" v-model="cash.amount" class="form-control">
                                </div>
                            </div>
                        </div>
                        <!-- STATUS -->
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-sm-3">
                                    <label for="date">Status</label>
                                </div>
                                <div class="col">
                                    <select v-model="cash.status_id" class="form-control">
                                        <option v-for="(item, index) in status" :key="index" :value="item.id">{{item.name}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- Description -->
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-sm-3">
                                    <label for="date">Description</label>
                                </div>
                                <div class="col">
                                    <textarea type="number" v-model="cash.description" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="btnUpdate_Click">Update</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL SHOW CASH -->
        <!-- Button trigger modal -->
        
        <!-- Modal -->
        <div class="modal fade" id="modalShowCash" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Details of {{cash.name}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 col-sm-3 font-weight-bold">Date</div>
                            <div class="col pl-5">{{cash.date}}</div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-3 font-weight-bold">Name</div>
                            <div class="col pl-5">{{cash.name}}</div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-3 font-weight-bold">Type</div>
                            <div class="col pl-5">{{cash.type}}</div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-3 font-weight-bold">Amount</div>
                            <div class="col pl-5">{{cash.amount}}</div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-3 font-weight-bold">Description</div>
                            <div class="col pl-5">{{cash.description}}</div>
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
        data(){
            return {
                cashs : {},
                cash : {},
                status : ["1", "2"],
                total_item: 0,
                per_page : 0,
                total_page : 0,
                current_page : this.$route.query.page,
            }
        },
        mounted() {
            this.getCashList();  
            this.getStatusList();          
        },
        methods: {
            getStatusList(){
                this.$parent.loading = true
                axios.get(url+'/status')
                .then(res => {
                    this.status = res.data;
                    this.$parent.loading = false
                })
                .catch(err => {
                    console.error(err.response.data.message); 
                })
            },
            getCashList()
            {
                this.$parent.loading = true
                let query = '?page='+page;
                axios.get(url+"/cash/" + query)
                .then(res => {
                    this.cashs = res.data.data;
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
                    console.error(err.response.data.message); 
                })
            },
            btnCreate_Click()
            {
                this.cash = { date : todayDate};
                $("#modalCreateCash").modal();
            },
            btnSave_Click()
            {
                let data = new FormData();
                data.append('date', this.cash.date);
                data.append('name', this.cash.name);
                data.append('type', this.cash.type);
                data.append('amount', this.cash.amount);
                data.append('description', this.cash.description);
                
                this.$parent.loading = true
                axios.post(url+'/cash',data)
                .then(res => {
                    $("#modalCreateCash").modal("hide");
                    this.getCashList();
                    this.$parent.loading = false
                    Swal.fire("Success", "Your data was saved successfully!!!", 'success');
                })
                .catch(err => {
                    console.error(err.response); 
                });
            },
            btnEdit_Click(id)
            {
                this.$parent.loading = true;

                axios.get(url+'/cash/'+id)
                .then(res => {
                    this.cash = res.data.data;
                    $("#modalUpdateCash").modal();
                    this.$parent.loading = false;
                    
                })
                .catch(err => {
                    console.error(err); 
                })
            },
            btnUpdate_Click()
            {
                let data = new FormData();
                data.append('_method', 'PUT');
                data.append('date', this.cash.date);
                data.append('name', this.cash.name);
                data.append('type', this.cash.type);
                data.append('amount', this.cash.amount);
                data.append('status_id', this.cash.status_id);
                data.append('description', this.cash.description);
                
                this.$parent.loading = true
                axios.post(url+'/cash/'+this.cash.id, data)
                .then(res => {
                    console.log(res)
                    $("#modalUpdateCash").modal("hide");
                    this.getCashList();
                    this.$parent.loading = false
                })
                .catch(err => {
                    console.error(err.response.data.message); 
                });
            },
            btnDetails_Click(id)
            {
                this.$parent.loading = true;
                axios.get(url+'/cash/'+id)
                .then(res => {
                    console.log(res)
                    this.cash = res.data.data
                    $("#modalShowCash").modal();
                    this.$parent.loading = false;
                })
                .catch(err => {
                    console.error(err); 
                })
            },
            btnDelete_Click(id)
            {
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
                        let data = new FormData();
                        data.append('_method', 'DELETE');

                        axios.post(url+"/cash/"+id, data)
                        .then(res => {
                            this.getCashList();
                            this.$parent.loading = false;
                            Swal.fire("Success", "Your data was deleted successfully!!!", 'success');
                        })
                        .catch(err => {
                            console.error(err.response.data.message); 
                        })
                    }
                    })
                
            }

        },
    }
</script>

<style>

</style>