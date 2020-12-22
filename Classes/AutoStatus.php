<?php

namespace VkApi\CLasses;

class AutoStatus
{
    /**
     * @var int
     */
    private $timeout;


    /**
     * @var string
     */
    private $accessToken;

    /**
     * Random phrase
     *
     * @var
     */
    private $phrase;
    /**
     * Version VK API.
     *
     * @var float
     */
    private $apiVersion;

    /**
     * @var int
     */
    private $maxChars;

    public function __construct($accessToken, $timeout)
    {
        $this->accessToken = $accessToken;
        $this->apiVersion = 5.126;
        $this->timeout = $timeout;
        $this->maxChars = 140;
    }

    /**
     * Get phrase for status
     *
     * @return $this
     */
    private function getPhrase()
    {
        $search = true;

        do {
            $response = json_decode(file_get_contents('https://api.forismatic.com/api/1.0/?method=getQuote&format=json'));
            $phrase = "{$response->quoteText} ";

            if ($response->quoteAuthor !== "") {
                $phrase .= $response->quoteAuthor;
            }

            $phraseChars = strlen($phrase);
            print_r("-------------------------- \nКоличество символов:{$phraseChars}\n");

            if ($this->maxChars > $phraseChars) {
                $this->phrase = $phrase;
                $search = false;

            } else {
                print_r("Фраза скипнута:{$phrase} \nПопробуем через 5 секунд!!!");
                sleep(5);
            }

        } while ($search != false);

        return $this;
    }

    /**
     * @return $this
     */
    private function setPhrase()
    {
        $params = ['text' => $this->phrase, 'access_token' => $this->accessToken, 'v' => $this->apiVersion];
        $params = http_build_query($params);
        $result = file_get_contents('https://api.vk.com/method/status.set?' . $params);
//        print_r(json_decode($result, true));

        return $this;
    }


    /**
     * Run cycle
     */
    public function run()
    {
        $always = true;

        while ($always) {
            $this->getPhrase()->setPhrase();
            print_r("Вк-статус обновлен: {$this->phrase}.\n");
            sleep($this->timeout);
        }
    }
}

