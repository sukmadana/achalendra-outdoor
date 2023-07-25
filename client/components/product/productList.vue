<template>
    <v-container>
        <v-row>
            <v-col cols="6" md="4" v-if="loading">
                <v-skeleton-loader type="card"></v-skeleton-loader>
            </v-col>
            <v-col cols="6" md="4" v-for="product in products" :key="product.id" v-if="!loading">
                <v-card>
                    <v-card-media :src="product.gallery[0].file_url">
                    </v-card-media>
                    <v-card-title primary-title>
                        <div>
                            <h3 class="headline mb-0">{{product.product_name}}</h3>
                            <div>{{product.category.category_name}}</div>
                        </div>
                    </v-card-title>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn flat color="primary">Lihat Product</v-btn>
                    </v-card-actions>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>
<script>
    import { mapGetters } from "vuex";

    export default {
        data:() => {
            loading: true
        },
        async mounted(){
            let getProduct = await this.$store.dispatch("frontend/fetchAllProducts");

            setTimeout(() => {
                this.loading = false;
            }, 2000);
        },
        computed: {
            ...mapGetters({
                products: "frontend/products",
            }),
        },
    }
</script>
