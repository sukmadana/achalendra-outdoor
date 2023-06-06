<template>
    <v-app id="inspire">
        <v-main>
            <v-container fluid fill-height>
                <v-layout align-center justify-center>
                    <v-flex xs12 sm8 md4>
                      
                        <v-card class="elevation-12">
                          <v-form
                                    @submit.prevent="login"
                                    v-model="valid"
                                >
                            <v-toolbar dark color="primary">
                                <v-toolbar-title>Login form</v-toolbar-title>
                            </v-toolbar>
                            <v-card-text>
                                
                                    <v-text-field
                                        label="Email"
                                        v-model="form.email"
                                        :rules="loginEmailRules"
                                        type="text"
                                        required
                                    ></v-text-field>
                                    <v-text-field
                                        id="password"
                                        label="Password"
                                        :rules="[rules.required, rules.min]"
                                        v-model="form.password"
                                        type="password"
                                        required
                                    ></v-text-field>
                                
                            </v-card-text>
                            <v-card-actions>
                                <v-row>
                                    <v-col cols="12">
                                        <v-checkbox
                                            label="Remember me"
                                            v-model="remember"
                                            name="remember"
                                        ></v-checkbox>
                                    </v-col>
                                    <v-col cols="6" class="flex w-100">
                                        <router-link
                                            :to="{ name: 'password.request' }"
                                            class="small ml-auto my-auto"
                                        >
                                            {{ $t("forgot_password") }}
                                        </router-link>
                                    </v-col>
                                    <v-col cols="6" class="d-flex justify-end">
                                        <v-btn color="primary" type="submit"
                                            >Login</v-btn
                                        >
                                    </v-col>
                                </v-row>
                            </v-card-actions>
                          </v-form>
                        </v-card>
                    </v-flex>
                </v-layout>
            </v-container>
        </v-main>
    </v-app>
</template>

<script>
import Form from "vform";
import {mapGetters} from 'vuex'

export default {
    layout: 'simple',
    middleware: "guest",

    data: () => ({
        valid: true,
        form: new Form({
            email: "",
            password: "",
        }),
        remember: false,
        loginEmailRules: [
            (v) => !!v || "Required",
            (v) => /.+@.+\..+/.test(v) || "E-mail must be valid",
        ],
        rules: {
            required: (value) => !!value || "Required.",
            min: (v) => (v && v.length >= 8) || "Min 8 characters",
        },
    }),

    head() {
        return { title: this.$t("login") };
    },
    
    computed: mapGetters({
        role: "user/role"
    }),

    methods: {
        async login() {
            let data;

            // Submit the form.
            try {
                const response = await this.form.post("/login");
                data = response.data;
                console.log(data);
            } catch (e) {
                console.log(e);;
            }

            // Save the token.
            this.$store.dispatch("auth/saveToken", {
                token: data.token,
                remember: this.remember,
            });

            // Fetch the user.
            await this.$store.dispatch("auth/fetchUser");

            console.log(this.$store.state.role);

            // Redirect home.
            if (this.role == 'admin') {
                this.$router.push({name: "admin.home"})
            }else{
                this.$router.push({ name: "home" });
            }
        },
    },
};
</script>
