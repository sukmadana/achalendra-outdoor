<template>
    <div>
        <v-toolbar color="primary" dark fixed>
            <v-btn icon>
                <v-icon>mdi-arrow-left</v-icon>
            </v-btn>

            <v-spacer></v-spacer>

            <v-btn icon>
                <v-badge color="red" content="0">
                    <v-icon>mdi-bell-ring</v-icon>
                </v-badge>
            </v-btn>
        </v-toolbar>
        <v-card dark tile height="300" color="primary" class="pa-10" flat>
            <v-container>
                <div class="d-flex justify-center">
                    <v-avatar size="120">
                        <img
                            src="https://cdn.vuetifyjs.com/images/john.jpg"
                            alt="John"
                        />
                    </v-avatar>
                </div>
                <v-card-title
                    primary-title
                    class="text-center d-flex justify-center"
                >
                    <div>
                        <h3 class="headline mb-0">John Doe</h3>
                        <p class="text-caption">New Member</p>
                    </div>
                </v-card-title>
            </v-container>
        </v-card>

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
                                    <v-icon dark> mdi-account-edit </v-icon>
                                </v-btn>
                                <span>Profile</span>
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
                                    <v-icon dark> mdi-cogs </v-icon>
                                </v-btn>
                                <span>Setting</span>
                            </v-col>
                        </v-row>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>
        <!--END MENU ICON-->

        <div class="latest-book py-10">
            <v-container>
                <div class="mb-10">
                    <v-row>
                        <v-flex xs2 align-self-start class="pl-3">
                            <v-icon color="secondary" x-large>mdi-cart</v-icon>
                        </v-flex>
                        <v-flex xs10>
                            <h2>Pesanan</h2>
                            <p>Daftar pesanan kamu yang sedang berlangsung.</p>
                        </v-flex>
                    </v-row>
                </div>
                <v-row>
                    <v-col cols="12" md="4" v-for="n in 3" :key="n" class="pa-2">
                        <v-card color="light-green lighten-5">
                            <v-row no-gutters>
                                <v-col cols="4">
                                    <v-img height="100%" width="100%" src="https://picsum.photos/id/11/500/300"></v-img>
                                </v-col>
                                <v-col>
                                    <div class="pa-5" >
                                        <h4 class="text-bold">Product title</h4>
                                        <p class="mb-0">Lorem ipsum dolor sit amet.</p>
                                    </div>
                                </v-col>
                            </v-row>
                        </v-card>
                    </v-col>
                </v-row>
                <div class="pt-10 pb-15">
                    <v-btn rounded outlined color="primary" large block>Lihat semua pesanan</v-btn>
                </div>
            </v-container>
        </div>
    </div>
</template>
<script>
export default {
    layout: "simple",
    data: () => ({
        user: {
            name: "John Doe",
        },
    }),
};
</script>
