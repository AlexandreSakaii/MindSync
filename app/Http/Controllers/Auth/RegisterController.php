<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRegistrationForm(Request $request)
    {
        $nome = $request->input('nome');
        $valor = $request->input('valor');
        $quantidadePsicologos = $request->input('quantidade_psicologos');

        return view('auth.register', compact('nome', 'valor', 'quantidadePsicologos'));
    }

    public function register(Request $request)
    {
        Log::info('Register request received', ['request' => $request->all()]);

        try {
            $this->validator($request->all())->validate();
        } catch (\Exception $e) {
            Log::error('Validation failed', ['errors' => $e->getMessage()]);
            return back()->withErrors($e->validator->errors());
        }

        try {
            $user = $this->create($request->all());
            Log::info('User created successfully', ['user' => $user]);
        } catch (\Exception $e) {
            Log::error('User creation failed', ['exception' => $e->getMessage()]);
            return back()->with('error', 'Failed to create user');
        }

        return redirect($this->redirectTo())->with('status', 'User created successfully');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'clinic_name' => ['required', 'string', 'max:255'],
            'cnpj' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'string', 'max:255'],
            'responsible_cpf' => ['required', 'string', 'max:255'],
            'responsible_name' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'cep' => ['required', 'string', 'max:255'],
            'street' => ['required', 'string', 'max:255'],
            'number' => ['required', 'string', 'max:255'],
            'complement' => ['nullable', 'string', 'max:255'],
            'card_name' => ['required', 'string', 'max:255'],
            'card_number' => ['required', 'string', 'max:255'],
            'card_expiration' => ['required', 'string', 'max:255'],
            'cvv' => ['required', 'string', 'max:4'],
            'plan_name' => ['required', 'string', 'max:255'],
            'plan_value' => ['required', 'numeric'],
            'quantidadePsicologos' => ['required', 'numeric'],
        ]);
    }

    protected function create(array $data)
    {
        Log::info('Creating user with data', ['data' => $data]);

        $user = User::create([
            'email' => $data['email'],
            'clinic_name' => $data['clinic_name'],
            'cnpj' => $data['cnpj'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'responsible_cpf' => $data['responsible_cpf'],
            'responsible_name' => $data['responsible_name'],
            'city' => $data['city'],
            'state' => $data['state'],
            'country' => $data['country'],
            'cep' => $data['cep'],
            'street' => $data['street'],
            'number' => $data['number'],
            'complement' => $data['complement'],
            'card_name' => $data['card_name'],
            'card_number' => Hash::make($data['card_number']),
            'card_expiration' => Hash::make($data['card_expiration']),
            'cvv' => Hash::make($data['cvv']),
            'plan_name' => $data['plan_name'],
            'plan_value' => $data['plan_value'],
            'quantidadePsicologos' => $data['quantidadePsicologos'],
        ]);

        Log::info('User creation successful', ['user' => $user]);

        return $user;
    }

    protected function redirectTo()
    {
        return '/';
    }
}
