<template>
    <div class="overflow-hidden">
        <v-app-bar
            absolute
            color="primary"
            dark
            shrink-on-scroll
            prominent
            src="https://picsum.photos/1920/1080?random"
            fade-img-on-scroll
            scroll-target="#scrolling-techniques-5"
            scroll-threshold="500"
        >
            <template v-slot:img="{ props }">
                <v-img
                    v-bind="props"
                    gradient="to top right, rgba(55,236,186,.7), rgba(25,32,72,.7)"
                ></v-img>
            </template>


            <v-app-bar-title> Achalendra Outdoor </v-app-bar-title>

        </v-app-bar>
        <v-sheet
            id="scrolling-techniques-5"
            class="overflow-y-auto overflow-x-hidden"
            height="100vh"
            style="padding-top: 180px"
        >
            <!--SEARCH BAR-->
            <v-row class="search-bar">
                <v-container class="py-0">
                    <v-col cols="12" class="py-0">
                        <v-text-field
                            placeholder="Cari perlengkapan yang kamu perlukan..."
                            outlined
                            color="primary"
                            prepend-inner-icon="mdi-magnify"
                        ></v-text-field>
                    </v-col>
                </v-container>
            </v-row>
            <!--END SEARCH BAR-->

            <!--MENU ICON-->
            <v-container class="pb-10">
                <v-row>
                    <v-col cols="12">
                        <v-card class="px-5 py-10">
                            <v-row>
                                <v-col cols="4" class="d-flex justify-content-center align-center flex-column">
                                    <v-btn
                                        color="primary"
                                        fab
                                        icon
                                        outlined
                                        plain
                                        raised
                                    >
                                        <v-icon dark> mdi-gauge </v-icon>
                                    </v-btn>
                                    <span>Dashboard</span>
                                </v-col>
                                <v-col cols="4" class="d-flex justify-content-center align-center flex-column">
                                    <v-btn
                                        color="primary"
                                        fab
                                        icon
                                        outlined
                                        plain
                                        raised
                                    >
                                        <v-icon dark> mdi-calendar-multiple </v-icon>
                                    </v-btn>
                                    <span>Pesanan</span>
                                </v-col>
                                <v-col cols="4" class="d-flex justify-content-center align-center flex-column">
                                    <v-btn
                                        color="primary"
                                        fab
                                        icon
                                        outlined
                                        plain
                                        raised
                                    >
                                        <v-icon dark> mdi-credit-card-outline </v-icon>
                                    </v-btn>
                                    <span>Tagihan</span>
                                </v-col>
                                <v-col cols="4" class="d-flex justify-content-center align-center flex-column">
                                    <v-btn
                                        color="primary"
                                        fab
                                        icon
                                        outlined
                                        plain
                                        raised
                                    >
                                        <v-icon dark> mdi-calendar-check </v-icon>
                                    </v-btn>
                                    <span>Kembalikan</span>
                                </v-col>
                                <v-col cols="4" class="d-flex justify-content-center align-center flex-column">
                                    <v-btn
                                        color="primary"
                                        fab
                                        icon
                                        outlined
                                        plain
                                        raised
                                    >
                                        <v-icon dark> mdi-calendar-clock-outline </v-icon>
                                    </v-btn>
                                    <span>History</span>
                                </v-col>
                                <v-col cols="4" class="d-flex justify-content-center align-center flex-column">
                                    <v-btn
                                        color="primary"
                                        fab
                                        icon
                                        outlined
                                        plain
                                        raised
                                    >
                                        <v-icon dark> mdi-dots-grid </v-icon>
                                    </v-btn>
                                    <span>Jelajah</span>
                                </v-col>
                            </v-row>
                        </v-card>
                    </v-col>
                </v-row>
            </v-container>
            <!--END MENU ICON-->

            <v-container class="py-10">
                <v-row>
                    <v-col cols="12">
                        <h2>Produk populer</h2>
                        <p class="text-md-caption">Jangan sampai kehabisan produk utama ini yang biasanya paling kalian perlukan.</p>
                    </v-col>
                </v-row>
            </v-container>

            <!--CATEGORY LIST-->
            <v-sheet class="mx-auto" max-width="700">
                <v-slide-group multiple show-arrows>
                    <v-slide-item
                        v-for="n in 5"
                        :key="n"
                        v-slot="{ active, toggle }"
                    >
                        <v-btn
                            class="mx-2"
                            :input-value="active"
                            active-class="purple white--text"
                            depressed
                            rounded
                            color="primary"
                            @click="toggle"
                        >
                            Options {{ n }}
                        </v-btn>
                    </v-slide-item>
                </v-slide-group>
            </v-sheet>
            <!--END CATEGORY LIST-->

            <!--FEATURE PRODUCT-->
            <v-container class="py-5 md:py-15">
                <v-row class="feature-product py-5">
                    <v-col cols="12" md="4" v-for="n in 6" :key="n">
                        <v-card class="mx-auto" max-width="400">
                            <v-img
                                class="white--text align-end"
                                height="200px"
                                src="https://cdn.vuetifyjs.com/images/cards/docks.jpg"
                            >
                            </v-img>
                            <v-card-title
                                >Top 10 Australian beaches</v-card-title
                            >

                            <v-card-text class="text--primary">
                                <div>Whitehaven Beach</div>
                            </v-card-text>

                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="primary" text>
                                    Pesan Sekarang!
                                </v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-col>
                </v-row>
            </v-container>
            <!--END FEATURE PRODUCT-->
        </v-sheet>
    </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
    layout: "simple",

    data: () => ({
        title: process.env.appName,
        model: null,
    }),

    head() {
        return { title: this.$t("home") };
    },

    computed: mapGetters({
        authenticated: "auth/check",
    }),
};
</script>

<style scoped>
</style>
