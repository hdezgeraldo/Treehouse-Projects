// hide the spoiler text
$('.spoiler span').hide();

// // when the button is pressed
// $('button').on('click mouseleave', function(){
//     $('.spoiler span').show();
//     $('button').hide();
// })

// Create the 'Reveal Spoiler' button
const $button = $('<button>Reveal Spoiler</button>');
// Append to the web page
$('.spoiler').prepend($button);

// If user clicks spoiler element, or nested element within spoiler
$('.spoiler').on('click', 'button', function(e){
    console.log(event.target);
    $(this).next().show();
    $(this).hide();
});