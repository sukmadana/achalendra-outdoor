<template>
    <card title="Add or Remove Product Image">
        <div class="py-md-6 px-md-8 pa-0">
            <v-row>
                <v-col cols="12" md="8">
                    <dropzone
                        id="productImage"
                        ref="image"
                        :options="imageOptions"
                        :destroyDropzone="true"
                        v-on:vdropzone-sending="sendingEvent"
                    ></dropzone>
                </v-col>
            </v-row>
        </div>
    </card>
</template>
<script>
import { mapGetters } from "vuex";
import Dropzone from "nuxt-dropzone";
import "nuxt-dropzone/dropzone.css";

export default {
    layout: "admin",
    middleware: "auth-admin",
    components: {
        Dropzone,
    },
    data() {
        return {
            imageOptions: {
                url: process.env.apiUrl + '/admin/product/upload',
                paramName: "images",
                uploadMultiple: true,
                headers: {
                    'Accept': 'application/json',
                    "Content-Type": "multipart/form-data" ,
                    'Authorization': 'Bearer '+ this.$store.getters['auth/token']

                },
                withCredentials: true
            },
        };
    },
    computed:{
    },
    methods:{
        sendingEvent (file, xhr, formData) {
        formData.append('paramName', 'some value or other');
        }
    }
};
</script>
