<template>
    <div class="userSignIn">
      <div class="modal-mask" :style="modalStyle">
        <div class="modal-container"  @click.self="toggleModal">
  
          <div class="modal-body">
            <header  style="text-align: center; font-size: 30px;">
              <slot name="header" >註冊</slot>
            </header>
            <hr>
            <main id ="app">
                <div class="row">
                  <div class="mb-3 col">
                    <label for="userName" class="form-label">名字</label>
                    <input v-model= "formData['userName']" type="text" class="form-control" id="userName">
                  </div>
                  <div class="col">
                    <label for="sex" class="form-label">性別</label>
                    <select  v-model=  "formData['sex']" class="form-select col">
                      <option selected>請選擇性別</option>
                      <option value="male">男</option>
                      <option value="female">女</option>
                      <option value="others">x</option>
                    </select>
                  </div>
                </div>
                
                <div class="mb-3">
                  <label for="InputAccount" class="form-label">帳號</label>
                  <input v-model= "formData['InputAccount']" type="text" class="form-control">
                </div>
                <div class="mb-3">
                  <label for="InputPassword" class="form-label">密碼</label>
                  <input v-model= "formData['InputPassword']" type="password" class="form-control">
                </div>
                <div class="mb-3">
                  <label for="InputPasswordCheck" class="form-label">密碼確認</label>
                  <input v-model= "formData['InputPasswordCheck']" type="password" class="form-control">
                  <p v-if="checkOutPassword" style="color: red;">密碼填寫不同</p>
                </div>
                <div class="mb-3">
                  <label for="emailAddress" class="form-label">電子郵件</label>
                  <input v-model= "formData['emailAddress']" type="email" class="form-control" placeholder="name@example.com">
                </div>
                <hr>
                <p v-if="checkOut" style="color: red;">請將所有內容填寫!!</p>
                <div style="text-align: center;">
                  <button type="submit" class="btn btn-primary" @click="submitForm()" >註冊</button>
                </div>
            </main>
         
          </div>
          
        </div>
      </div>
      <p @click="isShow = true" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" style="width: 100%;">sign in</p>
    </div>
</template>
<script>
  export default {
    data() {
      return {
        isShow: false,
        formData: {
          userName: '',
          sex: '',
          InputAccount: '', 
          InputPassword: '',
          InputPasswordCheck:'',
          emailAddress: ''
        },
        checkOut: false,
        checkOutPassword:false
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
        let formCheck = true;
        if(!(_this.formData['userName'] && _this.formData['sex'] && _this.formData['InputAccount'] && _this.formData['InputPassword'] && _this.formData['emailAddress'])) {
          // alert("缺失內容");
          _this.checkOut = true;
          formCheck = false;
        }
        else {
          _this.checkOut = false;
        }
        if(_this.formData['InputPassword'] != _this.formData['InputPasswordCheck']) {
          //密碼錯誤
          _this.checkOutPassword = true;
          formCheck = false;
        }
        else {
          _this.checkOutPassword = false;
        }
        if(formCheck) {
          _this.checkOut = false;
          _this.checkOutPassword = false;
          const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
          const requestOptions = {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify(_this.formData)
          };
          
          fetch('/userAdd', requestOptions)
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
              alert('註冊成功!');
              _this.isShow = false;
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