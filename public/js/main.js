$(function(){
	$("#navHandle").on("click",function(){
		$(".container nav").slideToggle();
	});
	//ajax bits--------------------------------

	$(".nav-type").on('click',function(e){
		e.preventDefault();

		var url = $(this).attr('href');

		var spinner = new Spinner().spin();
		$('.main.group').append(spinner.el);

		$.get(url,function(res){
			$('.main.group').empty().append(res);
		});
	});
});
