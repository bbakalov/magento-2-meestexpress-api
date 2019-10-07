<?php
declare(strict_types=1);

namespace Bdn\MeestExpress\Model\Service;

/**
 * Class Api
 *
 * @package Bdn\MeestExpress\Model\Service
 */
class ApiConnector extends AbstractApiConnector
{

    /**
     * MeestExpress API error list
     *
     * @var array
     */
    private $meestExpressErrorCodes = [
            400 => 'Вхідні дані неправильні. Запит не може бути виконаний з причини невірного синтаксису.',
            401 => 'Несанкціонований доступ. Перевірте ім’я користувача, пароль та токен.',
            404 => 'Кінцева точка API не існує / відсутній доступ до неї',
            405 => 'Неприпустимий метод',
            410 => 'Ресурс більше не існує і не буде доступний в майбутньому',
            415 => 'Тип контенту не підтримується сервером'
    ];

    /**
     * @throws \Zend_Http_Exception
     */
    public function validateResponse()
    {
        if (array_key_exists($this->response->getStatus(), $this->meestExpressErrorCodes)) {
            throw new \Zend_Http_Exception($this->meestExpressErrorCodes[$this->response->getStatus()]);
        }
    }
}
