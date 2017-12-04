<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Mail;
use App\Page;
use App\Role;
use App\User;
use App\Tag;
use App\Article;
use App\Quote;
use App\Slide;
use App\Brand;
use App\News;
use App\Newsletter;
use App\EmailTemplate;
use Modules\Shop\Models\Product;
use App\Http\Requests\Frontend\Profiles\UpdateProfileRequest;
use App\Http\Requests\Frontend\NewsletterSignup;
use App\Http\Requests\Frontend\ContactUs;

/**
 * Description of PageController
 *
 * @author dinhtrong
 */
class PagesController extends Controller
{

    private $page;
    private $user;
    private $role;
    private $brand;
    protected $loggedUser;

    public function __construct(Page $page, User $user, Role $role, Brand $brand, News $news)
    {
        parent::__construct();
        $this->page = $page;
        $this->user = $user;
        $this->role = $role;
        $this->brand = $brand;
        $this->news = $news;
        //$this->middleware('auth');
        //$this->loggedUser = \Auth::user();
    }

    public function home()
    {
        $latestArticle = Article::latest()->published()->first();
        $latestProduct = Product::latest()->published()->first();
        $slides = Slide::active()->get();
        return view('layouts.home', compact('latestArticle', 'latestProduct', 'slides'));
    }

    public function news_item(Request $request)
    {
        $slug = $this->getSlug($request);
        $news = News::where('slug', $slug)->first();
        if (!$news) {
            throw new ModelNotFoundException;
        }
        return view('pages.news-page', compact('news'));
    }

    public function view_brand(Request $request)
    {
        $slug = $this->getSlug($request);
        $brand = Brand::where('slug', $slug)->first();
        if (!$brand) {
            throw new ModelNotFoundException;
        }
        return view('pages.brand-page', compact('brand'));
    }

    public function show(Request $request)
    {
        $slug = $this->getSlug($request);
        if (!$slug) {
            throw new NotFoundHttpException;
        }
        $page = $this->page->where('slug', $slug)->first();
        if (!$page) {
            throw new ModelNotFoundException;
        }
        if (view()->exists('pages.' . $slug)) {
            return view('pages.' . $slug, compact('page'));
        } else {
            return view('pages.page', compact('page'));
        }
    }

    public function showTags(Request $request, $slug)
    {
        $tag = Tag::where('slug', $slug)->first();
        if (!$slug || !$tag) {
            throw new NotFoundHttpException;
        }

        $articles = $tag->articles()->published()->posted()->orderBy('title', 'ASC')->get();
        $products = $tag->products()->published()->orderBy('name', 'ASC')->get();

        $coaches = $tag->coaches()->active()->orderBy('f_name', 'ASC')->get();

        return view('pages.tags', compact('articles', 'products', 'tag'));
    }

    public function delete_subscription(Request $request)
    {
        $data = $request->all();
        $subscription = \Modules\Shop\Models\StockNotificationEmail::findOrFail($data['id']);
        $subscription->delete();
        if ($request->ajax()) {
            return response()->json(['message' => 'The subscription was successfully cancelled.']);
        }
        return redirect()->back()->with('message', 'The subscription was successfully cancelled.');
    }

    public function newsletter_signup(NewsletterSignup $request)
    {

        $post_data = $request->all();

        $check_signedup = Newsletter::where('signup_email', $request->signup_email)->first();
        if ($check_signedup) {
            return response(' You have already subscribed to receive updates!', 422);
        }
        $post_data['status'] = '1';
        $signup = Newsletter::create($post_data);

        if ($signup) {

            // Send them the confirmation email

            $template = EmailTemplate::where('name','newsletter-signup')->first(); 
            $data = [];

            $str = $template->email;
            $message =  str_replace('{username}',$signup->signup_name,$str);

            $data['message'] = $message ;
            $data['subject'] = $template->subject;
            $data['to_email'] = $request->signup_email;
            $data['username'] = $template->subject;

            Mail::send('emails.'.$template->template, ['data' => $data], function ($m) use ($data) {
                $m->from('no-reply@nurturedforliving.com','Nurtured For Living');
                $m->to($data['to_email']);
                $m->subject($data['subject']);
            });

            return response()->json(['message' => 'You have successfully registered for updates!']);
        } else {
            return response(' There was an error, please try again!', 422);
        }

        return redirect()->back()->with('message', 'The subscription was successfully cancelled.');
    }

    public function cancel_signup(Request $request)
    {
        $data = $request->all();
        $subscription = Newsletter::where('signup_email', $request->signup_email)->first();
        ;
        $subscription->delete();
        return redirect()->back()->with('message', 'The subscription was successfully cancelled.');
    }

    public function contact_us(ContactUs $request)
    {

        $data = $request->all();
        $data['to_email'] = $data['department'] . '@nurturedforliving.com';

        Mail::send('emails.contact-us', ['data' => $data], function ($m) use ($data) {
            $m->from('no-reply@nurturedforliving.com','Nurtured For Living');
            // $m->replyTo($data['email']);
            $m->to($data['to_email']);
            $m->subject('Contact us form submission for ' . $data['department']);
        });

        if (count(Mail::failures()) < 1) {
            return response()->json(['message' => 'Thank you!, your message was successfully sent.']);
        } else {
            return response(' There was an error, please try again!', 422);
        }
    }
    /* *************
     * USER ACCOUNT
     * *************/

    public function my_account()
    {
        return view('account_pages.my_account');
    }

    public function edit_account()
    {
        return view('account_pages.edit_account');
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $data = $request->except('password');
        if ($request->password != '') {
            $data['password'] = \Hash::make($request->password);
            ;
        }

        $profile = \Auth::user();
        $avatar = $this->uploadAvatar($request);
        if ($avatar) {
            $data['avatar'] = $avatar;
        }

        if ($profile->update($data)) {
            return response()->json(['message' => 'Your profile was successfully updated.']);
        } else {
            return response(' There was an error updating your profile, please try again!', 422);
        }
    }

    private function uploadAvatar(UpdateProfileRequest $request)
    {
        if ($request->hasFile('avatar')) {
            $user = $request->user();
            $avatar = $request->file('avatar');
            $userFolder = public_path('users' . DIRECTORY_SEPARATOR . $user->id);
            $avatarFolder = $userFolder . DIRECTORY_SEPARATOR . 'avatar';
            if (!\File::exists($avatarFolder)) {
                \File::makeDirectory($avatarFolder, 0775, true);
            }
            \File::cleanDirectory($avatarFolder);
            $name = 'avatar.' . $avatar->getClientOriginalExtension();
            $avatar->move($avatarFolder, $name);
            return 'users/' . $user->id . '/avatar/' . $name;
        }
        return null;
    }

    private function uploadChefAvatar(UpdateProfileRequest $request)
    {
        if ($request->hasFile('chef_avatar')) {
            $user = $request->user();
            $avatar = $request->file('chef_avatar');
            $userFolder = public_path('users' . DIRECTORY_SEPARATOR . $user->id);
            $chefAvatarFolder = $userFolder . DIRECTORY_SEPARATOR . 'chef_avatar';
            if (!\File::exists($chefAvatarFolder)) {
                \File::makeDirectory($chefAvatarFolder, 0775, true);
            }
            \File::cleanDirectory($chefAvatarFolder);
            $name = 'chef_avatar.' . $avatar->getClientOriginalExtension();
            $avatar->move($chefAvatarFolder, $name);
            return 'users/' . $user->id . '/chef_avatar/' . $name;
        }
        return null;
    }
}
