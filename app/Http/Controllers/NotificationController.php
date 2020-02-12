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
  public function index(): JsonResponse
  {
    $listNotification = Notification::take(20)->orderBy('id', 'desc')->get();
    $notification = Notification::where('read', false)->take(1)->orderBy('id', 'desc')->get();
    $notification->map(static function ($item) {
      $now = Carbon::now();
      $time = Carbon::parse($item->updated_at)->addHour(2);
      if ($now->diffInHours($time) <= 0) {
        $item->read = true;
        $item->save();
      }
    });

    return response()->json([
      'response' => $notification,
      'list' => $listNotification,
    ], 200);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param Request $request
   * @return JsonResponse
   * @throws ValidationException
   */
  public function store(Request $request): JsonResponse
  {
    $this->validate($request, [
      'status' => 'required|numeric',
      'description' => 'required|string',
      'full_description' => 'required|string',
    ]);

    $notification = new Notification();
    $notification->status = $request->status;
    if ($notification->status == 0) {
      $notification->rbg = '#dd4b39';
    } else if ($notification->status == 1) {
      $notification->rbg = '#ffc107';
    } else {
      $notification->rbg = '#17a2b8';
    }
    $notification->description = $request->description;
    $notification->full_description = $request->full_description;
    $notification->read = false;
    $notification->save();

    $response = $this->sendToFireBase($notification->description, $notification->full_description, $notification->status);

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
  public function update(Request $request, $id): JsonResponse
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
        $notification->rbg = '#dd4b39';
      } else if ($notification->status == 1) {
        $notification->rbg = '#ffc107';
      } else {
        $notification->rbg = '#17a2b8';
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
  public function destroy($id): JsonResponse
  {
    Notification::destroy($id);
    return response()->json(['response' => 'data is deleted'], 200);
  }

  private function sendToFireBase($title, $message, $status)
  {
    if ($status == 0) {
      $status = 'high';
    } else {
      $status = 'normal';
    }
    $body = array(
      'to' => '/topics/all',
      'notification' => [
        'title' => $title,
        'body' => $message,
        'content_available' => true,
        'priority' => $status
      ]
    );

    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://fcm.googleapis.com/fcm/send',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => json_encode($body),
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Authorization: key=AAAAa0Jmw_U:APA91bFzrJTigY_9-klhkDv08IDJBPmQVdyPCFmeVI-ghuljBfe4dgvRvR3-lM4-b92Tag7yNlRadYMIlGpLidxA9emjoHhCwuVx1ZMJfuO6E8pCUvxR06UKVl7OXVo8xhi69kOtfqxJ'
      ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
  }
}
