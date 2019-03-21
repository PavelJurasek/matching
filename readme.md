# Matching

Example of matching algorithm introduced by A. E. Roth in his book Who Gets What‑‑And Why.

## What it does

We have a bunch of applicants (medicine doctor graduates in the book) and a bunch of companies (hospitals in the book) who are supposed to be matched according to preferencies given by both sides.

See ```output-static.txt```: it takes 3 steps to reach the perfect matching (each step is separated by dashed lines).

The first step shows initial state: Applicant A wants to work in C1 the most, C2 is his alternative choice. ```none``` at this point refers to the fact, that he did not accept any offer yet. C1: Prefers applicants in given order - A, B, C and doesn't have any applicant confirmation just yet.

In the second step, every company submits offers to as many applicants as they can actually accept. Applicants accept or reject offers based on their preferences.

As not all companies have filled their capacities, another round takes place. Again, companies send as many offers as they need to fill their capacities. They disregard all applicants they reached out in previous steps and they only talk to applicants waiting down on their preference list.     

Last step shows final matching: every applicant accepts job in the most prefered company if the company actually want that particular applicant. At the same time, companies get the best applicants they can - they only reach out applicants they want in order from the most wanted to the least wanted. 
