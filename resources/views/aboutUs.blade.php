<head>
    @include('head.head')
    <title>關於我們</title>
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
    img {
        max-height: 200px;
        width: auto;
    }
    .img p {
        padding-top: 20px;
    }
    .img div {
        display: flex;
        align-items: center;
    }
    .img {
        display: flex;
        justify-content: space-around;
        background: #ebebeb;
        margin-left: 5%;
        margin-right: 5%;
        margin-bottom: 25px;
        border-radius: 10px;
    }
    .h3 {
        width: 20%;
        display: flex;
        justify-content: center;
    }
    @media screen and (max-width: 1200px) {
        .img {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .col-5 {
            width: 100%;
        }
        .img div {
            justify-content: center;
        }
    }
    </style>
</head>
<body>
    <div id="wrap">
        @include('layouts.header')  
        <div class ="content">
            <div class="open_info">
                <h1 id="design">設計理念</h1>
                <div>
                    <div>
                        <h3 class="h3">實用性：</h3>
                        <div class="img row"><div class="col-5"><img  src="{{ asset('image/design/practical.jpg') }}" alt="Image" style="width: auto;" title="practical"></div>
                            <p class="col-5">此專案之創新基礎理論在於突破對話疏離感，增進人機互動真實度。我們利用擴增實境讓不敢與外國人對話的使用者可以與虛擬人物對話，不僅提供互動式學習更可以提升使用者的學習意願讓使用者輕鬆地克服語言障礙、增加自信心、提高英語口說的流暢度，也可以更加自然地表達。</p></div>
                    </div>
                    <div>
                        <h3 class="h3">創新性：</h3>
                        <div class="img row"><p class="col-5">自行添加對話文本，目前市面上大多的對話系統都已綁定相對的文本，而本系統設有專屬網頁可以提供管理者添加新的對話腳本；3D虛擬人物，本系統為了讓使用者在對話時更有臨場感，在對話過程中會透過AR來結合當下的環境，並顯示虛擬人物來進行對話互動，讓使用者可以沈浸式體驗虛擬對話的樂趣。</p>
                        <div class="col-5"><img src="{{ asset('image/design/innovation.jpg') }}" alt="Image" style="width: auto;" title="innovation"></div></div>
                    </div>
                    <div>
                        <h3 class="h3">功能性：</h3>
                        <div class="img row"><div class="col-5"><img src="{{ asset('image/design/practical.jpg') }}" alt="Image" style="width: auto;" title="functional"></div>
                        <p class="col-5">系統中包含開放式對話及封閉式對話練習兩種模式。開放式對話模式中，每當使用者提出問題時，系統會將語音轉成文字再利用ChatGPT獲得相應的回覆，並將符合回覆的人物動作顯示給使用者讓使用者體會到與真人互動的感覺；封閉式對話將腳本分成場景及主題。腳本可設置不同的場景，再依據不同情況或情境在相同的場景設置多種不同的主題。當使用者選定場景之後，會以隨機的方式選擇主題，並在此次對話腳本結束後系統會顯示使用者最終口語練習結果。</p></div>
                        </div>
                    <div>
                        <h3 class="h3">差異性：</h3>
                        <div class="img row"><p class="col-5">目前市場上的英文口說練習軟體多為隨機與外國友人通話或多為使用者面對手機單方面說話系統給予回饋。本系統在開放式對話的特點在於使用者可以體驗與3D虛擬人物做對話，不僅可以提高對話的趣味性，還可以間接體驗到與人對話的真實性。<br><br>在封閉式對話的特點也類似於上述內容，在此模式中可以利用內建的對話腳本進行練習，練習過程中也將會告知使用者發音是否正確，若是有發音錯誤的單詞會以不同的顏色的方式來進行提醒。<br><br>在對話練習結束後，會提供準確度、完成度、發音度、流暢度的分數，可以讓使用者更加瞭解自身的問題。</p>                
                        <div class="col-5"><img  src="{{ asset('image/design/innovation.jpg') }}" alt="Image" style="width: auto;" title="diff"></div></div>
                    </div>
                    </div>  
            </div>
            <div class ="close_info">
                <h1 id="future">未來展望</h1>
                <div class="img row">
                    <p class="col-5">本專案建置一套英語對話練習系統，利用擴增實境的效果，讓使用者在對話的過程中可以體會到與真人互動的感覺，對此可以增加使用者在利用非母語對話時的自信心。且本專案系統內設有封閉式對話與開放式對話兩種不同對話模式，期望能讓不同程度的英語口說練習者能以生動且活潑的方式學習外語。
                    未來我們希望能與外語補習班做合作，將本系統導入傳統學習場所，以互動式為主的學習過程更能增加使用者對學習的渴望，利用封閉式對話練習來奠定對話基礎，或利用開放式對話練習來使對話更加流暢。<br><br>也期待未來可以加入更多語言進入本系統，讓更多想學習不同語言的人都能使用。
                    而上述在使用情境提到可以將本專案之系統導入至博物館與圖書館。在系統上稍加改變，將原有封閉式對話模式內的語音辨識替換成選項模式，利用系統原有的提問搭配選項給使用者，可以在參觀博物館與閱讀圖書以後，利用本系統進行小測驗，可達到學習之效果。</p>
                    <div class="col-5"><img  src="{{ asset('image/future.jpg') }}" alt="Image" style="width: auto;" title="diff"></div>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="/js/app.js"></script>