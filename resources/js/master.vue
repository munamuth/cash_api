<template>
    <div>
        <div class="container-fluid">
            <div class="loading-status text-center" v-if="loading">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>                    
                </div>                
                <p class="">Loading...</p>
            </div>
            <div class="row">
                <div class="col-12 col-sm-2">
                    <ul>
                        <li v-for="(item, index) in routers" :key="index"><router-link :to="item.path">{{item.name.charAt(0).toUpperCase() +  item.name.slice(1)}}</router-link></li>                        
                    </ul>
                </div>
                <div class="col">
                    <router-view></router-view>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        
        data() {
            return {
               loading : false,
               routers : this.$router.options.routes,
            }
        },
        mounted(){
            
        }
    }
</script>

<style>
    .loading-status {
            position: absolute;
            left: calc(50% - 75px);
            top: calc(50vh - 40px);
            z-index: 10000;
            width: 150px;
            height: 80px;
            padding: 15px;
            background: #d8cece;
    }
</style>