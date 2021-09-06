Pig Latin Translator
--------------------
Author: Martin Koči
Email: mkoci11@gmail.com

Translator from english to pig latin. This translator support translation of words and sentences. Ignores
not alphanumerical characters at beginning, between words and ending it just leave them where they supposed to be.
It also supports different dialects and correct lower and upper case.

Examples of translation
-----------------------
In words that begin with consonant sounds, the initial consonant or consonant cluster is
moved to the end of the word, and “ay“ is added, as in the following examples:

beast → east-bay </br>
dough → ough-day </br>
happy → appy-hay </br>
question → estion-quay </br>
star → ar-stay </br>
three → ee-thray </br>

In words that begin with vowel sounds or silent consonants, the syllable “ay“ is added to the
end of the word. In some dialects, to aid in pronunciation, an extra consonant is added to the
beginning of the suffix; for instance,eagle could yield eagle‘yay, eagle‘way, or eagle‘hay.

Requirements
------------

- Web Project for Nette 3.1 requires PHP 7.2

Testing of translation
----------------------

You can test it in browser on localhost.

When you download this repository run:

```bash
composer install
```

then run for creating a web server:
```bash
php -S localhost:8000 -t www
```
Then visit `http://localhost:8000` in your browser to see the pig latin translator.

Or u can just send http request to localhost at /homepage/translation URL with 2 parameters value and dialect.

Example:
```bash
curl localhost:8000/homepage/translate?value=Hello\&dialect=yay
```

Response:
```json
{
  "pig-latin":"Ello-hay"
}
```

Or u can test functionality of translation method with Nette tester

```bash
vendor/bin/tester .
```
