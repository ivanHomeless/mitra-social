<template>
  <div class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <AppPreloader/>

    <!-- Navbar -->
    <TheHeader/>

    <!-- Main Sidebar Container -->
    <TheSidebar/>

    <!-- Content Wrapper. Contains page content -->

    <router-view/>

    <!-- /.content-wrapper -->

    <TheFooter/>

  </div>
  <!-- ./wrapper -->

  </div>
</template>

<script>
import TheSidebar from "@/components/app/TheSidebar"
import TheFooter from "@/components/app/TheFooter"
import TheHeader from "@/components/app/TheHeader"
import AppPreloader from "@/components/common/AppPreloader"


export default {
  name: 'MainLayout',

  mounted() {
    this.$store.dispatch('fetchUser')
  },
  components: {TheFooter, TheSidebar, TheHeader, AppPreloader}
}
</script>

<style scoped>

</style>