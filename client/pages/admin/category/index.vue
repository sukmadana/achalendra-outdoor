<template>
    <div class="pa-6 dashboard--wrapper">
        <div class="dashboard--heading text-h3 mb-8">Category</div>
        <v-card>
            <v-card-title class="mb-4 flex justify-content-lg-end w-100">
                <v-btn
                @click.stop="add"
                    color="secondary"
                    tile
                    class="py-4 px-5 ml-auto"
                    >Add Category</v-btn
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
                    :items="categories"
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
        <!--ADD-->
        <v-dialog
            v-model="addModal"
            max-width="400px"
            transition="dialog-transition"
        >
            <v-card>
                <v-card-title>
                    <h3 class="headline">Add New Category</h3>
                </v-card-title>
                <v-card-text>
                    <v-form @submit.prevent="storeCategory" v-model="valid">
                        <div class="form-group">
                            <v-text-field
                                v-model="form.name"
                                :rules="nameRules"
                                label="Name"
                                id="id"
                                required
                            ></v-text-field>
                        </div>
                        <div class="button w-full">
                            <v-spacer></v-spacer>
                            <v-btn color="default" @click="clearForm"
                                >Cancel</v-btn
                            >
                            <v-btn color="primary" type="submit">Save</v-btn>
                        </div>
                    </v-form>
                </v-card-text>
            </v-card>
        </v-dialog>

        <!--UPDATE-->
        <v-dialog
            v-model="deleteConfirm"
            max-width="270px"
            transition="dialog-transition"
        >
            <v-card color="warning">
                <v-card-title>
                    <div>
                        <h3 class="headline white--text mb-0">
                            Delete Category
                        </h3>
                    </div>
                </v-card-title>
                <v-card-text>
                    <p class="white--text">
                        Are you sure to delete this record?
                    </p>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="default" @click="clearDelete">Cancel</v-btn>
                    <v-btn color="error" @click="confirmDelete">Delete</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <v-dialog
            v-model="updateModal"
            max-width="400px"
            transition="dialog-transition"
        >
            <v-card>
                <v-card-title>
                    <h3 class="headline" v-if="updateItem">
                        Update {{ updateItem.name }}
                    </h3>
                </v-card-title>
                <v-card-text>
                    <v-form @submit.prevent="runUpdate" v-model="valid">
                        <div class="form-group">
                            <v-text-field
                                v-if="updateItem"
                                v-model="form.name"
                                :rules="nameRules"
                                label="label"
                                id="id"
                                required
                            ></v-text-field>
                        </div>
                        <div class="button w-full">
                            <v-spacer></v-spacer>
                            <v-btn color="default" @click="clearUpdate"
                                >Cancel</v-btn
                            >
                            <v-btn color="primary" type="submit">Update</v-btn>
                        </div>
                    </v-form>
                </v-card-text>
            </v-card>
        </v-dialog>
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
                { text: "Category Name", value: "name" },
                { text: "Slug", value: "slug" },
                { text: "Action", value: "action", sortable: false },
            ],
            form: new Form({
                name: "",
            }),
            loading: true,
            deleteConfirm: false,
            deleteID: null,
            addModal: false,
            updateModal: false,
            valid: false,
            updateItem: null,
            nameRules: [(v) => !!v || "Name is required"],
        };
    },

    async mounted() {
        let getData = await this.$store.dispatch("categories/fetchCategories");

        setTimeout(() => {
            this.loading = false;
        }, 2000);
    },
    computed: {
        ...mapState({
            isLoaded: "isLoaded",
        }),
        ...mapGetters({
            categories: "categories/categories",
            isLoaded: "categories/isLoaded",
        }),
    },
    methods: {
        // ADD
        add() {
            this.clearForm();
            this.addModal = true;
        },

        async storeCategory() {
            try {
                const result = this.form.post("/admin/product-category/create");

                let getData = await this.$store.dispatch(
                    "categories/fetchCategories"
                );
                mapGetters({
                    categories: "categories/categories",
                    isLoaded: "categories/isLoaded",
                });

                this.$router.push({ name: "admin.category" });
                this.clearForm();
            } catch (error) {
                console.log(error);
            }
        },
        clearForm() {
            this.form.name = "";
            if (this.addModal === true) {
                this.addModal = false;
            }
        },

        // DELETE
        setDelete(id) {
            this.deleteID = id;
            this.deleteConfirm = true;
        },
        clearDelete() {
            this.deleteConfirm = false;
            this.deleteID = [];
        },
        async confirmDelete() {
            try {
                const response = await axios.get(
                    "/admin/product-category/delete/" + this.deleteID
                );
                if (response.status) {
                    let getData = await this.$store.dispatch(
                        "categories/fetchCategories"
                    );
                    mapGetters({
                        categories: "categories/categories",
                        isLoaded: "categories/isLoaded",
                    });

                    this.clearDelete();
                }
            } catch (error) {
                console.log(error);
            }
        },

        // UPDATE
        setUpdate(item) {
            this.updateItem = item;
            this.form.name = item.name;
            this.updateModal = true;
        },
        clearUpdate() {
            this.updateModal = false;
            this.updateItem = [];
        },
        async runUpdate() {
            let data;

            try {
                const response = await this.form.patch(
                    "/admin/product-category/update/" + this.updateItem.slug
                );
                let getData = await this.$store.dispatch(
                    "categories/fetchCategories"
                );
                mapGetters({
                    categories: "categories/categories",
                    isLoaded: "categories/isLoaded",
                });

                this.clearUpdate();
                this.$router.push({ name: "admin.category" });
            } catch (error) {
                console.log(error);
            }
        },
    },
};
</script>
