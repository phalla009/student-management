<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Payments;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function index(): View
    {
        $payments = Payments::with('enrollment')->get();
        return view('payments.index')->with('payments', $payments);
    }

    public function create(): View
    {
        $enrollments = Enrollment::all();
        return view('payments.create', compact('enrollments'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'enrollment_id' => 'required|integer|exists:enrollments,id',
            'paid_date' => 'required|date',
            'amount' => 'required|numeric',
        ]);

        Payments::create($validated);

        return redirect()->route('payments.index')->with('flash_message', 'Payment Added!');
    }

    public function show(string $id): View
    {
        $payment = Payments::findOrFail($id);
        return view('payments.show')->with('payment', $payment);
    }

    public function edit(string $id): View
    {
        $payment = Payments::findOrFail($id);
        $enrollments = Enrollment::all();

        return view('payments.edit', compact('payment', 'enrollments'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'enrollment_id' => 'required|exists:enrollments,id',
            'paid_date' => 'required|date',
            'amount' => 'required|numeric',
        ]);

        $payment = Payments::findOrFail($id);
        $payment->update($validated);

        return redirect()->route('payments.index')->with('flash_message', 'Payment Updated!');
    }
    

    public function destroy(string $id): RedirectResponse
    {
        Payments::destroy($id);
        return redirect()->route('payments.index')->with('flash_message', 'Payment Deleted!');
    }
}
