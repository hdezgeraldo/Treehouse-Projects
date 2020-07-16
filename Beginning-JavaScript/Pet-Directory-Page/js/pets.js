/*
  Create an array of 'pet' objects.
  Each object should have the following properties: 
  name, type, breed, age, and photo
*/
var pets = [
  {
    name: 'Zuko',
    type: 'Dog',
    breed: 'Australian Shepherd',
    age: '2',
    photo: 'img/aussie.jpg'
  },
  {
    name: 'Rider',
    type: 'Dog',
    breed: 'Golden Retriever',
    age: '9',
    photo: 'img/golden.jpg'
  }
];

var output = '';
for(var i = 0; i < pets.length; i++){
  output += `
    <h2>${pets[i].name}</h2>
    <h3>${pets[i].type} | ${pets[i].breed}</h3>
    <p>Age: ${pets[i].age}</p>
    <img src="${pets[i].photo}" alt="${pets[i].breed}">
    <br>
  `
}

var main = document.querySelector('main');
main.insertAdjacentHTML('beforeend', output);