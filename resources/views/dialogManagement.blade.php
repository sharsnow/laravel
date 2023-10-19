<head>
    
    @include('head.head')
    <!-- <script src="https://libs.baidu.com/jquery/2.1.4/jquery.min.js"></script> -->
    <link href="css/side.css" rel="stylesheet" type="text/css">
</head>

<body>
<div>
  @include('layouts.header')  
  <div id= "add">
    <dialog-manage>
    </dialog-manage>
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
</script>
<script src="/js/app.js"></script>