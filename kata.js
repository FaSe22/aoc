function Containers(input) {
  if (input.length == 1) return 1;

  let stacks = [];
  let arr = input.split("");
  let cp = Object.assign({}, arr)
  cp = Object.values(cp)
  cp.sort()
  cp.reverse()

  if (JSON.stringify(arr) === JSON.stringify(cp)) return 1;

  for (i = 0; i < arr.length; i++) {
    if (arr[i] < arr[i - 1]) {
      stacks.push(arr[i])
    }
  }
  var unique = stacks.filter(onlyUnique);
  console.log(unique)
  return unique.length;
}

function onlyUnique(value, index, array) {
  return array.indexOf(value) === index;
}


// Test cases
console.log(Containers("A")); // Output: 1
console.log(Containers("CBACBACBACBACBA")); // Output: 3
console.log(Containers("CCCCBBBBAAAA")); // Output: 1
console.log(Containers("CODEWARS")); // Output: 5


