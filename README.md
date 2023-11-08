此為透過laravel進行撰寫並透過Vue.js進行前端設計。  
網頁主要用來編輯封閉式對話腳本、虛擬人物動作及系統說明書。  

前台-系統說明書
==============
在前台可以讓使用者了解系統是如何做操作及設備的選擇。   

後台-腳本編輯
=======
![後台腳本](/laravel/public/image/dialog.png "dialog")
![腳本編輯](/laravel/public/image/manual/dialog.png "dialogEdit")

管理者可以根據想要讓使用者練習內容進行腳本的設計。主要是透過不同的地點來進行分類，而在相同的地點可以再根據不同的主題或是情境來做更詳細的腳本設置，用來提供管理者做豐富的腳本設置。若是在地點內含有多種的主題則會在使用者在選擇時以隨機的方式挑選主題。   
- 在編輯對話練習的腳本練習時，問與答的方式來做設置。   
- 必須先設定問才能設置答，而答最多只能3個或是不設置。
- 在設置問時，可以同時設置虛擬人物的動作。
- 若是在設置問時，沒有答時則虛擬人物說完此句子後則完成此對話練習。
- 在設置答時，"前往"是指使用者若是回答此句子後，會前往的下一個問。若是為空白時，則會結束此對話練習。

後台-動作查看
===========
![動作查看](/laravel/public/image/manual/action.png "action")

可以讓使用者不同性別的虛擬人物的動作樣式
