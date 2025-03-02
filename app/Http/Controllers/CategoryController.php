<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\transfer;
use App\Models\transaction;
use Illuminate\Http\Request;
use App\Models\TransactionType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user()->id;
        $transaction = Transaction::where('user_id', $user)->get();
        $categories = Category::whereNull('user_id')->orWhere('user_id', $user)->get()->map(function ($category) use ($user) {
            $incomeAmount = Transaction::where('category_id', $category->id)
                ->whereHas('transactionType', function ($query) {
                    $query->where('name', 'Income');
                })
                ->where('user_id', $user)
                ->sum('amount');
    
            $expenseAmount = Transaction::where('category_id', $category->id)
                ->whereHas('transactionType', function ($query) {
                    $query->where('name', 'Expense');
                })
                ->where('user_id', $user)
                ->sum('amount');

            $tranferIn = Transfer::where('to_wallet_id', $category->id)
                ->where('user_id', $user)
                ->sum('amount');
            $tranferOut = Transfer::where('wallet_id', $category->id)
                ->where('user_id', $user)
                ->sum('amount');
                
            $category->incomeAmount = $incomeAmount + $tranferIn;
            $category->expenseAmount = $expenseAmount + $tranferOut;
            $category->remainingBalance = ($incomeAmount - $expenseAmount) + ($tranferIn - $tranferOut);
    
            return $category;
        });
        $income =  TransactionType::where('name', 'Income')->first();
        $incomeAmount = Transaction::where('transaction_type_id', $income->id)->sum('amount');
        // dd($income);
        $expense =  TransactionType::where('name', 'Expense')->first();
        $expenseAmount = Transaction::where('transaction_type_id', $expense->id)->sum('amount');
        return view('pages.category.index', compact(
            'categories',
            'incomeAmount',
            'expenseAmount',
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user()->id;
        $categories = category::whereNull('user_id')->orWhere('user_id', $user)->get();
        session(['user_id' => $user]);
        return view('pages.category.create', compact(
            'categories',
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge([
            'user_id' => session('user_id'),
        ]);

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:15',
            'cover' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            'user_id' => 'required',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }

        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $path = $file->storeAs('covers', "Icon-{$request->name}.{$file->extension()}", 'public');
        }
        

        category::create([
            'name' => $request->name,
            'cover' => $path,
            'user_id' => $request->user_id
        ]);
        return redirect()->route('category.create')->with('success', 'Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    $category = Category::findOrFail($id);
    $filePath = $category->cover;

    $request->merge([
        'user_id' => session('user_id'),
    ]);

    $validator = Validator::make($request->all(), [
        'name' => 'required|max:15',
        'cover' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
        'user_id' => 'required',
    ]);
    
    if ($validator->fails()) {
        return redirect()->back()
        ->withErrors($validator)
        ->withInput();
    }

    if ($request->hasFile('cover')) {
        // Hapus file lama jika ada
        if ($category->cover) {
            Storage::delete('public/' . $category->cover);
        }
        // Simpan file baru
        $file = $request->file('cover');
        $path = $file->storeAs('covers', "Icon-{$request->name}.{$file->extension()}", 'public');
        
        $filePath = $path;
    }

    $category->update([
        'name' => $request->name,
        'cover' => $filePath,
        'user_id' => $request->user_id
    ]);
    return redirect()->route('category.create')->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

    return redirect()->route('category.create')->with('success', 'Category deleted successfully');
    }
}
