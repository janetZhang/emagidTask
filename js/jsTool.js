// JavaScript Document
$(document).ready(function(){
	$("#p-form").click(function(){
		$("#c-form").css("background-color","#83aeba");
		$("#p-form").css("background-color","#396");
		$("h1").text("Product form");
		$("#tab2").hide(1000);
		$("#tab1").show(1000);
		});
		
	$("#c-form").click(function(){
		$("#p-form").css("background-color","#83aeba");
		$("#c-form").css("background-color","#396");		
		$("h1").text("Category form");		
		$("#tab1").hide(1000);
		$("#tab2").show(1000);
	});
	/*
    $('select').each(function () {
        if ($('option:selected', this).val() == '') {
            alert('Choose one category');
            return false;
        }
	})*/
	

	
	// fetch pagination result
    $("#results").load("pagination.php", {'page':0},function() {$("#1-product-page").addClass('active');});  //initial page number to load

	// fetch management pagination results
	$(".mg").click(function (e) {
        $("#results").prepend('<div class="loading-indication"> Loading...</div>');      
		var id = "#1-"+$(this).attr("id")+"-page";
        $("#results").load("pagination.php", {'page': 0,'type':$(this).attr("id")}, function(){$(id).addClass('active');});
        return false; //prevent going to herf link
    });
	
	$(".a-mg").click(function (e) {
		var id = "#1-"+$(this).attr("id")+"-page";		
        $("#results").load("pagination.php", {'page': 0,'type':$(this).attr("id")}, function(){$(id).addClass('active');});
        return true; //prevent going to herf link
    });	
	
		
	
});