
<head>
    @include('head.head')
    <title>首頁</title>
    <style>
    .title {
        margin: auto;
        width: 100%;
        padding: 70px 0;
        display: flex;
        text-align: center;
        justify-content: center;
        position: absolute;
        top: 20%;
        flex-direction: column;
    }
    #app {
        display: block;
        overflow: hidden;
        width: 100%;
    }
    
    h4 {
        margin: 1rem 0;
        font-size: 1rem;
    }
    
    
    </style>
    
</head>
<body >
<div id="wrap">
    
    @include('layouts.header')  
    <div class = "title">
        <h1 style = "font-size: 800%;    margin-bottom: 0; ">
            Talk to me
        </h1>
        <h2 style = "font-size: 200%;">
        結合ChatGPT 之擬真情境外語口說練習系統
        </h2>
    </div>
    <div style = "margin-left: 45%">
        <a href="{{ url('/seeMore') }}" class="btn btn-primary" style = "position: absolute;top: 70%;">了解更多</a>
        
    </div>
    @if($data['user_token'] == 'null') 
    <div style =" position: absolute;top: 80%;left: 44.5%;">
        <ul >
            <li style ="float: left;padding-right: 10px;border-right: 1px solid #000; height: 30px;">
                @include('layouts.login')
            </li>
            <li style ="float: left;padding-left: 10px; height: 30px;">
                @include('layouts.signIn')
            </li>
        </ul>
    </div>
    @endif
</div>


</body>
<script src="/js/app.js"></script>

