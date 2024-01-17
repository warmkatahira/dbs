import{s as i}from"./loading-e0e1f0e1.js";$(".select_file input[type=file]").on("change",function(){let e=$(this).closest(".select_file");e.find(".select_file_name").html(""),$.each($(this).prop("files"),function(n,t){e.find(".select_file_name").append(t.name+"<br>")})});$(".select_file input[type=file]").on("change",function(){const e=this.files[0].name;window.confirm(`アップロードを実行しますか？

ファイル名: `+e)==!0&&(i(),$("#upload_form").submit()),$("#select_file").val(null)});
