<?php

namespace App\Mail;

use App\Models\ElearningAcces;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ElearningCertificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $acces;

    public function __construct(ElearningAcces $acces)
    {
        $this->acces = $acces;
    }

    public function build()
    {
        $email = $this->subject('Votre certificat de formation - DJOK PRESTIGE')
            ->view('emails.elearning.certification');

        // Vérifier que le fichier existe avant de l'attacher
        if (
            $this->acces->certification_file_path &&
            Storage::disk('public')->exists($this->acces->certification_file_path)
        ) {

            $filePath = Storage::disk('public')->path($this->acces->certification_file_path);
            $fileName = 'certificat-djok-prestige-' . $this->acces->nom . '-' . date('Y') . '.pdf';

            $email->attach($filePath, [
                'as' => $fileName,
                'mime' => 'application/pdf',
            ]);
        } else {
            // Loguer une erreur si le fichier n'existe pas
            \Illuminate\Support\Facades\Log::warning('Fichier de certification non trouvé pour l\'accès', [
                'acces_id' => $this->acces->id,
                'file_path' => $this->acces->certification_file_path
            ]);
        }

        return $email;
    }
}
