<template>
    <v-app>
      <v-app-bar app dense elevation="0" tile flat>
        <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
      </v-app-bar>

      <v-navigation-drawer v-model="drawer" app>
        <admin-sidebar />
      </v-navigation-drawer>

      <!-- Sizes your content based upon application components -->
      <v-main>
        <v-container fluid>
          <nuxt />
        </v-container>
      </v-main>

      <v-footer color="tertiary" dark app>
        <!-- -->
        <span class="text--white">
          &copy;Achalendra Outdoor - {{new Date().getFullYear()}}
        </span>

      </v-footer>
    </v-app>
</template>

<script>
import Navbar from "~/components/Navbar";
import AdminSidebar from "~/components/AdminSidebar";
import { mapGetters } from "vuex";

export default {
  components: {
    Navbar,
    AdminSidebar,
  },

  data: () => ({
    drawer: true,
    group: null,
  }),

  watch: {
    group() {
      this.drawer = false;
    },
  },

  computed: mapGetters({
    role: "auth/role",
  }),
};
</script>
