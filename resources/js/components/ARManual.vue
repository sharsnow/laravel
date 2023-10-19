<template>
    <div class="context row" id="place">
        <div class="col-5"> 
            <video v-if="currentTab === 'view'" autoplay muted loop :src="getVideoUrl()"></video>
            <img v-else-if="currentTab === 'device'"  :src="img">
        </div>
        <div class="card text-center col" >
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item"><a class="nav-link" :class="{ active: currentTab === 'view' }"  @click="changeTab('view')">說明</a></li>
                <li class="nav-item"><a class="nav-link" :class="{ active: currentTab === 'device' }"  @click="changeTab('device')">設備要求</a></li>
                </ul>
            </div>
            <div class="card-body">
                <div v-if="currentTab === 'view'">
                    <h5 class="card-title">檢視内容</h5>
                    <p>請掃描附近"平面"地板，若是出現黑色區塊則為偵測此為平面。並將攝像頭對準此黑色區塊至少3秒。則人物就會出現至黑色區塊</p>
                    <p style="color: brown;">註: 若是未出現黑色區塊，需等待一段時間或是換至其他較大平面</p>
                    <p style="color: brown;">註: 若是人物超出文字方塊，請將攝像頭向後移動</p>
                </div>
                <div v-else-if="currentTab === 'device'" >
                    <h5 class="card-title">頭盔要求</h5>
                    <p class="card-text">此AR頭盔需自備手機執行此學習方式，故AR頭盔前方需有透明空間讓手機的攝像鏡頭可照至外部環境。</p>
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
                    videoUrl: '/videos/AR.mp4',
                    ARglassUrl: '/manual/ARglass.png',
                    img:'',
                    url: ''
                };
            },
            methods: {
                changeTab(tab) {
                    let _this = this;
                    _this.currentTab = tab;
                },
                getVideoUrl() {
                    let _this = this;
                    _this.url = this.videoUrl;
                    return this.url;
                },
            },
            mounted() {
                let _this = this;
                _this.img = `/image/${_this.ARglassUrl}`;
            }
      };
    </script>
    