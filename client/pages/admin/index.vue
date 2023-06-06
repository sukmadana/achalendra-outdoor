<template>
  <div class="dashboard-home">
    <h1>Home Admin</h1>
    <v-card>
      <v-card-text>
        <v-skeleton-loader
            type=" image, article,actions"
          ></v-skeleton-loader>

      </v-card-text>
    </v-card>
  </div>
</template>

<script>
export default {
  layout: "admin",
  middleware: "auth-admin",

  head() {
    return { title: "Admin Dashboard" };
  },
};
</script>
