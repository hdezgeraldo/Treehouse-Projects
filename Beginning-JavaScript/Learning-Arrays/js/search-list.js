const inStock = ['pizza', 'cookies', 'eggs', 'apples', 'milk', 'cheese', 'bread', 'lettuce', 'carrots', 'broccoli', 'potatoes', 'crackers', 'onions', 'tofu', 'limes', 'cucumbers'];
var search = prompt('Search for a product.');
let message;


if(!search){
// Obtain message from user and display search results
	message = `<ul><strong>In stock:</strong> ${inStock.join(', ')}</ul>`
}else if(inStock.includes(search.toLowerCase()) ){
	message = `Yes, we have ${search}. It's #${inStock.indexOf(search.toLowerCase()) + 1} on the list!`;
}else{
	message = `No, we don't have that item in stock`;
}

document.querySelector('main').innerHTML = `<ul>${message}</ul>`