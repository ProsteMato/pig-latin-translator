<?php


use Tester\Assert;
use App\Presenters\HomepagePresenter;

require __DIR__ . '/bootstrap.php';


class HomepageTest extends \Tester\TestCase
{

    /**@var App\Presenters\HomepagePresenter */
    private $presenter;

    public function setUp()
    {
        $this->presenter = new HomepagePresenter();
    }

    public function tearDown() { }

    public function testConsonants()
    {
        $translation = $this->presenter->translate("beast", "yay");
        Assert::same("east-bay", $translation);
        $translation = $this->presenter->translate("dough", "yay");
        Assert::same("ough-day", $translation);
        $translation = $this->presenter->translate("happy", "yay");
        Assert::same("appy-hay", $translation);
    }

    public function testClusterConsonants()
    {
        $translation = $this->presenter->translate("star", "yay");
        Assert::same("ar-stay", $translation);
        $translation = $this->presenter->translate("three", "yay");
        Assert::same("ee-thray", $translation);
    }

    public function testVowel()
    {
        $translation = $this->presenter->translate("apple", "yay");
        Assert::same("apple-yay", $translation);
    }

    public function testSilentConsonants()
    {
        $translation = $this->presenter->translate("question", "yay");
        Assert::same("estion-quay", $translation);
    }

    public function testDiffDialects()
    {
        $translation = $this->presenter->translate("apple", "yay");
        Assert::same("apple-yay", $translation);
        $translation = $this->presenter->translate("apple", "hay");
        Assert::same("apple-hay", $translation);
        $translation = $this->presenter->translate("apple", "way");
        Assert::same("apple-way", $translation);
    }

    public function testUpperCase()
    {
        $translation = $this->presenter->translate("Apple", "yay");
        Assert::same("Apple-yay", $translation);
        $translation = $this->presenter->translate("Hello", "yay");
        Assert::same("Ello-hay", $translation);
    }

    public function testUpperCaseInWord()
    {
        $translation = $this->presenter->translate("HELLO", "yay");
        Assert::same("ELLO-hay", $translation);
    }

    public function testNotAlphanumericSymbolAtStart()
    {
        $translation = $this->presenter->translate("?apple", "yay");
        Assert::same("?apple-yay", $translation);
    }

    public function testNotAlphanumericSymbolAtEnd()
    {
        $translation = $this->presenter->translate("apple?", "yay");
        Assert::same("apple-yay?", $translation);
    }

    public function testSentence()
    {
        $translation = $this->presenter->translate("Hello how are you?", "yay");
        Assert::same("Ello-hay ow-hay are-yay ou-yay?", $translation);
    }
}

(new HomepageTest())->run();