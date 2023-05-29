<?php

namespace App\Services\Debt;

use App\Models\Debt;
use App\Models\DebtPayment;
use Illuminate\Support\Facades\Validator;

class DebtService
{
    public function getAllEmployeeDebts()
    {
        $debts = Debt::with(['employee', 'debtPayments'])->get();
        return [
            'code' => 200,
            'message' => 'Berhasil mendapatkan data',
            'data' => $debts
        ];
    }
    public function getDebt($id)
    {
        $debts = Debt::find($id)->load(['employee', 'debtPayments']);
        return [
            'code' => 200,
            'message' => 'Berhasil mendapatkan data',
            'data' => $debts
        ];
    }
    public function createDebt($attr)
    {
        $validator = Validator::make($attr, [
            'nip' => 'required',
            'tanggal' => 'required',
            'hutang' => 'required'
        ]);
        if ($validator->fails()) {
            return [
                'code' => 422,
                'message' => 'Data yang diberikan tidak valid',
                'errors' => $validator->errors()
            ];
        }
        $debt = Debt::create([
            'employee_nip' => $attr['nip'],
            'tanggal' => $attr['tanggal'],
            'hutang' => $attr['hutang']
        ]);
        if ($debt) {
            return [
                'code' => 201,
                'message' => 'Hutang berhasil ditambah',
                'data' => $debt
            ];
        }
    }
    public function payDebt($attr)
    {
        $validator = Validator::make($attr, [
            'nip' => 'required',
            'debt_id' => 'required',
            'tanggal' => 'required',
            'cicilan' => 'required'
        ]);
        if ($validator->fails()) {
            return [
                'code' => 422,
                'message' => 'Data yang diberikan tidak valid',
                'errors' => $validator->errors()
            ];
        }
        $debtPayment = DebtPayment::create([
            'employee_nip' => $attr['nip'],
            'debt_id' => $attr['debt_id'],
            'tanggal' => $attr['tanggal'],
            'cicilan' => $attr['cicilan']
        ]);
        if ($debtPayment) {
            return [
                'code' => 201,
                'message' => 'Cicilan berhasil dibayar',
                'data' => $debtPayment
            ];
        }
    }
    public function deleteDebt($id)
    {
        $deleted = Debt::find($id)->delete();
        if ($deleted) {
            return [
                'code' => 204,
                'message' => 'Hutang berhasil dihapus'
            ];
        }
    }
    public function deleteDebtPayment($id)
    {
        $deleted = DebtPayment::find($id)->delete();
        if ($deleted) {
            return [
                'code' => 204,
                'message' => 'Cicilan berhasil dihapus'
            ];
        }
    }
}