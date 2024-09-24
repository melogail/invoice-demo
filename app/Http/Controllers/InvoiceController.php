<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paginateNumber = request()->query('paginate') ?? 10;

        // In case of API
        if (request()->wantsJson()) {
            return InvoiceResource::collection(Invoice::with('user')->filter([
                                                                                   'invoice_status_filter'     => request()->query('status'),
                                                                                   'invoice_total_filter'      => request()->query('total'),
                                                                                   'invoice_created_at_filter' => request()->query('created_at'),
                                                                                   'invoice_customer_filter'   => request()->query('customer'),
                                                                               ])->paginate($paginateNumber));
        }

        return inertia('Invoices/Index', [
            'invoices' => InvoiceResource::collection(Invoice::with('user')->filter([
                                                                                        'invoice_status_filter'     => request()->query('status'),
                                                                                        'invoice_total_filter'      => request()->query('total'),
                                                                                        'invoice_created_at_filter' => request()->query('created_at'),
                                                                                        'invoice_customer_filter'   => request()->query('customer'),
                                                                                    ])->paginate($paginateNumber)),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Invoices/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvoiceRequest $request)
    {
        $request->validated();

        auth()->user()->invoices()->create($request->validated());

        // In case of API
        if ($request->wantsJson()) {
            return response()->json([
                                        'status'  => 'success',
                                        'message' => 'Invoice created successfully',
                                    ]);
        }

        return to_route('invoices.index')->with('success', 'Invoice created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        if (request()->wantsJson()) {
            return response()->json(InvoiceResource::make($invoice->load('user')));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * InvoiceUpdate the specified resource in storage.
     */
    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        $request->validated();

        // In case of API
        $invoice->update($request->validated());
        if ($request->wantsJson()) {
            return response()->json([
                                        'status'  => 'success',
                                        'message' => 'Invoice updated successfully',
                                    ]);
        }

        return to_route('invoices.index')->with('success', 'Invoice updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        Gate::authorize('forceDelete', $invoice);

        $invoice->forceDelete();

        // In case of API
        if (request()->wantsJson()) {
            return response()->json([
                                        'status'  => 'success',
                                        'message' => 'Invoice deleted successfully',
                                    ]);
        }

        return to_route('invoices.index')->with('success', 'Invoice deleted successfully');
    }
}
