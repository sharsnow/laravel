<template>
    <div class="context row" id="place">
        <div class="col-5">
            <img :src="viewSrc">
        </div>
        <div class="card text-center col" >
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link">查看</a>
                </li>
                </ul>
            </div>
            <div class="card-body">
                <div>
                    <h5 class="card-title">檢視内容</h5>
                    <p>使用者透過語音來與虛擬人物溝通</p>
                </div>
            </div>
        </div>
    </div>
    
</template>
    <script>
      export default {
        delimiters: ['${' , '}'],
            data() {
                return {
                    viewImg: '/dialogPractice/openDialog.png',
                    viewSrc: ''
                };
            },
            methods: {
            },
            mounted() {
                let _this = this;
                _this.viewSrc = `/image${_this.viewImg}`;
            }
      };
    </script>
    