<template>
      <div class="modal-mask" :style="modalStyle">
        <div class="modal-container"  @click.self="toggleModal">
  
          <div class="modal-body">
            <div>
              <label for="type" class="form-label">新增主題</label>
              <input v-model= "type" type="text" class="form-control" id="type">
            </div>
            <div v-if="submit">請填寫完全</div>
            <div v-if="!message"> 此主題已存在或不符合格式</div>
            <div class="buttonSide">
              <button  type="button" class="submit" @click="submitForm">送出</button>
              <button  type="button" @click="isShow = false">取消</button>
            </div>
          </div>
        </div>
      </div>
      <p  class = "individualTopic" @click="isShow = true" v-if="!isShow" style="display: flex;justify-content: center;font-weight: bold;">填加新主題</p>
</template>
<script>
  export default {
    emits: ['AddTopic'],
    data() {
      return {
        isShow: false,
        type: '',
        checkOut: false,
        checkOutPassword:false,
        submit:false
      };
    },
    computed: {
      modalStyle() {
        return {
          'display': this.isShow ? '' : 'none'
        };
      }
    },
    methods: {
      toggleModal() {
        console.log('click')
        this.isShow = !this.isShow;
      },
      submitForm() {
        let _this = this;
        let formData = new FormData();
        _this.submit = false;
        formData.append('type', _this.type);
        if(_this.type != null && _this.type != '') {
          _this.type = '';
          this.$emit('AddTopic', formData);
        }
        else {
          _this.submit = true;
        }
        
      }
    },
    props: {
      message: Boolean
    }
  };
</script>