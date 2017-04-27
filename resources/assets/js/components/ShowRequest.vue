<template>
    <div v-for="(request,index) in requests">
        <h3>
            <i v-if="replied" class="fa fa-check-circle-o"></i>&nbsp
            Request from {{request.client_name}} for 
        </h3>
        <div>
            <div  v-if="request.request.date>new Date()">
                <button
                class="btn btn-success btn-xs" id="reply" data-index="index">
                Reply
                </button>
                <button v-else class='btn btn-danger btn-xs request dismiss'>
                        Ignore   
                </button>
            </div>
            
        </div>
    </div>
</template>

<script>
    export default{

        data(){
            replied:false,
            requests:[],
            user_id:''
        },
        mounted(){
            this.getRequestsFromServer();
            
        },

        methods:{
            getRequestsFromServer:function(){
                axios.get('/getVendorRequests')
                    .then(function(response){
                        this.requests = response;
                    })
            },

            replyRequest:function(){
                axios.post();
            },

            dismissRequest:function(){
                axios.post();
            }
        }
    }
</script>