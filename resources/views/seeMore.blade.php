<head>
    @include('head.head')
    <title>See More</title>
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
    .row {
        padding: 20px;
    }
    .card {
        margin: 10px;
        padding-top: 10px;
    }
    svg {
        border-radius: 3%;
    }
    img {
        min-height: 200px;
        width: auto;
        object-fit: cover;
        border-radius: 20px;
        transform:scale(1,1);
        transition: all 0.5s cubic-bezier(0.09, 0.65, 0.58, 1);
    }
    img:hover {
        transform:scale(1.05,1.05);
    }
</style>
  </head>
<div id="wrap">
@include('layouts.header')  

<div class = "content">
<div>
        <h1>系統說明書</h1>
        <div class="row">
            <div class="col-6 card" style="width: 18rem;">
            <img src="{{ asset('image/AR.jpg') }}" alt="Image" title="AR">
                <div class="card-body">
                    <h5 class="card-title">AR</h5>
                    <p class="card-text">透過AR來結合當下的環境，並顯示虛擬人物來進行對話互動，讓使用者可以沈浸式體驗虛擬對話的樂趣。</p>
                    <a href="{{ url('manual#AR') }}" class="btn btn-primary">了解更多</a>
                </div>
            </div>
            <div class="col-6 card" style="width: 18rem;">
            <img src="{{ asset('image/virtualPlayer.jpg') }}" alt="Image" title="擬真情境">
                <div class="card-body">
                    <h5 class="card-title">裸視3D</h5>
                    <p class="card-text">透過設置在不同定點的方式，讓使用者隨地的練習或是依照地點的需求設置所需的內容。</p>
                    <a href="{{ url('manual#virtual') }}" class="btn btn-primary">了解更多</a>
                </div>
            </div>
            <div class="col-6 card" style="width: 18rem;">
            <img src="{{ asset('image/dialog.png') }}" alt="Image" title="AR">
                <div class="card-body">
                    <h5 class="card-title">後臺操作</h5>
                    <p class="card-text">提供管理者設計腳本。</p>
                    <a href="{{ url('manual#dialog') }}" class="btn btn-primary">了解更多</a>
                </div>
            </div>
    </div>
    <div>
        <h1>對話練習</h1>
        <div class="row">
            <div class="col-6 card" style="width: 18rem;">
            <img src="{{ asset('image/openDialog.png') }}" alt="Image" title="openDialog">
                <div class="card-body">
                    <h5 class="card-title">開放式對話</h5>
                    <p class="card-text">使用者可以體驗與3D虛擬人物做對話，不僅可以提高對話的趣味性，還可以間接體驗到與人對話的真實性。</p>
                    <a href="{{ url('infoDialog#openDialog') }}" class="btn btn-primary">了解更多</a>
                </div>
            </div>
            <div class="col-6 card" style="width: 18rem;">
            <img src="{{ asset('image/closeDialog.png') }}" alt="Image" title="closeDialog">
                <div class="card-body">
                    <h5 class="card-title">封閉式對話</h5>
                    <p class="card-text">利用內建的對話腳本進行練習，練習過程中也將會告知使用者發音是否正確，若是有發音錯誤的單詞會以不同的顏色的方式來進行提醒。</p>
                    <a href="{{ url('infoDialog#closeDialog') }}" class="btn btn-primary">了解更多</a>
                </div>
            </div>
        </div>
    </div>
    <div>
        <h1>關於我們</h1>
        <div class="row">
            <div class="col-6 card" style="width: 18rem;">
                <img src="{{ asset('image/design.jpg') }}" alt="Image" title="openDialog">
                <div class="card-body">
                    <h5 class="card-title">設計理念</h5>
                    <p class="card-text">英語對話練習系統，結合傳統外語補習班資源，促進自主學習，拓展語言視野。</p>
                    <a href="{{ url('aboutUs#design') }}" class="btn btn-primary">了解更多</a>
                </div>
            </div>
            <div class="col-6 card" style="width: 18rem;">
                <img src="{{ asset('image/future.jpg') }}" alt="Image" title="openDialog">
                <div class="card-body">
                    <h5 class="card-title">未來展望</h5>
                    <p class="card-text">透過擴增實配合兩種對話模式，拓展多語言學習，期許應用於傳統學習場所、博物館或圖書館。</p>
                    <a href="{{ url('aboutUs#future') }}" class="btn btn-primary">了解更多</a>
                </div>
            </div>
        </div>
    </div> 
</div>
</div>


<script src="/js/app.js"></script>