// variables containing HTML element selections for DOM manipulation
const form = document.querySelector('form');
const input = form.querySelector('input');

const mainDiv = document.querySelector('.main');
const ul = document.querySelector('#invitedList');

const div = document.createElement('div');
const filterLabel = document.createElement('label');
const filterCheckBox = document.createElement('input');

filterLabel.textContent = "Hide those who haven't responded";
filterCheckBox.type = "checkbox";
div.appendChild(filterLabel);
div.appendChild(filterCheckBox);
mainDiv.insertBefore(div, ul);

/***********************************************************
 * Description: this function will filter list items to those
 * who have only 'responded' to the invitation 
 ***********************************************************/
filterCheckBox.addEventListener('change', (event) => {
	const isChecked = event.target.checked;
	const lis = ul.children;
	// if list item has been checked
	if(isChecked){
		for(let i = 0; i < lis.length; i++){
			let li = lis[i];
			if(li.className === 'responded'){
				li.style.display = '';	// revert to previous display style
			}else{
				li.style.display = 'none';	// hide the list item
			}
		}
	}else{
		for(let i = 0; i < lis.length; i++){
			let li = lis[i];
			li.style.display = '';
		}
	}
})

/***********************************************************
 * Description: this function will create new list items
 * and add text based on input form
 ***********************************************************/
function createListItem(text){
	const li = document.createElement('li');
	const span = document.createElement('span');
	span.textContent = text;	// assign value to new list item
	li.appendChild(span);
	input.value = '';				// reset input form value

	// create a label for each list element
	const label = document.createElement('label');
	label.textContent = 'Confirmed';

	// create a checkbox for each list element
	const checkBox = document.createElement('input');
	checkBox.type = 'checkbox';
	label.appendChild(checkBox);

	li.appendChild(label);

	// REMOVE
	const editButton = document.createElement('button');
	editButton.textContent = 'Edit';
	li.appendChild(editButton);

	// create remove buttons
	const removeButton = document.createElement('button');
	removeButton.textContent = 'Remove';
	li.appendChild(removeButton);

	return li;
}

/***********************************************************
 * Description: this event listener will create list items
 * when a user submits a new value in the input form.
 ***********************************************************/
form.addEventListener('submit', (event) => {
	// prevent browser from refreshing after form submissions
	event.preventDefault();

	const text = input.value;

	const li = createListItem(text);

	ul.appendChild(li);
})

/***********************************************************
 * Description: this event listener will add a class type
 * to the existing list element
 ***********************************************************/
ul.addEventListener('change', (event) => {
	// get the list element (parent's parent of target)
	const listCheck = event.target.parentNode.parentNode;
	// this will store the boolean value of the checkbox attribute
	const checked = event.target.checked;
	if(checked){
		listCheck.className = 'responded';
	}else{
		listCheck.className = '';
	}
});

/***********************************************************
 * Description: this event listener will add a class type 
 * to the existing list element
 ***********************************************************/
ul.addEventListener('click', (event) => {
	if(event.target.tagName === "BUTTON"){
		const button = event.target;
		const li = event.target.parentNode;
		// good practice to locate correct 'ul' based on element
		// that triggered the event
		const ul = li.parentNode;
		if(button.textContent === 'Remove'){
			ul.removeChild(li);
		}
		// this adds an 'Edit' button functionality 
		else if(button.textContent === 'Edit'){
			const span = li.firstElementChild;
			const input = document.createElement('input');
			input.type = "text";
			input.value = span.textContent;
			li.insertBefore(input, span);
			li.removeChild(span);
			button.textContent = 'Save';
		} 
		// this adds a 'Save' button functionality
		else if(button.textContent === 'Save'){
			const span = document.createElement('span');
			const input = li.firstElementChild;
			const editText = input.value;
			span.textContent = editText;
			li.insertBefore(span, input);
			li.removeChild(input);
			button.textContent = 'Edit';
		}
	}
});