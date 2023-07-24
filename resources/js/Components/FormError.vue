<template>
  <div class="text-xs text-red-500" v-if="errors.hasOwnProperty(property)">
    <ul>
      <li v-for="err in errors[property]">{{ err }}</li>
    </ul>
  </div>
</template>

<script>
export default {
  name: "FormError",
  props: ['errors', 'property'],
  setup(props) {

    return [];
  }
}
</script>

<style scoped>

</style>
