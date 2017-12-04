<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Notification;
use App\Recipe;
/**
 * Description of PageController
 *
 * @author dinhtrong
 */
class NotificationSubscriptionsController extends Controller {


    private $notification;
    private $course;
    private $recipe;
    
    public function __construct(Notification $notification) {
        parent::__construct();
        $this->notification = $notification;
    }
    


    public function add_content_subscription(Request $request){
        $data = $request->all();
        $subscription = Notification::where('resource_id',$data['resource_id'])->where('user_id',$data['user_id'])->where('resource_type',$data['resource_type'])->first();
        
        switch ($data['resource_type']) {
            case 'course':
                $resource = Course::find($data['resource_id']);
                $error_message = 'You have already added ' . $resource->title . ' to your subscription list';
                $message = 'You will be notified when the enrolment date for ' . $resource->title . ' has been set.';
                break;

            case 'recipe':
                $resource = Recipe::find($data['resource_id']);
                $error_message = 'You have already subscribed to recipe updates';
                $message = 'You have subscribed to recipe updates.';
                break;
            
            default:
                # code...
                break;
        }

        if($subscription){
            return response( $error_message, 422);
        }else{
            $this->notification->create($data);
            return response()->json(['message'=> $message ]);
        }
        
    }


/*
    public function delete_content_subscription($subscriptionId) {
        $subscription = Notification::findOrFail($subscriptionId);
        $subscription->delete();
        return response()->json(['message'=> 'The course subscription was successfully removed from your notifications list.']);
    }
*/

    public function delete_content_subscription(Request $request) {
        $data = $request->all();
        $subscription = Notification::find($data['id']);
        $subscription->delete();
        return redirect()->back()->with('message', 'The course enrolment notification was successfully cancelled.');
    }
    
}
