<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Email;
use App\Models\EmailLog;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Email::all();
    }

 
    /** 
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $validated = $request->validate([
                'subject' => 'required|string',
                'to' => 'required|array|min:1',
                'to.*'=>'email',
                'cc' => 'nullable|array',
                'cc.*'=>'email',
                'bcc' => 'nullable|array',
                'bcc.*'=> 'email',
                'body' => 'required|string',
                'attachments'=> 'nullable|array',
                'attachments.*.file_name'=>'required_with:attachments|string',
                'attachments.*.file_data'=>'required_with:attachments|string',
                'user_id'=> 'required|integer',
                'user_name'=> 'required|string',
                'system_name'=> 'required|string',
            ]);
            
            $savedattachments = [];

            if(!empty($validated['attachments'])) {
                foreach ($validated['attachments'] as $attachments) {
                    $fileName = $attachments['file_name'];
                    $fileData = base64_decode($attachments['file_data']);

                    $uniquename = uniqid() . '_' . $fileName;
                    $filePath = 'public/attachments/' . $uniquename;

                    Storage::put($filePath, $fileData);

                    $savedattachments = [
                        'file_name' => $fileName,
                        'path' => $filePath,
                    ];
                }

                $validated['attachments'] = $savedattachments;
            }

            $email = Email::create($validated);

            EmailLog::create([
                'status'=> 'success',
                'log_message'=> 'Email enviado e salvo com sucesso.',
                'email_id' => $email->id,
            ]);

            return response()->json([
                'status'=> 'success',
                'message'=> 'Email enviado e salvo com sucesso.',
                'email_id'=> $email->id,
            ], 200);   
           
        } catch(ValidationException $e){
            $errors = $e->errors();

            EmailLog::create([
                'email_id'=>null,
                'status'=> 'error',
                'log_message' =>'Erro de validação nos dados de e-mail: ' . json_encode($errors),
            ]);

            return response()->json([
                'status'=>'error',
                'message'=>'Dados invalidos ou ausentes.',
                'errors'=> $errors,
            ], 400);

        } catch (\Exception $e) {
            EmailLog::create([
                'email_id' => $email->id ?? null,
                'status' => 'error',
                'log_message' => 'Erro ao enviar e-mail:' . $e->getMessage(),
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Falha ao enviar e-mail.',
                'error' => $e->getMessage(),
            ], 500);
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $user_name)
    {
        return Email::where('user_name', $user_name)->firstOrFail();
    }



}
