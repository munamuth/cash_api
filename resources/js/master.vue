<template>
    <div>
        <div class="container-fluid">
            
            <div class="loading-container" v-if="loading" >
                <div class="loading-status text-center">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>                    
                    </div>                
                    <p class="">Loading...</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <!--
                    <passport-clients></passport-clients>
                    <passport-authorized-clients></passport-authorized-clients>
                    <passport-personal-access-tokens></passport-personal-access-tokens>
                    -->
                </div>
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
    .loading-container{
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        
        z-index: 10000;
        background: #a9a9a922;
    }
    .loading-status {
            position: absolute;
            left: calc(50% - 75px);
            top: calc(50vh - 40px);
            width: 150px;
            height: 80px;
            padding: 15px;
            background: #d8cece;
    }
</style>