<head>
    @include('head.head')
    <title>系統說明書</title>
    <style>
        .content {
            position: absolute;
            top: 10%;
            left: 10%;
            width: 80%;
        }
        .content h1 {
            border-bottom: 1px solid #000;
        }
        .context {
            display: flex;
            margin-bottom: 20px;
            padding-left: 2%;
            padding-right: 5%;
            flex-direction: row-reverse;
        }
        .context img,
        .context video {
            max-height: 300px;
            width: auto;
        }
        .card-body p {
            text-align: left;
        }
        .manage {
            border-bottom: 1px solid #aea7a7;
            margin-left: 2%;
        }
        h4 {
            background: rgb(191 191 191);
            padding-top: 5px;
            padding-bottom: 5px;
            padding-left: 10px;
        }
        @media screen and (max-width: 1350px) {
            .context {
                display: flex;
                flex-direction: column-reverse;
            }
            .col-5{
                width: auto;
                text-align: center;
                margin-top: 10px;
            }
        }
    </style>
</head>
<div id="wrap">
@include('layouts.header')  
    <div class ="content">
        <div class="AR_manual">
            <h1 id="AR">AR</h1>
            <div>
                使用者可以穿戴可移動式的AR頭盔，利用AR技術做場景導引式的學習，並將虛擬人物透設至真實環境，可讓使用者彷彿有真人與他溝通。
                <p style="color: brown;">註: 遊玩過程請注意身旁環境並在空曠處遊玩</p>
                <p style="color: brown;">註: 目前僅支援Android 建議版本12以上。若版本過低可能無法預期執行AR模式</p>
            </div>
            <ar-manual></ar-manual>  
        </div>
        <div class ="virtual_manual">
            <h1 id="virtual">裸視3D</h1>
            <div>
                建立多個不同的英語角落以便於每位使用者可以進行學習，且不用擔心相互影響的問題，進行同時間不同地點的操作，搭配擬真虛擬人像，使學習更加生動有真實體驗感。
            </div>
            <virtual-manual></virtual-manual>
        </div>
        <div class ="dialog_manual ">
            <h1 id="dialog">後臺管理</h1>
            <div>
                <p>提供管理者設計腳本及查看虛擬動作樣式。</p>
                <h4>腳本內容: 管理所有的地點、主題及腳本</h4>
                    <p class = "manage">地點、主題管理</p>
                    <place-manual></place-manual>
                    <p class = "manage">腳本管理</p>
                    <dialog-manual></dialog-manual>
                <h4>動作內容: 用來查看動作的樣式</h4>
                    <action-manual></action-manual>
            </div>
        </div>
    </div>
</div>
<script src="/js/app.js"></script>
<script>
    
</script>