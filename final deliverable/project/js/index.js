const scrollProgress = document.getElementById('progress-bar');
const height =
  document.documentElement.scrollHeight - document.documentElement.clientHeight;

window.addEventListener('scroll', () => {
  const scrollTop =
    document.body.scrollTop || document.documentElement.scrollTop;
  scrollProgress.style.width = `${(scrollTop / height) * 100}%`;
});

//function to perform autocomplete as the user types
$(document).ready(function() {
  $('input[name="q"]').on('input', function() {
      var searchTerm = $(this).val();
      var searchType = $('select[name="search_type"]').val();
      if (searchTerm !== "") {
          $.ajax({
              url: 'autocomplete.php',
              method: 'GET',
              data: { q: searchTerm, search_type: searchType },
              success: function(data) {
                  // Display autocomplete results
                  $('#autocomplete-results').html(data);
              }
          });
      } else {
          // Clear autocomplete results when the input is empty
          $('#autocomplete-results').html('');
      }
  });
});