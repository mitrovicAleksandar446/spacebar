<?php
/**
 * Created by PhpStorm.
 * User: aleksa446
 * Date: 4/13/19
 * Time: 1:19 PM
 */

namespace App\Service;


use App\Helper\LoggerTrait;
use Nexy\Slack\Client;
use Psr\Log\LoggerInterface;

class SlackClient
{
    use LoggerTrait;

    /**
     * @var Client
     */
    private $slack;

    /**
     * SlackClient constructor.
     * @param Client $slack
     */
    public function __construct(Client $slack)
    {

        $this->slack = $slack;
    }

    /**
     * @param string $from
     * @param string $message
     * @throws \Http\Client\Exception
     */
    public function sendMessage(string $from, string $message)
    {
        $this->logInfo("Beaming a message to Slack !", [
            'message' => $message
        ]);

        $slackMessage = $this->slack->createMessage();

        $slackMessage
            ->from($from)
            ->withIcon(':ghost:')
            ->setText($message);

        $this->slack->sendMessage($slackMessage);
    }
}