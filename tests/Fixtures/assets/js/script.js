// This is a single-line comment explaining the file

/**
 * This is a multi-line comment explaining the
 * purpose of this function, which demonstrates
 * JavaScript's modern ES6+ features.
 */

// Function declaration
function greet( person ) {
    return "Hello, " + person + "!";
}

// Arrow function with implicit return
const greetArrow = ( person ) => `Hello, ${person}!`; // ES6 template literals

/* 
    Calling functions to greet the user.
    Both traditional and arrow function examples.
*/
console.log( greet( name ) );  // Outputs: Hello, John Doe!
console.log( greetArrow( name ) );  // Outputs: Hello, John Doe!

// Object destructuring
console.log( user.profile?.username ?? "Guest" ); // Outputs: jsCoder
console.log( user.address?.street ?? "No address provided" ); // Outputs: No address provided
