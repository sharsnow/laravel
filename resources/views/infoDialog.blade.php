<head>
    @include('head.head')
    <title>對話練習</title>
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
<head>
<body>
<div id="wrap">
    @include('layouts.header')

    <div class ="content">
    <div class="open_info">
            <h1 id="frontPage">首頁</h1>
            <div>進行對話練習相關設定。</div>  
            <front-page></front-page>
        </div>
        <div class="open_info">
            <h1 id="openDialog">開放式對話</h1>
            <div>使用者可以毫無限制地與3D虛擬人物作溝通，以體驗與人對話的真實性。且3D虛擬人物搭配20種以上的動作，使多種對話內容皆可搭配最合適的動作已讓使用者沉浸式的體驗。</div>
            <open-dialog></open-dialog>
        </div>
        <div class ="close_info">
            <h1 id="closeDialog">封閉式對話</h1>
            <div>利用內建的對話腳本進行練習，練習過程中也將會告知使用者發音是否正確，若是有發音錯誤的單詞會以不同的顏色的方式來進行提醒。</div>
            <close-dialog></close-dialog>
        </div>
    </div>
</div>
</body>
<script src="/js/app.js"></script>