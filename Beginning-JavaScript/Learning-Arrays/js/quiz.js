// 1. Create a multidimensional array to hold quiz questions and answers
var quiz_array = [
  ["What is my first name?", "geraldo"],
  ["What is my last name?", "hernandez"],
  ["What is my favorite dessert?", "banana cake"]
];

// 2. Store the number of questions answered correctly
var score = 0;
var correct = [];
var incorrect = [];

/* 
  3. Use a loop to cycle through each question
      - Present each question to the user
      - Compare the user's response to answer in the array
      - If the response matches the answer, the number of correctly
        answered questions increments by 1
*/
for(var i = 0; i < quiz_array.length; i++){
  var response = prompt(quiz_array[i][0]);
  if(quiz_array[i][1] === response.toLowerCase()){
    correct.push(quiz_array[i][0]);
    score++;
  }else{
    incorrect.push(quiz_array[i][0]);
  }
}

function createItemList(arr){
  var html = '';
  for(var j = 0; j < arr.length; j++){
    html += `<li>${arr[j]}</li>`;
  }
  return html;
}

// 4. Display the number of correct answers to the user
document.querySelector('main').innerHTML = 
`<h1>You got ${score} question(s) correct</h1>
<h2>You got these questions right:</h2>
<ol>${createItemList(correct)}</ol>
<h2>You got these questions wrong:</h2>
<ol>${createItemList(incorrect)}</ol>
`;
