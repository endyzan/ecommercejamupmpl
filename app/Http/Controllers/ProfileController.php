<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Alamat;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
            'alamat' => Alamat::where('id_user', Auth::id())->get(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function addAddress(Request $request)
    {
        $user_id = Auth::id();
        $request->validate([
            'alamat' => 'required|string|max:255',
        ], [
            'alamat.required' => 'Alamat tidak boleh kosong.',
            'alamat.string' => 'Alamat harus berupa teks.',
            'alamat.max' => 'Alamat tidak boleh lebih dari 255 karakter.',
        ]);
        Alamat::create([
            'alamat' => $request->alamat,
            'id_user' => Auth::id(),
        ]);

        return redirect()->back()->with('status', 'alamat-updated');
    }

    public function deleteAddress($id)
    {
        $alamat = Alamat::findOrFail($id);
        if ($alamat->id_user !== Auth::id()) {
            return redirect()->back()->withErrors(['error' => 'Hak Akses Diperlukan !']);
        }
        $alamat->delete();

        return redirect()->back()->with('status', 'alamat-deleted');
    }
}
