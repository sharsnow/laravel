<template>
    <div class="context row" id="place">
        <div class="col-5">
            <img v-if="currentTab === 'chooseSex'" :src="chooseSexSrc">
            <img v-else-if="currentTab === 'chooseMode'"  :src="modSrc">
            <img  v-else-if="currentTab === 'leave'"  :src="leaveSrc">
            <img  v-else-if="currentTab === 'wait'"  :src="waitSrc">
        </div>
        <div class="card text-center col" >
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link" :class="{ active: currentTab === 'chooseSex' }"  @click="changeTab('chooseSex')">選擇性別</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" :class="{ active: currentTab === 'chooseMode' }" @click="changeTab('chooseMode')">選擇模式</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" :class="{ active: currentTab === 'leave' }"  @click="changeTab('leave')">退出遊戲</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" :class="{ active: currentTab === 'wait' }"  @click="changeTab('wait')">待機</a>
                </li>
                </ul>
            </div>
            <div class="card-body">
                <div v-if="currentTab === 'chooseSex'">
                    <div>
                        <h5 class="card-title">選擇性別</h5>
                        <p>使用者透過語音選擇性別決定後續對話練習的對象</p>
                    </div>
                </div>
                <div v-else-if="currentTab === 'chooseMode'" >
                    <h5 class="card-title">選擇模式</h5>
                    <p>使用者透過語音選擇要練習的模式</p>
                </div>
                <div v-else-if="currentTab === 'leave'" >
                    <h5 class="card-title">退出遊戲</h5>
                    <p class="card-text">使用語音輸入"離開遊戲"並再次確認則可結束全部練習對話</p>
                </div>
                <div v-else-if="currentTab === 'wait'" >
                    <h5 class="card-title">待機</h5>
                    <p class="card-text">若是使用者長時間未輸入語音，則會進入待機模式。使用者須語音輸入"hello"以喚起並回到首頁</p>
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
                    currentTab: 'chooseSex', // Default tab
                    chooseSexImg: '/dialogPractice/chooseSex.png',
                    chooseSexSrc: '',
                    modImg: '/dialogPractice/chooseMode.png',
                    modSrc: '',
                    leaveImg: '/dialogPractice/leaveGame.png',
                    leaveSrc: '',
                    waitImg: '/dialogPractice/wait.png',
                    waitSrc:''
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
                _this.chooseSexSrc = `/image${_this.chooseSexImg}`;
                _this.modSrc = `/image${_this.modImg}`;
                _this.addSrc = `/image${_this.addImg}`;
                _this.leaveSrc = `/image${_this.leaveImg}`;
                _this.waitSrc = `/image${_this.waitImg}`;
            }
      };
    </script>
    