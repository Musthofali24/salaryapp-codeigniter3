// Active Class
$(".Filter_List .inline-list li").on("click", function () {
	var FilterClass = $(this).attr("filter");
	console.log(FilterClass);
	if (!$(this).hasClass("active")) {
		$(this).addClass("active");
		$(this).siblings().removeClass("active");
	}
	$(".Portfolio_projects .row .col-md-6").each(function () {
		if (FilterClass == "All") {
			$(this).fadeIn();
		} else {
			if ($(this).hasClass(FilterClass)) {
				$(this).fadeIn();
			} else {
				$(this).hide();
			}
		}
	});
});

// Toggle Active class

$(".collapse_menu").on("click", function () {
	$(this).toggleClass("active");
});
