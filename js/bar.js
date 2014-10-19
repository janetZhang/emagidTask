// JavaScript Document
$(document).ready(function(){	
	//pagination on click
	$(".paginate_click").click(function (e) {
        $("#results").prepend('<div class="loading-indication"> Loading...</div>');
        
        var clicked_id = $(this).attr("id").split("-"); //ID of clicked element, split() to get page number.
        var page_num = parseInt(clicked_id[0]); //clicked_id[0] holds the page number we need 
		var type = clicked_id[1];
        var id = "#"+$(this).attr("id");

        //post page number and load returned data into result element
        //notice (page_num-1), subtract 1 to get actual starting point
        $("#results").load("pagination.php", {'page': (page_num-1),'type':type}, function(){$(id).addClass('active');});
        
        return false; //prevent going to herf link
    });
	// delete items from list by type and id
	$(".delete").click(function (e) {
		var arrays = $(this).attr("id").split("-"); //ID of clicked element, split() to get page number.
		var type = arrays[0];
        var id = parseInt(arrays[1]); //type_id[1] holds the id number 
		var page_num = arrays[2];
		var page_id = '#'+page_num+'-'+type+'-page';
        $("#results").load("pagination.php", {'type': type,'id':id,'page':(page_num-1)}, function(){$(page_id).addClass('active');});
        return true; //prevent going to herf link
    });	
	
});