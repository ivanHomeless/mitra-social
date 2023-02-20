<template>
  <footer class="main-footer">
    <strong>Copyright &copy; {{ year }} <a href="/">MitraSOCIAL</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>
</template>

<script>
export default {
  name: "TheFooter",
  computed: {
    year() {
      return new Date().getFullYear();
    },
  }
}
</script>

<style scoped>

</style>