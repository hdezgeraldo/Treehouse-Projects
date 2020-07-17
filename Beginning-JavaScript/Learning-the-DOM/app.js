const toggleList = document.getElementById('toggleList');
const listDiv = document.querySelector('.list');
const descriptionInput = document.querySelector('input.description');
const descriptionP = document.querySelector('p.description');
const descriptionButton = document.querySelector('button.description');
const addItemInput = document.querySelector('input.addItemInput');
const addItemButton = document.querySelector('button.addItemButton');
const removeItemButton = document.querySelector('button.removeItemButton');
const listItems = document.querySelectorAll('ul li');
const listUl = listDiv.querySelector('ul');

// Grab a collection of all children elements of a node
const lis = listUl.children;

// Grab first and last child elements
const firstListItem = listUl.firstElementChild;
const lastListItem = listUl.lastElementChild;

firstListItem.style.backgroundColor = 'grey';
lastListItem.style.backgroundColor = "lightblue";


function attachListItemButtons (li) {
    // Create up button
    let up = document.createElement('button');
    up.className = 'up';
    up.textContent = 'Up';
    li.appendChild(up);

    // Create down button
    let down = document.createElement('button');
    down.className = 'down';
    down.textContent = 'Down';
    li.appendChild(down);

    // Create remove button
    let remove = document.createElement('button');
    remove.className = 'remove';
    remove.textContent = 'Remove';
    li.appendChild(remove);
}

// Loop through collection of list items from Node.children
for(let i = 0; i < lis.length; i++){
    attachListItemButtons(lis[i]);
}

// This event listener will listen for a button click
listUl.addEventListener('click', (event) => {
    if(event.target.tagName.toLowerCase() === 'button'){
        if(event.target.className == 'remove'){
            // grab the parent of the button element
            let li = event.target.parentNode;
            // grab the parent of the list element
            let ul = li.parentNode;
            ul.removeChild(li);      // remove the list element
        } else if(event.target.className == 'up'){
            // grab the parent of the button element
            let li = event.target.parentNode;
            // grab the previous element's sibling
            let prevLi = li.previousElementSibling;
            // grab the parent of the list element
            let ul = li.parentNode;
            // test to see if element is already a 1st child
            if(prevLi){
                ul.insertBefore(li, prevLi); // move before
            }
        } else if(event.target.className == 'down'){
            // grab the parent of the button element
            let li = event.target.parentNode;
            // grab sibling
            let sibling = li.nextElementSibling;
            // grab the parent of the list element
            let ul = li.parentNode;
            if(sibling){
                ul.insertBefore(sibling, li); // move before
            }
        }
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

    // Create elements for each list item and add value
    let li = document.createElement('li');
    li.textContent = addItemInput.value;

    // Call function to create ALL buttons for list item
    attachListItemButtons(li);

    // append, or add a created element as a child
    ul.appendChild(li);
    li.appendChild(button);
    li.appendChild(button2);

    addItemInput.value = '';
});