$(function () {
  /**
   * used at Equip_management
   */
  $("[name='upfile']").on('change', function (e) {
    
    var reader = new FileReader();
    
    reader.onload = function (e) {
        $("#preview").attr('src', e.target.result);
    }
 
    reader.readAsDataURL(e.target.files[0]);   
 
  });
})