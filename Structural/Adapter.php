<?php

interface Notification
{
    public function send(string $title, string $message);
}

class EmailNotification implements Notification {
    private $adminEmail;

    public function __construct(string $adminEmail)
    {
        $this->adminEmail = $adminEmail;
    }

    public function send(string $title, string $message): void
    {
        $sent = mail($this->adminEmail, $title, $message);

        if ($sent)
            echo "Sent email to '{$this->adminEmail}'.\n";
        else
            echo "Failed to send email.\n";
    }
}

class SlackApi {
    private $login;
    private $apiKey;

    public function __construct(string $login, string $apiKey)
    {
        $this->login = $login;
        $this->apiKey = $apiKey;
    }

    public function login(): void
    {
        // slack log in
        echo "Logged in to a slack account '{$this->login}'.\n";
    }

    public function sendMessage(string $chatId, string $message): void
    {
        echo "Posted message into the '$chatId' chat.\n";
    }
}


// adapter
class SlackNotification implements Notification {
    private $slack;
    private $chatId;

    public function __construct(SlackApi $slack, string $chatId)
    {
        $this->slack = $slack;
        $this->chatId = $chatId;
    }

    public function send(string $title, string $message): void
    {
        $slackMessage = "#" . $title . "# " . strip_tags($message);

        $this->slack->login();
        $this->slack->sendMessage($this->chatId, $slackMessage);
    }
}

function sendWarningNotification(Notification $notification)
{
    $notification->send('Alarm!', '<strong>Website is down!</strong>');
}

$notification = new EmailNotification('developer@website.com');

sendWarningNotification($notification);

$slackApi = new SlackApi('developer@website.com', 'XX77W8veEER33423d');
$notification = new SlackNotification($slackApi, "Xfr77r43rWWerjf8");
sendWarningNotification($notification);
