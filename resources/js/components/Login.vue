<template>
    <div class="lightbox">
      <div class="modal-mask" :style="modalStyle">
        <div class="modal-container"  @click.self="toggleModal">
  
          <div class="modal-body">
            <header style="text-align: center;font-size: 30px;">
              <slot name="header" >登入</slot>
            </header>
            <hr>
            <main>
                <div class="mb-3">
                  <label for="InputAccount" class="form-label">帳號</label>
                  <input type="text"  v-model= "formData['InputAccount']" class="form-control">
                </div>
                <div class="mb-3">
                  <label for="InputPassword" class="form-label">密碼</label>
                  <input type="password"  v-model= "formData['InputPassword']" class="form-control" >
                </div>
                <p v-if="checkOut" style="color: red;">請將所有內容填寫!!</p>
                <p v-if="login == 2" style="color: red;">密碼錯誤</p>
                <p v-if="login == 3" style="color: red;">查無此帳號或密碼</p>
                <hr>
                <div style="text-align: center">
                  <div id ="signIn">   <user-sign style="display: flex;justify-content: center;align-items: center;"></user-sign> </div>
                  <button type="submit" class="btn btn-primary" @click="submitForm()">登入</button>
                </div>
                
             
            </main>
         
          </div>
  
        </div>
      </div>
      <p @click="isShow = true" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">log in</p>
      
    </div>
</template>
<script>
  
  export default {
    data: () => ({
      isShow: false,
      formData: {
        InputAccount: '',
        InputPassword: ''
      },
      checkOut: false,
      login: 0
    }),
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
        let formCheck = true;
        if(!(_this.formData['InputAccount'] && _this.formData['InputPassword'] )) {
          _this.checkOut = true;
          formCheck = false;
        }
        else {
          _this.checkOut = false;
        }
        if(formCheck) {
          _this.checkOut = false;
          const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
          const requestOptions = {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify(_this.formData)
          };
          
          fetch('/userLogin', requestOptions)
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
            if(data.status) {
              if(data.password) {
                _this.login = 1;
                window.location.href = '/dialogManagement';
              }
              else {
                _this.login = 2;
              }
            } else {
              _this.login = 3;
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