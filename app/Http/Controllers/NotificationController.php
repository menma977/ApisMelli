<?php

namespace App\Http\Controllers;

use App\Model\Notification;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class NotificationController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return JsonResponse
   *
   * * Status
   * * * 0: Danger -> #dd4b39
   * * * 0: Warning -> #ffc107
   * * * 0: Info -> #17a2b8
   */
  public function index()
  {
    $notification = Notification::where("read", false)->get();
    $notification->map(function ($item) {
      $now = Carbon::now()->addHour();
      if ($now->gt($item->updated_at)) {
        $item->read = true;
        $item->save();
      }
    });

    return response()->json(['response' => $notification], 200);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param Request $request
   * @return JsonResponse
   * @throws ValidationException
   */
  public function store(Request $request)
  {
    $this->validate($request, [
      'status' => 'required|numeric',
      'description' => 'required|string',
      'full_description' => 'required|string',
    ]);

    $notification = new Notification();
    $notification->status = $request->status;
    if ($notification->status == 0) {
      $notification->rbg = "#dd4b39";
    } else if ($notification->status == 1) {
      $notification->rbg = "#ffc107";
    } else {
      $notification->rbg = "#17a2b8";
    }
    $notification->description = $request->description;
    $notification->full_description = $request->full_description;
    $notification->read = false;
    $notification->save();

    return response()->json(['response' => 'data is saved'], 200);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param Request $request
   * @param $id
   * @return JsonResponse
   * @throws ValidationException
   */
  public function update(Request $request, $id)
  {
    $this->validate($request, [
      'status' => 'nullable|numeric',
      'description' => 'nullable|string',
      'full_description' => 'nullable|string',
    ]);

    $notification = Notification::find($id);
    if ($request->status) {
      $notification->status = $request->status;
      if ($notification->status == 0) {
        $notification->rbg = "#dd4b39";
      } else if ($notification->status == 1) {
        $notification->rbg = "#ffc107";
      } else {
        $notification->rbg = "#17a2b8";
      }
    }
    if ($request->description) {
      $notification->description = $request->description;
    }
    if ($request->full_description) {
      $notification->full_description = $request->full_description;
    }

    if ($request->status || $request->description || $request->full_description) {
      $notification->read = false;
    } else {
      $notification->read = true;
    }

    $notification->save();

    return response()->json(['response' => 'data is update'], 200);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param $id
   * @return JsonResponse
   */
  public function destroy($id)
  {
    Notification::destroy($id);
    return response()->json(['response' => "data is deleted"], 200);
  }
}
