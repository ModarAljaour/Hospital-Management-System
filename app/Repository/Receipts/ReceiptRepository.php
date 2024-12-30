<?php

namespace App\Repository\Receipts;

use App\Interfaces\Receipts\ReceiptRepositoryInterface;
use App\Models\FundAccount;
use App\Models\Patient;
use App\Models\PatientAccount;
use App\Models\ReceiptAccount;
use Illuminate\Support\Facades\DB;

class ReceiptRepository implements ReceiptRepositoryInterface
{
    public function index()
    {
        $receipts = ReceiptAccount::all();
        return view('Dashboard.Receipt.index', compact('receipts'));
    }

    public function create()
    {
        $Patients = Patient::whereHas('invoice', function ($query) {
            $query->whereIn('type', [1, 2]);
        })
            ->with(['invoice' => function ($query) {
                $query->select('patient_id', 'type', 'total_with_tax');
            }])
            ->withSum('invoice as total_due', 'total_with_tax') // يجمع مجموع المبالغ على المريض
            ->withSum('receipt_accounts as total_paid', 'Debit') // يجمع مجموع المبالغ المدفوعة من المريض
            ->get();
        // dd($Patients);
        return view('Dashboard.Receipt.add', compact('Patients'));
    }

    // store Receipts
    public function store($request)
    {
        DB::beginTransaction();
        try {

            $receipts = new ReceiptAccount();
            $receipts->date = date('Y-m-d');
            $receipts->patient_id = $request->patient_id;
            $receipts->Debit = $request->Debit;
            $receipts->save();

            $receipts->description = $request->description;
            $receipts->save();

            $fund_account = new FundAccount();
            $fund_account->date = date('Y-m-d');
            $fund_account->receipt_id = $receipts->id;
            $fund_account->Debit = $receipts->Debit;
            $fund_account->credit = 0.00;
            $fund_account->save();


            $patient = new PatientAccount();
            $patient->date = date('y-m-d');
            $patient->patient_id = $request->patient_id;
            $patient->receipt_id = $receipts->id;
            $patient->Debit = 0.00;
            $patient->credit = $request->Debit;
            $patient->save();

            DB::commit();

            return redirect()->route('receipt.index')->with('success', 'receipt add successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    // Edit Receipts
    public function edit($id)
    {
        $receipt_accounts = ReceiptAccount::findOrFail($id);
        $Patients = Patient::whereHas('singleInvoice', function ($query) {
            $query->where('type', 2);
        })
            ->with(['singleInvoice' => function ($query) {
                $query->select('patient_id', 'type');
            }])
            ->get();
        return view('Dashboard.Receipt.edit', compact(['receipt_accounts', 'Patients']));
    }

    // show Receipts
    public function show($id)
    {
        $receipt = ReceiptAccount::findOrFail($id);
        return view('Dashboard.Receipt.print', compact(['receipt']));
    }
    // update Receipts
    public function update($request, $id)
    {
        DB::beginTransaction();
        try {

            $receipts = ReceiptAccount::findOrFail($id);
            $receipts->date = date('Y-m-d');
            $receipts->patient_id = $request->patient_id;
            $receipts->Debit = $request->Debit;
            $receipts->save();

            $receipts->description = $request->description;
            $receipts->save();

            $fund_account = FundAccount::where('receipt_id', $request->id)->first();
            $fund_account->date = date('Y-m-d');
            $fund_account->receipt_id = $receipts->id;
            $fund_account->Debit = $receipts->Debit;
            $fund_account->credit = 0.00;
            $fund_account->save();


            $patient = PatientAccount::where('receipt_id', $request->id)->first();
            $patient->date = date('y-m-d');
            $patient->patient_id = $request->patient_id;
            $patient->receipt_id = $receipts->id;
            $patient->Debit = 0.00;
            $patient->credit = $request->Debit;
            $patient->save();

            DB::commit();

            return redirect()->route('receipt.index')->with('success', 'receipt add successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    // destroy Receipts
    public function destroy($id)
    {
        try {
            ReceiptAccount::destroy($id);
            session()->flash('delete');
            return redirect()->back();
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
