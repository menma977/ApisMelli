<?php

namespace App\Http\Controllers;

use App\model\Bee;
use App\User;
use Illuminate\Support\Facades\File;

class FrontEndController extends Controller
{
  public function index()
  {
    $user = User::all();
    $stup = Bee::whereNull('user')->get()->count();
    $online = 0;

    $imageName = array();
    $imagePartner = array();

    $files = File::files('dist/img/gallery');
    foreach ($files as $id => $value) {
      $file = pathinfo($value);
      $imageName[$id] = $file["basename"];
    }

    $files = File::files('dist/img/partner');
    foreach ($files as $id => $value) {
      $file = pathinfo($value);
      $imagePartner[$id] = $file["basename"];
    }

    foreach ($user as $item) {
      foreach ($item->tokens as $subItem) {
        if ($subItem->revoked == 0) {
          $online += 1;
        }
      }
      if ($item->isOnline()) {
        $online += 1;
      }
    }

    $data = [
      'user' => $user->count(),
      'online' => $online,
      'stup' => $stup,
      'imageName' => $imageName,
      'imagePartner' => $imagePartner,
    ];
    return view('welcome', $data);
  }
}
