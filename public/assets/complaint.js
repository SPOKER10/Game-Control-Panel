$(document).ready(function(){$("._cs").select2({minimumInputLength:1,ajax:{url:_PAGE_URL+"api/search",dataType:"json",type:"POST",data:function(a){return{term:a}}},processResults:function(a){return{results:a}}}),$("._cs").on("select2:select",function(a){$("._type").prop("disabled",!0),$("._lt").show();var b=$("._cs").val();$.ajax({url:_PAGE_URL+"api/complaints/get/types",type:"POST",data:{user:b},success:function(a){$("._type").prop("disabled",!1),$("._lt").hide(),$("._type").html(a)}})}),$("._type").change(function(){$("._reason").prop("disabled",!0),$("._lr").show();var a=$("._type").val();$.ajax({url:_PAGE_URL+"api/complaints/get/reasons",type:"POST",data:{type:a},success:function(a){$("._reason").prop("disabled",!1),$("._lr").hide(),$("._reason").html(a)}})})});