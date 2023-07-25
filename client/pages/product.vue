<template>
    <div>
        <v-app-bar color="primary" dark fixed>
            <v-btn :to="{name: 'welcome'}" icon>
                <v-icon>mdi-arrow-left</v-icon>
            </v-btn>
            <v-spacer></v-spacer>

            <v-btn icon>
                <v-badge color="red" content="0">
                    <v-icon>mdi-cart</v-icon>
                </v-badge>
            </v-btn>
        </v-app-bar>
        <v-carousel hide-delimiters height="200" class="mt-10" show-arrows-on-hover cycle>
            <v-carousel-item
                v-for="(item, i) in bannerImage"
                :key="i"
                :src="require(`~/assets/image/banner/${item}`)"
            ></v-carousel-item>
        </v-carousel>

        <product-filter />

        <v-container>
            <v-row>
                <v-col cols="6" md="4" v-if="loading" v-for="n in 4" :key="n">
                    <v-skeleton-loader type="card"></v-skeleton-loader>
                </v-col>
                <v-col
                    cols="6"
                    md="4"
                    v-for="product in products"
                    :key="product.id"
                    v-if="!loading"
                >
                    <v-card>
                        <v-img
                            height="150"
                            :src="product.gallery[0].file_url"
                        ></v-img>
                        <v-card-title>
                            <div>
                                <h3 class="headline mb-0">
                                    {{ product.name }}
                                </h3>
                                <div>{{ product.category.category_name }}</div>
                            </div>
                            <v-spacer class="hidden-xs-only"></v-spacer>
                            <div>
                                <div>
                                    <span class="text--primary text-body-1"
                                        >Rp. {{ price(product.price) }}</span
                                    >
                                    <span class="text-caption text--accent-2"
                                        >/hari</span
                                    >
                                </div>
                            </div>
                        </v-card-title>
                        <v-card-actions>
                            <v-btn  block :to="{name: 'product.single', params: {slug: product.slug}}" rounded color="primary"
                                >Lihat Product</v-btn
                            >
                        </v-card-actions>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>
    </div>
</template>
<script>
import { formatPrice } from "~/utils";
import { mapGetters } from "vuex";
import productFilter from '~/components/product/productFilter';

export default {
    layout: "simple",
    components: {
        productFilter
    },
    data: () => ({
        loading: true,
        bannerImage: ["banner1.png", "banner2.jpg", "banner3.jpg"],
    }),
    async mounted() {
        let getProduct = await this.$store.dispatch("frontend/fetchAllProduct");

        setTimeout(() => {
            this.loading = false;
        }, 2000);
    },
    computed: {
        ...mapGetters({
            products: "frontend/products",
        }),
    },
    methods: {
        price(value) {
            return formatPrice(value);
        }
    },
};
</script>
