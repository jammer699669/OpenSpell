# OpenSpell
Complete Database of spelling for UK Canada USA Australia and NewZealand
Contains 561,436 words

The database is fully indexed allowing for fast searches.

A couple of notes on how the database is set up.

there were issues trying to use an apostrophe in the search. WE could store it in the database however mysql kept throwing errors when we tried to use in to perform a search.


Our solution was simple and effective

the entries into the database were modified and all ' were replaced with _

so now  a few  changes to how a search is done
in PHP

( user input etc )
$userword=str_replace("'","_",$userword);

when words are returned from  the database we revese the process

$outword=str_replace("_","'",$outword);


 The solution itself is not perfect however there is not a word in the English language that uses an Underscore.

The sample code is written in as simple PHP as possible so should be easy to understand.

If YOU have questions please go to the site listed below. The most currect database file will always be located on the Ospell site.

Included is sample code to access the database however please note that the samples should not be used in a production environment as they have not been hardened and very little error checking is included.


The downloads for the current database ( sql file)  are located at


https://ospell.itechecom.com

There is no Login or signup up needed just go to the download section and get the file
