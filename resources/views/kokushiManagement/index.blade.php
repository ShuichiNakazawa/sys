<!-- resources/views/rooms/management.blade.php -->
@extends('layouts.app_kokushi')

@section('content')

@if(session('message'))
<div class="alert alert-success">
  {{ session('message') }}
</div>
@endif

<div id="system_message">

</div>

@include('common.errors')

<div id="app" class="">
  <div class="" style="text-align: center;">
    <h3>国試 管理画面トップ</h3>
  </div>
  <div class="row">
    

    <div class="" style="">
      <br><br><br>
      <div style="z-index: 20;">
        <div style="background: white; width: 200px; height: 100px; margin-left: 50px; margin-bottom: 50px; border-radius: 10px; z-index: 30; position: relative;">
          <div style="background: lightblue; width: 194px; height: 94px; margin-top: 3px; margin-left: 3px; border-radius: 10px; position: absolute; z-index: 10;">
            <div style="background: lightblue; width: 188px; height: 88px; margin-top: 3px; margin-left: 3px; border-radius: 10px; position: absolute; border-left: solid 1px white; z-index: 10;">
              <div style="background: white; width: 172px; height: 82px; margin-top: 3px; margin-left: 10px; border-radius: 10px; position: absolute; text-align: center; padding-top: 7px; z-index: 10;" v-on:click="onClassificationManagement">
                <p style="font-size: 20px;">問題分類<br>管理</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      

      
      <div style="z-index: 10;">
        <div style="background: white; width: 200px; height: 100px; margin-left: 50px; margin-bottom: 50px; border-radius: 10px; z-index: 20; position: relative;">
          <div style="background: rgb(48, 105, 96); width: 194px; height: 94px; margin-top: 3px; margin-left: 3px; border-radius: 10px; position: absolute; z-index: 10;">
            <div style="background: rgb(48, 105, 96); width: 188px; height: 88px; margin-top: 3px; margin-left: 3px; border-radius: 10px; position: absolute; border-left: solid 1px white;">
              <div style="background: white; width: 172px; height: 82px; margin-top: 3px; margin-left: 10px; border-radius: 10px; position: absolute; text-align: center; padding-top: 7px;" v-on:click="onQuestionSentenceManagement">
                <p style="font-size: 20px;">問題文・解説<br>管理</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <br><br>


      <div style="z-index: 10;">
        <div style="background: white; width: 200px; height: 100px; margin-left: 50px; margin-bottom: 50px; border-radius: 10px; z-index: 20; position: relative;">
          <div style="background: rgb(48, 105, 96); width: 194px; height: 94px; margin-top: 3px; margin-left: 3px; border-radius: 10px; position: absolute; z-index: 10;">
            <div style="background: rgb(48, 105, 96); width: 188px; height: 88px; margin-top: 3px; margin-left: 3px; border-radius: 10px; position: absolute; border-left: solid 1px white;">
              <div style="background: white; width: 172px; height: 82px; margin-top: 3px; margin-left: 10px; border-radius: 10px; position: absolute; text-align: center; padding-top: 7px;" v-on:click="onReferTotalData">
                <p style="font-size: 20px;">科目別集計<br>参照</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <br><br>
    </div>

    {{-- 問題分類管理領域 --}}
    <br><br>
    <div style="z-index: 5; width: 80%;" id="classificationArea" v-bind:class="[isClsAreActive ? 'activeDiv' : 'inactiveDiv']">
      <br>

      {{-- タブ枠 --}}
      <div class="row" style="margin-left: 30px; z-index: 5;">
        <div style="margin-right: 15px; border: solid 4px lightgray; font-size: 20px; width: 150px; text-align: center; border-top-left-radius: 10px; border-top-right-radius: 10px; z-index: 5;" v-on:click="onSubjectGroupTab">
          科目グループ
        </div>
        <div style="margin-right: 15px; border: solid 4px lightgray; font-size: 20px; width: 150px; text-align: center; border-top-left-radius: 10px; border-top-right-radius: 10px; z-index: 5" v-on:click="onSubjectTab">
          科目
        </div>

        <div style="margin-right: 15px; border: solid 4px lightgray; font-size: 20px; width: 150px; text-align: center; border-top-left-radius: 10px; border-top-right-radius: 10px; z-index: 5" v-on:click="onTitleTab">
          タイトル
        </div>
        <div style="margin-right: 15px; border: solid 4px lightgray; font-size: 20px; width: 150px; text-align: center; border-top-left-radius: 10px; border-top-right-radius: 10px; z-index: 5" v-on:click="onFieldTab">
          分野
        </div>
      </div>
      
      {{-- 外枠 --}}
      <div style="background: lightgray; text-align: center; padding-top: 10px; max-width: 100%; height: 635px; margin-top: -3px; margin-left: -50px; border: solid 3px lightgray; border-radius: 15px; z-index: 5;">


        <div style="background: white; margin-left: 70px; margin-right: 20px; border-radius: 20px; z-index: 5;">
          <br>

          <div class="row" style="margin: 0 auto; font-size: 20px; z-index: 5;">
            <div style="width: 30%">
            </div>
            <div style="margin: 0 auto;">
              <div class="btn-choice">
                  登録
              </div>
            </div>

            <div style="margin: 0 auto;">
              <div class="btn-choice">
                一覧表示
              </div>

            </div>
            <div style="width: 30%">
            </div>
          </div>
          <br>

        </div>

        <div style="z-index: 5;">
          <br>
        </div>

        <!-- 科目グループ登録 -->
        <div id="registSubjectGroup" v-bind:class="[isRegSubGrpActive ? 'activeDiv' : 'inactiveDiv']" style="background: white; height: 500px; margin-left: 70px; margin-right: 20px; border-radius: 20px; z-index: 5;">
          <br>
          <h4>科目グループ 登録</h4>

          <div class="card-body">

              <div style="text-align: left; padding-left: 20px;">


                <p>
                  <label for="subject_group_name">科目グループ名：</label>
                  <input typt="text" v-model="subject_group_name_SubGrpSto" name="subject_group_name" id="subject_group_name" value="" size="30">
                </p>
                <p>
                  <input type="submit" value="登録" v-on:click="onStoreSubjectGroup">
                </p>
              </div>
        
          </div>
        </div>

        <!-- 科目グループリスト -->
        <div id="subjectGroupList" v-bind:class="[isSubGrpLstActive === true ? 'activeDiv' : 'inactiveDiv']" style="background: white; height: 500px; margin-left: 70px; margin-right: 20px; border-radius: 20px; display: none;">
          <br>
          <h4>科目グループリスト</h4>

          <div class="card-body">

              <div style="text-align: left; padding-left: 20px;">


                <p>
                  <label for="subject_group_name">科目グループ名：</label>
                  <input typt="text" name="subject_group_name" id="subject_group_name" value="" size="30" v-model="subject_group_name">
                </p>
                <p>
                  <input type="submit" value="修正" v-on:click="onModifySubjectGroup">
                </p>
              </div>
        
          </div>
        </div>

        <!-- 科目登録 -->
        <div id="registSubject" v-bind:class="[isRegSubActive === true ? 'activeDiv' : 'inactiveDiv']" style="background: white; height: 500px; margin-left: 70px; margin-right: 20px; border-radius: 20px;">
          <br>
          <h4>科目登録</h4>

          <div class="card-body">

              <div style="text-align: left; padding-left: 20px;">

                <p>
                  <label for="subject_group_id">科目グループ名：</label>
                  <select v-model="subject_group_id_SubSto" id="subject_group_id_SubSto" style="font-size:17px;">
                    <option disabled value=""></option>
                    <option v-for="subject_group in subject_groups"
                            v-bind:value="subject_group.id">
                        @{{ subject_group.subject_group_name }}
                    </option>
                  </select>
                </p>

                <p>
                  <label for="subject_name_SubSto">科目名：</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <input typt="text" name="subject_name_SubSto" id="subject_name_SubSto" value="" size="30" v-model="subject_name_SubSto">
                </p>

                <p>
                  <input type="submit" value="登録" v-on:click="onStoreSubject" id="register_subject">
                </p>
              </div>
        
          </div>
        </div>

        <!-- 科目リスト -->
        <div id="subjectList" v-bind:class="[isSubLstActive === true ? 'activeDiv' : 'inactiveDiv']" style="background: white; height: 500px; margin-left: 70px; margin-right: 20px; border-radius: 20px;">
          科目リスト
        </div>

        <!-- タイトル登録 -->
        <div id="registTitle" v-bind:class="[isRegTitActive === true ? 'activeDiv' : 'inactiveDiv']" style="background: white; height: 500px; margin-left: 70px; margin-right: 20px; border-radius: 20px;">
          <br>
          <h4>問題タイトル 登録</h4>

          <div class="card-body">
                <div style="text-align: left; padding-left: 20px;">

                  <p>
                    <label for="subject_group_id_TitSto">科目グループ名：</label>
                    
                    <select v-model="subject_group_id_TitSto" id="subject_group_id_TitSto" style="font-size:17px;">
                      <option disabled value=""></option>
                      <option v-for="subject_group in subject_groups"
                              v-bind:value="subject_group.id">
                          @{{ subject_group.subject_group_name }}
                      </option>
                    </select>
                  </p>

                  <!--
                  科目名：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  -->

                  <p>
                    <label for="subject_name_in_classify">科目名：</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <select v-model="subject_id_TitSto" id="subject_id_TitSto" style="font-size: 17px;">
                      <option disabled value="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>

                      <option v-for="subject in subjects_TitSto"
                              v-bind:value="subject.id">
                              @{{ subject.subject_name }}
                      </option>
                    </select>
                  </p>

                  <p>
                    <label for="title_name_TitSto">タイトル名：</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input typt="text" v-model="title_name_TitSto" name="title_name_TitSto" id="title_name_TitSto" value="" size="30">
                  </p>

                  <p>
                    <input type="submit" value="登録" v-on:click="onStoreTitle" id="register_title">
                  </p>

            </div>
          </div>
        </div>

        <!-- タイトルリスト -->
        <div id="titleList" v-bind:class="[isTitLstActive === true ? 'activeDiv' : 'inactiveDiv']" style="background: white; height: 500px; margin-left: 70px; margin-right: 20px; border-radius: 20px;">
          タイトルリスト

          <h4>問題タイトル</h4>
          科目名：
          <select id="subject_name">
            <option value="0"> </option>
          </select>
          <br><br>

          <table class="table table-striped task-table">
            <thead>
              <th>問題タイトル一覧</th>
            </thead>

            <tbody>
              <tr>
                <th>タイトルID</th>
                <th>問題タイトル名</th>
                <th></th>
                <th></th>
              </tr>
            </tbody>
          </table>

        </div>

        <!-- 分野登録 -->
        <div id="registField" v-bind:class="[isRegFldActive === true ? 'activeDiv' : 'inactiveDiv']" style="background: white; height: 500px; margin-left: 70px; margin-right: 20px; border-radius: 20px;">
          分野登録
        </div>

        <!-- 分野リスト -->
        <div id="fieldList" v-bind:class="[isFldLstActive === true ? 'activeDiv' : 'inactiveDiv']" style="background: white; height: 500px; margin-left: 70px; margin-right: 20px; border-radius: 20px;">
          分野リスト
        </div>

      </div>
    </div>

    <!-- 問題文・解説文登録領域 -->

    <div style="z-index: 5; width: 80%;" id="questionSentenceArea" v-bind:class="[isQesAreActive ? 'activeDiv' : 'inactiveDiv']">
      <br>
      <div class="row" style="margin-left: 30px; z-index: 5;">
        <div style="margin-right: 15px; border: solid 4px lightgray; font-size: 20px; width: 150px; text-align: center; border-top-left-radius: 10px; border-top-right-radius: 10px; z-index: 5;" v-on:click="onQuestionTab">
          問題文
        </div>
        <div style="margin-right: 15px; border: solid 4px lightgray; font-size: 20px; width: 150px; text-align: center; border-top-left-radius: 10px; border-top-right-radius: 10px; z-index: 5" v-on:click="onExplanationTab">
          解説文
        </div>
    
      </div>
      
        <div style="background: lightgray; text-align: center; padding-top: 10px; max-width: 100%; max-height: 1500px; margin-top: -3px; margin-left: -50px; border: solid 3px lightgray; border-radius: 15px; z-index: 5;">
          <div style="background: white; margin-left: 70px; margin-right: 20px; border-radius: 20px; z-index: 5;">
            <br>
    
            <div class="row" style="margin: 0 auto; font-size: 20px; z-index: 5;">
              <div style="width: 30%">
              </div>
              <div style="margin: 0 auto;">
                <div class="btn-choice">
                    登録
                </div>
              </div>
    
              <div style="margin: 0 auto;">
                <div class="btn-choice">
                  一覧表示
                </div>
    
              </div>
              <div style="width: 30%">
              </div>
            </div>
            <br>
    
          </div>
    
          <div style="z-index: 5;">
            <br>
          </div>
    
          <!-- 問題文登録 -->
          <div id="registQuestionSentence" v-bind:class="[isRegQesActive ? 'activeDiv' : 'inactiveDiv']" style="background: white; max-height: 1400px; margin-left: 70px; margin-right: 20px; border-radius: 20px; z-index: 5;">
            <br>
            <h4>問題文 登録</h4>
    
            <div class="card-body" style="margin-bottom: 10px;">
    
                <div style="text-align: left; padding-left: 20px; max-height: 900px;">
    
                  <!-- 大改修 問題文登録のための各項目を配置していく-->
                  <p>
                    科目グループ
                    <!-- <select> -->
                    <select v-model="subject_group_id">
                      <option disabled value="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
                      <option v-for="subject_group in subject_groups"
                              v-bind:value="subject_group.id">
                          @{{ subject_group.subject_group_name }}
                      </option>
                    </select>
                    &nbsp;&nbsp;&nbsp;

                    科目名
                    <select v-model="subject">
                      <option disabled value="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>

                      <option v-for="subject in subjects"
                              v-bind:value="subject.id">
                              @{{ subject.subject_name }}
                      </option>
                    </select>
                    &nbsp;&nbsp;&nbsp;

                    問題タイトル
                    <select v-model="title">
                      <option disabled value="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>

                      <option v-for="title in titles"
                              v-bind:value="title.title_id">
                              @{{ title.question_title }}
                    </select>
                    <br><br>

                    問題番号
                    <input type="text" v-model="question_number" size="3">
                    &nbsp;&nbsp;&nbsp;

                    選択肢の数
                    <select v-model="number_of_choice">
                      <option value="3">
                        ３
                      </option>
                      <option  value="4" selected="selected">
                        ４
                      </option>
                      <option value="5">
                        ５
                      </option>
                      <option value="6">
                        ６
                      </option>
                      <option value="7">
                        ７
                      </option>
                      <option value="8">
                        ８
                      </option>
                      <option value="9">
                        ９
                      </option>
                    </select>
                    &nbsp;&nbsp;&nbsp;

                    必須回答数
                    <select v-model="number_of_need_select">
                      <option value="0">
                        ０
                      </option>
                      <option value="1" selected="selected">
                        １
                      </option>
                      <option value="2">
                        ２
                      </option>
                      <option value="3">
                        ３
                      </option>
                      <option value="4">
                        ４
                      </option>
                      <option value="5">
                        ５
                      </option>
                    </select>
                    <br><br>

                    問題文
                    <textarea rows="3" cols="80" v-model="question_sentence" id="question_sentence">

                    </textarea>
                    <br><br>

                    図表の有無
                    <input type="radio" v-model="flag_graph_exists" name="falg_graph_exists" class="radio_hide" id="flag_0" value="0" checked="checked">
                    <label for="flag_0" class="btn-correct_answer" id="label_flag_0">無し</label>
                    &nbsp;
      
                    <input type="radio" v-model="flag_graph_exists" name="falg_graph_exists" class="radio_hide" id="flag_1" value="1">
                    <label for="flag_1" class="btn-correct_answer" id="label_flag_1">有り</label>
                    &nbsp;&nbsp;&nbsp;
      
                    <label class="image_item hide_item">画像</label>
                    <input type="file" name="image" class="image_item hide_item">

                    <hr>

                    <div id="choice1">
                      選択肢１
                      <textarea rows="2" cols="80" v-model="choiceSentence[1]">

                      </textarea>

                      <input type="checkbox" name="answer1" id="answer1" class="choice1 choice_hide" v-on:click="onCorrectAnswerButton">
                      <label for="answer1" class="btn-correct_answer choice1">正答</label>
                      <br>
                    </div>

                    <div id="choice2">
                      選択肢２
                      <textarea rows="2" cols="80" v-model="choiceSentence[2]">

                      </textarea>
                      <input type="checkbox" name="answer2" id="answer2" class="choice2 choice_hide" v-on:click="onCorrectAnswerButton">
                      <label for="answer2" class="btn-correct_answer choice2">正答</label>

                      <br>
                    </div>

                    <div id="choice3">
                      選択肢３
                      <textarea rows="2" cols="80" v-model="choiceSentence[3]">

                      </textarea>
                      <input type="checkbox" name="answer3" id="answer3" class="choice3 choice_hide" v-on:click="onCorrectAnswerButton">
                      <label for="answer3" class="btn-correct_answer choice3">正答</label>
                      <br>
                    </div>

                    <div id="choice4" v-bind:class="[isChoiceActive[4] === true ? 'activeDiv' : 'inactiveDiv']">
                      選択肢４
                      <textarea rows="2" cols="80" v-model="choiceSentence[4]">

                      </textarea>

                      <input type="checkbox" name="answer4" id="answer4" class="choice4 choice_hide" v-on:click="onCorrectAnswerButton">
                      <label for="answer4" class="btn-correct_answer choice4">正答</label>
                      <br>
                    </div>

                    <div id="choice5" v-bind:class="[isChoiceActive[5] === true ? 'activeDiv' : 'inactiveDiv']">
                      選択肢５
                      <textarea rows="2" cols="80" v-model="choiceSentence[5]">

                      </textarea>
                      <input type="checkbox" name="answer5" id="answer5" class="choice5 choice_hide" v-on:click="onCorrectAnswerButton">
                      <label for="answer5" class="btn-correct_answer choice5">正答</label>

                      <br>
                    </div>

                    <div id="choice6"  v-bind:class="[isChoiceActive[6] === true ? 'activeDiv' : 'inactiveDiv']">
                      選択肢６
                      <textarea rows="2" cols="80" v-model="choiceSentence[6]">

                      </textarea>

                      <input type="checkbox" name="answer6" id="answer6" class="choice6 choice_hide" v-on:click="onCorrectAnswerButton">
                      <label for="answer6" class="btn-correct_answer choice6">正答</label>
                      <br>
                    </div>

                    <div id="choice7"  v-bind:class="[isChoiceActive[7] === true ? 'activeDiv' : 'inactiveDiv']">
                      選択肢７
                      <textarea rows="2" cols="80" v-model="choiceSentence[7]">

                      </textarea>

                      <input type="checkbox" name="answer7" id="answer7" class="choice7 choice_hide" v-on:click="onCorrectAnswerButton">
                      <label for="answer7" class="btn-correct_answer choice7">正答</label>
                      <br>
                    </div>

                    <div id="choice8"  v-bind:class="[isChoiceActive[8] === true ? 'activeDiv' : 'inactiveDiv']">
                      選択肢８
                      <textarea rows="2" cols="80" v-model="choiceSentence[8]">

                      </textarea>

                      <input type="checkbox" name="answer8" id="answer8" class="choice8 choice_hide" v-on:click="onCorrectAnswerButton">
                      <label for="answer8" class="btn-correct_answer choice8">正答</label>
                      <br>
                    </div>

                    <div id="chcoice9"  v-bind:class="[isChoiceActive[9] === true ? 'activeDiv' : 'inactiveDiv']">
                      選択肢９
                      <textarea rows="2" cols="80" v-model="choiceSentence[9]">

                      </textarea>

                      <!--
                      <input type="checkbox" name="answer8" id="answer9" class="choice9">
                      <label for="answer9" class="btn-correct_answer choice9 choice_hide">正答</label>
                      -->

                      <input type="checkbox" name="answer9" id="answer9" class="choice9 choice_hide" v-on:click="onCorrectAnswerButton">
                      <label for="answer9" class="btn-correct_answer choice9">正答</label>
                      <br>
                    </div>

                  </p>
                  <p>
                    <input type="submit" value="登録" v-on:click="onRegisterQuestionSentence" id="register_question_sentence">
                  </p>
                </div>
          
            </div>
          </div>

    
        </div>
      </div>
      <br><br>
    

    <!-- 科目別集計参照領域 -->
    <div style="z-index: 5; width: 80%;" id="" v-bind:class="[isRefTotActive ? 'activeDiv' : 'inactiveDiv']">
      <br>

      

        <div style="background: lightgray; text-align: center; padding-top: 10px; max-width: 100%; max-height: 1500px; margin-top: -3px; margin-left: -50px; border: solid 3px lightgray; border-radius: 15px; z-index: 5;">
          <div style="background: white; margin-left: 70px; margin-right: 20px; border-radius: 20px; z-index: 5;">
            <br>

            <div>
              <!-- 科目グループ選択セレクトボックス -->
              科目グループ
              <!-- <select> -->
              <select v-model="subject_group_id_ref_data">
                <option disabled value="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
                <option v-for="subject_group in subject_groups"
                        v-bind:value="subject_group.id">
                    @{{ subject_group.subject_group_name }}
                </option>
              </select>
              &nbsp;&nbsp;&nbsp;

              <!-- 科目選択セレクトボックス -->
              科目名
              <select v-model="subject_ref_data">
                <option disabled value="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>

                <option v-for="subject in subjects"
                        v-bind:value="subject.id">
                        @{{ subject.subject_name }}
                </option>
              </select>
              &nbsp;&nbsp;&nbsp;

              <br><br>


              <!-- 科目別集計データ 表示領域 -->



              <!-- テーブル -->
            </div>
    
          </div>
    
          <div style="z-index: 5;">
            <br>
          </div>
    
          <!-- 問題文登録 -->
          <div id="registQuestionSentence" v-bind:class="[isRegQesActive ? 'activeDiv' : 'inactiveDiv']" style="background: white; max-height: 1400px; margin-left: 70px; margin-right: 20px; border-radius: 20px; z-index: 5;">
            <br>
            <h4>問題文 登録</h4>
    
            <div class="card-body" style="margin-bottom: 10px;">
    
                <div style="text-align: left; padding-left: 20px; max-height: 900px;">


                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

    
    </div>
    <br><br>




  </div>

{{-- 問題文・解説文管理領域 --}}

  </div>
  <br>

  <div class="listArea">
    <div class="innerList">

      <!-- TOP  -->


    </div>
  </div>

@endsection

@section('script')
  <script src="https://jp.vuejs.org/js/vue.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script>
    var app = new Vue({
      el: '#app',
      data: {

        /* 表示タブ制御 */
        tabNumber: 1,
        modeNumber: 1,

        isClsAreActive: true,
        isQesAreActive: false,
        isRegQesActive: false,
        isExpAreActive: false,
        isRefTotActive: false,

        //分類
        isRegSubGrpActive: true,
        isSubGrpLstActive: false,

        isRegSubActive: false,
        isSubLstActive: false,

        isRegTitActive: false,
        isTitLstActive: false,

        isRegFldActive: false,
        isFldLstActive: false,

        //問題文・解説文管理
        isRegQesActive: false,
        isRegComActive: false,

        // 選択肢文４～９表示フラグ
        isChoiceActive: [false, true, true, true, true, false, false, false, false, false],

        /* 問題分類管理 */
        /* 科目グループ登録 */
        subject_group_id_SubGrpSto:   "",         // 科目グループID（科目グループ登録）
        subject_group_name_SubGrpSto: "",         // 科目グループ名（科目グループ登録）

        /* 科目登録 */
        subject_group_id_SubSto:      "",         // 科目グループID（科目登録）
        subject_group_name_SubSto:    "",         // 科目グループ名（科目登録）
        subject_name_SubSto:          "",         // 科目名（科目登録）
        subjects_SubSto:              "",         // 科目配列（科目登録）

        /* タイトル登録 */
        subject_group_id_TitSto:      "",         // 科目グループID（タイトル登録）
        subject_id_TitSto:            "",         // 科目ID（タイトル登録）
        subject_name_TitSto:          "",         // 科目名（タイトル登録）
        subjects_TitSto:              "",         // 科目配列（タイトル登録）
        title_name_TitSto:            "",         // タイトル名（タイトル登録）
        title_names_TitSto:           "",         // タイトル名配列（タイトル登録）

        /* 削除候補 */
        subject_name_in_classify: "",

        // 科目グループ名
        subject_group_name: "",

        // 科目グループID
        subject_group_id: "",

        // 科目名
        subject_name: "",



        /* 問題文登録 */
        // 科目グループ
        subject_group: "",

        // 科目グループID
        subject_group_id: 0,

        // 科目
        subject: "",

        // タイトル
        title: "",

        // 問題番号
        question_number: "",

        // 選択肢の数
        number_of_choice: 4,

        // 必須回答数
        number_of_need_select: 1,

        // 正答の数
        number_of_answer: 0,

        // 入力された問題文
        question_sentence: "",

        // 図表有無
        flag_graph_exists: 0,

        // 選択肢
        choiceSentence: ["","","","","","","","","",""],

        // 選択肢１ ここは削除するかもしれない
        choice_sentence1: "",

        // 選択肢２
        choice_sentence2: "",

        // 選択肢３
        choice_sentence3: "",
        
        // 選択肢４
        choice_sentence4: "",

        // 選択肢５
        choice_sentence5: "",

        // 選択肢６
        choice_sentence6: "",        

        // 選択肢７
        choice_sentence7: "",

        // 選択肢８
        choice_sentence8: "",

        // 選択肢９
        choice_sentence9: "",

        // 正答１～５
        answerSentence: ["", "", "", "", ""],

        //科目グループ名一覧 配列
        subject_groups: [],

        //科目名一覧 配列
        subjects: [],

        //タイトル一覧 配列
        titles: [],


        /* 科目別集計参照 */
        // 科目グループID
        subject_group_id_ref_data: [],

        // 科目ID
        subject_ref_data: [],

      },

      /////////////////////////
      // ライフサイクルハック
      /////////////////////////
      created: function() {

        // JSON の URL(サーバーに配置する)
        var url = process.env.MIX_DM_HOST . "/kokushi/management/api/get_subject_groups";         // Laravel側で、被アクセス時にデータを返すように設定する。
        //var url = "https://lara-assist.jp/kokushi/management/api/get_subject_groups";         // Laravel側で、被アクセス時にデータを返すように設定する。
        //var url = "http://localhost:8080/kokushi/management/api/get_subject_groups";         // Laravel側で、被アクセス時にデータを返すように設定する。

        // 科目グループ名、科目名、問題タイトル

        // 非同期通信でJSONP を読込む
        $.ajax({
          url : url,
          type: 'GET',
          dataType: 'json',
          //jsonp: 'callback',
        })
        .done(function(data, textStatus, jqXHR) {
          this.subject_groups = data;
        }.bind(this))
        .fail(function(jqXHR, textStatus, errorThrown) {
          console.log('通信が失敗しました');
          console.log('jqXHR: ' + jqXHR);
          console.log('jqXHR[0]: ' + jqXHR[0]);
          console.log('jqXHR[1]: ' + jqXHR[1]);
          console.log('textStatus: ' + textStatus);
          console.log('errorThrown: ' + errorThrown);
        });

      },

      methods: {
        //////////////////////////////////////////////////
        // 問題分類管理タブのクリックイベントハンドラ
        //////////////////////////////////////////////////
        onClassificationManagement: function() {
          console.log('問題分類管理タブ 押下');

          //表示・非表示変更
          //フラグ一覧と真偽設定
          this.isClsAreActive = true;
          this.isQesAreActive = false;
          this.isRegQesActive = false;
          this.isExpAreActive = false;
          this.isRefTotActive = false;

          this.isRegSubGrpActive = true;      // 科目グループ登録エリア 有効化
          this.isSubGrpLstActive = false;

          console.log('科目グループ登録アクティブフラグ：' + this.isRegSubGrpActive);

          this.isRegSubActive     = false;
          this.isSubLstActive     = false;

          this.isRegTitActive     = false;
          this.isTitLstActive     = false;

          this.isRegFldActive     = false;
          this.isFldLstActive     = false;
        },

        //////////////////////////////////////////////////
        // 問題文・解説文管理タブのクリックイベントハンドラ
        //////////////////////////////////////////////////
        onQuestionSentenceManagement: function() {
          console.log('問題文・解説文管理タブ 押下');

          //表示・非表示変更
          //フラグ一覧と真偽設定
          this.isClsAreActive = false;
          this.isQesAreActive = true;
          this.isRegQesActive = true;
          this.isExpAreActive = false;
          this.isRefTotActive = false;

          this.isRegSubGrpActive = false;
          this.isSubGrpLstActive = false;

          this.isRegSubActive     = false;
          this.isSubLstActive     = false;

          this.isRegTitActive     = false;
          this.isTitLstActive     = false;

          this.isRegFldActive     = false;
          this.isFldLstActive     = false;
        },

        //////////////////////////////////////////////////
        // 科目別集計参照タブのクリックイベントハンドラ
        //////////////////////////////////////////////////
        onReferTotalData: function() {
          console.log('科目別集計参照タブ 押下');

          //表示・非表示変更
          //フラグ一覧と真偽設定
          this.isClsAreActive = false;
          this.isQesAreActive = false;
          this.isRegQesActive = false;
          this.isExpAreActive = false;
          this.isRefTotActive = true;

          this.isRegSubGrpActive = false;
          this.isSubGrpLstActive = false;

          this.isRegSubActive     = false;
          this.isSubLstActive     = false;

          this.isRegTitActive     = false;
          this.isTitLstActive     = false;

          this.isRegFldActive     = false;
          this.isFldLstActive     = false;
        },

        


        /////////////////////////////////////////////
        // 科目グループタブのクリックイベントハンドラ
        /////////////////////////////////////////////
        onSubjectGroupTab: function() {
          console.log('科目グループタブ 押下');

          // inactiveクラスを科目コンテンツ、タイトルコンテンツ、分野コンテンツに設定する
          // activeクラスを科目グループコンテンツへ設定する

          // 登録と一覧表示の、どっちが押下されているかによって、アクティブにするコンテンツが変わるため、条件分岐が必要
          this.isClsAreActive = true;
          this.isQesAreActive = false;
          this.isRegQesActive = false;
          this.isExpAreActive = false;

          this.isRegSubGrpActive = true;      // 科目グループ登録エリア 有効化
          this.isSubGrpLstActive = false;

          console.log('科目グループ登録アクティブフラグ：' + this.isRegSubGrpActive);

          this.isRegSubActive     = false;
          this.isSubLstActive     = false;

          this.isRegTitActive     = false;
          this.isTitLstActive     = false;

          this.isRegFldActive     = false;
          this.isFldLstActive     = false;

        },

        ////////////////////////////////////////
        // 科目タブのクリックイベントハンドラ
        ////////////////////////////////////////
        onSubjectTab: function() {
          console.log('科目タブ 押下');

          this.isClsAreActive = true;
          this.isQesAreActive = false;
          this.isRegQesActive = false;
          this.isExpAreActive = false;

          this.isRegSubGrpActive = false;
          this.isSubGrpLstActive = false;

          this.isRegSubActive     = true;     // 科目登録エリア 有効化
          this.isSubLstActive     = false;

          this.isRegTitActive     = false;
          this.isTitLstActive     = false;

          this.isRegFldActive     = false;
          this.isFldLstActive     = false;
        },

        ////////////////////////////////////////
        // タイトルタブのクリックイベントハンドラ
        ////////////////////////////////////////
        onTitleTab: function() {
          console.log('タイトルタブ 押下');

          this.isClsAreActive = true;
          this.isQesAreActive = false;
          this.isRegQesActive = false;
          this.isExpAreActive = false;

          this.isRegSubGrpActive = false;
          this.isSubGrpLstActive = false;

          this.isRegSubActive     = false;
          this.isSubLstActive     = false;

          this.isRegTitActive     = true;     // タイトル登録エリア 有効化
          this.isTitLstActive     = false;

          this.isRegFldActive     = false;
          this.isFldLstActive     = false;
        },

        ////////////////////////////////////////
        // 分野タブのクリックイベントハンドラ
        ////////////////////////////////////////
        onFieldTab: function() {
          console.log('分野タブ 押下');

          this.isClsAreActive = true;
          this.isQesAreActive = false;
          this.isRegQesActive = false;
          this.isExpAreActive = false;

          this.isRegSubGrpActive = false;
          this.isSubGrpLstActive = false;

          this.isRegSubActive     = false;
          this.isSubLstActive     = false;

          this.isRegTitActive     = true;
          this.isTitLstActive     = false;

          this.isRegFldActive     = false;    // 分野登録エリア 有効化
          this.isFldLstActive     = false;
        },

        ////////////////////////////////////////
        // 問題文タブのクリックイベントハンドラ
        ////////////////////////////////////////
        onQuestionTab: function() {
          console.log('問題文タブ 押下');

          this.isClsAreActive = false;
          this.isQesAreActive = true;
          this.isRegQesActive = true;
          this.isExpAreActive = false;

          this.isRegSubGrpActive = false;
          this.isSubGrpLstActive = false;

          this.isRegSubActive     = false;
          this.isSubLstActive     = false;

          this.isRegTitActive     = false;
          this.isTitLstActive     = false;

          this.isRegFldActive     = false;
          this.isFldLstActive     = false;
        },

        ////////////////////////////////////////
        // 解説文タブのクリックイベントハンドラ
        ////////////////////////////////////////
        onExplanationTab: function() {
          console.log('解説文タブ 押下');

          this.isClsAreActive = false;
          this.isQesAreActive = false;
          this.isRegQesActive = false;
          this.isExpAreActive = true;

          this.isRegSubGrpActive = false;
          this.isSubGrpLstActive = false;

          this.isRegSubActive     = false;
          this.isSubLstActive     = false;

          this.isRegTitActive     = false;
          this.isTitLstActive     = false;

          this.isRegFldActive     = false;
          this.isFldLstActive     = false;
        },

        //********************
        //
        //  ボタン押下時の処理
        //
        //********************

        //科目グループ登録
        onStoreSubjectGroup: function() {
          console.log('科目グループ登録ボタン 押下')

          console.log('this.subject_name: ' + this.subject_name);
        },

        // 科目登録
        onStoreSubject: function() {
          console.log('科目登録ボタン 押下')

          console.log('this.subject_group_id: ' + this.subject_group_id);
          console.log('this.subject_name: ' + this.subject_name);

          var flag_button_disabled = 0;

          $('#system_message').removeClass("alert alert-danger alert-success");
          $('#system_message').html("");

          // 科目登録ボタン 非活性化
          $("#register_subject").prop('disabled', true);

          // 科目グループ 判定
          if(this.subject_group_id === 0){

            // 未選択
            $('#system_message').addClass("alert alert-danger");
            $('#system_message').html("科目グループ名が選択されていません。");

          } else {

            // 科目名 入力判定
            if(this.subject_name_in_classify === ""){

              // 科目名 未入力
              $('#system_message').addClass("alert alert-danger");
              $('#system_message').html("科目名が入力されていません。");

            } else {

              // 科目名テーブル 読込み
              var url = process.env.MIX_DM_HOST . "/kokushi/management/api/get_subjects/0";    // 本番用
              //var url = "https://lara-assist.jp/kokushi/management/api/get_subjects/0";    // 本番用
              //var url = "http://localhost:8080/kokushi/management/api/get_subjects/1";      // ローカル環境テスト用

              let params = new URLSearchParams();
              //params.append ('subject_group_id', this.subject_group),

              axios.get(url, params).then(res => {
                console.log('axiosの戻り値：' + res.data);

                // axios 終了コード 判定
                if(res.data[0] === 0){

                  // 科目テーブル読込 正常終了
                  // 取得した科目名を格納
                  this.subjects = res.data[1];

                  console.log('this.subjects: ' + this.subjects);
                  console.log('this.subjects.length: ' + this.subjects.length);

                  // 科目名 重複チェック
                  // subjects は、単純な科目名の配列ではないと思う。連想配列
                  for(let work_subject of this.subjects){

                    console.log('work_subject: ' + work_subject);
                    //console.log('work_subject.length: ' + work_subject.length);

                    if(this.subject_name_in_classify == work_subject.subject_name){
                      console.log('科目名 重複あり');

                      // 登録せずに終了
                      // アラート表示
                      $('#system_message').addClass("alert alert-danger");
                      $('#system_message').html("同じ科目名がすでに登録されています。");

                      // タイトル名が１件でも重複している場合にフラグを立てる。
                      flag_exist_duplication = 1;

                    }
                  }

                  // タイトル名登録 判定
                  if(flag_exist_duplication == 0){

                    // 問題タイトルテーブル 登録処理
                    console.log('問題タイトルテーブル登録 処理');

                    var url = process.env.MIX_DM_HOST . "/kokushi/management/api/get_subjects/0";    // 本番用
                    //var url = "https://lara-assist.jp/kokushi/management/api/get_subjects/0";    // 本番用
                    //var url = "http://localhost:8080/kokushi/management/api/store_subjects";      // ローカル環境テスト用

                    let params = new URLSearchParams();
                    params.append ('subject_group_id', this.subject_group),     // 科目グループID
                    params.append ('subject_name', this.subject_name),          // 科目名

                    axios.post(url, params).then(res => {
                      console.log('axiosの戻り値：' + res.data);

                      // axios 終了コード 判定
                      if(res.data[0] === 0){

                        // 問題タイトルテーブル登録 正常終了
                        // タイトル名 初期化
                        this.title_name_TitSto = "";

                        // 登録ボタン 活性化
                        // アラート表示
                        $('#system_message').addClass("alert alert-success");
                        $('#system_message').html("タイトル名を登録しました。");

                        // 登録ボタン 非活性化
                        $("#register_question_sentence").prop('disabled', false);

                      }
                    });

                  } else {

                    // 科目登録に不備あり
                    console.log('科目テーブル登録 中止');
                  }
                }
              });
            }
          }
        },


        // タイトル登録ボタン 押下時処理
        onStoreTitle: function() {

          console.log('タイトル登録ボタン 押下')

          console.log('this.subject_group_id_TitSto: ' + this.subject_group_id_TitSto);
          console.log('this.title_name_TitSto: ' + this.title_name_TitSto);

          var flag_button_disabled = 0;

          $('#system_message').removeClass("alert alert-danger alert-success");
          $('#system_message').html("");

          // タイトル登録ボタン 非活性化
          $("#register_title").prop('disabled', true);

          // 科目選択 判定
          if(this.subject_id_TitSto === 0){

            // 未選択
            $('#system_message').addClass("alert alert-danger");
            $('#system_message').html("科目名が選択されていません。");

            // 登録ボタン 活性化
            $("#register_title").prop('disabled', false);

          } else {

            // タイトル入力 判定
            if(this.title_name_TitSto == ""){
              // 未入力
              $('#system_message').addClass("alert alert-danger");
              $('#system_message').html("タイトル名が選択されていません。");

              // 登録ボタン 活性化
              $("#register_title").prop('disabled', false);

            } else {

              console.log('タイトル名 重複チェック');

              // タイトル名 重複チェック

              // タイトル一覧を取得するためのURLを設定
              
              var url = process.env.MIX_DM_HOST . "/kokushi/management/api/get_titles/" + this.subject_id_TitSto;    // 本番用
              //var url = "https://lara-assist.jp/kokushi/management/api/get_titles/" + this.subject_id_TitSto;    // 本番用
              //var url = "http://localhost:8080/kokushi/management/api/get_titles/" + this.subject_id_TitSto;      // ローカル環境テスト用

              let params = new URLSearchParams();

              /* axios */
              axios.get(url, params).then(res => {
                console.log('axiosの戻り値：' + res.data);

                // axios 終了コード 判定
                if(res.data[0] === 0){

                  // この変数はまだ定義していない
                  this.title_names_TitSto = JSON.parse(res.data[1]);

                  // タイトル名 重複チェック
                  for(let work_title_name of this.title_names_TitSto){

                    console.log('work_title_name: ' + work_title_name.question_title);

                    if(this.title_name_TitSto == work_title_name.question_title){
                      console.log('タイトル名 重複あり');

                      // 登録せずに終了
                      // アラート表示
                      $('#system_message').addClass("alert alert-danger");
                      $('#system_message').html("同じタイトル名がすでに登録されています。");

                      // 登録ボタン 活性化
                      $("#register_title").prop('disabled', false);

                      flag_button_disabled = 1;

                    } else {

                      // タイトル名 重複無し
                      //console.log('タイトル名 重複なし');

                    }
                  }

                  // タイトル名登録 判定
                  if(flag_button_disabled == 0){

                    console.log('タイトル登録 レコード挿入処理');

                    // Axios 科目ID・タイトル名をAPIへ投げてレコード登録
                    
                    var url = process.env.MIX_DM_HOST . "/kokushi/management/api/store_title";    // 本番用
                    //var url = "https://lara-assist.jp/kokushi/management/api/store_title";    // 本番用
                    //var url = "http://localhost:8080/kokushi/management/api/store_title/";      // ローカル環境テスト用

                    let params = new URLSearchParams();

                    params.append ('subject_id', this.subject_id_TitSto),          // 科目名
                    params.append ('title_name', this.title_name_TitSto),          // タイトル名

                    /* axios */
                    axios.post(url, params).then(res => {
                      console.log('axiosの戻り値：' + res.data);

                      // axios 終了コード 判定
                      if(res.data[0] === 0){

                        // 正常登録
                        // アラート削除
                        $('#system_message').addClass("alert alert-success");
                        $('#system_message').html("タイトル名を登録しました。");

                        // 登録ボタン 活性化
                        $("#register_title").prop('disabled', false);

                      } else {

                        // 異常終了
                        console.log('タイトル名登録 異常終了');

                        // 登録ボタン 活性化
                        // アラート表示
                        $('#system_message').addClass("alert alert-danger");
                        $('#system_message').html("タイトル名登録 異常終了");

                        // 登録ボタン 活性化
                        $("#register_title").prop('disabled', false);
                      }
                    });

                  } else {

                    // タイトル登録に不備あり
                    console.log('タイトルテーブル登録 中止');
                  }

                  
                } else {

                  // タイトル一覧取得 異常終了
                  // アラート表示
                  $('#system_message').addClass("alert alert-danger");
                  $('#system_message').html("タイトル一覧取得 異常終了");

                  // 登録ボタン 活性化
                  $("#register_title").prop('disabled', false);
                }
              });
            }
          }
        },

        //**************************************************
        //  問題分類管理 修正系
        //**************************************************

        // 科目グループ修正ボタン 押下時処理
        onModifySubjectGroup: function() {

          // 
          console.log('科目グループ修正ボタン 押下時処理 開始');
        },

        //////////////////////////////
        //  正答ボタン押下時 処理
        //////////////////////////////
        onCorrectAnswerButton: function() {

          console.log('正答ボタン 押下');

          

          // 押下されている正答ボタンの数
          var number_of_pushed = 0;

          // 押下されている正答ボタンの数を算出
          for(i=0;i<this.number_of_choice; i++){

            var iPlus1 = i + 1;

            // ID名 編集
            var idName = "#answer" + iPlus1;

            // チェック済 判定
            if($(idName).prop("checked")){

              number_of_pushed++;

            }

          }

          // Vue変数へ反映
          this.number_of_answer = number_of_pushed;

          //console.log('押下済み正答ボタン数： ' + this.number_of_answer);

        },


        //////////////////////////////
        //  問題文登録ボタン押下時 処理
        //////////////////////////////
        onRegisterQuestionSentence: function() {

          console.log('問題文登録処理 開始');

          // アラート削除
          $('#system_message').removeClass("alert alert-success");
          $('#system_message').html("");

          // 登録ボタン 非活性化
          $("#register_question_sentence").prop('disabled', true);

          var message = "";
          var json_data = [];

          var work_choiceSentence = [];         // 選択肢文 編集用
          var work_answerSentence = [];         // 正答文 編集用

          // 入力項目チェック
          // 科目グループ

          // 科目
          if(this.subject === ""){
            message += "科目名が選択されていません。\n";
          }

          // タイトル
          if(this.title === ""){
            message += "問題タイトルが選択されていません。\n";
          }

          // 問題番号
          if(this.question_number === ""){
            message += "問題番号が入力されていません。\n";
          }

          // 選択肢の数

          // 必須回答数
          
          // 問題文
          if(this.question_sentence === ""){
            message += "問題文が入力されていません。";
          }

          // 選択肢１～９
          // 選択肢の数の影響を受けるため、いったん保留

          // 正答ボタン押下数０判定
          /*
          if(){

          }
          */

          // エラーメッセージ 有無判定
          if(message === ""){

            console.log('問題文レコード 登録処理 開始');

            // ajax通信
            // 問題文テーブルへレコードを書き込む。
            
            var url = process.env.MIX_DM_HOST . "/kokushi/management/api/store_question_sentence";    // 本番用
            //var url = "https://lara-assist.jp/kokushi/management/api/store_question_sentence";    // 本番用
            //var url = "http://localhost:8080/kokushi/management/api/store_question_sentence";      // ローカル環境テスト用

            json_data['subject_id']             = this.subject;                    // 科目ID
            json_data['title_id']               = this.title;                      // タイトルID
            json_data['question_number']        = this.question_number;            // 問題番号
            json_data['number_of_choice']       = this.number_of_choice;           // 選択肢の数
            json_data['number_of_need_select']  = this.number_of_need_select;      // 必須回答数
            json_data['number_of_answer']       = this.number_of_answer;           // 正答の数
            json_data['question_sentence']      = this.question_sentence;          // 問題文
            json_data['flag_graph_exists']      = this.flag_graph_exists;          // 図表の有無
/*
            json_data[0] = this.subject;                    // 科目ID
            json_data[1] = this.title;                      // タイトルID
            json_data[2] = this.question_number;            // 問題番号
            json_data[3] = this.number_of_choice;           // 選択肢の数
            json_data[4] = this.number_of_need_select;      // 必須回答数
            json_data[5] = this.number_of_answer;           // 正答の数
            json_data[6] = this.question_sentence;          // 問題文
            json_data[7] = this.flag_graph_exists;          // 図表の有無
*/
            // 選択肢１～９
            // 選択肢の数だけ繰り返す
            for(var i = 0; i < this.number_of_choice; i++){
              var idNumber = i + 1;
              work_choiceSentence[i] = this.choiceSentence[idNumber];              
            }

            json_data['array_choice_sentence'] = work_choiceSentence;             // 選択肢文配列
//            json_data[8] = work_choiceSentence;             // 選択肢文配列

            // 正答の数 算出する必要がある。登録ボタン押下時ではなく、正答ボタン押下時に変更するようにするか？

            var numOfAns = 0;

            // 正答１～５
            for(var i = 0; i < this.number_of_choice; i++){

              var iPlus1 = i + 1;
              var idName = "#answer" + iPlus1;

              if($(idName).prop("checked")){
                work_answerSentence[numOfAns] = iPlus1;
                numOfAns++;
              }

            }

            json_data['array_answer_sentence'] = work_answerSentence;             // 正答文配列
//            json_data[9] = work_answerSentence;             // 正答文配列


            // アクセスURL テスト
            console.log('url: ' + url);

            // json_data 
            console.log('json_data["subject_id"]:' + json_data['subject_id']);

            console.log('json_data: ' + json_data);

            for (var key in json_data){
              console.log("json_data[" + key + "]: " + json_data[key]);
            }
            //
            //json_data = JSON_stringify(json_data);

            //var jd = JSON.stringify(json_data);

            //console.log('jd: ' + jd);

            let params = new URLSearchParams();
            params.append ('subject_id', this.subject),
            params.append ('title_id', this.title),
            params.append ('question_number', this.question_number),

            params.append ('number_of_choice', this.number_of_choice),
            params.append ('number_of_need_select', this.number_of_need_select),
            params.append ('number_of_answer', this.number_of_answer),

            params.append ('question_sentence', this.question_sentence),
            params.append ('flag_graph_exists', this.flag_graph_exists),

            params.append ('array_choice_sentence', work_choiceSentence),
            params.append ('array_answer_sentence', work_answerSentence),

            axios.post(url, params).then(res => {
//            axios.post(url, json_data).then(res => {
              console.log('axiosの戻り値：' + res.data);

              // axios 終了コード 判定
              if(res.data[0] === 0){

                // 正常終了
                $('#system_message').addClass("alert alert-success");
                $('#system_message').html("登録できました。");

                // 問題番号 加算
                this.question_number = Number(this.question_number) + 1;

                // 初期化
                //this.number_of_choice = 4;    // 選択肢の数
                this.number_of_need_select  = 1;  // 必須回答数

                // 正答ボタン 初期化
                for(var i=1; i<10; i++){

                  let idName = "#answer" + i;
                  $(idName).prop("checked", false);
                }


                //

              } else {

                // 異常終了

              }

            });

          } else {

            // 入力エラー有り。メッセージをアラートとして表示させる。
            alert(message);

          }

        },

        ////////////////////
        // 科目一覧 取得処理
        ////////////////////
        getSubjects: async function(subject_group_id) {

          // axios
          
          var url = process.env.MIX_DM_HOST . "/kokushi/management/api/get_subjects" + subject_group_id;    // 本番用
          //var url = "https://lara-assist.jp/kokushi/management/api/get_subjects" + subject_group_id;    // 本番用
          //var url = "http://localhost:8080/kokushi/management/api/get_subjects/" + subject_group_id;    // ローカル環境テスト用

          let params = new URLSearchParams();

          /* axios */
          var x = await axios.get(url, params).then(res => {
            console.log('axiosの戻り値：' + res.data);

            // axios 終了コード 判定
            if(res.data[0] === 0){

              // この関数は２か所から呼ばれる。 タイトル登録の変数を指定するのはおかしい。
              // 最終的には科目リストをreturn してあげれば良い。

              console.log('res.data[1]: ' + res.data[1]);

              return res.data[1];

/*
              // ここのロジックは、科目名を登録する際に使用する。
              // タイトル名 重複チェック
              for(let work_subject_name of this.subjects_TitSto){

                console.log('work_subject_name: ' + work_subject_name);

                // 科目名 重複判定 
                if(this.subject_name_TitSto == work_subject_name.subject_name){
                  console.log('科目名 重複あり');

                  // 登録せずに終了
                  // アラート表示
                  $('#system_message').addClass("alert alert-danger");
                  $('#system_message').html("同じ科目名がすでに登録されています。");

                  var flag_button_disabled = 1;

                }

              }

              // 科目登録 判定
              if(flag_button_disabled == 0){

                // 科目テーブル登録処理
                console.log('科目テーブル登録処理');

                //var url = "https://lara-assist.jp/kokushi/management/api/store_subjects/0";    // 本番用
                var url = "http://localhost:8080/kokushi/management/api/store_subject";      // ローカル環境テスト用

                let params = new URLSearchParams();
                params.append ('subject_group_id', this.subject_group),     // 科目グループID
                params.append ('subject_name', this.subject_name),          // 科目名

                axios.post(url, params).then(res => {
                  console.log('axiosの戻り値：' + res.data);

                  // axios 終了コード 判定
                  if(res.data[0] === 0){

                    // 科目テーブル登録 正常終了
                    // 科目名 初期化
                    this.subject_name = "";

                    // 登録ボタン 活性化
                    // アラート削除
                    $('#system_message').addClass("alert alert-success");
                    $('#system_message').html("登録しました。");

                    // 登録ボタン 非活性化
                    $("#register_question_sentence").prop('disabled', false);

                  }
                });


              } else {

                // タイトル登録に不備あり
                console.log('タイトルテーブル登録 中止');
              }
*/
            } else {

              // 科目リスト取得 異常終了
              console.log('科目リスト取得 異常終了');

              // アラート表示
              $('#system_message').addClass("alert alert-danger");
              $('#system_message').html("科目リスト取得処理 異常終了");

              // 登録ボタン 非活性化
              $("#register_question_sentence").prop('disabled', false);

            }
          });

          return x;

        },

        ////////////////////
        // 問題文 取得処理
        ////////////////////
        getQuestionSentence: function() {

          // 科目・タイトル・問題番号をもとに、問題文を取得する。
          // 問題文が取得出来た場合は、二重登録を防ぐために登録ボタン・テキストエリアを非活性化する。
        
          // 問題文テーブルを読込み、該当するレコードの問題文を取得する。
          
          var url = process.env.MIX_DM_HOST . "/kokushi/management/api/get_question_sentence/"    // 本番用
                        + this.subject
                  + "/" + this.title
                  + "/" + this.question_number;
          //var url = "https://lara-assist.jp/kokushi/management/api/get_subject_groups";    // 本番用
/*
          //var url = "http://localhost:8080/kokushi/management/api/get_question_sentence/"    // ローカル環境テスト用
                        + this.subject
                  + "/" + this.title
                  + "/" + this.question_number;
*/

          // 非同期通信
          $.ajax({
            url : url,
            type: 'GET',
            dataType: 'json',
  
          })
          .done(function(data, textStatus, jqXHR) {
  
            console.log('問題文取得 テスト 値：' + data);
  
            // 戻り値 取得
            var work_question_sentence = data;
  
            // vue変数へ設定
            this.question_sentence = data;
  
            // 科目・タイトル・問題番号が一致するレコードが存在する場合、
            // ・テキストエリア（問題文）を非活性化
            // ・登録ボタンを非活性化
            // ・アラート表示
  
            // 問題文 存在チェック
            if(this.question_sentence === null){
  
              // テキストエリア（問題文） 活性化
              $("#question_sentence").prop('disabled', false);

              // 選択肢１～９ 初期化
              for(i=0; i<10; i++){
                iPlus1 = i + 1;
                this.choiceSentence[iPlus1] = "";
              }

              // 正答１～５ 初期化
              for(i=0; i<6; i++){
                iPlus1 = i + 1;
                this.answerSentence[iPlus1] = "";
              }

              // 登録ボタン 活性化
              $("#register_question_sentence").prop('disabled', false);
  
            } else {
  
              // テキストエリア（問題文） 非活性化
              $("#question_sentence").prop('disabled', true);
  
              // 登録ボタン 活性化
              $("#register_question_sentence").prop('disabled', true);
  
            }
    
          }.bind(this))
          .fail(function(jqXHR, textStatus, errorThrown) {
            console.log('通信が失敗しました');
            console.log('jqXHR: ' + jqXHR);
            console.log('jqXHR[0]: ' + jqXHR[0]);
            console.log('jqXHR[1]: ' + jqXHR[1]);
            console.log('textStatus: ' + textStatus);
            console.log('errorThrown: ' + errorThrown);
          });

          // もし余裕があれば、選択肢テーブル・正答テーブル読込を行い、画面へ表示させる。
          // 当面、問題文が登録されている事が確認できれば問題ないので、このままにしておく。

        },
      },

      watch: {
        /* 科目登録 科目グループID 変更時処理 */
        subject_group_id_SubSto: function(newSubjectGroupId, oldSubjectGroupId){

          console.log('科目グループID 変更時処理');
          this.subjects_SubSto = this.getSubjects(newSubjectGroupId);

        },

        /* タイトル登録 科目グループID 変更時処理 */
        subject_group_id_TitSto: async function(newSubjectGroupId, oldSubjectGroupId){

          console.log('タイトル登録 科目グループID 変更時処理');

          // タイトル登録画面用の科目リストへ格納
          this.subjects_TitSto = await this.getSubjects(newSubjectGroupId);

          console.log('this.subjects_TitSto: ' + this.subjects_TitSto);
        },

        /* タイトル登録 科目変更時処理 まるまる登録処理へ移動させる */
        subject_id_TitSto: function(newSubjectId, oldSubjectId){

          console.log('タイトル登録 科目変更時処理 開始');

          // 現状、処理は無い

        },

        // 科目グループが変化したとき呼び出されるハンドラ
        subject_group_id: function(newSubjectGroup, oldSubjectGroup) {

          this.subject_group = newSubjectGroup;

          console.log('科目グループ 変化。ウォッチャー');
          if (newSubjectGroup !== oldSubjectGroup) {

            // ajaxを呼出し、科目グループに対応する科目を取得する。
            // 変更のたびにサーバーアクセスするのは非効率だが、その仕組みを未検討
            
            var url = process.env.MIX_DM_HOST . "/kokushi/management/api/get_subjects/" + newSubjectGroup;    // 
            //var url = "https://lara-assist.jp/kokushi/management/api/get_subject_groups";                  // Laravel側で、被アクセス時にデータを返すように設定する。
            //var url = "http://localhost:8080/kokushi/management/api/get_subjects/" + newSubjectGroup;    // Laravel側で、被アクセス時にデータを返すように設定する。

            console.log('urlテスト：' + url);

            // 科目グループ名、科目名、問題タイトル

            // 非同期通信でJSONP を読込む
            $.ajax({
              url : url,
              type: 'GET',
              dataType: 'json',
              //jsonp: 'callback',
            })
            .done(function(data, textStatus, jqXHR) {
              this.subjects = data[1];
            }.bind(this))
            .fail(function(jqXHR, textStatus, errorThrown) {
              console.log('通信が失敗しました');
              console.log('jqXHR: ' + jqXHR);
              console.log('jqXHR[0]: ' + jqXHR[0]);
              console.log('jqXHR[1]: ' + jqXHR[1]);
              console.log('textStatus: ' + textStatus);
              console.log('errorThrown: ' + errorThrown);
            });

            // 科目名 初期化
            this.subject = "";

            // 問題タイトル 初期化
            this.title = "";

          }
        },

        //科目が変化したとき呼び出されるハンドラ
        subject: function(newSubject, oldSubject) {

          console.log('タイトル読込中での科目グループチェック：' + this.subject_group);

          this.subject = newSubject;

          //問題タイトル読込
          
          var url = process.env.MIX_DM_HOST . "/kokushi/management/api/get_titles/" + newSubject;    //
          //var url = "https://lara-assist.jp/kokushi/management/api/get_subject_groups";                  // Laravel側で、被アクセス時にデータを返すように設定する。
          //var url = "http://localhost:8080/kokushi/management/api/get_titles/" + newSubject;    // Laravel側で、被アクセス時にデータを返すように設定する。

          // 非同期通信
          $.ajax({
            url : url,
            type: 'GET',
            dataType: 'json',
            //jsonp: 'callback',
          })
          .done(function(data, textStatus, jqXHR) {
            if(data[0] == 0){

              // タイトルリスト 保存
              this.titles = JSON.parse(data[1]);

              console.log('ajaxテスト(titles)：' + this.titles);
            }


          }.bind(this))
          .fail(function(jqXHR, textStatus, errorThrown) {
            console.log('通信が失敗しました');
            console.log('jqXHR: ' + jqXHR);
            console.log('jqXHR[0]: ' + jqXHR[0]);
            console.log('jqXHR[1]: ' + jqXHR[1]);
            console.log('textStatus: ' + textStatus);
            console.log('errorThrown: ' + errorThrown);
          });

          // 問題タイトル 初期化
          this.title = "";

          // 問題文 取得判定
          if(     this.subject          !== ""
              &&  this.title            !== ""
              &&  this.question_number  !== ""){

            // 問題文取得
            this.getQuestionSentence();

          } else {

            // 該当する問題文が存在していないが、前回の問題文が残っているケースがある為、
            // 問題文と非活性状態を初期化する。
            this.question_sentence = "";
          }
        },

        title: function(newTitle, oldTitle){

          // 問題文 取得判定
          if(     this.subject          !== ""
              &&  this.title            !== ""
              &&  this.question_number  !== ""){

            // 問題文取得
            this.getQuestionSentence();
          }

        },

        //「問題番号」が変化したとき呼び出されるハンドラ
        question_number: function(newQuestionNumber, oldQuestionNumber){


          console.log('問題番号 変更');

          //this.question_number = newQuestionNumber;

          // 科目・タイトルの選択と、問題番号の変更チェック
          if(     this.subject      !== ""
              &&  this.title        !== ""
              &&  newQuestionNumber !== ""
              &&  newQuestionNumber !== oldQuestionNumber ){

            // 問題文取得
            this.getQuestionSentence();
  
          } else {

          // 科目・タイトルどちらかが未選択状態

          }
        },


        //「選択肢の数」が変化したとき呼び出されるハンドラ
        number_of_choice: function(newNumberOfChoice, oldNumberOfChoice){

          console.log('選択肢の数 変更');

          //選択肢の数のぶんだけ、IDが（choice1 ～ choice9）の選択肢欄を表示する。
          //最低でも3つは表示されたままなので、４番目以降が表示・非表示判定対象
          var numOfHide = newNumberOfChoice - 3;      // 非表示にする数

          console.log('newNumberOfChoice: ' + newNumberOfChoice);

          for(var i=4; i<10; i++){
            if(i <= newNumberOfChoice){
              this.isChoiceActive[i] = true;
            } else {
              this.isChoiceActive[i] = false;
            }
          }

        },

        //「画像有無フラグ」が変化したとき呼び出されるハンドラ
        flag_graph_exists: function(newFlagGraphExists, oldFlagGraphExists) {

          // 画像有無
          if(newFlagGraphExists == 0){

            // ファイル選択 無効化
            $('.image_item').addClass('hide_item');

            console.log('ファイル選択 無効化');

          } else {

            //ファイル選択 有効化
            $('.image_item').removeClass('hide_item');

            console.log('ファイル選択 有効化');

          }

        },

        // 問題分類管理 科目登録 科目名変更時処理
        subject_name_in_classify: function(newSubjectInClassify, oldSubjectInClassify){

          console.log('問題分類管理 科目登録 科目名変更時処理 開始');

          // メッセージ 削除
          $('#system_message').removeClass("alert alert-danger");
          $('#system_message').html("");

          // 登録ボタン 非活性化
          $("#register_subject").prop('disabled', false);
          /*
          // 科目名テーブル読込
          //var url = "https://lara-assist.jp/kokushi/management/api/get_subjects/0";    // 本番用
          var url = "http://localhost:8080/kokushi/management/api/get_subjects/0";      // ローカル環境テスト用

          let params = new URLSearchParams();
          //params.append ('subject_group_id', this.subject_group),

          axios.get(url, params).then(res => {
            console.log('axiosの戻り値：' + res.data);

            // axios 終了コード 判定
            if(res.data[0] === 0){

              // 科目テーブル読込 正常終了
              // 取得した科目名を格納
              this.subjects = res.data[1];

              console.log('this.subjects: ' + this.subjects);
              console.log('this.subjects.length: ' + this.subjects.length);

              // 科目名 重複チェック
              // subjects は、単純な科目名の配列ではないと思う。連想配列
              for(let work_subject of this.subjects){

                console.log('work_subject: ' + work_subject);
                //console.log('work_subject.length: ' + work_subject.length);

                if(this.subject_name == work_subject.subject_name){
                  console.log('科目名 重複あり');

                  // 登録せずに終了
                  // アラート表示
                  $('#system_message').addClass("alert alert-danger");
                  $('#system_message').html("同じ科目名がすでに登録されています。");

                  // 登録ボタン 非活性化
                  $("#register_question_sentence").prop('disabled', true);


                } else {
                  console.log('科目名 重複なし');
                  // 科目登録ボタン 活性化
                  // メッセージ 削除
                  $('#system_message').removeClass("alert alert-danger");
                  $('#system_message').html("");

                  // 登録ボタン 非活性化
                  $("#register_question_sentence").prop('disabled', false);

                }
              }
            }
          });
          */
        },

        //subject_ref_data
        // 科目別集計参照 科目グループ名変更時処理
        subject_group_id_ref_data: function(newSubject_group_idRefData, oldSubject_group_idRefData){

          // 科目セレクトボックスへ、対応する科目グループの科目をテーブル内容を取得してから設定
          // subject_ref_data を初期化
        },

        // 科目別集計参照 科目グループ名変更時処理
        subject_ref_data: function(newSubjectRefData, oldSubjectRefData){

          // 画面へ集計した各項目を表示する。
          // タイトル、入力済問題数、画像フラグオン数、入力済画像数、最新（古）登録日と更新日
        },


      }      

    })
  </script>
@endsection