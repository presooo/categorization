# Questions and Answers

## What is the difference between ++a and a++?
If `a` is 1 after `++a`, `a` will have the value of 2 but after `a++`, value will be 1 but in memory it will be 2.

## Can you explain what you consider to be the key differences between object-oriented programming and functional programming?
OOP revolves around the concept of objects while functional programming, the evaluation of functions. OOP data is mutable and stored in objects while functional programming data is immutable, cannot be stored in objects but can be transformed only via functions.

## What is the difference between a closure, a callback, a lambda, and a promise?

A closure gives access to an outer function's scope to an inner function.
A callback function is one that is passed to another function as an argument and invoked inside  the outher function. I have mostly used these with asynchronous operations.
A promise generally represents the completion/failure and value/result of an asynchronous operation.
Lambdas are nameless functions that are definied inline. They can be assigned to a variable and passed around as objects.

## Explain logic short-circuiting, and how it can affect the code you write?

Short-circuiting is when an expression's evaluations is stopped at the first determined outcome. I use it a lot. Especially to prevent repetition and when working with objects. A small example would be:

`if ($obj !== null && $var = $obj->getVar()) {}`

If short-circuiting was not used in the example above, a null exception would have been thrown on the function call.

## What are your thoughts on composition versus inheritance?

I think we as people favor composition just because it comes more natural to us. We see composition everywhere around us: a car has so many different parts, wheels, engine(which has a lot of parts of itself), a table has legs, etc. Composition is pretty much some parts that make one whole thing. It is a bit easier to test too because you can easily mock some parts of the whole thing.

With inheritance you need to find commonality, create a family tree. But the benefit of it is that it pretty much defines the classification hierarchy and its semantics/meaning.

## How would you choose between using a regular expression, a parser, or a simple string search? Give examples.

I use string searches in very basic situations like comparing two users' names. RegEx I use when validating variables/properties, for example: tokens, email addresses. For anything more complex I use a parser, especially if it a file format, some kind of a user created rules system where they type a statement and a rule is created out of it.

## Can you explain how dependency injection helps when writing unit tests?
DI promotes decoupling and that makes writing unit test easier and more flexible.

## Give an example of how you would use defensive programming techniques (otherthan to sanitise user input).
1 - Throw early - all validating IFs should be at the top of the method and should either throw or return to prevent further execution with invalid parameters.
2 - Create a multitude of exceptions and use them correctly.
3 - Do not provide any sensitive data in the exceptions' messages but rather keep them abstract - "Login failed" > "User with id '1abv' was not found" or "Wrong password for this username"
4 - Validate/assert all user input and throw accordingly

## Do you think it is good or bad to commit “built” ﬁles? (E.g. the output of SCSS, etc.)Explain why.

I've worked within both scenarios. My opinion is that they are not necessary. I dont like that they create a dependency and they take space. 

## When would you use fully-normalised form, and when would you use JSON columns?

I have never been in a situation where a JSON column would have resolved an issue, so I dont really have an answer to this and there is no point in me copying something from google.

## When would you use a stored procedure and why?

I've used them a couple of times a long time ago, and only for one reason, performance. But they do provide a bit more security as well due to being pre-written.

## When is it inadvisable to rely upon ORM?

I think when working with senstive data. An orm allows updates, inserts etc and that creates a security risk.

## What was the most useful feature that was added to the latest version of yourchosen language? Please include a snippet of code that shows how you've used it.

PHP 8:

Union types: `public function foo(Foo|Bar $variable): int|float;`

and nullsafe operator:

`$dateAsString = $startDate ? $startDate->asDateTimeString() : null;`


## What is your preferred approach to responsive design?

Up until now I have worked on web applications and platform mainly so Desktop first but I've always used Bootstrap or similar to help with the responsivnes.


## Please describe yourself using JSON.
`
{
  "name": "Pres",
  "age": 27,
  "nationality": "Bulgarian",
  "hobbies": [
    "Football",
    "Boxing",
    "Drawing"
  ]
}
`