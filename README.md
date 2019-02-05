# superbowlboxpool
A very basic (but effective) Super Bowl Box Pool manager, written in PHP and backed by MySQL

## Introduction
I started this small project around 2011 because I grew tired of managing yearly box pools in Excel or even worse, a pen-and-paper spreadsheet. Literally 2 days before the Super Bowl, I configured a very basic tool in PHP that tracked who paid, what box they picked, and how much money was still owed. After the game, I realized I had the groundwork already laid out for a user-facing interface that would allow them to pick their own box and input their own information. All I would need to do is mark if they paid or not.

Fast foward 364 days and I did zero work on the script. So again, I sat up all night expanding and modularizing bits of the backend until it evolved into a primative, but working, webapp. The next few weeks were spent cleaning up injection vectors, prettying up the CSS, etc.

Now, years after the initial use, I'm ready to start cleaning the code up for mass production (not just one-off installs). I plan on growing it to allow an infinite amount of tracked pools as well as maintaining my own pool management site (similar to Wordpress.com vs Wordpress.org). 

## Current Status
As it stands, this isn't really ready for primetime by anyone other than myself. Why? Because there's still loads of stuff that I do manually that I need to document, automate, or eliminate. With that being said, **USE AT YOUR OWN RISK**

I do promise to update the project regularly. I am new to Git and have never used any form of tracking software to manage my small things. This just seems to be the right idea and the perfect project to learn on.

## Future Plans
- Multiple pools, tracked by ID, protected via user and admin passwords.
- Payment integration via Paypal and Venmo. Cash option for manual payments.
- Cleaner CSS and layout. Responsive design for mobile?
- More team logos, selectable by Admin.
- Score retrieval via some type of API (https://github.com/BurntSushi/nfldb looks very interesting)
