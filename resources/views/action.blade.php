<head>
    @include('head.head')
    <link href="css/side.css" rel="stylesheet" type="text/css">
    <style>
        
        .optionTitle li {
            font-size: 20px;
            height: 10%;
            border-bottom: 1px solid #91887c69;
        }
        video {
            width: 100%;
            height: 50%;
        }
        .sex_choice {
            margin-left: 0px;
            margin-right: 0px;
        }
        .context {
            flex-direction: row;
        }
        .actionGroup {
            height: 500px;
            overflow-y: auto;
        }
        @media screen and (max-width: 1000px) {
            .context {
                flex-direction: column;
            }
            #action {
                overflow-y: auto;
            }
            .actionGroup {
                max-height: 100px;
                overflow-y: auto;
                margin-bottom: 20px;
            }
        }
        
    </style>
</head>

<body>
    @include('layouts.header')  
    <div id="action" class="mid">
        <div class="asideMenu" id="add">
            <side :message="sideView"></side>
        </div>
        <div class="main_context">
            <div class="chapter">動作</div>

            <div class = "context row ">
                <div class= "actionGroup col">
                    <div class="list">
                    <ul class="optionTitle">
                        <li v-for="(a, index) in actions" :key="a.no" @click="actionVideo(index)"> 
                            ${ a.action }
                        </li>
                    </ul>
                    </div>
                </div>

                <div class="col" >
                    <div style="font-size: 20px;background: #cdcaca47;width: 100%;border-radius: 4px;">目前動作: ${ actionPlay.action }</div>
                <video autoplay muted loop :src="getVideoUrl()" v-if="checkIsMale()"></video>
                <video autoplay muted loop :src="getVideoUrl()" v-if="!checkIsMale()"></video>
                
                <div class="sex_choice row">
                    <div>
                        選擇性別
                    </div>
                    <div class="form-check col">
                    <input class="form-check-input" type="radio" v-model="actionPlay.sex" id="male" value="male" checked>
                    <label class="form-check-label" for="male">
                        男性動作
                    </label>
                    </div>
                    <div class="form-check col">
                    <input class="form-check-input" type="radio" v-model="actionPlay.sex" id="female" value="female">
                    <label class="form-check-label" for="female">
                        女性動作
                    </label>
                    </div>
                </div>
                
            </div>
            </div>
            
        </div>
       
    </div>
    
</body>

<script>
     $(function () {
        $(".btn").click(function () {
            $(".asideMenu").toggleClass("active");
            $(".main_context").toggleClass("active");
            $(".fa-chevron-right").toggleClass("rotate");
        });
    });
    const vm = Vue.createApp({
        delimiters: ['${' , '}'],
        data() {
            return {
                sideView:'action',
                actions:[
                    {
                        no:'',
                        english_name:'',
                        action:'',
                        video_female:'',
                        video_male:''
                    }
                ],
                actionPlay:{
                    index: 0,
                    action:'',
                    sex: "male",
                    videoUrl: '',
                },
                videoUrl: ''
            }
        },
        methods: {
            checkIsMale() {
                let _this = this;
                let index = _this.actionPlay.index;
                try {
                    if(_this.actionPlay.sex == 'male') {
                        _this.actionPlay.videoUrl = `/videos/${_this.actions[index].video_male}`;
                        return true;
                    }
                    else {
                        _this.actionPlay.videoUrl = `/videos/${_this.actions[index].video_female}`;
                        return false;
                    }
                } catch (error) {
                    console.log(error);
                }
                
            },
            getVideoUrl() {
                this.videoUrl = this.actionPlay.videoUrl;
                return this.videoUrl;
            },
            actionVideo(index) {
                
                let _this = this;
                console.log(_this.actions[index]);
                _this.actionPlay.index =  index;
                _this.actionPlay.action = _this.actions[index].action;
                _this.actionPlay.sex = 'male';
                _this.actionPlay.videoUrl = `/videos/${_this.actions[index].video_male}`;

            },
            playVideo() {
                this.$refs.videoPlayer.play();
            },
            pauseVideo() {
                this.$refs.videoPlayer.pause(); 
            },
            togglePlayPause() {
                const video = this.$refs.videoPlayer;
                if (video.paused) {
                    this.playVideo();
                } else {
                    this.pauseVideo();
                }
            }
        },
        mounted() {
            let _this = this;
            const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
            const requestOptions = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: null
            };
            
            fetch('/actionGet', requestOptions)
            .then(response => {
            if (response.ok) {
                return response.json();
            } else {
                throw new Error('請求失敗');
            }
            })
            .then(data => {
            //成功
                // console.log(data);
                _this.actions = data;
                _this.actionPlay.index = 0;
                _this.actionPlay.action = _this.actions[0].action;
                _this.actionPlay.sex = 'male';
                _this.actionPlay.videoUrl = `/videos/${ _this.actions[0].video_male}`;

            })
            .catch(error => {
                console.error(error);
            });
            }
    }).mount('#action');
    
</script>
<script src="js/app.js"></script>