<template>
    <div>
        <card title="Attributes">
            <v-card-title class="mb-4 flex justify-content-lg-end w-100">
                <v-btn
                    @click.stop="add"
                    color="secondary"
                    class="py-4 px-5 ml-auto"
                    >Add Attribute</v-btn
                >
            </v-card-title>
            <div class="wrapper">
                <v-skeleton-loader
                    type="table-thead, table-tbody"
                    loading="loading"
                    v-show="loading"
                ></v-skeleton-loader>
                <v-data-table
                    v-show="!loading"
                    :headers="headers"
                    :items="attributes"
                    :items-per-page="5"
                    item-key="id"
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
                            @click.stop="setDelete(item.slug)"
                            color="error"
                            class="my-2 mx-1"
                            fab
                            small
                        >
                            <v-icon>mdi-delete</v-icon>
                        </v-btn>
                    </template>
                </v-data-table>
            </div>
        </card>

        <!--ADD-->
        <v-dialog
            v-model="addModal"
            max-width="400px"
            transition="dialog-transition"
        >
            <v-card>
                <v-card-title>
                    <h3 class="headline">Add New Attributes</h3>
                </v-card-title>
                <v-card-text>
                    <v-form @submit.prevent="storeAttribute" v-model="valid">
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

        <!--Update-->
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
                            <v-btn color="default" @click="clearForm"
                                >Cancel</v-btn
                            >
                            <v-btn color="primary" type="submit">Update</v-btn>
                        </div>
                    </v-form>
                </v-card-text>
            </v-card>
        </v-dialog>

        <!--DELETE-->
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
    </div>
</template>
<script>
import axios from "axios";
import { mapGetters, mapState } from "vuex";
import Form from "vform";

export default {
    middleware: "auth-admin",
    layout: "admin",
    data() {
        return {
            headers: [
                { text: "Attribute Name", value: "name" },
                { text: "Slug", value: "slug" },
                { text: "Action", value: "action", sortable: false },
            ],
            loading: true,
            form: new Form({
                name: "",
            }),
            valid: false,
            addModal: false,
            updateModal: false,
            updateItem: null,
            deleteConfirm: false,
            deleteID: null,
            nameRules: [(v) => !!v || "Name is required"],
        };
    },
    async mounted() {
        let getData = await this.$store.dispatch("attribute/fetchAttributes");

        setTimeout(() => {
            this.loading = false;
        }, 2000);
    },
    computed: {
        ...mapGetters({
            attributes: "attribute/attributes",
        }),
    },
    methods: {
        add() {
            this.clearForm();
            this.addModal = true;
        },

        clearForm() {
            this.form.name = "";
            if (this.addModal === true) {
                this.addModal = false;
            }

            if (this.updateModal === true) {
                this.updateModal = false;
            }
        },

        async storeAttribute() {
            try {
                const result = this.form.post("/admin/attribute/create");

                let getData = await this.$store.dispatch(
                    "attribute/fetchAttributes"
                );

                this.clearForm();
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
        async runUpdate() {
            let data;

            try {
                const response = await this.form.patch(
                    "/admin/attribute/update/" + this.updateItem.slug
                );
                let getData = await this.$store.dispatch(
                    "attribute/fetchAttributes"
                );

                this.clearForm();
            } catch (error) {
                console.log(error);
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
                    "/admin/attribute/delete/" + this.deleteID
                );
                if (response.status) {
                    let getData = await this.$store.dispatch(
                        "attribute/fetchAttributes"
                    );

                    this.clearDelete();
                }
            } catch (error) {
                console.log(error);
            }
        },
    },
};
</script>
