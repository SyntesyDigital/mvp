<?php

namespace Modules\RRHH\Jobs;

use Modules\RRHH\Entities\Tools\EmailTemplate;
use Blade;
use Mail;

class SendEmailTemplate
{
    private $identifier;
    private $data;
    private $email;

    public function __construct($identifier, $email, $data = [], $file = null)
    {
        $this->identifier = $identifier;
        $this->data = $data;
        $this->email = $email;
        $this->file = $file;
    }

    public static function render($string, $data)
    {
        $obLevel = ob_get_level();
        ob_start();
        extract($data, EXTR_SKIP);

        try {
            eval('?'.'>'.Blade::compileString($string));
        } catch (Exception $e) {
            while (ob_get_level() > $obLevel) {
                ob_end_clean();
            }
            throw $e;
        } catch (Throwable $e) {
            while (ob_get_level() > $obLevel) {
                ob_end_clean();
            }
            throw new FatalThrowableError($e);
        }

        return ob_get_clean();
    }

    public function handle()
    {
        $template = EmailTemplate::where('identifier', $this->identifier)->first();

        if (! $template) {
            throw new \Exception('Template '.$this->identifier.' not exist');
        }

        $body = $this->render(htmlspecialchars_decode($template->body), $this->data);
        $subject = $this->render(htmlspecialchars_decode($template->subject), $this->data);
        $email = $this->email;
        $file = $this->file;

        Mail::send('bwo::emails.template', [
            'body' => $body,
        ], function ($message) use ($subject, $email, $body, $file) {
            $message
                ->to($email)
                ->subject($subject);

            $filePath = isset($file['path']) ? $file['path'] : null;

            if ($filePath) {
                $fileName = isset($file['name']) ? [
                    'as' => $file['name'],
                ] : null;

                $message->attach($filePath, $fileName);
            }
        });

        return true;
    }
}
