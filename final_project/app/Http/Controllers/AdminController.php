<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\View\View;


class AdminController extends Controller
{
    public function showAccountManagement()
    {
        $accounts = Account::all();
        return view('admin.accountmanagement', compact('accounts'));
    }

    public function showUserDashboard()
    {
      return view('profile.dashboard');
    }
    public function index()
    {
        return view('admin.dashboard');
    }
    public function showLogin()
    {
        return view('auth.login');
    }
    public function updateAccount(Request $request, $id)
    {
      $accounts = Account::find($id);
      if ($accounts) {
        $accounts->username = $request->input('username');
        $accounts->email = $request->input('email');
        $accounts->password = bcrypt($request->input('password'));
        $accounts->usertype = $request->input('usertype');
        $accounts->phone = $request->input('phone');
        $accounts->save();
        showAccountManagement();
        return response()->json(['message' => 'Account updated successfully']);
      } else {
        return response()->json(['message' => 'Account not found'], 404);
      }
    }
    public function deleteAccount(Request $request, $id)
{
  $account = Account::find($id);
  if ($account) {
    $account->delete();
    return response()->json(['message' => 'Account deleted successfully']);
  } else {
    return response()->json(['message' => 'Account not found'], 404);
  }
}
}


