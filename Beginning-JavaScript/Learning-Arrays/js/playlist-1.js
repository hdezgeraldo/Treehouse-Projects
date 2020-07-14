const playlist = [
	'So What',
	'Respect',
	'What a Wonderful World',
	'At Last',
	'Three Little Birds',
	'The Way You Look Tonight'
];

/* Name: createItemList
	 Description: this function will loop through an array
	 and proceed to add the contents to a string. */
function createItemList(arr){
	var list = '';
	for(var i = 0; i < arr.length; i++){
		list += `<li>${arr[i]}</li>`
	}
	return list;
}

document.querySelector('main').innerHTML = 
	`<ol>
		${createItemList(playlist)}
	</ol>
	`

// testing 'indexOf()' function on a non-existing value
const people = [ 'Maria', 'Alyssa', 'Toni', 'Lee', 'Reggie' ];
let personIndex = people.indexOf('Maria');  // 0

if ( personIndex !== -1) { // it's ok because we're checking for -1 only
	console.log(`${people[personIndex]} is in the array at index ${personIndex}.`);
}
