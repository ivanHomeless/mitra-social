<template>
  <div>
    <ul>
      <li v-for="item in 5">
        <slot :iter="item"/>
      </li>
    </ul>
  </div>
</template>

<script>
function calculateDaysBetweenDates(begin, end) {

}

export default {
  name: "TheTest",

}
</script>

<style scoped>

</style>