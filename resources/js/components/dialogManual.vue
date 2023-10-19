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
                        <p>點擊"前往"則可前往回答後接續的問題，若"前往"為空白則此回答後續無內容</p>
                        <p>點擊上/下個問題則可前往接續問題，但與問題與問題之間沒有關係，問題與問題之間的主要透過回答的"前往"作為之間的橋樑</p>
                    </div>
                </div>
                <div v-else-if="currentTab === 'modify'" >
                    <h5 class="card-title">刪除或修改内容</h5>
                    <p class="card-text">點擊"刪除"/"修改"則進入刪除/修改頁面</p>
                    <p style="color: brown;">註: 修改禁止填入空白</p>
                    <p style="color: brown;">註: 若刪除問題後，請檢察前後接續問題的回答是否出現</p>
                </div>
                <div v-else-if="currentTab === 'addTabContent'" >
                    <h5 class="card-title">新增内容</h5>
                    <p class="card-text">前往要新增的腳本並移動至最後的問題，點擊"新增問題"</p>
                    <p style="color: brown;">註: 須先填寫完問題才能接續填回答</p>
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
                    viewImg: '/manual/dialog.png',
                    viewSrc: '',
                    modImg: '/manual/modifyDialog.png',
                    modSrc: '',
                    addImg: '/manual/addDialog.png',
                    addSrc: '',
                };
            },
            methods: {
                changeTab(tab) {
                    let _this = this;
                    _this.currentTab = tab;
                },
            },
            mounted() {
                let _this = this;
                _this.viewSrc = `/image${_this.viewImg}`;
                _this.modSrc = `/image${_this.modImg}`;
                _this.addSrc = `/image${_this.addImg}`;
            }
      };
    </script>
    