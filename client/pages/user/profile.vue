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
        <v-img
            src="https://cdn.vuetifyjs.com/images/lists/ali.png"
            height="300px"
            dark
        >
            <v-row>
                <v-spacer></v-spacer>
                <v-card-title>
                    <div class="text-h5 pr-5">{{ user.name }}</div>
                    <v-btn dark icon class="mr-4">
                        <v-icon>mdi-pencil</v-icon>
                    </v-btn>
                </v-card-title>
            </v-row>
        </v-img>

        <v-list two-line>
            <v-list-item>
                <v-list-item-icon>
                    <v-icon color="indigo"> mdi-phone </v-icon>
                </v-list-item-icon>

                <v-list-item-content>
                    <v-list-item-title>(650) 555-1234</v-list-item-title>
                    <v-list-item-subtitle>Mobile</v-list-item-subtitle>
                </v-list-item-content>

                <v-list-item-icon>
                    <v-icon>mdi-whatsapp</v-icon>
                </v-list-item-icon>
            </v-list-item>


            <v-divider inset></v-divider>

            <v-list-item>
                <v-list-item-icon>
                    <v-icon color="indigo"> mdi-email </v-icon>
                </v-list-item-icon>

                <v-list-item-content>
                    <v-list-item-title
                        >aliconnors@example.com</v-list-item-title
                    >
                    <v-list-item-subtitle>Personal</v-list-item-subtitle>
                </v-list-item-content>
            </v-list-item>

            <v-divider inset></v-divider>

            <v-list-item>
                <v-list-item-icon>
                    <v-icon color="indigo"> mdi-map-marker </v-icon>
                </v-list-item-icon>

                <v-list-item-content>
                    <v-list-item-title>1400 Main Street</v-list-item-title>
                    <v-list-item-subtitle
                        >Orlando, FL 79938</v-list-item-subtitle
                    >
                </v-list-item-content>
            </v-list-item>
        </v-list>
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
