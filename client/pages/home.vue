<template>
  <card :title="$t('home')">
    {{ $t('you_are_logged_in') }} User
  </card>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  middleware: 'auth',

  head () {
    return { title: this.$t('home') }
  },


}
</script>
