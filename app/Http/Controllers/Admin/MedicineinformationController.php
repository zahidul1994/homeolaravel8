<?php

namespace App\Http\Controllers\admin;
use App\Models\Disease;
use App\Helpers\CommonFx;
use App\Models\Medicine;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Kamaln7\Toastr\Facades\Toastr;
use App\Models\Medicineinformation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Redirect;

class MedicineinformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medicineinformation=Medicineinformation::with('disease')->latest()->paginate(10);
        return view('admin.medicineinformation.index')->with('medicineinformation',$medicineinformation)->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumbs = [
            ['link' => "admin", 'name' => "Home"], ['link' => "admin/medicineinformationlist", 'name' => "Medicineinformation"], ['name' => "Create"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
        $diseases= Disease::whereuse(1)->pluck('diseasename','id');
        return view('admin.medicineinformation.create', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs])->with('diseases',$diseases);
    }


    
        public function store(Request $request)
        {
                 
   // return response(dd($request));exit;
    
    $this->validate($request,[
        'title' => 'required|min:3|max:160|unique:medicineinformations',
       'keyword' => 'required',
        'metadescription' => 'required',
        'disease_id' => 'required',
        // 'medicineinfo' => 'required',
        'description' => 'min:3|required',
        'photo' => 'required|image|mimes:jpeg,jpg,png,webp|max:1000'
    ]);
        try {
            DB::beginTransaction();
            if ($request->hasfile('photo')) {
    
            $rand = uniqid(CommonFx::make_slug(Str::limit($request->title,60)));
          $name = $rand.".".$request->photo->extension();
               $waterMarkUrl = storage_path().'/app/files/shares/backend/watermark.png';
            //   $request->photo->move(storage_path().'/app/files/shares/medicineinformation/', $name);
                  $img=Image::make($request->photo->move(storage_path().'/app/files/shares/medicineinformation/', $name,60));
        $img->insert($waterMarkUrl, 'bottom-right', 5, 5);
               $img->save();
                 $resizedImage_thumb = Image::make(storage_path().'/app/files/shares/medicineinformation/' . $name)->resize(330, 232);
             $resizedImage_thumbs = Image::make(storage_path().'/app/files/shares/medicineinformation/' . $name)->resize(35, null, function ($constraint) {
                 $constraint->aspectRatio();
             });
            $resizedImage_thumb->save(storage_path() . '/app/files/shares/medicineinformation/thumb/'.$name, 60);
               $resizedImage_thumbs->save(storage_path() . '/app/files/shares/medicineinformation/thumbs/'.$name, 60);
          }
          else{
           $name ='not-found.jpg';
          };
            $schema='
{
  "@context": "https://schema.org",
  "@type": "BlogPosting",
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "https://homeobari.com/homeo-info/'. CommonFx::bnslug($request->title).'"
  },
  "headline": "'. $request->title.'",
  "image": "https://homeobari.com/den/storage/app/files/shares/medicineinformation/'.$name.'",
  "author": {
    "@type": "Person",
    "name": "'. Auth::guard('admin')->user()->name .'"
  },  
  "publisher": {
    "@type": "Organization",
    "name": "person",
    "logo": {
      "@type": "ImageObject",
      "url": "https://homeobari.com/den/storage/app/files/shares/profileimage/'.Auth::user()->image.'"
    }
  },
  "datePublished":"'.date("Y m d") .'",
  "dateModified":"'. date("Y-m-d").'"

}';
            $userinfo =Medicineinformation::create(array(
            'title' => $request->title,
            'slug' => CommonFx::bnslug($request->title),
            'keyword' => $request->keyword,
            'photo' => $name,
            'minides' => $request->minides,
            'disease_id' => $request->disease_id,
            'metadescription' => $request->metadescription,
            'schemainfo' =>$schema,
             'admin_id' => Auth::guard('admin')->user()->id,
            'description' => $request->description,
                ));
         DB::commit();
                Disease::find($request->disease_id)->update(array('use' =>2));
                Cache::forget('medicineinformation');
                $medicineinfo=Medicineinformation::wherestatus(1)->latest()->take(20)->select('title','slug','photo','metadescription')->get();
                Cache::forever('medicineinformation',$medicineinfo);
                Toastr::success("Medicineinformation Create Successfully", "Well Done");
            return Redirect::to('admin/medicineinformationlist'); 
                }
                catch (\Exception $e) {
                    DB::rollBack();
                    Toastr::warning("Medicineinformation Create Successfully Fail", "Sorry Done");
                   return Redirect::to('admin/medicineinformationlist'); 
                }
            }

    /**
     * Display the specified resource.
     *
     * @param  \App\Medisine  $disease
     * @return \Illuminate\Http\Response
     */
    public function show(Medisine $disease)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Medisine  $disease
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $breadcrumbs = [
            ['link' => "admin", 'name' => "Home"], ['link' => "admin/medicineinformationlist", 'name' => "Medicineinformation"], ['name' => "Edit"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
        $diseases= Disease::whereuse(1)->pluck('diseasename','id');
       $medicineinfoid =Medicineinformation::find($id);
        $diseases= Disease::whereuse(1)->pluck('diseasename','id');
        return view('admin.medicineinformation.edit', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs])->with('diseases',$diseases)->with('medicineinfoid',$medicineinfoid);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Medisine  $disease
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $this->validate($request,[
        'title' => 'required|min:3|max:190|unique:medicineinformations,title,'.$id,
        'keyword' => 'required|min:3|max:190',
        'metadescription' => 'required|min:3|max:160',
         'disease_id' => 'required',
       'description' => 'min:3|required',
        ]);
        try {
            DB::beginTransaction();
     if ($request->hasfile('photo')) {
            $rand = uniqid(CommonFx::make_slug(Str::limit($request->title,30)));
            $name = $rand.".".$request->photo->extension();
               $waterMarkUrl = storage_path().'/app/files/shares/backend/watermark.png';
              // $request->photo->move(storage_path().'/app/files/shares/medicineinformation/', $name);
                  $img=Image::make($request->photo->move(storage_path().'/app/files/shares/medicineinformation/', $name,60));
        $img->insert($waterMarkUrl, 'bottom-right', 5, 5);
               $img->save();
                 $resizedImage_thumb = Image::make(storage_path().'/app/files/shares/medicineinformation/' . $name)->resize(330, 232);
             $resizedImage_thumbs = Image::make(storage_path().'/app/files/shares/medicineinformation/' . $name)->resize(35, null, function ($constraint) {
                 $constraint->aspectRatio();
             });
            $resizedImage_thumb->save(storage_path() . '/app/files/shares/medicineinformation/thumb/'.$name, 60);
               $resizedImage_thumbs->save(storage_path() . '/app/files/shares/medicineinformation/thumbs/'.$name, 60);
          }
          else{
           $name =$request->oldphoto;
          };
$info= Medicineinformation::find($id);
$schema='
{
  "@context": "https://schema.org",
  "@type": "BlogPosting",
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "https://homeobari.com/homeo-info/'. CommonFx::bnslug($request->title) .'"
  },
  "headline": "'. $request->title.'",
  "image": "https://homeobari.com/storage/app/files/shares/medicineinformation/'.$name.'",
  "author": {
    "@type": "Person",
    "name": "'. Auth::guard('admin')->user()->name .'"
  },  
  "publisher": {
    "@type": "Organization",
    "name": "person",
    "logo": {
      "@type": "ImageObject",
      "url": "https://homeobari.com/storage/app/files/shares/profileimage/'.Auth::user()->image.'"
    }
  },
  "datePublished":"'.date('Y-m-d', strtotime($info->created_at)) .'",
  "dateModified":"'. date("Y-m-d").'"

}';
if($request->disease_id != $info->disease_id){
    Disease::find($info->disease_id)->update(array('use' => 1));
    Disease::find($request->disease_id)->update(array('use' =>2));
    
}

        $list =  Medicineinformation::find($id);
        $list->title = $request->title;
        $list->keyword = $request->keyword;
        $list->metadescription= $request->metadescription;
        $list->disease_id= $request->disease_id;
        $list->description= $request->description;
       $list->slug =CommonFx::bnslug($request->title);
        $list->photo= $name;
       $list->schemainfo=$schema;
        $list->update();
            
        DB::commit();
        Cache::forget('medicineinformation');
        $medicineinfo=Medicineinformation::wherestatus(1)->latest()->take(20)->select('title','slug','photo','metadescription')->get();
        Cache::forever('medicineinformation',$medicineinfo);
        Toastr::success("Medicineinformation Update Successfully ", "Well Done");
         return Redirect::to('admin/medicineinformationlist'); 
        }
        catch (\Exception $e) {
            DB::rollBack();
            Toastr::warning("Medicineinformation Create Successfully Fail", "Sorry Done");
                  return Redirect::to('admin/medicineinformationlist'); 
        }
    }


 
    public function destroy($id)
    {
        $delete=Medicineinformation::destroy($id);
        
      
        if($delete) {
            Cache::forget('medicineinformation');
            $medicineinfo=Medicineinformation::wherestatus(1)->latest()->take(20)->select('title','slug','photo','metadescription')->get();
            Cache::forever('medicineinformation',$medicineinfo);
             Toastr::danger("Medicineinformation Delete Successfully", "Done");
            return Redirect::to('admin/medicineinformationlist'); 
         } else {
              Toastr::warning("Medicineinformation Delete Successfully Fail", "Sorry Done");
             return Redirect::to('admin/medicineinformationlist'); 
         }
    }

   public function setapproval(Request $request){
        $id =$request->id;
        $roomapproval = Medicineinformation::find($id);
        if($request->action=="allow"){
            $roomapproval->status=2;
        }
        if($request->action=="deny"){
            $roomapproval->status=1;


        }
            $roomapproval->update();
            if($roomapproval->update()){
                Cache::forget('medicineinformation');
        $medicineinfo=Medicineinformation::wherestatus(1)->latest()->take(20)->select('title','slug','photo','metadescription')->get();
       Cache::forever('medicineinformation',$medicineinfo);
                return response()->json(['success' => true]);
            }



    }
    // account active inactive start
   
      public function searchmedicine(Request $request){
        $output="";
        $searchvalue = Medicineinformation::Where('title','LIKE','%%%'.$request->id."%%%")->orwhere('metadescription','LIKE','%'.$request->id."%")->latest()->take(30)->get();
        if(count($searchvalue))
{
foreach ($searchvalue as $key => $searchval) {
$output.='<tr>'.
'<td>'.$searchval->id.'</td>'.
'<td>'.$searchval->title.'</td>'.
'<td>'.$searchval->metadescription.'</td>'.
'<td>'.$searchval->status.'</td>'.
'<td>'.'<a target="_blank" href="'.url('admin/editmedicinelist/'.$searchval->id).'" class="btn-floating mb-1 waves-effect waves-light"> <i class="material-icons">edit</i></a>'.'</td>'.
'</tr>';
}
return Response($output);
   }
   else{
    $output.='<tr>'
    .'<td><h1>Sorry</h1></td>'.
    '<td><h1>NO </h1></td>'.
    '<td><h1>Data</h1></td>'.
    '<td><h1> Found</h1></td>'.
    '<td><h1>Type</h1></td>'.
    '<td><h1> Another</h1></td>'.
    '<td><h1>Info</h1></td>'.
    '</tr>';
    return Response( $output);
    
   }
    }


}
