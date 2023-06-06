<template>
    <v-form @submit.prevent="storeProduct">
        <div class="py-lg-6 px-md-8 pa-0 mb-15">
            <v-row>
                <v-col cols="8">
                    <div class="headline mb-10">
                        <h2>Add new Product</h2>
                    </div>
                </v-col>
            </v-row>

            <v-row>
                <v-col cols="12" md="8">
                    <div class="mb-5">
                        <v-text-field
                            label="Product Title"
                            v-model="form.name"
                            outlined
                        ></v-text-field>
                    </div>
                    <v-tabs color="secondary">
                        <v-tab> General </v-tab>
                        <v-tab-item
                            reverse-transition="tab-reverse-transition"
                            transition="fade"
                        >
                            <v-card>
                                <v-card-title primary-title>
                                    <div>
                                        <h3 class="headline mb-0">
                                            General Setting
                                        </h3>
                                    </div>
                                </v-card-title>
                                <v-card-text>
                                    <v-row>
                                        <v-col cols="12" md="6">
                                            <v-text-field
                                                label="Price"
                                                v-model="form.price"
                                                prefix="Rp."
                                                outlined
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12" md="6">
                                            <v-text-field
                                                name="qty"
                                                label="Quantity"
                                                outlined
                                                v-model="form.qty"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-textarea
                                                label="Description"
                                                name="description"
                                                v-model="form.description"
                                                textarea
                                                outlined
                                            ></v-textarea>
                                        </v-col>
                                    </v-row>
                                </v-card-text>
                            </v-card>

                            <v-card>
                                <v-card-text>
                                    <v-row>
                                        <v-col cols="12" class="mt-5">
                                            <h3>Product Attributes</h3>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-row
                                                v-for="(field, index) in form.attributes"
                                                :key="index"
                                            >
                                                <v-col cols="5">
                                                    <v-text-field
                                                        label="Attribute"
                                                        v-model="field.name"
                                                        outlined
                                                    ></v-text-field>
                                                </v-col>
                                                <v-col cols="5">
                                                    <v-text-field
                                                        label="Value"
                                                        v-model="field.value"
                                                        outlined
                                                    ></v-text-field>
                                                </v-col>
                                                <v-col cols="2">
                                                    <v-btn
                                                        color="red darken-1"
                                                        @click="removeField(index)"
                                                        x-large
                                                    >
                                                        <v-icon color="white">
                                                            mdi-delete-outline
                                                        </v-icon>
                                                    </v-btn>
                                                </v-col>
                                            </v-row>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-spacer></v-spacer>
                                            <v-btn @click="addField">Add Attributes</v-btn>
                                        </v-col>
                                    </v-row>
                                </v-card-text>
                            </v-card>
                        </v-tab-item>

                    </v-tabs>
                </v-col>
                <v-col cols="12" md="4">
                    <v-card class="pa-5">
                        <v-row full-width class="mb-5">
                            <v-card-text>
                                <div class="mb-3">
                                    <v-text-field label="Tags" v-model="form.tags" outlined messages="Pisahkan dengan koma (,)"></v-text-field>
                                </div>
                                <v-select :items="categories" item-text="name" item-value="id" v-model="form.category_id" outlined label="Category"></v-select>
                                <v-select
                                    :items="productStatus"
                                    v-model="form.status"
                                    label="Status"
                                    outlined
                                >
                                </v-select>
                            </v-card-text>
                        </v-row>
                        <v-card-actions>
                            <v-row>
                                <v-flex
                                    align-center
                                    fill-height
                                    d-flex
                                    justify-end
                                    tag="div"
                                    wrap
                                    width="100%"
                                >
                                    <v-btn :to="{name : 'admin.product'}" color="primary" rounded outlined large>cancel</v-btn>
                                    <v-btn  class="ml-5" color="secondary" type="submit" rounded large :loading="uploadProgress" :disabled="uploadProgress"
                                        >Save Product</v-btn
                                    >
                                </v-flex>
                            </v-row>
                        </v-card-actions>
                    </v-card>
                </v-col>
            </v-row>
        </div>
    </v-form>
</template>
<script>
import Form from "vform";
import { mapGetters } from "vuex";
import { validationMixin } from "vuelidate";
import { required } from "vuelidate/lib/validators";
import Dropzone from 'nuxt-dropzone'
import 'nuxt-dropzone/dropzone.css'


export default {
    layout: "admin",
    middleware: "auth-admin",
    mixins: [validationMixin],
    validations: {
        title: { required },
    },
    components: {
        Dropzone
    },
    data() {
        return {
            form: new Form({
                name: "",
                description: "",
                price: 0,
                images: [],
                qty: 0,
                attributes: [
                    {
                        name: "",
                        value: ""
                    }
                ],
                category_id:"",
                tags: [],
                status: "publish",
            }),
            productStatus: ["draft", "publish"],
            imageSrc: [],
            uploadProgress: false,
            categorySelect: [],
            options: {
                url: '/',
                uploadMultiple: true,
                paramName: 'images[]',
            }
        };
    },
    async mounted() {
        let getData = await this.$store.dispatch("categories/fetchCategories");
    },
    computed: {
        ...mapGetters({
            categories: "categories/categories",
        }),
        getCategoryValue(){
            this.categories.forEach(cat => {
                this.categorySelect.push({
                    text: cat.name,
                    value: cat.slug
                })
            });
        }
    },
    methods: {
        addField() {
            this.form.attributes.push({
                name: "",
                value: "",
            });
        },
        vsending(file, xhr, formData) {
            console.log(xhr);
        },
        vfileAdded(file) {
            this.form.images.push(file.upload)
            console.log(file.upload);
            console.log(this.form);
        },
        removeField(index) {
            this.form.attributes.splice(index, 1);
        },
        async storeProduct(){
            let data;

            try {
                const response = await this.form.post(
                    "/admin/product/create" ,{
                        onUploadProgress : (e)=>{
                            this.uploadProgress = true
                        }
                    }
                );
                data = response.data;

                await this.$store.dispatch("product/fetchProduct");
            } catch (error) {
                console.log(error);
            }

            if (data) {
                this.$router.push({ name: "admin.product" });
            }
        }
    },
};
</script>
