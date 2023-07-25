<template>
    <div >
        <div v-if="loading" class="page-loading">
            <v-progress-circular
            :size="50"
            color="amber"
            indeterminate
            ></v-progress-circular>
        </div>
        <div v-if="!loading">
            <v-app-bar color="primary" dark fixed>
                <v-btn :to="{ name: 'product' }" icon>
                    <v-icon>mdi-arrow-left</v-icon>
                </v-btn>
                <v-spacer></v-spacer>

                <v-btn icon>
                    <v-badge color="red" content="0">
                        <v-icon>mdi-cart</v-icon>
                    </v-badge>
                </v-btn>
            </v-app-bar>
            <div class="mt-15">
                <v-container>
                    <v-row class="mb-5">
                        <v-col cols="12" md="4">
                            <v-carousel cycle hide-delimiters height="400">
                                <v-carousel-item
                                    v-if="product.gallery !== null"
                                    v-for="item in product.gallery"
                                    :key="item.id"
                                    :src="item.file_url"
                                ></v-carousel-item>
                            </v-carousel>
                        </v-col>
                        <v-col cols="12" md="8">
                            <h1 class="mb-5">{{product.name}}</h1>
                            <div class="d-flex d-md-block">
                                <v-chip class="mb-md-5">{{product.category.category_name}}</v-chip>
                                <v-spacer></v-spacer>
                                <h4><span class="primary--text">Rp. {{price(product.price)}}</span> <span class="text-body-2 grey--text">/day</span></h4>
                            </div>
                            <div class="mt-5 mb-10">
                                <h5 class="mb-2">Tags</h5>
                                <span class="grey--text">{{product.tags}}</span>
                            </div>
                            <v-row>
                                <v-col cols="12" md="6" class="d-flex justify-end">
                                    <el-input-number block  v-model="qty" @change="handleQtyChange" :min="1" :max="product.qty"></el-input-number>
                                </v-col>
                                <v-col cols="12" md="6">
                                    <v-btn @click="addToCart" block color="primary" large dark outlined rounded>
                                        <v-icon>mdi-cart</v-icon>
                                        <span>Pesan Sekarang</span>
                                    </v-btn>
                                </v-col>
                            </v-row>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col>
                            <div class="mb-5">

                            </div>
                            <div>
                                <h3 class="mb-2">Deskripsi</h3>
                                <div>{{product.description}}</div>
                            </div>
                        </v-col>
                    </v-row>
                </v-container>
            </div>
        </div>
    </div>
</template>
<script>
import { formatPrice } from "~/utils";
import { mapGetters,mapActions } from "vuex";
import axios from "axios";
export default {
    layout: "simple",
    data: () => ({
        loading: true,
        qty:1,
        product: {
            category: {
                category_name: ''
            }
        }
    }),
    async mounted() {
        let slug = this.$route.params.slug;
        let getProduct = await this.$store.dispatch(
            "frontend/setSingleProduct",
            { slug }
        );

        let theProduct = this.$store.state.frontend.singleProduct

        if (theProduct) {
                setTimeout(() => {
                    this.loading = false;
                    this.product = theProduct
                }, 2000);
            }


    },
    computed: {
        // ...mapGetters({
        //     product: "frontend/singleProduct",
        // }),
    },
    methods: {
        ...mapActions(['frontend/setSingleProduct']),
        price(value) {
            return formatPrice(value);
        },
        handleQtyChange(value) {
            console.log(value)
        },
        async addToCart(){
            let data = {
                id: this.product.id,
                name: this.product.name,
                qty: this.qty,
                price: this.product.price,
                total: this.product.price * this.qty
            }

            let response = await this.$store.dispatch('cart/setItemCart', {data})
        },
    },
};
</script>
<style>
    .page-loading{
        width: 100%;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>
