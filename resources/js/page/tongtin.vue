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
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Start Date</th>
                                <th>Name</th>
                                <th>Amount</th>
                                <th>Number Of Play</th>
                                <th>Number Of Players</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr  v-for="(item, index) in tongtins.data" :key="index">
                                <td>{{item.id}}</td>
                                <td>{{item.start_date}}</td>
                                <td>{{item.name}}</td>
                                <td>{{item.amount}}</td>
                                <td>{{item.number_of_play}}</td>
                                <td>{{item.number_of_player}}</td>
                                <td>{{item.status}}</td>                                
                                <td>
                                    <button class="btn btn-info btn-sm" @click="btnDetails_Click(item.id)">Details</button>
                                    <button class="btn btn-warning btn-sm" @click="btnEdit_Click(item.id)">Edit</button>
                                    <button class="btn btn-danger btn-sm" @click="btnDelete_Click(item.id)">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot v-if="total_page != 1">

                            <tr class="text-center justify-content-center">
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
                                <label for="">Status</label>
                            </div>
                            <div class="col">
                                <select v-model="tongtin.status_id">
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
                        <button type="button" class="btn btn-primary" @click="btnUpdate_Click">Save</button>
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
                $("#modalCreateTongtin").modal();
            },
            btnUpdate_Click(){

            }
        },
    }
</script>

<style lang="scss" scoped>

</style>