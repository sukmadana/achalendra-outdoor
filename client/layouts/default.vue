<template>
  <div class="dashboard" :class="role">
    <navbar />

    <nuxt />
  </div>
</template>

<script>
import Navbar from '~/components/Navbar'
import { mapGetters } from 'vuex'

export default {
  components: {
    Navbar
  },

  computed: mapGetters({
    role: 'auth/role'
  }),
}
</script>
