const playlist = [
  ['So What', 'Miles Davis', '9:04'],
  ['Respect', 'Aretha Franklin', '2:45'],
  ['What a Wonderful World', 'Louis Armstrong', '2:21'],
  ['At Last', 'Ella Fitzgerald', '4:18'],
  ['Three Little Birds', 'Bob Marley and the Wailers', '3:01'],
  ['The Way You Look Tonight', 'Frank Sinatra', '3:21']
];

var myArtists = `${playlist[0][1]}, $`

function createListItems( arr ) {
  let items = '';
  for ( let i = 0; i < arr.length; i++ ) {
    for( let j = 0; j < arr[i].length; j++){
      if(j === 0){
        items += `<li>${ arr[i][j] },`;
      }else if(j === 1){
        items += ` by ${ arr[i][j] }`;
      }else{
        items += ` - ${ arr[i][j] }</li>`;
      }
    }
  }
  return items;
}

document.querySelector('main').innerHTML = `
  <ol>
    ${createListItems(playlist)}
  </ol>
`;