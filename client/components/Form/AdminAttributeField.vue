<template>
    <v-row>
        <v-col cols="6">
            <v-text-field
                label="Attribute"
                v-model="attibute.name"
                outlined
            ></v-text-field>
        </v-col>
        <v-col cols="6">
            <v-text-field
                label="Value"
                v-model="attibute.value"
                outlined
            ></v-text-field>
        </v-col>
    </v-row>
</template>
<script>
export default {
    props: {
        value: {
            type: Object
        },
    },
    computed: {
        attributes: {
            get() {
                return this.value;
            },
            set(attributes) {
                this.$emit("input", attributes);
            },
        },
    },
};
</script>
