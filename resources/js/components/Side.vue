<template>
    <div class="viewGroup">
        <div class="viewTitle">查看內容</div>
        <div class="view"><img class="imageDot" :src="imageDot" alt="Image">
            <div style="text-align: center;width: 50%; " @click="headFor('dialog')" >腳本內容</div>
        </div>
        <div class="view"><img class="imageDot" :src="imageDot" alt="Image">
            <div style="text-align: center;width: 50%;" @click="headFor('action')" >動作內容</div>
        </div>
        <button class="btn"><i class="fas fa-chevron-right fa-2x"></i></button>
    </div>
</template>
<script>
export default{
    data() {
        return{
            dotImg:'period.png',
            imageDot: '',
        }
    },
    methods: {
        headFor(href) {
            console.log(href);
            if(href == 'dialog') {
                console.log('前往 dialog');
                window.location.href = '/dialogManagement';
            }
            else if(href == 'action') {
                console.log('前往 action');
                window.location.href = '/action';
            }
        }
    },
    mounted() {
        let _this = this;
        console.log(_this.message);

        _this.imageDot = `/image/${_this.dotImg}`;
    },
    props: {
    message: String 
    }
}
</script>