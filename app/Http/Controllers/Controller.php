<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Mail;
use Intervention\Image\ImageManagerStatic as Image;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function uploadFile($requestFile, $path)
    {
        $status = true;
        $extension = $requestFile->extension();
        $newFileName = uniqid('file_') . '.' . $extension;
        try {
            $requestFile->storeAs($path, $newFileName);
        } catch(\Exception $e) {
            $newFileName = $e->getMessage();
            $status = false;
        }
        
        return [
            'status' => $status,
            'file_name' => $newFileName
        ];
    }

    public function uploadFileAsp($requestFile, $path, $width = null, $height = null)
    {
        $status = true;
        $errorMessage = null;
        $extension = $requestFile->extension();
        $newFileName = uniqid('file_') . '.' . $extension;
        try {
            $resize = Image::make($requestFile->getRealPath());
            $resize->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
            //$resize->insert('images/qrcode.png', 'bottom-right', 10, 10);
            $resize->save(storage_path($path . '/'. $newFileName));
        } catch(\Exception $e) {
            $errorMessage = $e->getMessage();
            $status = false;
        }

        return [
            'status' => $status,
            'file_name' => $newFileName,
            'error_message' => $errorMessage
        ];
    }

    public function showImage($path = null, $fileName = '120.png') 
    {
        $pathToFile = storage_path($path .'/'. $fileName);
        if (!file_exists($pathToFile)) {
            $pathToFile = "images/120.png";
        }

        return response()->file($pathToFile);
    }

    public function showFile($path = null, $fileName = null) 
    {
        $pathToFile = storage_path('app/' . $path .'/'. $fileName);
        if (file_exists($pathToFile)) {
            return response()->file($pathToFile);
        }

        return "file notfound";
    }

    public function sendMail($data, $template)
    {
        $sendMal = Mail::send($template, ['data' => $data], function($mail) use ($data) {
            $mail->from('dekcomcr@gmail.com', 'Dekcomcr Team');
            $mail->to($data['to_email'], $data['to_name']);
            $mail->cc('mytepper@gmail.com', 'Dekcomcr Team');
            $mail->replyTo('dekcomcr@gmail.com', 'Dekcomcr Team');
            $mail->subject($data['subject']);
        });

        return (Mail::failures()) ? false : true;
    }
}
