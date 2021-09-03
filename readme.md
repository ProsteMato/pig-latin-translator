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

You can test it in browser in localhost.

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

Web Server Setup
----------------

The simplest way to get started is to start the built-in PHP server in the root directory of your project:

	php -S localhost:8000 -t www

Then visit `http://localhost:8000` in your browser to see the welcome page.

For Apache or Nginx, setup a virtual host to point to the `www/` directory of the project and you
should be ready to go.

**It is CRITICAL that whole `app/`, `config/`, `log/` and `temp/` directories are not accessible directly
via a web browser. See [security warning](https://nette.org/security-warning).**
