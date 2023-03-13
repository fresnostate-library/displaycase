// init Isotope
var $grid = $('#display-list').isotope({
  // options...
});

// layout Isotope after each image loads
$grid.imagesLoaded().progress( function() {
  $grid.isotope('layout');
});

// filter items on button click
$('.filter-button-group').on( 'click', 'button', function() {
  var filterValue = $(this).attr('data-filter');
  $grid.isotope({ filter: filterValue });
});