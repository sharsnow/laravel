<template>
  <div id = "topic" class="mid">

  <div class="main_context">
    <div class="chapter">
      <div>腳本</div>
      <div @click="QRcode_download" class="QRcode_download">
        <qrcode-vue id="qrcode" :value="value" :size="size" level="H" ref="qrcode" style="display: none;"/>
        <div style="font-size: 20px;"> 下載 QR code</div>
      </div>
    </div>
    <div class="context" >
      <div class = "context_info row">
        <div class="col row contextTitle" ><header class="col-5"> 地點: </header><div class="col contextTe" >{{context_topic.place}}</div></div>
        <div class="col row contextTitle" ><header class="col-5"> 類型: </header> <div class="col contextTe" >{{context_topic.type}}</div></div>
        <div class="col row contextTitle" ><header class="col-5"> 問題: </header> <div class="col contextTe" >{{ currentQuestionGroup.qus_no }}</div></div>
      </div>
      <div class = "correct_dialog">
        <div class = "question">
          <div class = "row" style="width: 100%;">
            <div class = "col-1 left">問題</div>
            <div class = "col-7 middle row">
              <div  v-if="!currentQuestionGroup.modify"> {{ currentQuestionGroup.question }}</div>
              <input v-if="currentQuestionGroup.modify" v-model=" currentQuestionGroup.question" class = "form-control form-control-sm">
              <input v-if="currentQuestionGroup.qus_no == 0" class = "form-control form-control-sm" v-model="newQuestionGroup.question">
              <div v-if="addQuestionCheck" style="text-align: center;font-size: 13px;">請將對話及動作填寫完成</div>
            </div>
              <div  class = "col middle" v-if="!currentQuestionGroup.modify && !currentQuestionGroup.question == ''">
              動作: {{ currentQuestionGroup.action }}
              </div>
            <div v-if="currentQuestionGroup.modify || currentQuestionGroup.question == ''"  class="col-2">
                動作:
                <select aria-label="Default select example" v-model="currentQuestionGroup.action" class="form-select ">
                <option v-for="a in actions" :value="a.action">
                  {{ a.action }}
                </option>
              </select>
            </div>
            <div class = "col-2 right"  v-if="!currentQuestionGroup.modify &&  currentQuestionGroup.question != '' && !deleteQuestionCheck">
              <div class="modify" @click="modifyQuestion()">修改</div>
              <div class="modify" @click="deleteQuestionCheck = true">刪除</div>
            </div>
            <div class = "col-2 right answerModify"  v-if="currentQuestionGroup.modify">
              <div class="modify" @click="modifyQuestionConfirm()">確定修改 </div>
              <div class="modify" @click="modifyQuestion()">取消修改</div>
            </div>
            <div class = "col-2 right answerModify"  v-if="deleteQuestionCheck">
              <div class="modify" @click="deleteQuestion()">確定刪除 </div>
              <div class="modify" @click="deleteQuestionCheck = false;">取消刪除</div>
            </div>
            <div class = "col right" v-if="currentQuestionGroup.qus_no == 0" @click ="addNewQuestionConfirm()">新增</div>
            
          </div>
        </div>  
        <div class = "answer_group" v-if="currentQuestionGroup.question != ''">
          <!-- ANSWER　範圍頭-->
          <div  v-for="(ca, index) in currentQuestionGroup.ans_dir" class="row answer_individual">
            <div class = "col left answer">
              回答
            </div>

            <div class="col-7 middle answer" v-if="addAnswerCheck && isShowAnswer.no == index && deleteAnswerCheck != index && !insertNewAnswer" style="display: flex;flex-direction: column;justify-content: flex-end;">
              <input class = "form-control form-control-sm" v-model="ca.answer" :id="index"  v-if="isShowAnswer.no == index">
              <div style="text-align: center;font-size: 13px;" > 回答不能為空 </div>
            </div>

            <div class="col-7 middle answer" v-else>
              <div :id="index" v-if=" isShowAnswer.no != index"> {{ ca.answer }}</div>
              <input class = "form-control form-control-sm" v-model="ca.answer" :id="index"  v-if="isShowAnswer.no == index">
            </div>
            
          
            <div class = "col middle answer">
              <div @click="direction(ca.qus_no)" :id="index" v-if=" isShowAnswer.no != index" style="width: 100%;height: 100%;text-align: center;display: flex;align-items: center;justify-content: center;">前往: {{ ca.qus_no }}</div>
              <select class="form-select col" aria-label="Default select example" v-if="isShowAnswer.no == index" v-model="ca.qus_no">
                <option :value="無"> 無 </option>
                <option v-for="qg in questionGroup" :value="qg.qus_no">{{ qg.qus_no }}</option>
              </select>
            </div>
            <div class = "col right answer"  v-if="isShowAnswer.no != index && deleteAnswerCheck != index">
              <div class="modify" @click="modifyAnswer(index, ca.answer, ca.qus_no)"> 修改</div>
              <div class="modify" @click="deleteAnswerCheck = index"> 刪除</div>
            </div >
            
            <div class = "col right answer answerModify"  v-if="isShowAnswer.no == index && deleteAnswerCheck != index">
              <div class="modify" @click="modifyAnswerConfirm(index, ca.answer, ca.qus_no); insertNewAnswer = false;">確定修改 </div>
              <div class="modify" @click="modifyAnswer(index, ca.answer, ca.qus_no)">取消修改</div>
            </div>

            <div class = "col right answer answerModify"  v-if="deleteAnswerCheck == index">
              <div class="modify" @click="deleteAnswer(index)">確定刪除 </div>
              <div class="modify" @click="deleteAnswerCheck = -1">取消刪除</div>
            </div>
            
          </div>
          <!-- ANSWER　範圍尾-->
          <!--新增ANSWER  範圍頭-->
          <div v-if="currentQuestionGroup.ans_dir.length < 3" class="row answer_individual">
            <div class = "col left answer"> 回答 </div>
            
            <div class="col-7 middle answer answerAdded" v-if="addAnswerCheck && insertNewAnswer">
              <input class = "form-control form-control-sm" v-model="newAnswer.answer">
              <div style="text-align: center;font-size: 13px;" > 回答不能為空 </div>
            </div>
            <div v-else class="col-7 middle answer">
              <input class = "form-control form-control-sm" v-model="newAnswer.answer">
            </div>
            <div class = "col-2 middle answer" style="padding: 0px;">
              <div class="answerDirectionAdd"> 導向 </div>
              <select class="form-select col" aria-label="Default select example"  v-model="newAnswer.qus_no">
                <option :value="無">{{ 結束 }}</option>
                <option v-for="qg in questionGroup" :value="qg.qus_no">
                  {{ qg.qus_no }}
                </option>
              </select>
            </div>
            <div class = "col-2 right answer" @click="addNewAnswerConfirm(); insertNewAnswer = true;">新增</div>
          
          </div>
          <!--新增ANSWER  範圍尾-->
        </div>
      </div>
      <div class = "dialog_change_group">
        <div  class = "change_dialog col-2">
          <div @click = "questionChoice(false)" v-if=" currentDialog != 0">
            上個問題
          </div> 
          <div v-if=" currentDialog == 0">
            已無上個問題
          </div>
        </div>
        
        <div v-if="addNewQuestion" class = "change_dialog col-2" @click = "questionChoice(true)" style="text-align: end;">
          <div v-if="currentDialog < questionGroup.length - 1 " >下個問題</div> 
          <div v-if="(currentDialog >= questionGroup.length - 1) "> 新增問題</div>
        </div> 
      </div>
    </div>
  </div>
    <div class="asideMenu" id="add">
      <side :message="sideView"></side>
      <side-dialog @sideDialog="getTopic"></side-dialog>
      
    </div>
    
  </div>
</template>
<script>
import QrcodeVue from 'qrcode.vue';
export default {
    data() {
        return {
          value:'1',
          size: '400',
          sideView:'dialog',
          context_topic: {// 目前類型
            place: '',
            type: '',
          } ,
          questionGroup: [ //同類型對話內容
          ],
          currentQuestionGroup: {
              action: '',
              ans_dir: [],
              question: '',
              qus_no: 0,
              modify: false
            },
          currentDialog: 0, //目前對話索引
          tmpTopic:'',
          isShowAnswer:{
            ans: '', 
            qus_no: '', 
            no:-1
          },
          isShowQuestion: {
            qus_no: '',
            qus: '',
            action:''
          },
          newQuestionGroup: {
            question: '',
            action:'',
            type:'',
            place:'',
            qus_no:0
          },
          newAnswer: {
            answer:'',
            qus_no:''
          },
          actions:[
           { action: ''}
          ],
          place:'',
          isShowPlace: {
            no: -1,
            place:''
          },
          isShowType: {
            no: -1,
            type:''
          },
          addNewQuestion: true,
          deleteQuestionCheck: false,
          deleteAnswerCheck: -1,
          addQuestionCheck: false,
          addAnswerCheck: false,
          insertNewAnswer:false
        }
    },
    components: {
      QrcodeVue,
    },
    methods: {
      QRcode_download() {
        
        const canvas = document.querySelector('#qrcode'); // 获取QR Code的Canvas元素
        const url = canvas.toDataURL('image/png'); // 将Canvas转换为DataURL

        const a = document.createElement('a');
        a.href = url;
        a.download = 'qrcode.png'; // 下载的文件名
        a.click();
      },
      getTopic(formData) {
        let _this = this;
        console.log(formData);

        _this.context_topic = formData;
        _this.getQuestionGroup(formData.place, formData.type);
      },
      modifyAnswer(index ,ans , qus_no) {
        let _this = this;
        _this.addAnswerCheck = false;
        if(_this.isShowAnswer.no == index) { //修改 -> 不修改

          _this.currentQuestionGroup.ans_dir[index].answer = _this.ans;
          _this.currentQuestionGroup.ans_dir[index].qus_no = _this.qus_no;
          _this.isShowAnswer.no = -1;
        } 
        else { //不修改 -> 修改
          _this.isShowAnswer.no = index;
          _this.ans = ans;
          _this.qus_no = qus_no;
        } 
      },  
      modifyAnswerConfirm(index, ans, qus_no) { //送出要修改的資訊
        let _this = this;
        _this.addAnswerCheck = false;
        if(ans.length == 0) {
          _this.addAnswerCheck = true;
        }
        else {
          let formData = new FormData();
          formData.append('ans_no', _this.currentQuestionGroup.ans_dir[index].ans_no);
          formData.append('ans', ans);
          if(qus_no == 'undefined' || qus_no == 'null') {
            formData.append('qus_no', "");
          } 
          else {
            formData.append('qus_no', qus_no);
          }
          
          
          const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
          const requestOptions = {
              method: 'POST',
              headers: {
                  'X-CSRF-TOKEN': csrfToken
              },
              body: formData // 不再使用 JSON.stringify
          };

          fetch('/AnswerGroupUpdate', requestOptions)
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
              if(data.message == "更新成功") {
                _this.currentQuestionGroup.ans_dir[index].answer = ans;
                _this.currentQuestionGroup.ans_dir[index].qus_no = qus_no;
                _this.questionGroup[_this.currentDialog] = _this.currentQuestionGroup;
                _this.isShowAnswer.no = -1;
              }
          })
          .catch(error => {
              console.error(error);
          });
        } 
        
      },
      modifyQuestion() {
        let _this = this;
        _this.addQuestionCheck = false;
        if(_this.currentQuestionGroup.modify) {
           _this.currentQuestionGroup.modify =  false;
           _this.currentQuestionGroup.question = _this.isShowQuestion.qus;
           _this.currentQuestionGroup.action = _this.isShowQuestion.action;

        }
        else {
          _this.currentQuestionGroup.modify =  true;
          _this.isShowQuestion.qus = _this.currentQuestionGroup.question;
          _this.isShowQuestion.action = _this.currentQuestionGroup.action;
        }
       
      },
      modifyQuestionConfirm() { //送出要修改的資訊
        let _this = this;
        let formData = new FormData();
        let action_no = _this.actions.filter(item => item.action == this.currentQuestionGroup.action);
        _this.addQuestionCheck = false;
        if(_this.currentQuestionGroup.question.length == 0 || action_no == null) {
          _this.addQuestionCheck = true;
        } 
        else {
          formData.append('qus_no',_this.currentQuestionGroup.qus_no);
          formData.append('question', _this.currentQuestionGroup.question);
          formData.append('action', action_no[0].no);
          const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
          const requestOptions = {
              method: 'POST',
              headers: {
                  'X-CSRF-TOKEN': csrfToken
              },
              body: formData // 不再使用 JSON.stringify
          };

          fetch('/questionUpdate', requestOptions)
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
              if(data.message == "更新成功") {

              _this.currentQuestionGroup.modify =  false;
              }
              // console.log(_this.currentQuestionGroup);
          })
          .catch(error => {
              console.error(error);
          });
        }
        
      },
      deleteQuestion() {
        let _this = this;
        let tmp = _this.currentDialog;
        // console.log(_this.currentQuestionGroup);

        const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
        const requestOptions = {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify(_this.currentQuestionGroup) // 不再使用 JSON.stringify
        };

        fetch('/QuestionDelete', requestOptions)
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
            if(data.message == '刪除成功') {
              _this.deleteQuestionCheck = false;
              
             
              return _this.getQuestionGroup(_this.context_topic.place, _this.context_topic.type);
            }
        })
        .then(()=> {
          _this.currentDialog = tmp;
          if(_this.currentDialog == _this.questionGroup.length - 1) {
            _this.currentQuestionGroup = _this.questionGroup[_this.currentDialog --];
          } 
          else {
            _this.currentQuestionGroup = _this.questionGroup[_this.currentDialog];
          }
        })
        .catch(error => {
            console.error(error);
        });
      },
      deleteAnswer(index) {
        let _this = this;
        let formData = new FormData();
        formData.append('ans_no', _this.currentQuestionGroup.ans_dir[index].ans_no);
        formData.append('qus_no', _this.currentQuestionGroup.qus_no);

        const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
        const requestOptions = {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            body: formData // 不再使用 JSON.stringify
        };

        fetch('/AnswerDelete', requestOptions)
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
            if(data.message == '刪除成功') {
              // console.log('刪除成功');
              let tmp = _this.currentDialog;
              _this.deleteAnswerCheck = -1;
              // console.log(tmp);
              _this.getQuestionGroup(_this.context_topic.place, _this.context_topic.type);
              _this.currentDialog = tmp;
            }
            // console.log(_this.currentQuestionGroup);
        })
        .catch(error => {
            console.error(error);
        });
      },
      questionChoice(group) { // 問題交換
        
        let _this = this;
        // console.log(_this.questionGroup);
        console.log(_this.currentQuestionGroup);
        _this.deleteQuestionCheck = false;
        _this.deleteAnswerCheck = -1;
        _this.addQuestionCheck = false;
        _this.addAnswerCheck = false;
        _this.currentQuestionGroup.modify = false;
        if(group) { //下一個
          if(_this.currentDialog == _this.questionGroup.length - 1) {
            _this.addNewQuestion = false;
            _this.addNewQuestionGroup();
            // console.log("新增對話");
            _this.currentDialog  = _this.questionGroup.length;
          }
          else if(typeof(_this.currentDialog) != 'undefined'){
            _this.currentQuestionGroup = _this.questionGroup[++_this.currentDialog];
            _this.isShowAnswer = [
              {ans: '', qus_no: '', show: false},
              {ans: '', qus_no: '', show: false},
              {ans: '', qus_no: '', show: false}
            ]
          }
          
        }
        else { //上個
          _this.addNewQuestion = true;
          if(_this.currentDialog == 0) {
            console.log("錯誤");
          }
          else if(typeof(_this.currentDialog) == 'undefined') {
            _this.currentQuestionGroup = _this.questionGroup[_this.questionGroup.length - 1];
            _this.isShowAnswer = [
              {ans: '', qus_no: '', show: false},
              {ans: '', qus_no: '', show: false},
              {ans: '', qus_no: '', show: false}
            ];
          }
          else {
            _this.currentQuestionGroup = _this.questionGroup[--_this.currentDialog];
            _this.isShowAnswer = [
              {ans: '', qus_no: '', show: false},
              {ans: '', qus_no: '', show: false},
              {ans: '', qus_no: '', show: false}
            ];
          }
        }
      },
      direction(dir) {
        let _this = this;
        dir = parseInt(dir);
        _this.deleteQuestionCheck = false;
        _this.addQuestionCheck = false;
        _this.addAnswerCheck = false;
        _this.currentQuestionGroup = _this.questionGroup.filter(item =>item.qus_no == dir)[0];
        _this.currentDialog = _this.questionGroup.findIndex(item => item.qus_no == dir);
        _this.isShowAnswer = [
              {ans: '', qus_no: '', show: false},
              {ans: '', qus_no: '', show: false},
              {ans: '', qus_no: '', show: false}
            ];
      },
      addNewQuestionGroup() {
        let _this = this;
        _this.currentQuestionGroup = {
          action: '',
          ans_dir: [],
          question: '',
          qus_no: 0,
          modify: false
        };
        _this.newQuestionGroup = {
            question: '',
            action:'',
            type:'',
            ans_dir:[],
            place:'',
            qus_no:0
        };
      },
      clearGroup() {
        let _this = this;
        let newGroup = {
            question: '',
            action:'',
            type:'',
            ans_dir:[],
            place:'',
            qus_no:0
        };
        _this.newAnswer = {
            answer:'',
            qus_no:''
          };
        _this.newQuestionGroup = newGroup;
      },
      addNewQuestionConfirm() {
        let _this = this;
        _this.addQuestionCheck = false;
        if(_this.newQuestionGroup.question == '' || _this.currentQuestionGroup.action == '') {
          _this.addQuestionCheck = true;
        }
        else {
          let no = _this.actions.filter(item =>item.action == _this.currentQuestionGroup.action);
          let formData = new FormData();
          formData.append('qus', _this.newQuestionGroup.question);
          formData.append('place', _this.context_topic.place);
          formData.append('type', _this.context_topic.type);
          formData.append('action', no[0].no);

          const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
          const requestOptions = {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            body: formData // 不再使用 JSON.stringify
          };

          fetch('/questionInsert', requestOptions)
          .then(response => {
          if (response.ok) {
              return response.json();
          } else {
              throw new Error('請求失敗');
          }
          })
          .then(data => {
          //成功
              console.log(data);
              if(data.message == "新增成功") {
                if(_this.questionGroup.length ==  0) {
                  _this.questionGroup =[{'action': _this.currentQuestionGroup.action,'ans_dir':[], 'question': _this.newQuestionGroup.question, 'qus_no': data.qus_no}];
                }
                else{
                  _this.questionGroup.push({'action': _this.currentQuestionGroup.action,'ans_dir':[], 'question': _this.newQuestionGroup.question, 'qus_no': data.qus_no});

                }
                
                _this.currentQuestionGroup = _this.questionGroup[_this.questionGroup.length - 1];
                _this.addNewQuestion = true;
              }
              else {
                console.log("新增失敗");
              }
              _this.clearGroup();
              // console.log(_this.currentQuestionGroup);
          })
          .catch(error => {
              console.error(error);
          });

        }
      },
      addNewAnswerConfirm() {
        let _this = this;

        _this.addAnswerCheck = false;
        let formData = new FormData();

        if(_this.newAnswer.answer.length == 0) {
          _this.addAnswerCheck = true;
        }
        else {
          formData.append('qus_no', _this.currentQuestionGroup.qus_no);
          formData.append('answer', _this.newAnswer.answer);
          formData.append('direction', _this.newAnswer.qus_no);
          formData.append('place', _this.context_topic.place);
          formData.append('type', _this.context_topic.type);

          const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
          const requestOptions = {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            body: formData // 不再使用 JSON.stringify
          };

          fetch('/answerInsert', requestOptions)
          .then(response => {
          if (response.ok) {
              return response.json();
          } else {
              throw new Error('請求失敗');
          }
          })
          .then(data => {
          //成功
            console.log(data);
            if(data.message == '新增成功') {
              _this.questionGroup[this.currentDialog].ans_dir.push({'ans_no': data.ans_no, 'answer': _this.newAnswer.answer, 'qus_no': _this.newAnswer.qus_no});
              _this.currentQuestionGroup.ans_dir = _this.questionGroup[this.currentDialog].ans_dir;
              _this.clearGroup();
            }
            
          })
          .catch(error => {
              console.error(error);
          });
        }
        
      },
      getQuestionGroup(place, type) {
        let _this = this;
        _this.currentDialog = 0;
        // console.log(place+ " "+type);
        _this.context_topic.place = place;
        _this.context_topic.type = type;
        const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
        const requestOptions = {
          method: 'POST',
          headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': csrfToken
          },
          body: JSON.stringify({'place': place, 'type': type})
        };

        fetch('/questionGroupIndex', requestOptions)
        .then(response => {
        if (response.ok) {
            return response.json();
        } else {
            throw new Error('請求失敗');
        }
        })
        .then(data => {
        //成功
        console.log(data);
        _this.value = _this.context_topic.place;
          if(data.length == 0) {
            console.log("新內容");
            _this.addNewQuestion = false;
            _this.questionGroup = [ ];
            _this.addNewQuestionGroup();
          } 
          else {
            _this.addNewQuestion = true;
            _this.questionGroup = data;
            _this.currentQuestionGroup = _this.questionGroup[_this.currentDialog];
            _this.isShowAnswer = [
              {ans: '', qus_no: '', show: false},
              {ans: '', qus_no: '', show: false},
              {ans: '', qus_no: '', show: false}
            ];
           
          }
           
        })
        .catch(error => {
            console.error(error);
        });
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
        })
        .catch(error => {
            console.error(error);
        });
    }
};
</script>