<?php

interface NotifierInterface {
    public function send(string $message): void;
}

class Notifier implements NotifierInterface {
    public function send(string $message): void
    {
        echo "Email sent: $message\n";
    }
}

class BaseDecorator extends Notifier {
    protected Notifier $wrappee;

    public function __construct(Notifier $notifier)
    {
        $this->wrappee = $notifier;
    }

    public function send(string $message): void
    {
        $this->wrappee->send($message);
    }
}

class SlackDecorator extends BaseDecorator {
    public function send(string $message): void
    {
        parent::send($message);

        echo "Slack message sent: $message\n";
    }
}

class SmsDecorator extends BaseDecorator {
    public function send(string $message): void
    {
        parent::send($message);

        echo "Sms sent: $message\n";
    }
}

$notifier = new Notifier();
$notifier = new SlackDecorator($notifier);

$notifier->send('Hello world');

$notifier2 = new Notifier();
$notifier2 = new SmsDecorator($notifier2);

$notifier2->send('Hi');
