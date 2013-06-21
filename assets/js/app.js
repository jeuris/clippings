// ++++++++++++++++++++++++++++++++++++++++++

!function ($) {

  $(function()
  {

	  $('#download-image').on('click', function (e)
	  {
	      
	      var url = $('.active.item').data('url');
	      e.preventDefault();

	      document.location.href = url;


	  })

	  $('#download-clipping').on('click', function (e)
	  {
	      
	      var url = $(this).data('url');
	      e.preventDefault();

	      document.location.href = url;


	  })

	  $('#download-collection').on('click', function (e)
	  {
	      
	      var url = $(this).data('url');
	      e.preventDefault();

	      document.location.href = url;


	  })	  

	  $('#years a').on('click', function (e)
	  {
	      
	  	  e.preventDefault();

	      var year = parseInt($(this).text());
	      var source = $(this).closest('ul').data('source');

	      source = source + '.json';

	      	jQuery.ajax(
	      	{
				url: source,    
				dataType: 'json',
				// cache: false,
				type: 'POST',
				data: {'year' : year, 'customerId' : customer},
				success: function(data)
				{
					$('#months').empty();
					//$("#month-buttons a").removeClass('disabled');

					var monthObject = data[1];

					for (var key in monthObject) 
					{
						$("#months").append("<li data-month="+ key +"><a href='#'>"+ monthObject[key] +"</a></li>");
					}

					$('#months li a').each(function()
					{
						$(this).click(function()
						{
				            var month = $(this).parent().data('month');
				            var month_txt = $(this).parent().text();
				            var url = $("#months").data('source');

				            getClipping(url, month, year);

				            $('#month-indicator').text(month_txt);
				        });
					})

				},
				error: function(error){console.log(error)}
			});

	  })

	  function getClipping(url, month, year)
	  {
	  		source = url + '.json';

	  		jQuery.ajax(
	      	{
				url: source,    
				dataType: 'json',
				// cache: false,
				type: 'POST',
				data: {'year' : year, 'month' : month, 'customerId' : customer},
				success: function(data)
				{
					$('#collections').empty();
					//$("#collection-buttons a").removeClass('disabled');

					var clippingsObject = data[1];

					var url = $("#collections").data('source');

					for (var key in clippingsObject) 
					{
						$("#collections").append("<li><a href='"+ url + clippingsObject[key].id +"'>"+ clippingsObject[key].name +"</a></li>");
					}

				},
				error: function(error){console.log(error)}
			});

	  }

  })

}(window.jQuery)

var Detail = 
{
	init:function()
	{
		var year = parseInt($('#yearbtn').text());
		var source = $('#years').data('source');

		source = source + '.json';

		jQuery.ajax(
      	{
			url: source,    
			dataType: 'json',
			// cache: false,
			type: 'POST',
			data: {'year' : year, 'customerId' : customer},
			success: function(data)
			{
				$('#months').empty();
				//$("#month-buttons a").removeClass('disabled');

				var monthObject = data[1];

				for (var key in monthObject) 
				{
					$("#months").append("<li data-month="+ key +"><a href='#'>"+ monthObject[key] +"</a></li>");
				}

				$('#months li a').each(function()
				{
					$(this).click(function()
					{
			            var month = $(this).parent().data('month');
			            var month_txt = $(this).parent().text();
			            var url = $("#months").data('source');

			            GetClipping.now(url, month, year);

			            $('#month-indicator').text(month_txt);
			        });
				})

			},
			error: function(error){console.log(error)}
		});
	},

	clipping:function()
	{
		var year = parseInt($('#yearbtn').text());
		var month = $('#month-indicator').data('source');
		var source = $('#months').data('source');

		//this.getClipping(source, month, year);
		GetClipping.now(source, month, year);

	}
}

var GetClipping = 
{
	now:function(url, month, year)
	{
		source = url + '.json';

	  		jQuery.ajax(
	      	{
				url: source,    
				dataType: 'json',
				// cache: false,
				type: 'POST',
				data: {'year' : year, 'month' : month, 'customerId' : customer},
				success: function(data)
				{
					$('#collections').empty();
					//$("#collection-buttons a").removeClass('disabled');

					var clippingsObject = data[1];

					var url = $("#collections").data('source');

					for (var key in clippingsObject) 
					{
						$("#collections").append("<li><a href='"+ url + clippingsObject[key].id +"'>"+ clippingsObject[key].name +"</a></li>");
					}

				},
				error: function(error){console.log(error)}
			});
	}
}
