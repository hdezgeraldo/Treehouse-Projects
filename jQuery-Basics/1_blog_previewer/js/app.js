$('#flashMessage')
  .hide();

// const title = "My First Blog Post";
// const content = "this is my <strong>first</strong> post content";

// $('#blogTitlePreview').text(title);
// $('#blogContentPreview').html(content);

$('#previewButton').click(function(){
  const title = $('#blogTitleInput').val();
  const content = $('#blogContentInput').val();

  $('#blogTitlePreview').text(title);
  $('#blogContentPreview').text(content);

  // You can chain jQuery
  $('#flashMessage')
    .slideDown(1000)
    .delay(3000)
    .slideUp(1000);

})