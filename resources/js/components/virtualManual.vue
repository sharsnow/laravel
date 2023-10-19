<template>
    <div class="context row" id="place">
        <div class="col-5"> 
            <img v-if="currentTab === 'vertical'"  :src="verticalImg">
            <img v-else-if="currentTab === 'horizon'"  :src="horizonImg">
        </div>
        <div class="card text-center col" >
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item"><a class="nav-link" :class="{ active: currentTab === 'vertical' }"  @click="changeTab('vertical')">直立式顯示器</a></li>
                <li class="nav-item"><a class="nav-link" :class="{ active: currentTab === 'horizon' }"  @click="changeTab('horizon')">橫立式顯示器</a></li>
                </ul>
            </div>
            <div class="card-body">
                <div v-if="currentTab === 'vertical'">
                    <h5 class="card-title">直立式顯示器</h5>
                    <p>透過垂直的布局，可更能增強3D虛擬人物得沉浸感並營照出更加逼真的互動場景，且在3D虛擬人物旁不會留下大量空白區塊，更能有效地利用空間。除此之外，能夠更教聚在人際互動提供更佳的互動體驗。</p>
                </div>
                <div v-else-if="currentTab === 'horizon'" >
                    <h5 class="card-title">橫立式顯示器</h5>
                    <p>橫立式的顯示器更加普遍，可以用於電視牆、互動牆甚至在一般的電腦螢幕就可使用。透過水平的布局，使用者可以更加專注在對話練習且可容易進行互動，這對於語言學習及溝通技巧地提高有更有幫助。</p>
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
                    currentTab: 'vertical', // Default tab
                    horizonUrl: 'virtualPlayer.jpg',
                    verticalUrl: 'closeDialog.png',
                    horizonImg:'',
                    verticalImg:'',
                    url: ''
                };
            },
            methods: {
                changeTab(tab) {
                    let _this = this;
                    _this.currentTab = tab;
                }
            },
            mounted() {
                let _this = this;
                _this.horizonImg = `/image/${_this.horizonUrl}`;
                _this.verticalImg = `/image/${_this.verticalUrl}`;
            }
      };
    </script>
    