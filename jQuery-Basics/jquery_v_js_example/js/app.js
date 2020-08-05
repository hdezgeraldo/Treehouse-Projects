const box = document.querySelector('.box');

// box.style.display = 'none';

// jQuery Example
// jQuery('.box').hide();
// $('.box').hide();
// $('.box').show();

// Vanilla JavaScript
box.addEventListener('click', function(){
    alert('you clicked me!');
})

// jQuery Function
$('.box').click(function(){
    alert('you clicked me!');
})

