<?php
/**
 * This file is implementing an english to pig latin translator. Pig latin translator supports translation of word
 * and sentences. It also supports different dialects.
 *
 * @todo Make difference between "y" as vowel and "y" as a consonant.
 *
 * @author Martin Koči <mkoci11@gmail.com>
 */

declare(strict_types=1);

namespace App\Presenters;

use Nette;
use Nette\Application\Responses\JsonResponse;


final class HomepagePresenter extends Nette\Application\UI\Presenter
{
    private $consonant = "";
    private $vowel = "";
    private $other = "";
    private $notWord = "";

    public function __construct()
    {
        parent::__construct();
        $this->consonant = '/^([^aeiou]+)(.*)/i';
        $this->vowel = '/^([aeiou]+)(.*)/i';
        $this->other = '/^((qu)+)(.*)/i';
        $this->notWord = '/([^[:alnum:]]+)/i';
    }

    /**
     * @brief When this action is called it will return translated string from english to pig latin as JSON response.
     * @param string $value English string
     * @param string $dialect Chosen dialect which will be used in translation.
     * @throws Nette\Application\AbortException
     */
    public function actionTranslate(string $value, string $dialect): void
    {
        $this->sendResponse(new JsonResponse([
            'pig-latin' => $this->translate($value, $dialect)
        ]));
    }

    /**
     * @brief This function translates all words one by one from english to pig latin.
     * @param string $value English string.
     * @param string $dialect Chosen dialect.
     * @return string Translated string to pig latin.
     */
    public function translate(string $value, string $dialect): string
    {
        $translated_string = "";

        //split string into words
        $words_to_translate = preg_split($this->notWord, $value, 0, PREG_SPLIT_DELIM_CAPTURE);

        foreach ($words_to_translate as $word) {
            $capitalized = false;

            //Check if first char of english word is upper.
            if (!empty($word) && preg_match('/^[A-Z]/', $word)) {
                $capitalized = true;
                $word = lcfirst($word);
            }

            //translate word to pig latin
            $translated_word = $this->translateWord($word, $dialect);

            //If english word started with upper letter convert first character to upper.
            if ($capitalized) {
                $translated_string .= ucfirst($translated_word);
                $capitalized = false;
            } else {
                $translated_string .= $translated_word;
            }
        }
        return $translated_string;
    }

    /**
     * @brief This function translates one word from english to pig latin.
     * @param string $word English word.
     * @param string $dialect Chosen dialect.
     * @return string Translated word.
     */
    public function translateWord(string $word, string $dialect): string
    {
        $translated_string = "";
        if (preg_match($this->notWord, $word)) { // no alphanumerical characters
            $translated_string = $word;
        } elseif (preg_match($this->vowel, $word)) { // begins with vowels
            $translated_string = preg_replace($this->vowel, "$1$2-" . $dialect, $word);
        } elseif (preg_match($this->other, $word)) { // begins with silent consonant
            $translated_string = preg_replace($this->other, "$3-$1ay", $word);
        } elseif (preg_match($this->consonant, $word)) { // begins with consonant or cluster of consonants
            $translated_string = preg_replace($this->consonant, "$2-$1ay", $word);
        }
        return $translated_string;
    }
}
