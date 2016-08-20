<?php

namespace App\Console\Commands;

use App\Models\Colecta;
use App\Models\Correo;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class EmailSend extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send emails';

    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        echo date("Y-m-d H:i:s") . " - Empiezo Emails" . PHP_EOL;
        Session::set('idColecta', Colecta::where('activa', 1)->first()->id);
        $emailsAMandar = Correo::where('status', 1)->get();
        foreach ($emailsAMandar as $email) {
            switch ($email->tipo_mail) {
                case 'Bienvenida':
                    $this->sendCorreoBienvenida($email);
                    break;
                case "Editar":
                    $this->sendCorreoEditar($email);
                    break;
                case "ConfirmarEditar":
                    $this->sendCorreoConfirmarEditar($email);
                    break;
                case "ManualDatos":
                    $this->sendCorreoManualDatos($email);
                    break;
                case "CambioPasswordUser":
                    $this->sendCorreoCambioPassword($email);
                    break;
                case "moverVoluntarios":
                    $this->sendCorreoMoverVoluntario($email);
                    break;
                default:
                    break;
            }
        }
        echo date("Y-m-d H:i:s") . " - Termino Emails" . PHP_EOL;
    }

    public function sendCorreoBienvenida($email)
    {
        if ($email) {
            $emailVars = json_decode(base64_decode($email->arr_emailvars), true);
            $vars = compact('emailVars');

            Mail::send('emails.bienvenido', $vars, function ($message) use ($email) {
                $sender = base64_decode($email->arr_sender);
                $sender2 = json_decode($sender, true);
                if (!$sender2) {
                    $sender2 = unserialize($sender);
                }
                $message->from($sender2);

                $to = base64_decode($email->arr_to);
                $to2 = json_decode($to, true);
                if (!$to2) {
                    $to2 = unserialize($to);
                }
                $message->to($to2);

                $message->replyTo($email->arr_replyto);

                $message->subject($email->arr_subject);
            });

            if (count(Mail:: failures()) == 0) {
                $email->status = 2;
                $email->save();
            }
        }
    }

    public function sendCorreoEditar($email)
    {
        if ($email) {
            $emailVars = json_decode(base64_decode($email->arr_emailvars), true);
            $vars = compact('emailVars');

            Mail::send('emails.editar', $vars, function ($message) use ($email) {
                $sender = base64_decode($email->arr_sender);
                $sender2 = json_decode($sender, true);
                if (!$sender2) {
                    $sender2 = unserialize($sender);
                }
                $message->from($sender2);

                $to = base64_decode($email->arr_to);
                $to2 = json_decode($to, true);
                if (!$to2) {
                    $to2 = unserialize($to);
                }
                $message->to($to2);

                $message->replyTo($email->arr_replyto);

                $message->subject($email->arr_subject);
            });

            if (count(Mail:: failures()) == 0) {
                $email->status = 2;
                $email->save();
            }
        }
    }

    public function sendCorreoConfirmarEditar($email)
    {
        if ($email) {
            $emailVars = json_decode(base64_decode($email->arr_emailvars), true);
            $vars = compact('emailVars');

            Mail::send('emails.confirmar_editar', $vars, function ($message) use ($email) {
                $sender = base64_decode($email->arr_sender);
                $sender2 = json_decode($sender, true);

                if (!$sender2) {
                    $sender2 = unserialize($sender);
                }
                $message->from($sender2);

                $to = base64_decode($email->arr_to);
                $to2 = json_decode($to, true);
                if (!$to2) {
                    $to2 = unserialize($to);
                }
                $message->to($to2);

                $message->replyTo($email->arr_replyto);

                $message->subject($email->arr_subject);
            });

            if (count(Mail:: failures()) == 0) {
                $email->status = 2;
                $email->save();
            }
        }
    }


    public function sendCorreoManualDatos($email)
    {
        if ($email) {
            $emailVars = json_decode(base64_decode($email->arr_emailvars), true);
            $vars = compact('emailVars');

            Mail::send('emails.sin_puntos', $vars, function ($message) use ($email) {
                $sender = base64_decode($email->arr_sender);
                $sender2 = json_decode($sender, true);
                if (!$sender2) {
                    $sender2 = unserialize($sender);
                }
                $message->from($sender2);

                $to = base64_decode($email->arr_to);
                $to2 = json_decode($to, true);
                if (!$to2) {
                    $to2 = unserialize($to);
                }
                $message->to($to2);

                $message->replyTo($email->arr_replyto);

                $message->subject($email->arr_subject);
            });

            if (count(Mail:: failures()) == 0) {
                $email->status = 2;
                $email->save();
            }
        }
    }

    public function sendCorreoCambioPassword($email)
    {
        if ($email) {
            $emailVars = json_decode(base64_decode($email->arr_emailvars), true);
            $vars = compact('emailVars');

            Mail::send('emails.password', $vars, function ($message) use ($email) {
                $sender = base64_decode($email->arr_sender);
                $sender2 = json_decode($sender, true);
                if (!$sender2) {
                    $sender2 = unserialize($sender);
                }
                $message->from($sender2);

                $to = base64_decode($email->arr_to);
                $to2 = json_decode($to, true);
                if (!$to2) {
                    $to2 = unserialize($to);
                }
                $message->to($to2);

                $message->replyTo($email->arr_replyto);

                $message->subject($email->arr_subject);
            });

            if (count(Mail:: failures()) == 0) {
                $email->status = 2;
                $email->save();
            }
        }
    }

    public function sendCorreoMoverVoluntario($email)
    {
        if ($email) {
            $emailVars = json_decode(base64_decode($email->arr_emailvars), true);
            $vars = compact('emailVars');

            Mail::send('emails.cambio_punto', $vars, function ($message) use ($email) {
                $sender = base64_decode($email->arr_sender);
                $sender2 = json_decode($sender, true);
                if (!$sender2) {
                    $sender2 = unserialize($sender);
                }
                $message->from($sender2);

                $to = base64_decode($email->arr_to);
                $to2 = json_decode($to, true);
                if (!$to2) {
                    $to2 = unserialize($to);
                }
                $message->to($to2);

                $message->replyTo($email->arr_replyto);

                $message->subject($email->arr_subject);
            });

            if (count(Mail:: failures()) == 0) {
                $email->status = 2;
                $email->save();
            }
        }
    }
}
