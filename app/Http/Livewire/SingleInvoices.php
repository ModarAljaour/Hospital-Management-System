<?php

namespace App\Http\Livewire;

use App\Events\CreateInvoice;
use App\Events\MyEvent;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\FundAccount;
use App\Models\Invoice;
use App\Models\Notification;
use App\Models\Patient;
use App\Models\PatientAccount;
use App\Models\Service;
use App\Models\SingleInvoice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class SingleInvoices extends Component
{

    public $InvoiceSaved, $InvoiceUpdated;
    public $show_table = true;
    public $tax_rate = 17;
    public $updateMode = false;
    public $price, $discount_value = 0;
    public $patient_id, $doctor, $section_id, $doctor_id;
    public $type;
    public $username;
    public $service_id, $single_invoices_id, $catchError;



    public function mount()
    {
        $this->username = auth()->user()->id;
    }

    public function render()
    {
        return view('livewire.single-invoices.single-invoices', [
            'single_invoices' => Invoice::where("invoice_type", 1)->get(),
            'Patients' => Patient::all(),
            'Doctors' => Doctor::all(),
            'Services' => Service::all(),
            'subtotal' => $Total_after_discount = ((is_numeric($this->price) ? $this->price : 0)) - ((is_numeric($this->discount_value) ? $this->discount_value : 0)),
            'tax_value' => $Total_after_discount * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100)
        ]);
    }

    public function show_form_add()
    {
        $this->show_table = false;
    }

    public function get_section()
    {
        $doctor = Doctor::with('section')->where('id', $this->doctor)->first();
        $this->section_id = $doctor->section->name;
    }

    public function get_price()
    {
        $this->price = Service::where('id', $this->service_id)->first()->price;
    }

    public function print($id)
    {
        $single_invoice = Invoice::findOrFail($id);
        return Redirect::route('single-invoices.print', [
            'invoice_date' => $single_invoice->invoice_date,
            'doctor_id' => $single_invoice->Doctor->name,
            'section_id' => $single_invoice->Section->name,
            'Service_id' => $single_invoice->Service->name,
            'type' => $single_invoice->type,
            'price' => $single_invoice->price,
            'discount_value' => $single_invoice->discount_value,
            'tax_rate' => $single_invoice->tax_rate,
            'total_with_tax' => $single_invoice->total_with_tax,
        ]);
    }

    public function edit($id)
    {
        $this->show_table = false;
        $this->updateMode = true;
        $single_invoice = Invoice::findOrFail($id);
        $this->single_invoices_id = $single_invoice->id;
        $this->patient_id = $single_invoice->patient_id;
        $this->doctor = $single_invoice->doctor_id;
        $this->section_id = DB::table('section_translations')->where('id', $single_invoice->section_id)->first()->name;
        $this->service_id = $single_invoice->service_id;
        $this->price = $single_invoice->price;
        $this->discount_value = $single_invoice->discount_value;
        $this->type = $single_invoice->type;
    }
    public function store()
    {
        // في حال نقدي
        if ($this->type == 1) {

            DB::beginTransaction();
            try {

                if ($this->updateMode) {
                    $single_invoices = Invoice::findOrFail($this->single_invoices_id);
                    $single_invoices->invoice_type = 1;
                    $single_invoices->invoice_date = date('Y-m-d');
                    $single_invoices->patient_id = $this->patient_id;
                    $single_invoices->doctor_id = $this->doctor;
                    $single_invoices->section_id = DB::table('section_translations')->where('name', $this->section_id)->first()->section_id;
                    $single_invoices->service_id = $this->service_id;
                    $single_invoices->price = $this->price;
                    $single_invoices->discount_value = $this->discount_value;
                    $single_invoices->tax_rate = $this->tax_rate;
                    // قيمة الضريبة = السعر - الخصم * نسبة الضريبة /100
                    $single_invoices->tax_value = ($this->price - $this->discount_value) * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100);
                    // الاجمالي شامل الضريبة  = السعر - الخصم + قيمة الضريبة
                    $single_invoices->total_with_tax = $single_invoices->price -  $single_invoices->discount_value + $single_invoices->tax_value;
                    $single_invoices->type = $this->type;
                    $single_invoices->invoice_status = 1;
                    $single_invoices->save();

                    // after saving single invoices it will save in found account
                    $fund_accounts = FundAccount::where('invoice_id', $this->single_invoices_id)->first();
                    $fund_accounts->date = date('Y-m-d');
                    $fund_accounts->invoice_id = $single_invoices->id;
                    $fund_accounts->Debit = $single_invoices->total_with_tax;
                    $fund_accounts->credit = 0.00;
                    $fund_accounts->save();

                    $this->InvoiceSaved = true;
                    $this->show_table = true;
                } else {
                    $single_invoices = new Invoice();
                    $single_invoices->invoice_type = 1;
                    $single_invoices->invoice_date = date('Y-m-d');
                    $single_invoices->patient_id = $this->patient_id;
                    $single_invoices->doctor_id = $this->doctor;
                    $single_invoices->section_id = DB::table('section_translations')->where('name', $this->section_id)->first()->section_id;
                    $single_invoices->service_id = $this->service_id;
                    $single_invoices->price = $this->price;
                    $single_invoices->discount_value = $this->discount_value;
                    $single_invoices->tax_rate = $this->tax_rate;
                    // قيمة الضريبة = السعر - الخصم * نسبة الضريبة /100
                    $single_invoices->tax_value = ($this->price - $this->discount_value) * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100);
                    // الاجمالي شامل الضريبة  = السعر - الخصم + قيمة الضريبة
                    $single_invoices->total_with_tax = $single_invoices->price -  $single_invoices->discount_value + $single_invoices->tax_value;
                    $single_invoices->type = $this->type;
                    $single_invoices->invoice_status = 1;
                    $single_invoices->save();

                    // after saving single invoices it will save in found account
                    $fund_accounts = new FundAccount();
                    $fund_accounts->date = date('Y-m-d');
                    $fund_accounts->invoice_id = $single_invoices->id;
                    $fund_accounts->Debit = $single_invoices->total_with_tax;
                    $fund_accounts->credit = 0.00;
                    $InvoiceSaved = true;
                    $fund_accounts->save();
                    $this->InvoiceSaved = true;
                    $this->show_table = true;

                    $patient = Patient::findorfail($this->patient_id);
                    $appointment_info = Appointment::where('doctor_id', $this->doctor)->where("email", $patient->email)->where('type', 'مؤكد')->first();
                    if ($appointment_info) {
                        $appointment = Appointment::findorfail($appointment_info->id);
                        $appointment->update([
                            'type' => 'منتهي'
                        ]);
                    }

                    // pusher config :
                    $notifications = new Notification();
                    $notifications->user_id = $this->doctor;
                    $patient = Patient::find($this->patient_id);
                    $notifications->message = " كشف جديد : " . $patient->name;
                    $notifications->save();
                    $data = [
                        'patient' => $this->patient_id,
                        'invoice_id' => $single_invoices->id,
                        'doctor_id' => $this->doctor,
                    ];
                    event(new CreateInvoice($data));
                }
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                $this->catchError = $e->getMessage();
            }
            // في حال كانت الفاتورة اجل
        } else {

            DB::beginTransaction();
            try {
                if ($this->updateMode) {
                    // حفظ في حسابات المريض
                    $single_invoices = Invoice::findOrFail($this->single_invoices_id);
                    $single_invoices->invoice_type = 1;
                    $single_invoices->invoice_date = date('Y-m-d');
                    $single_invoices->patient_id = $this->patient_id;
                    $single_invoices->doctor_id = $this->doctor;
                    $single_invoices->section_id = DB::table('section_translations')->where('name', $this->section_id)->first()->section_id;
                    $single_invoices->service_id = $this->service_id;
                    $single_invoices->price = $this->price;
                    $single_invoices->discount_value = $this->discount_value;
                    $single_invoices->tax_rate = $this->tax_rate;
                    // قيمة الضريبة = السعر - الخصم * نسبة الضريبة /100
                    $single_invoices->tax_value = ($this->price - $this->discount_value) * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100);
                    // الاجمالي شامل الضريبة  = السعر - الخصم + قيمة الضريبة
                    $single_invoices->total_with_tax = $single_invoices->price -  $single_invoices->discount_value + $single_invoices->tax_value;
                    $single_invoices->type = $this->type;
                    $single_invoices->invoice_status = 1;
                    $single_invoices->save();

                    // حفظ في جدول الحسابات
                    $patient_accounts = PatientAccount::where('single_invoices_id', $this->single_invoices_id)->first();
                    $patient_accounts->date = date('Y-m-d');
                    $patient_accounts->invoice_id = $single_invoices->id;
                    $patient_accounts->patient_id = $single_invoices->patient_id;
                    $patient_accounts->Debit = $single_invoices->total_with_tax;
                    $patient_accounts->credit = 0.00;
                    $patient_accounts->save();
                    $this->InvoiceSaved = true;
                    $this->show_table = true;
                } else {
                    // حفظ في حسابات المريض
                    $single_invoices = new Invoice();
                    $single_invoices->invoice_type = 1;
                    $single_invoices->invoice_date = date('Y-m-d');
                    $single_invoices->patient_id = $this->patient_id;
                    $single_invoices->doctor_id = $this->doctor;
                    $single_invoices->section_id = DB::table('section_translations')->where('name', $this->section_id)->first()->section_id;
                    $single_invoices->service_id = $this->service_id;
                    $single_invoices->price = $this->price;
                    $single_invoices->discount_value = $this->discount_value;
                    $single_invoices->tax_rate = $this->tax_rate;
                    // قيمة الضريبة = السعر - الخصم * نسبة الضريبة /100
                    $single_invoices->tax_value = ($this->price - $this->discount_value) * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100);
                    // الاجمالي شامل الضريبة  = السعر - الخصم + قيمة الضريبة
                    $single_invoices->total_with_tax = $single_invoices->price -  $single_invoices->discount_value + $single_invoices->tax_value;
                    $single_invoices->type = $this->type;
                    $single_invoices->invoice_status = 1;
                    $single_invoices->save();

                    // حفظ في جدول الحسابات
                    $patient_accounts = new PatientAccount();
                    $patient_accounts->date = date('Y-m-d'); 
                    $patient_accounts->invoice_id = $single_invoices->id;
                    $patient_accounts->patient_id = $single_invoices->patient_id;
                    $patient_accounts->Debit = $single_invoices->total_with_tax;
                    $patient_accounts->credit = 0.00;
                    $patient_accounts->save();
                    $this->InvoiceSaved = true;
                    $this->show_table = true;

                    //  check patients
                    $patient = Patient::findorfail($this->patient_id);

                    $appointment_info = Appointment::where('type', 'مؤكد')->where('email', $patient->email)->where('doctor_id', $this->doctor)->first();

                    //                     dd($appointment_info);
                    if ($appointment_info) {
                        $appointment = Appointment::findorfail($appointment_info->id);
                        $appointment->update([
                            'type' => 'منتهي'
                        ]);
                    }


                    // // pusher config :
                    // $notifications = new Notification();
                    // $notifications->user_id = $this->doctor;
                    // $patient = Patient::find($this->patient_id);
                    // $notifications->message = " كشف جديد : " . $patient->name;
                    // $notifications->save();
                    // $data = [
                    //     'patient' => $this->patient_id,
                    //     'invoice_id' => $single_invoices->id,
                    //     'doctor_id' => $this->doctor,
                    // ];
                    // event(new CreateInvoice($data));


                }
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
        }
    }

    public function setInvoiceId($id)
    {
        $this->single_invoices_id = $id;
    }

    public function destroy()
    {
        try {
            Invoice::destroy($this->single_invoices_id);
            return redirect()->to('single-invoices');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
