<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;

class EmailService
{
    public function sendEmail($subject, $toEmail, $toName, $isHtml = false, $message)
    {
        // Configuration du mail
        $data = ['message' => $message];

        Mail::send([], $data, function ($mail) use ($subject, $toEmail, $toName, $message, $isHtml) {
            $mail->to($toEmail, $toName)
                 ->subject($subject);

            // Définit le contenu du mail (HTML ou texte simple)
            if ($isHtml) {
                $mail->setBody($message, 'text/html');
            } else {
                $mail->setBody($message, 'text/plain');
            }
        });
    }
}
