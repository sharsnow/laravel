<template>
  <div class="modal-mask" :style="modalStyle">
    <div class="modal-container"  @click.self="toggleModal">

      <div class="modal-body">
        <div>
            <label for="place" class="form-label">新增地點</label>
            <input v-model= "place" type="text" class="form-control" id="place">
        </div>
        <hr>
        <div>
          <label for="type" class="form-label">新增主題</label>
          <input v-model= "type" type="text" class="form-control" id="type">
        </div>
        <div v-if="submit">請填寫完全</div>
        <div v-if="!topicIsNull">主題已經存在</div>
        <div class="buttonSide">
          <button  type="button" class="submit" @click="submitForm">送出</button>
          <button  type="button" @click="isShow = false; topicIsNull = true; type=''; place= '';">取消</button>
        </div>
      </div>
    </div>
  </div>
  <p  class = "individualTopic" @click="isShow = true" v-if="!isShow" style="display: flex;">填加新腳本</p>
</template>
<script>
  export default {
    emits: ['addPlace'],
    data() {
      return {
        isShow: false,
        type: '',
        place:'',
        checkOut: false,
        checkOutPassword:false,
        submit:false,
        topicIsNull: true
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
        _this.topicIsNull = true;
        _this.isShow = false;
        // console.log(_this.place+ " "+ _this.type);
        formData.append('place', _this.place);
        formData.append('type', _this.type);
        if(!(formData.get('place') && formData.get('type'))) {
          _this.submit = true;

        }
        else {
          const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
          const requestOptions = {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            body: formData // 不再使用 JSON.stringify
          };
          
          fetch('/topicAdd', requestOptions)
          .then(response => {
            if (response.ok) {
              return response.json();
            } else {
              throw new Error('請求失敗');
            }
          })
          .then(data => {
            //成功
            console.log(data);
            if(data.message == '新增成功') {
              _this.creatQrCode(_this.place);
              _this.type = '',
              _this.place = '',
               
              this.$emit('AddPlace', true);
            }
            else if(data.message == '已經存在') {
              _this.topicIsNull = false;
            }
          })
          .catch(error => {
            console.error(error);
          });
        }
      }
    }
  };
</script>