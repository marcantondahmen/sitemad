+function() {

	const filter = document.getElementById('filter'),
		  sites = document.getElementById('sites'),
		  rows = Array.prototype.slice.apply(sites.querySelectorAll('tbody tr'));

	filter.addEventListener('keyup', function() {

		let filterValues = filter.value.toLowerCase().split(' ');
		
		rows.forEach(row => {

			row.classList.remove('d-none');

			for (var i = 0; i < filterValues.length; i++) {
				if (row.textContent.indexOf(filterValues[i]) == -1) {
					row.classList.add('d-none');
					break;
				}
			}

		});

	});

}();