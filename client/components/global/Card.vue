<template>
  <div class="dashboard--wrapper pa-6">
    <div v-if="title" class="card-header mb-8">
      <h3>
        {{ title }}
      </h3>
    </div>

    <v-card>
		<div v-if="button">
			<v-card-title class="mb-4 flex justify-content-lg-end w-100">
			  <v-btn :to="toUrl" color="secondary" tile class="py-4 px-5 ml-auto"
				>Add {{ title }}</v-btn
			  >
			</v-card-title>
		</div>

      <v-card-text>
        <slot />
      </v-card-text>
    </v-card>
  </div>
</template>

<script>
export default {
  name: "Card",

  props: {
    title: { type: String, default: null },
	button: {type: Boolean, default: false},
	toUrl: {type: String, default: null}
  },
};
</script>
