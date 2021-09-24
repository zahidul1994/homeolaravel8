@extends('layouts.adminMaster')

@section('content')
@section('title', "Profile")
 
{{-- vendor styles --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/select2/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/select2/select2-materialize.css')}}">
@endsection

{{-- page style --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/page-users.css')}}">
@endsection

{{-- page content --}}
@section('content')

<!-- users edit start -->
<div class="section users-edit">
  <div class="card">
    <div class="card-content">
      <!-- <div class="card-body"> -->
      <ul class="tabs mb-2 row">
        <li class="tab">
          <a class="display-flex align-items-center active" id="account-tab" href="#account">
            <i class="material-icons mr-1">person_outline</i><span>Account</span>
          </a>
        </li>
        <li class="tab">
          <a class="display-flex align-items-center" id="information-tab" href="#information">
            <i class="material-icons mr-2">error_outline</i><span>Password</span>
          </a>
        </li>
      </ul>
      <div class="divider mb-3"></div>
      <div class="row">
        <div class="col s12" id="account">
          <!-- users edit media object start -->
          <div class="media display-flex align-items-center mb-2">
            <a class="mr-2" href="#">
              <img src="{{@asset('storage/app/files/shares/profileimage/'.Auth::user()->image)}}" alt="users avatar" class="z-depth-4 circle"
                height="64" width="64">
            </a>
            <div class="media-body">
              <h5 class="media-heading mt-0">{{Auth::user()->name}}</h5>
              <div class="user-edit-btns display-flex">
                <a href="#Profilephoto" class="btn-small indigo modal-trigger">Change</a>
              
              </div>
            </div>
          </div>
      
          <!-- Modal Structure -->
          <div id="Profilephoto" class="modal modal-fixed-footer">
            <div class="modal-content">
              <h4>Change Profile Photo</h4>
              <p>Upload Your Photo</p>

              {!! Form::open(array('url' => 'admin/updateprofilephoto','method'=>'POST','id'=>'theform','files'=>true )) !!}
              <div class="col  s12 file-field input-field">
                <div class="btn float-right">
                    <span>Photo</span>
                    {!!Form::file('photo', ['accept'=>".jpg,.jpeg,.png"])!!}
                   
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>
              <div class="row">
                <div class="input-field col s12">
                    <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Update
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </div>
       
 {!! Form::close() !!}
            </div>
            <div class="modal-footer">
              <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Close</a>
            </div>
          </div>
          <!-- users edit media object ends -->
          @include('partial.formerror')
          <!-- users edit account form start -->
          {!! Form::model($admininfoid, array('url' =>['admin/updateprofileinfo/'.$admininfoid->id], 'method'=>'PATCH','id'=>'accountForm','files'=>true)) !!}
         
            <div class="row">
              <div class="col s12 m6">
                <div class="row">
                  <div class="input-field col s12">
                    <i class="material-icons prefix pt-2">mail_outline</i>
                    <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email"
                      value="{{ $admininfoid->email }}" required autocomplete="email" disabled>
                    <label for="email">Email</label>
                    @error('email')
                    <small class="red-text ml-10" role="alert">
                      {{ $message }}
                    </small>
                    @enderror
                  </div>
                    <div class="input-field col s12">
                      <i class="material-icons prefix pt-2">accessibility</i>
                      <input id="name" type="text" class="@error('name') is-invalid @enderror" name="name"  value="{{$admininfoid->name }}"
                        required autocomplete="caddress" autofocus>
                      <label for="name" class="center-align"> Name *</label>
                      @error('name')
                      <small class="red-text ml-10" role="alert">
                        {{ $message }}
                      </small>
                      @enderror
                    </div>
                 
                     <div class="input-field col s12">
                      <i class="material-icons prefix pt-2">border_color</i>
                      <input id="profession" type="text" class="@error('profession') is-invalid @enderror" name="profession"  value="{{$admininfoid->profession}}"
                        required autocomplete="profession" autofocus>
                      <label for="profession" class="center-align"> profession *</label>
                      @error('profession')
                      <small class="red-text ml-10" role="alert">
                        {{ $message }}
                      </small>
                      @enderror
                    </div>
                 
                  <div class="row margin">
                    <div class="input-field col s12">
                      <i class="material-icons prefix pt-2">person</i>
                  @php( $gender = array(
                    'Male'=>'Male',
                  'Female'=>'Female',
                  'Other'=>'Other'
                 ))
            {!!Form::select('gender',$gender,$admininfoid->gender) !!}
                      <label for="gender">Gender</label>
                    </div>
                  </div>
                  
                   
               
                </div>
              </div>
              <div class="col s12 m6">
                <div class="row">
                  <div class="input-field col s12">
                    <i class="material-icons prefix pt-2">phone</i>
                    <input id="phone" type="text" class="@error('phone') is-invalid @enderror" name="phone"  value="{{$admininfoid->phone }}"
                      required autocomplete="phone" autofocus>
                    <label for="mobile_no" class="center-align">Phone Number *</label>
                    @error('phone')
                    <small class="red-text ml-10" role="alert">
                      {{ $message }}
                    </small>
                    @enderror
                  </div>
                 
                      <div class="input-field col s12">
                      <i class="material-icons prefix pt-2">places</i>
                      <input id="address" type="text" class="@error('address') is-invalid @enderror" name="address"  value="{{$admininfoid->address }}"
                        required autocomplete="address" autofocus>
                      <label for="address" class="center-align"> Address *</label>
                      @error('address')
                      <small class="red-text ml-10" role="alert">
                        {{ $message }}
                      </small>
                      @enderror
                    </div>
                  @php( $countries = array(
                    'BD'=>'BANGLADESH',
                  'AF'=>'AFGHANISTAN',
                  'AL'=>'ALBANIA',
                  'DZ'=>'ALGERIA',
                  'AS'=>'AMERICAN SAMOA',
                  'AD'=>'ANDORRA',
                  'AO'=>'ANGOLA',
                  'AI'=>'ANGUILLA',
                  'AQ'=>'ANTARCTICA',
                  'AG'=>'ANTIGUA AND BARBUDA',
                  'AR'=>'ARGENTINA',
                  'AM'=>'ARMENIA',
                  'AW'=>'ARUBA',
                  'AU'=>'AUSTRALIA',
                  'AT'=>'AUSTRIA',
                  'AZ'=>'AZERBAIJAN',
                  'BS'=>'BAHAMAS',
                  'BH'=>'BAHRAIN',
                  'BB'=>'BARBADOS',
                  'BY'=>'BELARUS',
                  'BE'=>'BELGIUM',
                  'BZ'=>'BELIZE',
                  'BJ'=>'BENIN',
                  'BM'=>'BERMUDA',
                  'BT'=>'BHUTAN',
                  'BO'=>'BOLIVIA',
                  'BA'=>'BOSNIA AND HERZEGOVINA',
                  'BW'=>'BOTSWANA',
                  'BV'=>'BOUVET ISLAND',
                  'BR'=>'BRAZIL',
                  'IO'=>'BRITISH INDIAN OCEAN TERRITORY',
                  'BN'=>'BRUNEI DARUSSALAM',
                  'BG'=>'BULGARIA',
                  'BF'=>'BURKINA FASO',
                  'BI'=>'BURUNDI',
                  'KH'=>'CAMBODIA',
                  'CM'=>'CAMEROON',
                  'CA'=>'CANADA',
                  'CV'=>'CAPE VERDE',
                  'KY'=>'CAYMAN ISLANDS',
                  'CF'=>'CENTRAL AFRICAN REPUBLIC',
                  'TD'=>'CHAD',
                  'CL'=>'CHILE',
                  'CN'=>'CHINA',
                  'CX'=>'CHRISTMAS ISLAND',
                  'CC'=>'COCOS (KEELING) ISLANDS',
                  'CO'=>'COLOMBIA',
                  'KM'=>'COMOROS',
                  'CG'=>'CONGO',
                  'CD'=>'CONGO, THE DEMOCRATIC REPUBLIC OF THE',
                  'CK'=>'COOK ISLANDS',
                  'CR'=>'COSTA RICA',
                  'CI'=>'COTE D IVOIRE',
                  'HR'=>'CROATIA',
                  'CU'=>'CUBA',
                  'CY'=>'CYPRUS',
                  'CZ'=>'CZECH REPUBLIC',
                  'DK'=>'DENMARK',
                  'DJ'=>'DJIBOUTI',
                  'DM'=>'DOMINICA',
                  'DO'=>'DOMINICAN REPUBLIC',
                  'TP'=>'EAST TIMOR',
                  'EC'=>'ECUADOR',
                  'EG'=>'EGYPT',
                  'SV'=>'EL SALVADOR',
                  'GQ'=>'EQUATORIAL GUINEA',
                  'ER'=>'ERITREA',
                  'EE'=>'ESTONIA',
                  'ET'=>'ETHIOPIA',
                  'FK'=>'FALKLAND ISLANDS (MALVINAS)',
                  'FO'=>'FAROE ISLANDS',
                  'FJ'=>'FIJI',
                  'FI'=>'FINLAND',
                  'FR'=>'FRANCE',
                  'GF'=>'FRENCH GUIANA',
                  'PF'=>'FRENCH POLYNESIA',
                  'TF'=>'FRENCH SOUTHERN TERRITORIES',
                  'GA'=>'GABON',
                  'GM'=>'GAMBIA',
                  'GE'=>'GEORGIA',
                  'DE'=>'GERMANY',
                  'GH'=>'GHANA',
                  'GI'=>'GIBRALTAR',
                  'GR'=>'GREECE',
                  'GL'=>'GREENLAND',
                  'GD'=>'GRENADA',
                  'GP'=>'GUADELOUPE',
                  'GU'=>'GUAM',
                  'GT'=>'GUATEMALA',
                  'GN'=>'GUINEA',
                  'GW'=>'GUINEA-BISSAU',
                  'GY'=>'GUYANA',
                  'HT'=>'HAITI',
                  'HM'=>'HEARD ISLAND AND MCDONALD ISLANDS',
                  'VA'=>'HOLY SEE (VATICAN CITY STATE)',
                  'HN'=>'HONDURAS',
                  'HK'=>'HONG KONG',
                  'HU'=>'HUNGARY',
                  'IS'=>'ICELAND',
                  'IN'=>'INDIA',
                  'ID'=>'INDONESIA',
                  'IR'=>'IRAN, ISLAMIC REPUBLIC OF',
                  'IQ'=>'IRAQ',
                  'IE'=>'IRELAND',
                  'IL'=>'ISRAEL',
                  'IT'=>'ITALY',
                  'JM'=>'JAMAICA',
                  'JP'=>'JAPAN',
                  'JO'=>'JORDAN',
                  'KZ'=>'KAZAKSTAN',
                  'KE'=>'KENYA',
                  'KI'=>'KIRIBATI',
                  'KP'=>'KOREA DEMOCRATIC PEOPLES REPUBLIC OF',
                  'KR'=>'KOREA REPUBLIC OF',
                  'KW'=>'KUWAIT',
                  'KG'=>'KYRGYZSTAN',
                  'LA'=>'LAO PEOPLES DEMOCRATIC REPUBLIC',
                  'LV'=>'LATVIA',
                  'LB'=>'LEBANON',
                  'LS'=>'LESOTHO',
                  'LR'=>'LIBERIA',
                  'LY'=>'LIBYAN ARAB JAMAHIRIYA',
                  'LI'=>'LIECHTENSTEIN',
                  'LT'=>'LITHUANIA',
                  'LU'=>'LUXEMBOURG',
                  'MO'=>'MACAU',
                  'MK'=>'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF',
                  'MG'=>'MADAGASCAR',
                  'MW'=>'MALAWI',
                  'MY'=>'MALAYSIA',
                  'MV'=>'MALDIVES',
                  'ML'=>'MALI',
                  'MT'=>'MALTA',
                  'MH'=>'MARSHALL ISLANDS',
                  'MQ'=>'MARTINIQUE',
                  'MR'=>'MAURITANIA',
                  'MU'=>'MAURITIUS',
                  'YT'=>'MAYOTTE',
                  'MX'=>'MEXICO',
                  'FM'=>'MICRONESIA, FEDERATED STATES OF',
                  'MD'=>'MOLDOVA, REPUBLIC OF',
                  'MC'=>'MONACO',
                  'MN'=>'MONGOLIA',
                  'MS'=>'MONTSERRAT',
                  'MA'=>'MOROCCO',
                  'MZ'=>'MOZAMBIQUE',
                  'MM'=>'MYANMAR',
                  'NA'=>'NAMIBIA',
                  'NR'=>'NAURU',
                  'NP'=>'NEPAL',
                  'NL'=>'NETHERLANDS',
                  'AN'=>'NETHERLANDS ANTILLES',
                  'NC'=>'NEW CALEDONIA',
                  'NZ'=>'NEW ZEALAND',
                  'NI'=>'NICARAGUA',
                  'NE'=>'NIGER',
                  'NG'=>'NIGERIA',
                  'NU'=>'NIUE',
                  'NF'=>'NORFOLK ISLAND',
                  'MP'=>'NORTHERN MARIANA ISLANDS',
                  'NO'=>'NORWAY',
                  'OM'=>'OMAN',
                  'PK'=>'PAKISTAN',
                  'PW'=>'PALAU',
                  'PS'=>'PALESTINIAN TERRITORY, OCCUPIED',
                  'PA'=>'PANAMA',
                  'PG'=>'PAPUA NEW GUINEA',
                  'PY'=>'PARAGUAY',
                  'PE'=>'PERU',
                  'PH'=>'PHILIPPINES',
                  'PN'=>'PITCAIRN',
                  'PL'=>'POLAND',
                  'PT'=>'PORTUGAL',
                  'PR'=>'PUERTO RICO',
                  'QA'=>'QATAR',
                  'RE'=>'REUNION',
                  'RO'=>'ROMANIA',
                  'RU'=>'RUSSIAN FEDERATION',
                  'RW'=>'RWANDA',
                  'SH'=>'SAINT HELENA',
                  'KN'=>'SAINT KITTS AND NEVIS',
                  'LC'=>'SAINT LUCIA',
                  'PM'=>'SAINT PIERRE AND MIQUELON',
                  'VC'=>'SAINT VINCENT AND THE GRENADINES',
                  'WS'=>'SAMOA',
                  'SM'=>'SAN MARINO',
                  'ST'=>'SAO TOME AND PRINCIPE',
                  'SA'=>'SAUDI ARABIA',
                  'SN'=>'SENEGAL',
                  'SC'=>'SEYCHELLES',
                  'SL'=>'SIERRA LEONE',
                  'SG'=>'SINGAPORE',
                  'SK'=>'SLOVAKIA',
                  'SI'=>'SLOVENIA',
                  'SB'=>'SOLOMON ISLANDS',
                  'SO'=>'SOMALIA',
                  'ZA'=>'SOUTH AFRICA',
                  'GS'=>'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS',
                  'ES'=>'SPAIN',
                  'LK'=>'SRI LANKA',
                  'SD'=>'SUDAN',
                  'SR'=>'SURINAME',
                  'SJ'=>'SVALBARD AND JAN MAYEN',
                  'SZ'=>'SWAZILAND',
                  'SE'=>'SWEDEN',
                  'CH'=>'SWITZERLAND',
                  'SY'=>'SYRIAN ARAB REPUBLIC',
                  'TW'=>'TAIWAN, PROVINCE OF CHINA',
                  'TJ'=>'TAJIKISTAN',
                  'TZ'=>'TANZANIA, UNITED REPUBLIC OF',
                  'TH'=>'THAILAND',
                  'TG'=>'TOGO',
                  'TK'=>'TOKELAU',
                  'TO'=>'TONGA',
                  'TT'=>'TRINIDAD AND TOBAGO',
                  'TN'=>'TUNISIA',
                  'TR'=>'TURKEY',
                  'TM'=>'TURKMENISTAN',
                  'TC'=>'TURKS AND CAICOS ISLANDS',
                  'TV'=>'TUVALU',
                  'UG'=>'UGANDA',
                  'UA'=>'UKRAINE',
                  'AE'=>'UNITED ARAB EMIRATES',
                  'GB'=>'UNITED KINGDOM',
                  'US'=>'UNITED STATES',
                  'UM'=>'UNITED STATES MINOR OUTLYING ISLANDS',
                  'UY'=>'URUGUAY',
                  'UZ'=>'UZBEKISTAN',
                  'VU'=>'VANUATU',
                  'VE'=>'VENEZUELA',
                  'VN'=>'VIET NAM',
                  'VG'=>'VIRGIN ISLANDS, BRITISH',
                  'VI'=>'VIRGIN ISLANDS, U.S.',
                  'WF'=>'WALLIS AND FUTUNA',
                  'EH'=>'WESTERN SAHARA',
                  'YE'=>'YEMEN',
                  'YU'=>'YUGOSLAVIA',
                  'ZM'=>'ZAMBIA',
                  'ZW'=>'ZIMBABWE'))
                
                  <div class="row margin">
                    <div class="input-field col s12">
                      <i class="material-icons prefix pt-2">flag</i>
                 
            {!!Form::select('country',$countries,$admininfoid->country) !!}
                      <label for="password-confirm">Country</label>
                    </div>
                  </div>
                   <div class="row margin">
                    <div class="input-field col s12">    
                    
             {!!Form::textarea('aboutyou',$admininfoid->aboutyou, array('id'=>'aboutyou','class'=>'materialize-textarea', 'rows' => 4, 'cols' => 54,'required'))!!}
    {!!Form::label('aboutyou',' About You*(Not More Than 560 Word)')!!}
      </div>
                  </div>
              <div class="col s12 display-flex justify-content-end mt-3">
                <button type="submit" class="btn indigo">
                  Update Info</button>
                
              </div>
            </div>
        {!! Form::close() !!}
          <!-- users edit account form ends -->
        </div>
        </div>
        </div>
        <div class="col s12" id="information">
          <!-- users edit Info form start -->
          {!! Form::open(array('url' => 'admin/updatepassword','method'=>'POST','id'=>'infotabForm')) !!}
         
            <div class="row margin">
              <div class="input-field col s12">
                <i class="material-icons prefix pt-2">lock_outline</i>
                <input id="oldpassword" type="password" class="@error('oldpassword') is-invalid @enderror" name="oldpassword" required
                  autocomplete="oldpassword">
                <label for="oldpassword">Old Password</label>
                @error('oldpassword')
                <small class="red-text ml-10" role="alert">
                  {{ $message }}
                </small>
                @enderror
              </div>
            </div>
            <div class="row margin">
              <div class="input-field col s12">
                <i class="material-icons prefix pt-2">lock_outline</i>
                <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required
                  autocomplete="password">
                <label for="password">Password</label>
                @error('password')
                <small class="red-text ml-10" role="alert">
                  {{ $message }}
                </small>
                @enderror
              </div>
            </div>
            <div class="row margin">
              <div class="input-field col s12">
                <i class="material-icons prefix pt-2">lock_outline</i>
                <input id="confirm" type="password" class="@error('confirm') is-invalid @enderror" name="confirm" required
                  autocomplete="confirm">
                <label for="confirm">Confirm Password</label>
                @error('confirm')
                <small class="red-text ml-10" role="alert">
                  {{ $message }}
                </small>
                @enderror
              </div>
            </div>
            
            <div class="row">
              <div class="input-field col s12">
                <button type="submit"
                  class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">Update Password</button>
              </div>
            </div>
            {!! Form::close() !!}
          <!-- users edit Info form ends -->
        </div>
      </div>
      <!-- </div> -->
    </div>
  </div>
</div>
<!-- users edit ends -->
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
<script src="{{asset('app-assets/vendors/select2/select2.full.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/jquery-validation/jquery.validate.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-script')
<script src="{{asset('app-assets/js/scripts/page-users.js')}}"></script>
@endsection