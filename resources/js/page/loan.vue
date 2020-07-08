<template>
    <div>
        <div class="row mt-3">
            <div class="col text-right">
                <button class="btn btn-primary" @click="btnCreate_Click">Create</button>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>Name</td>
                                <td>Type</td>
                                <td>Amount</td>
                                <td>Duration</td>
                                <td>Status</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in loans.data" :key="index">
                                <td>{{loan.id}}</td>
                                <td>{{loan.name}}</td>
                                <td>{{loan.type}}</td>
                                <td>{{loan.amount}}</td>
                                <td>{{loan.status}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Modal create Loan -->
        <div class="modal fade" id="modalCreateLoan" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        Body
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save</button>
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
                current_page: 1,
            }
        },
        mounted() {
            this.getLoanList(this.current_page);
        },
        methods: {
            getLoanList(page){
                this.$parent.loading = true
                axios.get(url+"/loam?page="+page)
                .then(res => {
                    console.log(res)
                    this.loans = res.data;
                    this.$parent.loading = false
                })
                .catch(err => {
                    console.error(err); 
                })
            },
            btnCreate_Click(){
                this.loan = { date : todayDate };
                $("#modalCreateLoan").modal();
            },
        },
    }
</script>

<style lang="scss" scoped>

</style>