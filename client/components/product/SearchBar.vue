<template>
    <!--SEARCH BAR-->
    <v-row class="search-bar">
        <v-container class="py-0">
            <v-col cols="12" class="py-0">
                <v-text-field
                    placeholder="Cari perlengkapan yang kamu perlukan..."
                    outlined
                    color="primary"
                    append-icon="mdi-magnify"
                ></v-text-field>
            </v-col>
        </v-container>
    </v-row>
    <!--END SEARCH BAR-->
</template>
<script>
    export default{
        name: 'search-bar'
    }
</script>
