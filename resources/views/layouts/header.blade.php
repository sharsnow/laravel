
<div class="header">
    <div class="header_title">
        <a  href="{{ url('/') }}">
            Talk To Me
        </a>
    </div>
    <div class="header_menu">
    
        <ul class="drop-down-menu">
            <li><a href="{{ url('/manual') }}">系統說明書</a>
            </li>
            <li><a href="{{ url('/infoDialog') }}">對話練習</a>
            </li>
            <li><a href="{{ url('/aboutUs') }}">關於我們</a>
            </li>
        </ul>
        <button for="menu-toggle" class="menu-toggle-label"><i class="fas fa-chevron-top">&#9660; 主菜單</i></button>
    </div>
    <div class = "header_left">
        <div class="search">
            @if($data['user_token'] == 'null') 
            <ul >
                <li style ="float: left;padding-right: 10px;border-right: 1px solid #000; height: 30px;">
                    @include('layouts.login')
                </li>
                <li style ="float: left;padding-left: 10px; height: 30px;">
                    @include('layouts.signIn')
                </li>
            </ul>
            @else
                <ul >
                    <li style ="float: left;padding-right: 10px;border-right: 1px solid #000; height: 30px;">
                        <a href="{{ url('dialogManagement') }}"> 進入後臺管理</a>
                    </li>
                    <li style ="float: left;padding-left: 10px; height: 30px;">
                        <a href="{{ url('logout') }}"> 登出 </a>
                    </li>
                </ul>
            @endif
        </div>    
        
            <div class = "header_login">
            
        </div>
    </div>
</div>
<script>
function toggleMenuOnSmallScreens() {
     if ($(window).width() < 1024) {
        $(".menu-toggle-label").click(function () {
            $(".header_menu").toggleClass("active");
            $(".fa-chevron-right").toggleClass("rotate");
        });

    } else {
        $(".btn").off("click");
    }
};

$(function () {
    toggleMenuOnSmallScreens();
    $(window).resize(function () {
        toggleMenuOnSmallScreens();
    });
});
</script>