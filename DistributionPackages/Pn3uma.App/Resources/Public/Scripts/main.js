import './jquery.min.js';
import './Vendors/tabulator.min.js';

$(document).ready(function () {
	checkHttp();
	checkPort();
	initTables();
});

function initTables() {
	var table = new Tabulator("#wordlist-table", {
		layout:"fitColumns",
		movableColumns: true,
	});
}

function checkPort() {
	$('#check-port').click(function () {
		$('form label').each(function () {
			var targetEl = $(this).find('.port');
			var domainUri = $(this).find('input').val();

			$.ajax({
				method: "POST",
				url: "/api/port",
				data: {domain: domainUri}
			}).done(function (data) {
				if (data.status === false) {
					targetEl.addClass('text-red-500');
				} else {
					targetEl.addClass('text-green-500');
				}
				targetEl.html(data.response);
			});
		});
	});
}

function checkHttp() {
	$('#check-http').click(function () {
		$('form label').each(function () {
			var targetEl = $(this).find('.http');
			var domainUri = $(this).find('input').val();

			$.ajax({
				method: "POST",
				url: "/api/http",
				data: {domain: domainUri}
			}).done(function (data) {
				if (data.status === false) {
					targetEl.addClass('text-red-500');
				}

				var fullHeaderResponse = '<div class="cursor-pointer group">';

				if (Array.isArray(data.response)) {
					fullHeaderResponse += '<div class="flex">' + data.response[0] + '</div><div class="absolute bg-neutral-800 rounded-sm hidden group-hover:block">';
					$.each(data.response, function (index, value) {
						if (index > 0) {
							fullHeaderResponse += '<span class="flex text-sm text-neutral-500 z-2 px-2">' + value + '</span>';
						}
					});
					fullHeaderResponse += '</div>';
				} else {
					fullHeaderResponse += '<div class="flex">' + data.response + '</div>';
				}

				fullHeaderResponse += '</div>';
				targetEl.html(fullHeaderResponse);
			});
		});
	});
}
