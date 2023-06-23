<template>
    <v-form @submit.prevent="updateDate">
        <div class="py-lg-6 px-md-8 pa-0 mb-15">
            <v-row>
                <v-col cols="8">
                    <div class="headline mb-10">
                        <h2>Update Product</h2>
                    </div>
                </v-col>
            </v-row>

            <v-row>
                <v-col cols="12" md="8">
                    <div class="mb-5">
                        <v-text-field
                            label="Product Title"
                            v-model="productName"
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
                                                v-model="productPrice"
                                                prefix="Rp."
                                                outlined
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12" md="6">
                                            <v-text-field
                                                name="qty"
                                                label="Quantity"
                                                outlined
                                                v-model="productQty"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-textarea
                                                label="Description"
                                                name="description"
                                                v-model="productDescription"
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
                                                v-for="(field, index) in productAttributes"
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

                            <v-card>
                                <v-card-text>
                                    <v-row>
                                        <v-col cols="12" class="mt-5">
                                            <h3>Product Images</h3>
                                        </v-col>
                                        <v-col cols="12">
                                            <el-upload action="/" list-type="picture-card" :on-preview="handlePicturePreview" :on-change="updateImageList" :file-list="imageList" :auto-upload="false">
                                                <i class="el-icon-plus"></i>
                                            </el-upload>
                                            <el-dialog :visible.sync="dialogVisible">
                                                <img :src="dialogImageUrl" width="100%" alt="">
                                            </el-dialog>
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
                                    <v-text-field label="Tags" v-model="productTags" outlined messages="Pisahkan dengan koma (,)"></v-text-field>
                                </div>
                                <v-select :items="categories" item-text="name" item-value="id" v-model="productCategoryID" outlined label="Category"></v-select>
                                <v-select
                                    :items="productStatus"
                                    v-model="productSetStatus"
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
                                    <v-btn  class="ml-5" color="secondary" type="submit" rounded large
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
import { mapGetters } from "vuex";
import { validationMixin } from "vuelidate";
import { required } from "vuelidate/lib/validators";
import axios from 'axios'


export default {
    layout: "admin",
    middleware: "auth-admin",
    mixins: [validationMixin],
    validations: {
        productName: { required },
    },
    data() {
        return {
            dialogImageUrl: '',
            dialogVisible: false,
            imageList: [],
            availableImages: [],
            status_msg: '',
            productName: '',
            productDescription: '',
            productPrice: 0,
            productQty: 0,
            productAttributes: [],
            productCategoryID: "",
            productTags:[],
            productSetStatus: "",
            productStatus: ["draft", "publish"],
            categorySelect: [],
            products:[]
        };
    },
    async mounted() {
        let getData = await this.$store.dispatch("categories/fetchCategories");
        this.getProduct()
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
        async getProduct(){
            let params = this.$route.params.slug
            const response = await axios.get('/admin/product/get/' + params)
            const data = response.data.data[0]


            this.products = data
            // this.imageList = data.gallery
            this.productName = data.name
            this.productCategoryID = data.category.id
            this.productDescription = data.description
            this.productPrice = data.price
            this.productAttributes = data.attributes
            this.productQty = data.qty
            this.productTags = data.tags
            this.productSetStatus = data.status

            let images = data.gallery
            images.forEach(image => {
                this.imageList.push({
                    id: image.id,
                    name : image.file_name,
                    url: image.file_url
                })

                this.availableImages.push({
                    id: image.id,
                    name : image.file_name,
                    url: image.file_url
                })
            });
        },

        updateImageList(file){
            this.imageList.push(file.raw)
            console.log(this.imageList);
        },
        handlePicturePreview(file){
            this.dialogImageUrl = file.url
            this.dialogVisible = true
        },
        addField() {
            this.productAttributes.push({
                name: "",
                value: "",
            });
        },
        removeField(index) {
            this.productAttributes.splice(index, 1);
        },
        async updateDate(){
            let data;
            const formData = new FormData()

            formData.append('_method', 'PATCH')
            formData.append('name', this.productName)
            formData.append('price', this.productPrice)
            formData.append('description', this.productDescription)
            formData.append('qty', this.productQty)
            formData.append('status', this.productSetStatus)
            formData.append('category_id', this.productCategoryID)
            formData.append('attributes', JSON.stringify(this.productAttributes))
            formData.append('available_image', JSON.stringify(this.availableImages))
            formData.append('tags', this.productTags)

            this.imageList.forEach((image, key) => {
                formData.append(`images[${key}]`, image)
            });

            const response = await axios.post('/admin/product/update/'+ this.$route.params.slug, formData,{
                headers: {'Content-Type' : 'multipart/form-data'}
            }).then((res)=>{
                data = res.data;
            })

            await this.$store.dispatch("product/fetchProduct");

            if (data) {
                this.$router.push({ name: "admin.product" });
            }
        }
    },
};
</script>
