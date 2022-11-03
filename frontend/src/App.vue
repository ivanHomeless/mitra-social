<template>
  <div id="app">
    <component :is="layout"/>
  </div>
</template>

<script>
import EmptyLayout from '@/layouts/EmptyLayout'
import MainLayout from '@/layouts/MainLayout'
export default {
  computed: {
    layout() {
      return (this.$route.meta.layout || 'empty') + '-layout'
    }
  },
  components: {
    EmptyLayout, MainLayout
  }
}
</script>

<style lang="scss">
@import 'https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback';
@import 'assets/plugins/fontawesome-free/css/all.css';
@import 'assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css';
@import 'assets/plugins/toastr/toastr.css';
@import 'assets/css/adminlte.min.css';
</style>