const toggleList = document.getElementById('toggleList');
const listDiv = document.querySelector('.list');
const descriptionInput = document.querySelector('input.description');
const descriptionP = document.querySelector('p.description');
const descriptionButton = document.querySelector('button.description');
const addItemInput = document.querySelector('input.addItemInput');
const addItemButton = document.querySelector('button.addItemButton');
const removeItemButton = document.querySelector('button.removeItemButton');
const listItems = document.querySelectorAll('ul li');

// This event listener will capitalize a list element
// using event bubbling 
listDiv.addEventListener('mouseover', (event) => {
    // if the tag name of the event target matches the list
    if(event.target.tagName.toLowerCase() === 'li'){
        event.target.textContent = event.target.textContent.toUpperCase();
    }
});
// This event listener will lowercase a list element
// using event bubbling
listDiv.addEventListener('mouseout', (event) => {
    // if the tag name of the event target matches the list
    if(event.target.tagName.toLowerCase() === 'li'){
        event.target.textContent = event.target.textContent.toLowerCase();
    }
});


toggleList.addEventListener("click", () => {
    if(listDiv.style.display == 'none'){
        toggleList.textContent = 'Hide List'
        listDiv.style.display = 'block';
    }else{
        listDiv.style.display = 'none';
        toggleList.textContent = 'Show List'
    }
});

descriptionButton.addEventListener('click', () => {
    descriptionP.innerHTML = descriptionInput.value + ':';
    descriptionInput.value = '';
});

addItemButton.addEventListener("click", () => {
    // Select an existing node
    let ul = document.getElementsByTagName('ul')[0];
    let li = document.createElement('li');
    li.textContent = addItemInput.value;
    // append, or add a created element as a child
    ul.appendChild(li);
    addItemInput.value = '';
});

removeItemButton.addEventListener("click", () => {
    let ul = document.querySelectorAll('ul')[0];
    // "element:last-child" allows you to select last child
    let li = document.querySelector('li:last-child');
    // removes a child node from the DOM
    ul.removeChild(li);
});