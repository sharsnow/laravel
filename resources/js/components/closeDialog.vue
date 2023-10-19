<template>
    <div class="context row" id="place">
        <div class="col-5">
            <img v-if="currentTab === 'choosePlace'" :src="choosePlaceSrc">
            <img v-else-if="currentTab === 'closeDialog'"  :src="viewSrc">
            <img v-else-if="currentTab === 'errorDialog'"  :src="errorDialogSrc">
            <img  v-else-if="currentTab === 'pronunciation'"  :src="pronunciationSrc">
        </div>
        <div class="card text-center col" >
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link" :class="{ active: currentTab === 'choosePlace' }"  @click="changeTab('choosePlace')">選擇場所</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" :class="{ active: currentTab === 'closeDialog' }" @click="changeTab('closeDialog')">對話練習</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" :class="{ active: currentTab === 'errorDialog' }" @click="changeTab('errorDialog')">對話練習錯誤</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" :class="{ active: currentTab === 'pronunciation' }"  @click="changeTab('pronunciation')">練習結果</a>
                </li>
                </ul>
            </div>
            <div class="card-body">
                <div v-if="currentTab === 'choosePlace'">
                    <div>
                        <h5 class="card-title">選擇場所</h5>
                        <p>使用者透過語音選擇場所</p>
                        <p>透過語音輸入"上/下一個"可以切換至不同場所</p>
                    </div>
                </div>
                <div v-else-if="currentTab === 'closeDialog'" >
                    <h5 class="card-title">對話練習</h5>
                    <p>使用者可以透過語音來決定要回答的內容</p>
                    <p style="color: brown;">註: 橘色的單字為發音較不標準、紅色為極度不標準</p>
                </div>
                <div v-else-if="currentTab === 'errorDialog'" >
                    <h5 class="card-title">對話練習錯誤</h5>
                    <p class="card-text">使用者若是語音輸入與上述選項皆不同達到3次，系統則強制進入讓使用者語音輸入要練習的選項並且透過系統輸出語音並進入下則對話練習</p>
                </div>
                <div v-else-if="currentTab === 'pronunciation'" >
                    <h5 class="card-title">最終發音結果</h5>
                    <p class="card-text">在結束一整個對話練習後，系統會將本次對話內容全部進行評分並顯示給使用者看</p>
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
                    currentTab: 'choosePlace', // Default tab
                    choosePlaceImg: '/dialogPractice/choosePlace.png',
                    choosePlaceSrc: '',
                    viewImg: '/dialogPractice/closeDialog.png',
                    viewSrc: '',
                    errorDialogImg: '/dialogPractice/sentenceError.png',
                    errorDialogSrc:'',
                    pronunciationImg: '/dialogPractice/pronunciation.png',
                    pronunciationSrc: '',
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
                _this.choosePlaceSrc = `/image${_this.choosePlaceImg}`;
                _this.viewSrc = `/image${_this.viewImg}`;
                _this.errorDialogSrc = `/image${_this.errorDialogImg}`;
                _this.pronunciationSrc = `/image${_this.pronunciationImg}`;
            }
      };
    </script>
    