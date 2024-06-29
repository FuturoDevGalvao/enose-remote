<?php

declare(strict_types=1);

namespace app\resources\utils;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as PHPMailerException;
use Dotenv\Dotenv;
use app\database\entyties\User;

class Email
{
    private string
        $Host,
        $Username,
        $Password,
        $Port,
        $CharSet;

    function __construct()
    {
        Dotenv::createImmutable(__DIR__ . "/../../../")->load();

        $this->Host = $_ENV["MAILTRAP_HOST"];
        $this->Username = $_ENV["MAILTRAP_USERNAME"];
        $this->Password = $_ENV["MAILTRAP_PASSWORD"];
        $this->Port = $_ENV["MAILTRAP_PORT"];
        $this->CharSet = "UTF-8";
    }

    public function senEmail($address, $subject, $body, $altBody, User $user): bool
    {
        $phpmailer = new PHPMailer();

        try {
            $phpmailer->isSMTP();
            $phpmailer->Host = $this->Host;
            $phpmailer->SMTPAuth = true;
            $phpmailer->Username = $this->Username;
            $phpmailer->Password = $this->Password;
            $phpmailer->Port = $this->Port;
            $phpmailer->CharSet = $this->CharSet;

            //Recipients
            $phpmailer->setFrom('from@example.com', 'ENOSE REMOTE');
            $phpmailer->addAddress($address, $user->getName());     //Add a recipient

            //Attachments
            //$phpmailer->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            //$phpmailer->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $phpmailer->isHTML(true);                                  //Set email format to HTML
            $phpmailer->Subject = $subject;
            $phpmailer->Body = $body;
            $phpmailer->AltBody = $altBody;

            return $phpmailer->send();
            echo 'Message has been sent';
        } catch (PHPMailerException $e) {
            echo "Error: " . $e->getMessage();
        }

        return false;
    }
}
