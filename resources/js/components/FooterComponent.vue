<template>
    <div class="col-12 d-block">
         <div class="col-6 float-md-left d-block d-md-inline-block mt-25">COPYRIGHT  &copy; 2020
                <span class="d-none d-sm-inline-block">, All rights Reserved</span>
        </div>
        <div  class="col-6 float-md-right d-md-block">

            <a target="_blank" :href="facebook_url" class="float-right btn-social-icon">
                <i class="text-primary" data-feather='facebook' style="font-size: 10px"></i>
            </a>
            <a target="_blank" :href="youtube_url" class="float-right btn-social-icon">
                 <i class="text-danger" data-feather='youtube'></i>
            </a>
            <a target="_blank" :href="email" class="float-right btn-social-icon">
                <i class="text-muted" data-feather='mail'></i>
            </a>
            <a target="_blank" :href="mobile_number" class="float-right btn-social-icon">
                <i class="text-muted" data-feather="phone"></i>
            </a>
            <a target="_blank" :href="whatsapp_number" class="float-right">
                <img src="/images/whatsapp.png" class="whatsapp_image"/>
            </a>
            <a target="_blank" :href="messenger_url" class="float-right btn-social-icon">
                <message-circle-icon size="1.5x" class="custom-class"></message-circle-icon>
            </a>
        </div>
    </div>
</template>

<script>
import { MessageCircleIcon } from 'vue-feather-icons'

    export default {

        data () {
            return {
                'facebook_url':null,
                'youtube_url':null,
                'email':null,
                'mobile_number':null,
                'whatsapp_number':null,
                'messenger_url':null,
            };
        },
        components: {
            MessageCircleIcon
        },
        props: [],

        created() {
        },
        mounted() {
                this.getSocialUrls();

        },
        methods:{
            getSocialUrls(){
                axios.get('/api/v1/configs/')
                    .then((response)=> {
                             this.facebook_url = response.data.facebook_url;
                             this.youtube_url = response.data.youtube_url;
                             this.email = 'mailto:'+response.data.email;
                             this.mobile_number = 'tel:'+response.data.mobile_number;
                             this.whatsapp_number = 'https://wa.me/'+response.data.whatsapp_number;
                             this.messenger_url = 'https://m.me/'+response.data.messenger_url;

                    });
            }
        }
    }


</script>
<style scoped>

.whatsapp_image{
    height: 20px;
    width: 20px;
    margin-bottom: 1px;
}
.btn-social-icon>svg{
    height: 1.4285rem;
    width: 1.4285rem;
    font-size: 1.45rem;
    margin-left: 1.1rem;
    -webkit-flex-shrink: 0;
    -ms-flex-negative: 0;
    flex-shrink: 0;
}
</style>
