$(document).ready(function() {
	$('.show-picker').click(function(e) {
		e.stopPropagation();
		myPicker.show();
	});
	$('.hide-picker').click(function(e) {
		e.stopPropagation();
		myPicker.hide();
	});
	$('#updatepas').click(function(e){
		if($("#newMatkhau").val()!=$("#comfirmMatkhau").val()){
			alert("M�?t kh�?u xa�c nh�?n kh�ng du�ng!");
		}
	});
	$('#oldMatkhau').change(function(){

		$
		.ajax({
			url : "/DoAn/Giangviens/kiemtramatkhau",
			type : "POST",
			data : {
				pass : $("#oldMatkhau").val()
			},
			dataType : "JSON",
			success : function(jsonStr) {
				//$("#chekpass").
			}
		});
	});
});