<template>
    <div class="sidebar-wrapper">
        <div class="sidebar-header">
            <div class="mt-auto mb-4 block mt-10">
                <v-avatar size="avatarSize" color="red" class="mb-1 mt-auto">
                    <img
                        v-if="user.photo_url"
                        :src="user.photo_url"
                        alt=" User profile"
                    />
                    <v-icon v-else> mdi-account-circle </v-icon>
                </v-avatar>
                <v-sheet
                    width="100%"
                    class="col-12 transparent pa-0 w-100 d-flex align-center justify-space-between flex-grow-1 flex-shrink-0"
                >
                    <h3 class="flex-grow-1 flex-shrink-0">{{ user.name }}</h3>
                    <v-spacer></v-spacer>

                    <v-menu bottom left>
                        <template v-slot:activator="{ on, attrs }">
                            <v-btn icon v-bind="attrs" v-on="on">
                                <v-icon>mdi-dots-vertical</v-icon>
                            </v-btn>
                        </template>

                        <v-list>
                            <v-list-item>
                                <v-btn color="secondary" @click.prevent="logout">
                                    Logout
                                </v-btn>
                            </v-list-item>
                        </v-list>
                    </v-menu>
                </v-sheet>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li class="sidebar-menu__item">
                <router-link
                    class="sidebar-menu__item--link"
                    :to="{ name: 'admin.home' }"
                    >Dashboard</router-link
                >
            </li>
            <li class="sidebar-menu__item">
                <v-btn
                    class="sidebar-menu__item--link"
                    text
                    @click="showProduct = !showProduct"
                >
                    <span>Product</span>
                    <v-icon>{{
                        showProduct ? "mdi-chevron-up" : "mdi-chevron-down"
                    }}</v-icon>
                </v-btn>
                <v-expand-transition>
                    <div v-show="showProduct">
                        <v-divider></v-divider>
                        <router-link
                            class="sidebar-menu__item--link"
                            :to="{ name: 'admin.category' }"
                            >Category</router-link
                        >
                        <router-link
                            class="sidebar-menu__item--link"
                            :to="{ name: 'admin.product' }"
                            >Product</router-link
                        >
                    </div>
                </v-expand-transition>
            </li>

            <li class="sidebar-menu__item">
                <v-btn
                    class="sidebar-menu__item--link"
                    text
                    @click="showOrder = !showOrder"
                >
                    <span>Order</span>
                    <v-icon>{{
                        showOrder ? "mdi-chevron-up" : "mdi-chevron-down"
                    }}</v-icon>
                </v-btn>
                <v-expand-transition>
                    <div v-show="showOrder">
                        <v-divider></v-divider>
                        <router-link
                            class="sidebar-menu__item--link"
                            :to="{ name: 'admin.category' }"
                            >New Order</router-link
                        >
                        <router-link
                            class="sidebar-menu__item--link"
                            :to="{ name: 'admin.category' }"
                            >Order History</router-link
                        >
                    </div>
                </v-expand-transition>
            </li>
        </ul>
    </div>
</template>
<script>
import { mapGetters } from "vuex";
export default {
    data: () => ({
        showProduct: false,
        showOrder: false,
    }),
    computed: mapGetters({
        user: "auth/user",
    }),

    methods: {
        async logout() {
            // Log out the user.
            await this.$store.dispatch("auth/logout");

            // Redirect to login.
            this.$router.push({ name: "login" });
        },
    },
};
</script>
<style>
    .v-toolbar__content{
        width: 100%;
    }
</style>
