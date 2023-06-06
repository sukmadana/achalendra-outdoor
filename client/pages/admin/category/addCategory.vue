<template>
    <card title="Add Category">
        <div class="py-md-6 px-md-8 pa-0">
            <v-row>
                <v-col cols="12" md="8">
                    <form @submit.prevent="add">
                        <div class="form-wrapper mb-8">
                            <v-text-field
                                v-model="form.name"
                                :error-messages="nameEmpty"
                                label="Name"
                                required
                                @input="$v.name.$touch()"
                                @blur="$v.name.$touch()"
                            ></v-text-field>
                        </div>
                        <v-btn
                            color="primary"
                            type="submit"
                            :disabled="isLoading"
                            :loading="isLoading"
                            class="mr-4"
                            >Add Category</v-btn
                        >
                        <v-btn :to="{name:'admin.category'}" color="default">cancel</v-btn>
                    </form>
                </v-col>
            </v-row>
        </div>
    </card>
</template>

<script>
import Form from "vform";
import { validationMixin } from "vuelidate";
import { required } from "vuelidate/lib/validators";

export default {
    layout: "admin",
    middleware: "auth-admin",
    mixins: [validationMixin],
    validations: {
        name: { required },
    },
    data() {
        return {
            isLoading: false,
            form: new Form({
                name: "",
            }),
        };
    },
    computed: {
        nameEmpty() {
            const errors = [];
            if (!this.$v.name.$dirty) return errors;
            !this.$v.name.required && errors.push("Name is required.");
            return errors;
        },
    },
    methods: {
        async add() {
            let data;

            try {
                const response = await this.form.post(
                    "/admin/product-category/create"
                );
                data = response.data;

                await this.$store.dispatch("categories/fetchCategories");
            } catch (error) {
                console.log(error);
            }

            if (data) {
                this.$router.push({ name: "admin.category" });
            }
        },
    },
};
</script>
