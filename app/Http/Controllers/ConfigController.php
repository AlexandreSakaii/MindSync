<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Log;

class ConfigController extends Controller
{
    public function updateEmail(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|confirmed|unique:users,email,'.$user->id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user->email = $request->input('email');
        $user->save();

        return redirect()->back()->with('success', 'Email atualizado com sucesso.');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user->password = Hash::make($request->input('password'));
        $user->save();

        return redirect()->back()->with('success', 'Senha atualizada com sucesso.');
    }

    public function addPaymentMethod(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'card_name' => 'required|string|max:255',
            'card_number' => 'required|string|max:255',
            'card_expiration' => 'required|string|max:255',
            'cvv' => 'required|string|max:4',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $cardNumberEncrypted = Crypt::encryptString($request->input('card_number'));
            $cardExpirationEncrypted = Crypt::encryptString($request->input('card_expiration'));
            $cvvEncrypted = Crypt::encryptString($request->input('cvv'));

            Log::info('Encrypted card data', [
                'card_number' => $cardNumberEncrypted,
                'card_expiration' => $cardExpirationEncrypted,
                'cvv' => $cvvEncrypted,
            ]);

            PaymentMethod::create([
                'user_id' => $user->id,
                'card_name' => $request->input('card_name'),
                'card_number' => $cardNumberEncrypted,
                'card_expiration' => $cardExpirationEncrypted,
                'cvv' => $cvvEncrypted,
            ]);

            Log::info('Payment method added successfully');
        } catch (\Exception $e) {
            Log::error('Failed to encrypt payment method data', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Failed to add payment method');
        }

        return redirect()->back()->with('success', 'Método de pagamento adicionado com sucesso.');
    }

    public function showConfig()
    {
        $user = Auth::user();
        $paymentMethods = $user->paymentMethods->map(function ($paymentMethod) {
            try {
                $cardNumber = Crypt::decryptString($paymentMethod->card_number);
                $cardExpiration = Crypt::decryptString($paymentMethod->card_expiration);
                $cvv = Crypt::decryptString($paymentMethod->cvv);

                Log::info('Decrypted card data successfully', [
                    'card_number' => $cardNumber,
                    'card_expiration' => $cardExpiration,
                    'cvv' => $cvv,
                ]);

                return [
                    'id' => $paymentMethod->id,
                    'card_name' => $paymentMethod->card_name,
                    'card_number' => $cardNumber,
                    'card_expiration' => $cardExpiration,
                    'cvv' => $cvv,
                ];
            } catch (\Exception $e) {
                Log::error('Failed to decrypt payment method data', ['error' => $e->getMessage()]);
                return null;
            }
        })->filter();

        return view('configuracao', compact('paymentMethods'));
    }

    private function getCardBrand($cardNumber)
    {
        $firstDigit = substr($cardNumber, 0, 1);
        $firstTwoDigits = substr($cardNumber, 0, 2);

        switch ($firstDigit) {
            case '3':
                return in_array($firstTwoDigits, ['34', '37']) ? 'American Express' : 'Diners Club';
            case '4':
                return 'Visa';
            case '5':
                return 'Mastercard';
            case '6':
                return 'Discover';
            default:
                return 'Desconhecido';
        }
    }

    public function updateClinicData(Request $request)
    {
        $user = Auth::user();

        $data = $request->only([
            'clinic_name',
            'cnpj',
            'phone',
            'responsible_name',
            'responsible_cpf'
        ]);

        $validator = Validator::make($data, [
            'clinic_name' => 'nullable|string|max:255',
            'cnpj' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'responsible_name' => 'nullable|string|max:255',
            'responsible_cpf' => 'nullable|string|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        foreach ($data as $key => $value) {
            if ($value) {
                $user->$key = $value;
            }
        }

        $user->save();

        return redirect()->back()->with('success', 'Dados da clínica atualizados com sucesso.');
    }

    public function updateClinicAddress(Request $request)
    {
        $user = Auth::user();

        $data = $request->only([
            'cep',
            'street',
            'number',
            'complement',
            'city',
            'state',
            'country'
        ]);

        $validator = Validator::make($data, [
            'cep' => 'nullable|string|max:255',
            'street' => 'nullable|string|max:255',
            'number' => 'nullable|string|max:255',
            'complement' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        foreach ($data as $key => $value) {
            if ($value) {
                $user->$key = $value;
            }
        }

        $user->save();

        return redirect()->back()->with('success', 'Dados de endereço da clínica atualizados com sucesso.');
    }


}
