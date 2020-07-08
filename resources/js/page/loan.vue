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
                        <tbdoy>
                            <tr v-for="(item, index) in loans.data" :key="index">
                                <td>{{loan.id}}</td>
                                <td>{{loan.name}}</td>
                                <td>{{loan.type}}</td>
                                <td>{{loan.amount}}</td>
                                <td>{{loan.status}}</td>
                            </tr>
                        </tbdoy>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        
    }
</script>

<style lang="scss" scoped>

</style>