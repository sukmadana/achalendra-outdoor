<template>
    <div class="pa-6 dashboard--wrapper">
        <div class="dashboard--heading text-h3 mb-8">Products</div>
        <v-card>
            <v-card-title class="mb-4 flex justify-content-lg-end w-100">
                <v-btn
                    :to="{ name: 'admin.product.add' }"
                    color="secondary"
                    tile
                    class="py-4 px-5 ml-auto"
                    >Add new Product</v-btn
                >
            </v-card-title>
            <v-card-text>
                <v-skeleton-loader
                    type="table-thead, table-tbody"
                    loading="loading"
                    v-show="loading"
                ></v-skeleton-loader>
                <v-data-table
                    v-show="!loading"
                    :headers="headers"
                    :items="products"
                    :items-per-page="5"
                    class="elevation-0"
                    loading="{isLoaded}"
                >
                    <template v-slot:item.action="{ item }">
                        <v-btn
                            @click.stop="setUpdate(item)"
                            color="success"
                            class="my-2 mx-1"
                            fab
                            small
                        >
                            <v-icon>mdi-pencil</v-icon>
                        </v-btn>
                        <v-btn :to="{ name: 'admin.product.image', params: { slug: item.slug } }" color="accent" class="my-2 mx-1" fab small>
                            <v-icon>mdi-image-plus</v-icon>
                        </v-btn>
                        <v-btn
                            @click.stop="setDelete(item.id)"
                            color="error"
                            class="my-2 mx-1"
                            fab
                            small
                        >
                            <v-icon>mdi-delete</v-icon>
                        </v-btn>
                    </template>
                </v-data-table>
            </v-card-text>
        </v-card>
    </div>
</template>
<script>
import { mapGetters, mapState } from "vuex";
import axios from "axios";
import Form from "vform";

export default {
    layout: "admin",
    middleware: "auth-admin",

    data() {
        return {
            headers: [
                { text: "Product Name", value: "name" },
                { text: "Slug", value: "slug" },
                {text: "Price", value: "price"},
                {text: "Category", value: "category.category_name"},
                { text: "Action", value: "action", sortable: false },
            ],
            form: new Form({
                name: "",
            }),
            loading: true,
        };
    },

    async mounted() {
        let getData = await this.$store.dispatch("product/fetchProducts");
        setTimeout(()=> {
            this.loading = false
        }, 2000)
    },
    computed: {
        ...mapGetters({
            products: "product/products",
        }),
    },
    methods: {

    },
};
</script>
