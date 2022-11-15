<template>
  <div>
    <div class="modal fade" :class="{'show': show}" id="modal-default"  aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">{{ modalTitle }}</h4>
            <button @click="$emit('modal-close')" type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <p>{{ modalBody }}</p>
          </div>
          <div class="modal-footer justify-content-between">
            <button @click="$emit('modal-close')" type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            <button v-if="control" @click="$emit('modal-action')" type="button" class="btn btn-primary">{{ controlTitle }}</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <div v-if="show" class="modal-backdrop fade" :class="{'show': show}"></div>
  </div>
</template>

<script>
export default {
  name: "AppModal",
  emits: ['modal-action', 'modal-close'],
  props: {
    modalTitle: {
      type: String,
      require: false,
      default: '',
    },
    modalBody: {
      type: String,
      require: false,
      default: '',
    },
    ModalBody: String,
    show: Boolean,
    control: {
      type: Boolean,
      require: false,
      default: false,
    },
    controlTitle: {
      type: String,
      require: false,
      default: '',
    },
  },
}
</script>

<style scoped>
.show {
  display: block;
}
</style>