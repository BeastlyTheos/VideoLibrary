$("#DetailsDialog").dialog({autoOpen: false, width: 500});
$("button.DetailsButton").click(
		function() 
			{
			$.ajax({url: "getVideoGrid.php", cache: false, data: {id: $(this).attr("id")}}).done(function(data) 
				{
				$("#DetailsDialog").html(data);
				$("#DetailsDialog").dialog("open");

				});
			}
		);