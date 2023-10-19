<template>
  <div>
    <div class="viewTitle">地點</div>
    <div class="scrollBarTopic">
      <div class="list">
        <ul class="optionTitle">
          <li v-for="(tp, index) in topics" :key="index">
            <div class="topics row" v-if="isShowPlace.no != index">
              <p class="col" @click="submit(index)"
                style="display: flex;align-content: center;align-items: center;margin-bottom: 0px;">{{ tp.place }}</p>
              <div class="col" style="display: flex;align-items: center;justify-content: flex-end;">
                <img class="imageDelete" :src="imageDelete" alt="Image" title="刪除" @click="deletePlaceCheck = index">
                <img class="imageModify" :src="imageModify" alt="Image" title="修改" @click="modifyPlace(index)">
              </div>
            </div>
            <div v-if="deletePlaceCheck == index" class="row" style="background: #6a4025;border-radius: 5px;width: 104%;padding-right: 5px;padding-left: 5px;">
              <div style="display: inline-block;" nowrap>
                確定刪除 <p style="color: azure; display: inline;">{{ tp.place }}</p> ?
              </div>
              <div class="col" @click="deletePlace(tp.place, index)"> 確定</div>
              <div class="col" @click="deletePlaceCheck = -1"> 取消</div>
            </div>
            <div v-if="isShowPlace.no == index">
              <div  style="background: #6a4025;border-radius: 5px;width: 104%;padding-right: 5px;padding-left: 5px;">
              原先: {{ isShowPlace.place }} <input  class="form-control form-control-sm" v-model="tp.place">
              <div v-if="placeIsNull">請填寫內容</div>
              <div class="row">
                <div class="col" @click="modifyPlaceConfirm(tp.place, tp.id, index)">確認</div>
                <div class="col" @click="modifyPlace(index)">取消</div>
              </div>
              </div>
            </div>
           
            <div class="individualTopic row" v-for="(type, j) in tp.type" v-if="choice == index">
              <div v-if="isShowType.no != j" style="display: flex;align-items: center;">
                <div class="col" style="text-align: left;">
                  <img class="imageDelete" :src="imageDelete" alt="Image" title="刪除" @click="deleteTypeCheck = j">
                  <img class="imageModify" :src="imageModify" alt="Image" title="修改" @click="modifyType(index, j)">
                </div>
                <p class="col-7" @click="getQuestionGroup(tp.place, type)" style="margin-bottom: 0px;">{{ type }}</p>
              </div>
              <div v-if="deleteTypeCheck == j" class="row" style="padding: 0;text-align: center;margin: 0;">
                <div style="display: inline-block;" nowrap>
                  確定刪除 <p style="color: rgb(255, 220, 107); display: inline;">{{ type}}</p> ?
                </div>
                <div class="col" @click="deleteType(tp.place, tp.type[j], index, j)"> 確定</div>
                <div class="col" @click="deleteTypeCheck = -1"> 取消</div>
              </div>
              <div v-if="isShowType.no == j">
                原先: {{ isShowType.type }} <input class="form-control form-control-sm" v-model="tp.type[j]">
                <div v-if="topicIsNull">請填寫內容</div>
                <div class="row">
                  <div class="col" @click="modifyTypeConfirm(index, j, tp.place, isShowType.type, tp.type[j])">確認</div>
                  <div class="col" @click="modifyType(index, j)">取消</div>
                </div>
              </div>
            </div>
            <div @click="place = tp.place">
              <add-topic :message="topicIsEmpty" @AddTopic="submitForm" v-if="choice == index"> </add-topic>
            </div>
          </li>
          <li>
            <add-place  @AddPlace="getTopicGroup"></add-place>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  emits: ['sideDialog'],
  data() {
    return {
      topics: [{ // 所有不同類型及動作
        id: 0,
        place: '',
        type: [],
        modify: false
      }],
      context_topic: {// 目前類型
        place: '',
        type: '',
      },
      deleteImg: 'trash-can.png',
      modifyImg: 'editing.png',
      imageDelete: '',
      imageModify: '',
      choice: -1,
      isShowPlace: {
        no: -1,
        place: ''
      },
      isShowType: {
        no: -1,
        type: ''
      },
      place:'',
      deletePlaceCheck: -1,
      deleteTypeCheck: -1,
      placeIsNull: false,
      topicIsNull: false,
      topicIsEmpty: true
    }
  },
  methods: {
    submit(index) { //取得place
      let _this = this;
      _this.topicIsEmpty = true;
      _this.currentDialog = 0;
      if(index == _this.choice) {
        _this.choice = -1;
      }
      else {
        _this.choice = index;
      }
      
    },
    getQuestionGroup(place, type = null) {
      let _this = this;

      _this.context_topic.place = place;
      if (type !== null) {
        _this.context_topic.type = type;
      }
      this.$emit('sideDialog', { 'place': _this.context_topic.place, 'type': _this.context_topic.type });
    },
    modifyPlace(index) {
      let _this = this;
      _this.topicIsEmpty = true;
      if (_this.isShowPlace.no != index) {
        _this.isShowPlace.no = index;
        _this.isShowPlace.place = _this.topics[index].place;
        _this.choice = index;
      }
      else {
        _this.isShowPlace.no = -1;
        _this.topics[index].place = _this.isShowPlace.place;

      }

    },
    modifyPlaceConfirm(place, id, index) {
      let _this = this;
      _this.placeIsNull = false;
      if(place.length == 0) {
        _this.placeIsNull = true;
      }
      else {
        const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
        const requestOptions = {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
          },
          body: JSON.stringify({ 'place': place, 'index': id }) // 不再使用 JSON.stringify
        };

        fetch('/topicModify', requestOptions)
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
          if (data.message == '修改成功') {
            _this.isShowPlace.no = -1;
            // console.log(_this.isShowPlace.place+" "+ _this.context_topic.place);
            if (_this.isShowPlace.place == _this.context_topic.place) {
              _this.topics[index].place = place;
              _this.context_topic.place = place;
              _this.getQuestionGroup(place);
            }
            else {
              _this.topics[index].place = place;
            }
            console.log("修改成功");

          } 
          else if (data.message == '修改失敗') {
            console.log("修改失敗");
          }
        })
        .catch(error => {
          console.error(error);
        });
      }
      
    },
    modifyType(index, j) {
      let _this = this;
      _this.topicIsEmpty = true;
      if (_this.isShowType.no == j) {
        _this.isShowType.no = -1;
        _this.topics[index].type[j] = _this.isShowType.type;

      }
      else {
        _this.isShowType.no = j;
        _this.isShowType.type = _this.topics[index].type[j];
      }
    },
    modifyTypeConfirm(index, j, place, beforeType, afterType) {
      let _this = this;
      // console.log(place+" " + beforeType+" " + afterType);
      _this.topicIsNull = false;
      if(afterType.length == 0) {
        _this.topicIsNull = true;
      }
      else {
        const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
        const requestOptions = {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
          },
          body: JSON.stringify({ 'place': place, 'before': beforeType, 'after': afterType }) // 不再使用 JSON.stringify
        };

      fetch('/typeModify', requestOptions)
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
          if (data.message == '修改成功') {
            _this.isShowType.no = -1;
            _this.topics[index].type[j] = afterType;
            if (beforeType == _this.context_topic.type) {
              _this.context_topic.type = afterType;
              this.$emit('sideDialog', { 'place': place, 'type': afterType });
            }
            console.log("修改成功");
          }
          else if(data.message == '修改失敗'){
            console.log("修改失敗");
          }
        })
        .catch(error => {
          console.error(error);
        });
      }
     
    },
    deletePlace(place, index) {
      let _this = this;
      const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
      const requestOptions = {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ 'place': place }) // 不再使用 JSON.stringify
      };

      fetch('/topicDelete', requestOptions)
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
          if (data.message == '刪除成功') {
            _this.topics.splice(index, 1);
            _this.deletePlaceCheck = -1;
            console.log("刪除成功");
            if (place == _this.context_topic.place) {
              _this.getQuestionGroup(_this.topics[0].place, _this.topics[0].type[0]);
            }
          }
        })
        .catch(error => {
          console.error(error);
        });
    },
    deleteType(place, type, index, j) {
      // console.log(place+ " "+ type);

      let _this = this;
      const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
      const requestOptions = {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ 'place': place, 'type': type })
      };

      fetch('/typeDelete', requestOptions)
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
          if (data.message == '刪除成功') {
            _this.topics[index].type.splice(j, 1);
            _this.deleteTypeCheck = -1;
            if (type == _this.context_topic.type) {
              _this.getQuestionGroup(_this.topics[0].place, _this.topics[0].type[0]);
            }
            console.log("刪除成功");
          }
        })
        .catch(error => {
          console.error(error);
        });
    },
    getTopicGroup() {
      let _this = this;
      _this.isShowPlace = {};
      const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
      const requestOptions = {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrfToken
        },
        body: null
      };

      fetch('/topicIndex', requestOptions)
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
          _this.topics = data;
          _this.context_topic.place = _this.topics[0].place;
          _this.context_topic.type = _this.topics[0].type[0];
          _this.getQuestionGroup(_this.context_topic.place, _this.context_topic.type);
          _this.currentDialog = 0;
        })
        .catch(error => {
          console.error(error);
        });
    },
    submitForm(dataFromChild) {
      let _this = this;
      _this.topicIsEmpty = true;
      dataFromChild.append('place', _this.place);
      const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
      const requestOptions = {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': csrfToken
        },
        body: dataFromChild// 不再使用 JSON.stringify
      };

      fetch('/topicAdd', requestOptions)
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
          if (data.message == "新增成功") {
            _this.choice = -1;
            _this.getTopicGroup();
          }
          else if (data.message == "已經存在") {
            _this.topicIsEmpty = false;
          }else if(data.message == "新增失敗") {
            _this.topicIsEmpty = false;
          }
        })
        .catch(error => {
          console.error(error);
        });
    }
  },
  mounted() {
    let _this = this;


    _this.imageDelete = `/image/${_this.deleteImg}`;
    _this.imageModify = `/image/${_this.modifyImg}`;

    _this.getTopicGroup();
  }
}  
</script>