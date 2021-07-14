
$(function(){
  window.addEventListener("popstate", function (e) {

    history.pushState(null, null, null);
    return;
  })

  var flag_correct =	$('#flag_correct').val();

  // 正解判定
  if (flag_correct == 1){

    // サウンドタイプ　取得
    var soundType	=	$('#sound_type').val();

    console.log('サウンドタイプ：' + soundType);

    // サウンドタイプに応じて正解音声再生
    if(soundType == 2){

      // 東北イタコ　再生
      $('#audio2').get(0).play();

      console.log('サウンド２');

    } else if(soundType == 3){

      // チャイム音　再生
      $('#audio3').get(0).play();

      console.log('サウンド３');

    }
  }
});