const person = {
  name: 'Edward',
  nickname: 'Duke',
  city: 'New York',
  age: 37,
  isStudent: true,
  skills: ['JavaScript', 'HTML', 'CSS']
};

for( let prop in person ){
  console.log(`${prop}: ${person[prop]}`);
}

// Store the keys of the `person` object in `personProps
const personProps = Object.keys(person);
console.log(personProps);  // will show an array of prop names
// > (6) ["name", "nickname", "city", "age", "isStudent", "skills"]

const personVals = Object.values(person);
console.log(personVals);

const name = {
  firstName: 'Reggie',
  lastName: 'Williams',
};

const role = {
  title: 'Software developer',
  skills: ['JavaScript', 'HTML', 'CSS'],
  isTeacher: true
};

// merge `name` and `role` into a `person` object
const another_person = {  
  ...name,
  ...role
};

console.log(another_person);