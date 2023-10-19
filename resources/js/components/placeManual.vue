<template>
<div class="context row" id="place">
    <div class="col-5">
        <img v-if="currentTab === 'view'" :src="viewSrc">
        <img v-else-if="currentTab === 'modify'"  :src="modSrc">
        <img  v-else-if="currentTab === 'addTabContent'"  :src="addSrc">
    </div>
    <div class="card text-center col" >
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
                <a class="nav-link" :class="{ active: currentTab === 'view' }"  @click="changeTab('view')">查看</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" :class="{ active: currentTab === 'modify' }" @click="changeTab('modify')">刪除或修改</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" :class="{ active: currentTab === 'addTabContent' }"  @click="changeTab('addTabContent')">新增</a>
            </li>
            </ul>
        </div>
        <div class="card-body">
            <div v-if="currentTab === 'view'">
                <div>
                    <h5 class="card-title">檢視内容</h5>
                    <p>封閉式對話將腳本分成場景及主題。腳本可設置不同的場景，再依據不同情況或情境在相同的場景設置多種不同的主題。當使用者選定場景之後，會以隨機的方式選擇主題</p>
                </div>
            </div>
            <div v-else-if="currentTab === 'modify'" >
                <h5 class="card-title">刪除或修改内容</h5>
                <p class="card-text">點擊<img class="imageDelete" :src="imageDelete" style="width: 15px;" alt="Image" title="刪除">
                <img class="imageModify" :src="imageModify" style="width: 15px;" alt="Image" title="修改">則進入刪除/修改頁面</p>
                <p style="color: brown;">註: 修改禁止填入空白或是已經存在的內容</p>
            </div>
            <div v-else-if="currentTab === 'addTabContent'" >
                <h5 class="card-title">新增内容</h5>
                <p class="card-text">點擊填加新主題/填加新腳本則可輸入內容</p>
                <p style="color: brown;">註: 修改禁止填入空白內容或已存在的主題</p>
                <p style="color: brown;">註: 若填入已存在的地點則會新增至舊有的地點</p>
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
                currentTab: 'view', // Default tab
                viewImg: '/manual/place.png',
                viewSrc: '',
                modImg: '/manual/modifyPlace.png',
                modSrc: '',
                addImg: '/manual/addPlace.png',
                addSrc: '',
                deleteImg: 'trash-can.png',
                modifyImg: 'editing.png',
                imageDelete: '',
                imageModify: '',
            };
        },
        methods: {
            changeTab(tab) {
                let _this = this;
                _this.currentTab = tab;
                console.log(_this.currentTab)
            },
        },
        mounted() {
            let _this = this;
            _this.viewSrc = `/image${_this.viewImg}`;
            _this.modSrc = `/image${_this.modImg}`;
            _this.addSrc = `/image${_this.addImg}`;
            _this.imageDelete = `/image/${_this.deleteImg}`;
            _this.imageModify = `/image/${_this.modifyImg}`;
        }
  };
</script>
