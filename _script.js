function hello() {
    $("#main").html("Hello jQuery");
}
									Updated 2007
Introduction to Prolog

Original author: T.M. Rao 	Modified by: Sandeep Mitra
(Material presented here is obtained from several sources, including books by Brakto, Clocksin and Mellish, Van Le, etc. and AMZI sample programs).


What is Prolog?		

The acronym Prolog stands for Programming in Logic  (Programmation en Logique). It is a general-purpose programming language based on predicate calculus.

First Prolog system was introduced in 1973 by Alain Colmerauer and his “Groupe d’Intelligence Artificielle de l’Universite d’Aix-Marseille.”

Purpose: Natural Language Understanding, Translation.

It is an interpreted language.



Prolog vs. Conventional Programming

“Conventional programming languages are fat and flabby”
-- John Backus

In conventional programming:
The programmer instructs machine how to solve a problem by performing a given sequence of actions.
The machine carries out the instructions in a specified order.

In logic programming:
The programmer defines what the problem using the language of logic
The system applied logical deduction to find answers to the problem.


Prolog Programs

A Prolog program is a description of a world written in Prolog notation.

Example:
Ann likes every toy she plays with.
Doll is a toy.
Snoopy is a toy.
Ann plays with Snoopy.
Sue likes everything Ann likes.

likes(ann, X) :- 
toy(X),plays(ann, X).
toy(doll).
toy(snoopy).
plays(ann, snoopy).
likes(sue, Y) :- 
likes(ann, Y).

Each line of the program is a “clause.”

First and the last clauses are “rules.”
The other three are “facts.”  

Fact represents a unit of information that is assumed to be true.  Rules are conditional assertions.

X and Y are variables  (begin with capital letter)
ann, doll, snoopy, sue  are constants   (begin with lower case)
likes, toy, plays	are predicates
“:-“ and “,”  are logical symbols  (read “if” and “and”)

Terms, Atomic Formulas, and Clauses

A term is a variable or a constant or an expression of the form f(T1, T2, … ,Tn) where f is a function symbol and T1, … Tn are terms (n > 0).  The symbol f is called the “functor”, n is the arity, T1, T2, … Tn are the arguments of the term. Remember: functors are not predicate symbols.

Examples of terms:

	ann.		% These are terms	
snoopy.	% because they are constants
	4.

	square(4).% This is a term, because 
% square is a function symbol, 
% and 4 is a constant
		plus(1, square(4)).	% This is also a term

An atomic formula is an expression of the form p(T1, T2, …, Tn), where p is a predicate symbol and T1, T2, … Tn are terms. If n == 0, that is there are no arguments, parentheses can be omitted. They contain predicates, constants, and variables and have a truth-value.


Examples of atomic formulas:

	likes(ann,X).		% likes is the predicate. 
toy(X).	
plays(ann,snoopy).
	isprime(plus(1,square(4)))

The last one is an atomic formula that happens to be true.  It shows that atomic formulas can contain “function symbols.”

A clause is formula of the form

A :- B1, B2, … ,Bm.

where m >= 0 and A and Bi are atomic formulas. (It is read:  A if B1 and B2 … and Bm)   The Atomic formula A is called the head of the clause and B1, B2, … Bm is called the body of the clause.  

If m >0, then the clause is called a RULE.

If m = 0, the implies symbol  :-  can be omitted. The clause looks like
	
	A.

and now it is called a FACT.

A Prolog program is a finite set of clauses.




Here are some examples of facts and rules in English, expressed in Prolog:
/*-------------------------------------------------------*/
/* Translating English into Prolog Notation             */
/*-------------------------------------------------------*/

/*-------------------------------------------------------*/
/* Facts							                 */
/* x is y, where x is a noun and y is a property that   */
/* x has, is expressed as y(x).                         */
valuable(gold).	% Gold is valuable
female(jane).		% Jane is female
human(socrates).	% Socrates is human



/* If there is a major relationship between x and y */ 
/* the relationship is expressed as:  relation(X,Y) */
owns(john, gold).	% John owns gold
father(john, mary).	% John is the father of Mary
likes(joe, mary).	% Joe likes Mary



/*-------------------------------------------------------*/
/* Rules							                 */

% If X is an animal and X has feathers, then X is a bird
% Anything that is an animal and has feathers is a bird
bird(X) :- 
animal(X), hasFeathers(X).

% X is a sister of Y if X is female and X and Y have the same parents
sister(X,Y) :- 	
female(X), 
father(X,F), 
father(Y,F),
	mother(X,M), 
mother(Y,M).

% A person may steal if the person is a thief and 
% he likes the thing and the thing is valuable
maySteal(P) :-
	thief(P), 
likes(P,T), 
valuable(T).



Queries

Prolog works by trying to satisfy a goal. The Prolog interpreter contains a main loop where the user types a goal (also called a query) and Prolog tries to satisfy it in any and all possible ways. This process is repeated indefinitely. This stops only when you type quit. (i.e. the word quit followed by a period) as the goal.   

In Prolog notation

?- likes(sue, X).

is a query. It asks, “What does sue like?”   (Strictly speaking, it asks “find an X for which likes(sue, X) is true).

Prolog figures out the answer as follows:

I Know:
Rule 1:	sue likes X if ann likes X.
Rule 2:	ann likes X if X is a toy and ann plays with X.
Fact 1: snoopy is a toy. 
Fact 2: ann plays with snoopy.

Therefore, a new fact is deduced:
ann likes snoopy. (Because of Rule2, Fact 1, Fact 2).  

Therefore, another new fact is deduced: 
sue likes snoopy.

Prolog will answer:
	X = snoopy.


Thus, a query has the form ?- A1, A2, … An. where each Ai is an atomic formula.  

In this query, there was only one atomic formula.





Working With Prolog

(Find out how to invoke Prolog on your system).

Prolog in ITSS is located under the CSC 401 class: START/PROGRAMS/CIS-CSC-CPS/CSC401/AMZI. Double-click on AMZI Prolog. It opens the AMZI program development environment.

Click on Listener and then Start to begin an interactive session. Clauses you enter are treated as “goals” to be satisfied. Prolog will use its database of facts and rules to satisfy your queries.  If it succeeds it answers with “Yes”.  If the answer is a “Yes”, and the goal had variables in it, then Prolog will show the values to which these variables were instantiated. 

In many cases, there are multiple answers to some match. If you wish to see all the matches one after the other, you should hit the TAB key and all the matching values will be successively displayed. Finally, you will see a ‘no’.

To type in your own predicates, click on “File” and “New File”.  Type your programs into this file and save it as filename.pro.  You then click on listener, and consult; and select the file to be consulted.  Consult loads the file.  Then, you can, in the listener window, type in your queries.


Consulting, Reconsulting, and Listing

A “consult” loads the facts and rules from the specified file into the Prolog database. For example, if try.pro contained:

toy(doll).
toy(snoopy).
plays(ann, snoopy).

And we consulted the file try.pro, the database will now contain the three facts shown above. You can actually check this by typing:  listing. as your goal. To satisfy the listing predicate Prolog will display all the facts and rules it has. However, there is no requirement that a fact or a rule must be present in the database just once. Prolog allows the same clause to be present more than once. Thus if you do a consult again, it will simply duplicate the clauses. This may have undesirable effects. 

However, a “Reconsult” consults the most recently consulted file; and loads only the parts that have been modified. Use consult to load the file for the first time (in a session), if you edit the file and modify its contents, then use reconsult.


7.	Unification

Prolog uses a process called unification to do its problem solving. Unification is a process of matching two Prolog expressions. If the expressions contain variables, then it will see if the variables can be bound to a common value that makes them equal. In Prolog, the equal sign, =, is considered the unification operator. If you type, exp1 = exp2. you are asking Prolog to unify exp1 and exp2. Here is a simple-minded explanation of unification:

A constant will unify only with itself.

a = a.	Yes.
a = b.	No.

An unbound variable (i.e. a variable which is not bound to anything at this time), will unify with a constant, and as a result the variable will be bound to that constant.

X = a.	Yes.
Y = b, Y = c.	No. This is because Y is already bound to b, and it cannot be bound to c.

An unbound variable will unify with a bound variable, and as a result, the two variables will be bound to the same value.

X = 5, Y = X.	Yes.  This makes both X and Y bound to the value 5.

An unbound variable will unify with another unbound variable. At this point, the two variables are bound to each other.  But neither is bound to a value.  However, when one gets bound to a value, the other automatically gets bound to the same value.

X = Y, Y = 4.	Yes.	First, X and Y are bound together. When Y is bound to 4, X is also bound to 4.

To unify two clauses, we proceed left to right, trying to unify the individual atomic formulas. As we proceed, variables will be bound to values or other variables. Unification succeeds only if the two expressions can be made identical by substituting values. If the unification fails, all the temporary bindings are undone.

Examples of Unification:

?- date(D,M,1983) = date(15, may, Y).

D = 15
M = may
Y = 1983

?- date(D,M,1983) = date(D1, may, Y1),
   date(D,M,1983) = date(15, may, Y).

D = 15
M = may
D1 = 15
Y1 = 1983
Y = 1983

?- point(A,B) = point(1,2).

A = 1
B = 2

?- point(A,B) = point(1,2,3).
No

?- triangle(point(-1,0), P2, P3) = triangle(P1, point(1,0), point(0,Y)).

P2 = point(1, 0)
P3 = point(0, H24)
P1 = point(-1, 0)
Y = H24

Some Predefined functions and predicates:
Arithmetic functions:	+	-	*	/	//	mod
(// is integer division)

Arithmetic Predicates:	<	<=	>	>=	=:=	is
=:= means have the same value;  
is causes evaluation)
== symbol is used to test if the two sides are identical with no substitution and no computation.

+(1,*(2,3))	is a term.  It is the same as 	1+2*3
X = 1+2*3	this unifies variable X to the term 1+2*3
X is 1+2*3	this causes evaluation and unifies X with 7

If you type	3 = 1 + 2 .	Prolog says no.
If you type 	3 is 1+2 .	Prolog says Yes.

?-	X + 2 = 1 + Y.
X = 1
Y = 2
?-	4 – 1 is 1 + 2 .
no
?-	4 – 1 =:=	1 + 2 .
yes
?-	X+2 == 1+Y.
no




Programming using predicates

To write a declarative Prolog program is to write facts and rules to describe a world or a problem.

a.	Prolog uses “backtracking” – a form of search to compute its answers.

% facts
big(bear).	%the bear is big
big(elephant).	%the elephant is big
small(cat).	%the cat is small
brown(bear).	%the bear is brown
black(cat).	%
gray(elephant).

% rules
dark(Z) :- black(Z).
dark(Z) :- brown(Z).

%query
?- dark(X),big(X). %what is dark and big?





b.	We can use recursion to do part of the job. 

Here is the familiar Factorial function:

factorial(0,1).
factorial(N,F) :-	
N > 0,
	N1 is N – 1,
factorial(N1, F1),
F is N * F1.


Here is how you use this function:

	?- factorial(7, F).
	F = 5040







Here is an example that shows how to print the Roman numeral notation for numbers between 1 and 39.

Observe the following: 
Comments are placed in /* … */.
In-line comments % … comment
write(exp) – Writes the expression.
nl – causes a new-line to be printed.
strings are to be placed in single quotes.
is operator causes evaluation of an expression
	
% Roman numerals for 1 <= X <= 39
roman(X) :-
	X > 39, 
	write('Number must be between 1 and 39'), nl. 
roman(X) :-
	X < 0, 
	write('Number must be between 1 and 39'), nl.
roman(X) :-
	X >= 10, X <= 39,
	write('X'),
	Y is X - 10,
	roman(Y).
roman(X) :-
	X == 9,
	write('IX').
roman(X) :-
	X >= 5, X <= 8,
	write('V'),
	Y is X - 5,
	roman(Y).
roman(X) :-
	X == 4,
	write('IV').
roman(X) :-
	X >= 1, X <= 3,
	write('I'),
	Y is X - 1,
	roman(Y).
roman(0) :- nl.





c.	Here is an example of the so called “procedureal programming” Prolog. Here, the Prolog predicates are invoked as if they are procedures in Java.


In this program we first build a database of facts that specify states and their capital cities. There is a findCapital predicate that will ask the user to enter a state name (Remember: you have to enter exactly as it is in the database, and follow it up by a period) and searches for the capital of that state. If the capital is found, then it print it. If it is not found, then it will ask the user to enter the capital of that state. It then assertz’s it into its database, and in a (near) future use of the findCapital it will know it. However, note that nothing is written on to the disk, so it really does not learn it permanently.



% First build a table of (state, capital) pairs
capital(newyork, albany).
capital(pennsylvania, harrisburg).
capital(maryland, annapolis).




% findCapital is the main driver. It accepts a state
% name and calls searchCapital to do the searching
findCapital :-
  write('Enter the State: '),
  read(State),
  searchCapital(State).
  


% Uses Prolog’s backtracking search to find a match 
% capital(State, City). If it is successful, then
% prints the city and stops.
searchCapital(State) :-
  capital(State, City),
  write('The Capital is: '),
  write(City), nl.



% The control will get here only if the first attempt
% to search fails. We then ask the user for info. 
% Observe the use of assertz, that appends the new 
% at the end of the database.
searchCapital(State) :-
  write('I do not know that state.'),nl,
  write('Can you tell me the capital?'),nl,
  write('I will remember next time.'),
  read(Capital),
  assertz(capital(State, Capital)),
  	  write('Thank you!'), nl.








d.	We can perform database applications using prolog.  We show the use of several built-in Prolog predicates: 

fail – Always fails. Used in forcing backtracking
write, nl cannot be resatisfied.
_ The underscore is a special variable called the “don’t care” variable.

%====================================================%
%                                                    %
%	Database programming in Prolog                  %
%	Prepared by T.M. Rao		                  %
%							                  %
%====================================================%


%	Parts database:
%	part(partnum, partname, color, price)
part(p1, nut, red, 1.25).
part(p2, nut, black, 1.30).
part(p3, bolt, green, 2.25).
part(p4, bolt, black, 2.50).




%	Suppliers database: supplier(supnum, location)
supplier(s1, brockport).
supplier(s2, rochester).
supplier(s3, newyork).


%	Supplies database:  
%	supplies(supnum, partnum, qty)
supplies(s1,p1,100).
supplies(s1,p2,500).
supplies(s2,p1,300).
supplies(s2,p3,300).
supplies(s3,p3,500).
supplies(s3,p4,400).






% We can now write queries to get info out of this
% database. write predicate writes an expression. 
% nl = new line, fail always fails.
% we use fail to force backtracking.



%1.	What are all the part numbers and names in the database?
getPartDetails :-
	part(Pnum,Pname,_,_),
	write(Pnum), tab(1),
	write(Pname),
	nl,
	fail.
getPartDetails :-
	nl,nl.



%2.	Similarly you can write predicates to get 
%    detais of suppliers

%3.	Get the SupNum and locations of all suppliers 
%	who supply the part p1.

getSuppliers(Pnum) :-
	supplies(Snum, Pnum, _),
	supplier(Snum, Loc),
	write(Snum), write(' located at '), 
     write(Loc), write(' supplies part '), 
     write(Pnum), nl,
	fail.
     getSuppliers(_) :- nl,nl.












	
List Processing

A list is either empty or a term of the form .(X,Y), where X can be any term and Y is a list.  X is called the head of the list and Y is called the tail of the list.

Ordinary			Dot 			Prolog List
Notation			Notation		Notation

(a,b)				.(a,.(b,[]))		[a,b]  or [a|b]

A list is also written as [H|T] where H is the head and T is the tail.  For example, if we write  [H|T] = [1,2,3] then H = 1 and T = [2,3].

Member Function:

member(X, List) :- 
List = [H|T], 
X = H.
member(X, List) :- 
List = [H|T],
 		member(X,T).

Better Version:

member(X,[X|_]).
member(X,[_|T]) :- 
member(X,T).

You can query the member function in 2 ways:

?- member(b,[a,b,b]).	% confirming query
yes
?-member(X,[a,b,b]).	% extract all members
X = a;
X = b;
X = b











List Manipulation:

a.	Adding a new element at the head of the list

% Adding an item into the list
	insert1(X, L, [X|L]).

	?- insert1(5, [6,7,8],X).
	X = [5,6,7,8]





b.	Length of a list: It is a two-place predicate. length(L,N). Given the list L, variable N is instantiated to the length of L.

length([],0).
Length([H|T],N) :- 
length(T,M),
N is 1+M.

	?-length([a,b,c], 3).
	yes
	?-length([a,b,c], N).
	N = 3





c.	Concatenation: Joining a second list to the end of the first list. This process is also called appending.

% List concatenation
concat([],[],[]).
concat(L,[],L).
concat([],L,L).
	concat([X|L1], L2, [X|L3]) :-
		concat(L1, L2, L3).







d.	Deleting an element from a list:

%Deleting an element from the list

% if head is the one to be deleted, result is tail
	del(X, [X|Tail], Tail).

	% Delete X from tail and put back the head.
	del(X, [Y|Tail], [X|Tail1]) :-
		del(X, Tail, Tail1).

	// del can also be used for insertion
	?-del(a,L, [1,2,3]).			
	L = [a,1,2,3];
	L = [1,a,2,3];
	L = [1,2,a,3];
	L = [1,2,3,a];
	No


e.	If the list we are dealing with has only numbers, then we can do some numerical computation. 



Here is something that computes the number of negative (less than zero) elements in a list.


	% The empty list has no negative elements
countNeg([],0).

% If the head is negative, then total number of 
% negatives is 1 + # of negatives in tail.
countNeg([H|T], N):-
  		H < 0,
  		countNeg(T,M),
  		N is M + 1.

	% Otherwise, it is the same as # of 
countNeg([H|T],N) :-
  		countNeg(T,N).





Computing the sum of a list:

	% sum of an empty list is 0
	sum([],0).
	
	% To compute the sum of a list, compute the sum of 
% its tail and then add the head
sum([H|T], N) :-
 	sum(T, M),
	N is M + H.



Finding the smallest element in a list:

We develop a 3-place predicate least (X, L, Rest) – where L is the given list, and X is the smallest element in it, and Rest is the list obtained from L by removing X. 

It goes with this rather complicated logic:
If the L has only one element X, i.e. L = [X], then X is the smallest, and we get [] after removing X from L.
If L has more elements, i.e. L = [H | T]; suppose the least of T is Y (i.e. least(Y, T, S). There are two possibilities here:
H <= Y	In this case H is the least; and Rest is same as T.
H > Y		In this case Y is the least; and to construct the rest, we have to put back the H into S.





% if the list has only one element X in it,
	% then X is the least and [] will be the 
	% resulting list after X is removed.
least(X,[X],[]).	


% X is the least of [H|T] and Y is the rest
% if Y is the least of T, and rest is S and
% This is a complicated construction. It says
% if H =< Y, X=H and Y=T OR
% if H > Y, X = Y, and R = [H|S]
% semicolon means OR
least(X,[H|T],R) :-     
  	 	least(Y, T, S),	   	
(H =< Y,(X,R)=(H,T); 
    		H > Y, (X,R)=(Y,[H|S])).
			

If we can find smallest, sorting can’t be too far:
 
	% Empty list is sorted.
selection_sort([],[]).	
selection_sort(L, [H|T]) :-
   		least(H, L, R),
   		selection_sort(R, T).


More Prolog

1.	Input/Output using files.
	
Prolog has the following predicates to handle input/output using files: see, seeing, seen and tell, telling, told.

see(F)	 	This opens a file for reading.  
Examples:	see(‘proj1.txt’).  or F = ‘proj1.txt’, see(F).

seen		This closes the current input stream.

seeing(F)	This instantiates F to the current input stream.

tell(F)		Open file for writing

told		Close the current output stream.

telling(F)	This instantiates F to the current output stream


This code reads prolog clauses from a file called numbers.txt and prints them. (Remember that the data in the file are supposed to be Prolog expressions – implying, they have to be followed by a period.

readFromFile :-
  see('numbers.txt'),
  read(X), read(Y), read(Z),
  write(X), nl, write(Y), nl, write(Z),
  seen.

If the file contained

32. 35. 45.

The query readFromFile. Would produce the following output:

32 
35 
45

Suppose we have some facts in our database:

square(2, 4).
square(3, 9).
square(4, 16).

If we want to write all these into a file called squares.txt (or squares.pro) we can use the following code:


writeToFile :-
  tell(‘squares.pro’),
  square(X,Y),
  write(square(X, Y)), write(‘.’), nl,
  fail.
WriteToFile :- 
  told.

Another way to do the same thing:

writeToFile :-
  tell(‘squares.pro’),
  listing(squares/2),
  told.
  

2.	The cut (!) predicate

Cut predicate is used to prevent backtracking.  Cut is a goal that always succeeds. But, if backtracking encounters a cut, then the goal containing the goal immediately fails.


Examples:

Suppose we want to express the following (examples from Brakto) situation:

If X <3, then Y = 0
If X >= 3 and X < 6, then Y = 2
If X >=6, then Y = 4.

This can be expressed in Prolog as:

f(X, 0) :- X < 3.
f(X, 2) :- X >= 3, X < 6.
f(X, 4) :- X >= 6.

Now try the goal:

?- f(1,Y), Y > 2.
 
Prolog will reply with a no.  Try and trace the way the no answer is produced. It does a lot of unnecessary backtracking.  The three conditions are mutually exclusive. This means that, once X < 3 has been tried and found true, you don’t have to try the others.

The performance of this predicate can be improved by introducing a cut.

f(X, 0) :- X < 3, !.
f(X, 2) :- X >= 3, X < 6, !.
f(X, 4) :- X >= 6.


In fact, once you have the cuts, it is not even necessary to check for X >= 3 in the second clause.

f(X, 0) :- X < 3, !.
f(X, 2) :- X < 6, !.
f(X, 4) :- X >= 6.


3.	The fail predicate:	It always fails. It forces backtracking.

process_customer :-
  customer(ID, Name, Address),
  process_trans(ID, Name, Address),
  fail.
process_customer.  % This is used to make the process_customer 
			 % succeed eventually.


A combination of cut and fail can be used prevent unnecessary backtracking.

eligible_citizenship(X) :- commit_crime(X,Y), !, fail.
eligible_citizenship(X) :- child(X, Y), citizen(Y).
eligible_citizenship(X) :- spouse(X, Y), citizen(Y).
eligible_citizenship(X) :- resident(X, Years), Years >= 5.


4.	The not predicate.

Negation (not) is defined as failure to succeed. This means that, not(G) succeeds if G fails; not(G) fails, if G succeeds.

hotel_full :- not(vacant(X)).
vacant(15).
vacant(20).

?- hotel_full.
no


Also observe:

isHome(X) :- not(isOut(X)).
isOut(sue).
husband(john, sue).

?- isHome(sue).
No.

?- isHome(john).
Yes.

?- isHome(X).
no.




5.	The repeat predicate

	repeat,
	  Goal, % a non-backtrackable predicate
	Condition.
This is like a repeat-until loop. This keeps repeating the Goal, until the condition becomes true.

Example:

%Customer database:  (ID, Name, Address) in file customer.pro
customer(1,bob ,'25 Bob Street ').
customer(2,bill ,'10 Bill Street ').
customer(3,jane ,'20 Jane Street ').

% tryRepeat.pro  Reads all the records from customer.pro
% and prints them. end_of_file is a special reserved word
% in Prolog.
go :-
  see('customer.pro'),
  processCustomers.
processCustomers :-
  repeat,
    read(ARecord),
    process(ARecord),
  ARecord = end_of_file, seen.

process(customer(I, N, A)) :-
  write(I), nl,
  write(N), nl,
  write(A), nl,nl,nl.
process(_).






6.	bagof, setof, 

	We have three types of “Collections.”

SET:	A collection of objects, in which there is NO order, but repeated elements are NOT allowed.

BAG: A collection of objects, in which there is NO order, but repeated elements ARE allowed.

LIST: A collection of objects, in which there IS an order, but repeated elements ARE allowed.

Examples:  
Set A = {a, b, c} = {c, b, a} = {b,a,c}, etc.
Bag B = {a, a, b, c} = {b, c, a, a} = {c, a, b, a}
List L = {a, a, b, c} in not the same as {a, c, b, a}


The bagof(X, G, L) makes L into a list of all X’s, that make G succeed. But there will be no duplicates.  Setf(X, G, L) is the same, except, it allows duplicates.
Here is an example:

grade(bob,  csc203, a).
grade(bill, csc203, a). 
grade(bob,  csc205, b).
grade(bill, csc205, c).
grade(jane, csc203, b).
grade(jane, csc203, b).
grade(bob,  csc203, a).

?- bagof(X, grade(X, Y, a), L).
X = H1
Y = csc203
L = [bob, bill, bob] 
yes
?- setof(X, grade(X, Y, a), L).

X = H1
Y = csc203
L = [bill, bob] 
yes
?-

