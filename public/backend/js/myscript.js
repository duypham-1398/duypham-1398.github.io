
$(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });

$("div.alert").delay(3000).slideUp();

function confirmDel(msg) {
	if(window.confirm(msg)) {
		return true;
	}

	return false;
}

$(document).ready(function () {
	$("#addImage").click(function(){
		$("#insert").append('<div class="form-group"><label>Hình ảnh </label><input type="file" name="fEditImage[]" ></div>');
		});
});

$(document).ready(function() {
	$("a#del_img").on('click',function() {
		var url = "http://localhost/khoaibeo/admin/sanpham/xoahinh/";
		var _token = $("form[name='frmEditPro']").find("input[name='_token']").val();
		var idHinh = $(this).parent().find("img").attr("idHinh");
		var img = $(this).parent().find("img").attr("src");
		var rid = $(this).parent().find("img").attr("id");
		$.ajax({
			url: url+idHinh,
			type: 'GET',
			cache: false,
			data: {"_token":_token,"idHinh":idHinh,"urlHinh":img},
			success: function (data) {
				if (data == "Oke") {
				} else {
					alert("Error!");
				}	$("#"+rid).remove();
				
			}
		});
	});
});

$(document).ready(function () {
	$("#addStep").click(function(){
		$("#insertStep").append('<div class="form-group"><label>Nội dung</label><textarea class="form-control" rows="3" name="txtMNContent[]" placeholder="Mô tả..."></textarea><br><label>Hình ảnh </label><input type="file" name="fImageStep[]" ></div>');
		});
});

