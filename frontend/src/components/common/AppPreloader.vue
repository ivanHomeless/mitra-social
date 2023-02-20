<template>
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="@/assets/img/AdminLTELogo.png" alt="AdminLTELogo" height="128" width="128">
  </div>
</template>

<script>
export default {
  name: "AppPreloader",
  mounted() {
    const preloader = jQuery('.preloader')
    preloader.css('height', 0);
    setTimeout(function () {
      preloader.children().hide();
    }, 200);
  },
}
</script>

<style scoped>

</style>