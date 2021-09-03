<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;
use Nette\Application\Responses\JsonResponse;


final class HomepagePresenter extends Nette\Application\UI\Presenter
{
    private $consonant = "";
    private $vowel = "";
    private $other = "";

    function __construct()
    {
        $this->consonant = '/^([^aeiouy]+)(.*)/';
        $this->vowel = '/^([aeiouy]+)(.*)/';
        $this->other = '/^((qu)+)(.*)/';
    }

    public function actionTranslate(string $value, string $dialect): void
    {
        $this->sendResponse(new JsonResponse([
            'pig-latin' => $this->translate($value, $dialect)
        ]));
    }

    private function translate(string $value, string $dialect): string
    {
        $translated_string = "";
        $words_to_translate = explode(' ', $value);

        foreach ($words_to_translate as $word) {
            if (preg_match($this->vowel, $value)) {
                $translated_string .= preg_replace($this->vowel, "$1$2" . $dialect, $word);
            } elseif (preg_match($this->other, $value)) {
                $translated_string .= preg_replace($this->other, "$3-$1" . $dialect, $word);
            } elseif (preg_match($this->consonant, $value)) {
                $translated_string .= preg_replace($this->consonant, "$2-$1ay", $word);
            }

        }
        return $translated_string;
    }
}
