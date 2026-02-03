@extends('layouts.vertical', ['title' => 'Checkout'])

@section('css')

@endsection

@section('content')
    @include('layouts.partials/page-title', ['subtitle' => 'Menu', 'title' => 'Checkout'] )

    <div class="flex gap-1.25 px-4 py-3 mb-5 text-teal-700 border border-teal-200 rounded-md bg-teal-50">
        <i class="size-4 text-teal-700" data-lucide="shopping-bag"></i>
        <p class="text-13xl">The minimum order requirement is <b>$1,800</b>. To meet this threshold, please add
            additional products with a combined value of <b>$300</b>.</p>
    </div>
    <div class="grid lg:grid-cols-3 grid-cols-1 gap-5 mb-5">
        <div class="lg:col-span-2 col-span-1">
            <div class="flex justify-between gap-5 mb-5 items-center">
                <a class="flex gap-1.25 text-sm items-center text-primary" href="#">
                    <i class="size-4" data-lucide="chevron-left"></i>
                    Back to Cart
                </a>
                <button
                    class="text-[13px] py-2 px-4 rounded bg-primary text-white transition-all duration-300 hover:bg-blue-600 inline-flex items-center"
                    type="button">Place Order
                    <i class="size-4 ms-1" data-lucide="move-right"></i>
                </button>
            </div>
            <div class="p-5 card mb-5">
                <h6 class="card-title mb-4">Shipping Information</h6>
                <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-5 mb-5">
                    <div class="col-span-1">
                        <label class="inline-block mb-2 text-sm text-default-800 font-medium" for="firstNameInput">First
                            Name</label>
                        <input
                            class="form-input"
                            id="firstNameInput" placeholder="Enter First Name" type="text"/>
                    </div>
                    <div class="col-span-1">
                        <label class="inline-block mb-2 text-sm text-default-800 font-medium" for="middleNameInput">Middle
                            Name</label>
                        <input
                            class="form-input"
                            id="middleNameInput" placeholder="Enter Middle Name" type="text"/>
                    </div>
                    <div class="col-span-1">
                        <label class="inline-block mb-2 text-sm text-default-800 font-medium" for="lastNameInput">Last
                            Name</label>
                        <input
                            class="form-input"
                            id="lastNameInput" placeholder="Enter Last Name" type="text"/>
                    </div>
                    <div class="col-span-1">
                        <label class="inline-block mb-2 text-sm text-default-800 font-medium" for="phoneNumberInput">Phone
                            Number</label>
                        <input
                            class="form-input"
                            id="phoneNumberInput" placeholder="(012) 345 678 9010" type="text"/>
                    </div>
                    <div class="col-span-1">
                        <label class="inline-block mb-2 text-sm text-default-800 font-medium"
                               for="alternativeNumberInput">Alternative Number</label>
                        <input
                            class="form-input"
                            id="alternativeNumberInput" placeholder="(012) 345 678 9010" type="text"/>
                    </div>
                    <div class="col-span-1">
                        <label class="inline-block mb-2 text-sm text-default-800 font-medium" for="emailAddressInput">Email
                            Address</label>
                        <input
                            class="form-input"
                            id="emailAddressInput" placeholder="Enter email" type="email"/>
                    </div>
                </div>
                <div class="mb-5">
                    <label class="inline-block mb-2 text-sm text-default-800 font-medium" for="streetAddressInput">Street
                        Address</label>
                    <input
                        class="form-input"
                        id="streetAddressInput" placeholder="Street address" type="text"/>
                </div>
                <div class="mb-5">
                    <label class="inline-block mb-2 text-sm text-default-800 font-medium"
                           for="townCityInput">Town/City</label>
                    <input
                        class="form-input"
                        id="townCityInput" placeholder="Town/City" type="text"/>
                </div>
                <div class="grid lg:grid-cols-3 grid-cols-1 gap-5">
                    <div class="col-span-1">
                        <label class="inline-block mb-2 text-sm text-default-800 font-medium"
                               for="stateInput">State</label>
                        <input
                            class="form-input"
                            id="stateInput" placeholder="State" type="text"/>
                    </div>
                    <div class="col-span-1">
                        <label class="inline-block mb-2 text-sm text-default-800 font-medium"
                               for="stateInput">Country</label>
                        <select
                            class="form-input">
                            <option value="Afghanistan">Afghanistan</option>
                            <option value="Åland Islands">Åland Islands</option>
                            <option value="Albania">Albania</option>
                            <option value="Algeria">Algeria</option>
                            <option value="American Samoa">American Samoa</option>
                            <option value="Andorra">Andorra</option>
                            <option value="Angola">Angola</option>
                            <option value="Anguilla">Anguilla</option>
                            <option value="Antarctica">Antarctica</option>
                            <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                            <option value="Argentina">Argentina</option>
                            <option value="Armenia">Armenia</option>
                            <option value="Aruba">Aruba</option>
                            <option value="Australia">Australia</option>
                            <option value="Austria">Austria</option>
                            <option value="Azerbaijan">Azerbaijan</option>
                            <option value="Bahamas">Bahamas</option>
                            <option value="Bahrain">Bahrain</option>
                            <option value="Bangladesh">Bangladesh</option>
                            <option value="Barbados">Barbados</option>
                            <option value="Belarus">Belarus</option>
                            <option value="Belgium">Belgium</option>
                            <option value="Belize">Belize</option>
                            <option value="Benin">Benin</option>
                            <option value="Bermuda">Bermuda</option>
                            <option value="Bhutan">Bhutan</option>
                            <option value="Bolivia">Bolivia</option>
                            <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                            <option value="Botswana">Botswana</option>
                            <option value="Bouvet Island">Bouvet Island</option>
                            <option value="Brazil">Brazil</option>
                            <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                            <option value="Brunei Darussalam">Brunei Darussalam</option>
                            <option value="Bulgaria">Bulgaria</option>
                            <option value="Burkina Faso">Burkina Faso</option>
                            <option value="Burundi">Burundi</option>
                            <option value="Cambodia">Cambodia</option>
                            <option value="Cameroon">Cameroon</option>
                            <option value="Canada">Canada</option>
                            <option value="Cape Verde">Cape Verde</option>
                            <option value="Cayman Islands">Cayman Islands</option>
                            <option value="Central African Republic">Central African Republic</option>
                            <option value="Chad">Chad</option>
                            <option value="Chile">Chile</option>
                            <option value="China">China</option>
                            <option value="Christmas Island">Christmas Island</option>
                            <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                            <option value="Colombia">Colombia</option>
                            <option value="Comoros">Comoros</option>
                            <option value="Congo">Congo</option>
                            <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of
                                The
                            </option>
                            <option value="Cook Islands">Cook Islands</option>
                            <option value="Costa Rica">Costa Rica</option>
                            <option value="Cote D'ivoire">Cote D'ivoire</option>
                            <option value="Croatia">Croatia</option>
                            <option value="Cuba">Cuba</option>
                            <option value="Cyprus">Cyprus</option>
                            <option value="Czech Republic">Czech Republic</option>
                            <option value="Denmark">Denmark</option>
                            <option value="Djibouti">Djibouti</option>
                            <option value="Dominica">Dominica</option>
                            <option value="Dominican Republic">Dominican Republic</option>
                            <option value="Ecuador">Ecuador</option>
                            <option value="Egypt">Egypt</option>
                            <option value="El Salvador">El Salvador</option>
                            <option value="Equatorial Guinea">Equatorial Guinea</option>
                            <option value="Eritrea">Eritrea</option>
                            <option value="Estonia">Estonia</option>
                            <option value="Ethiopia">Ethiopia</option>
                            <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                            <option value="Faroe Islands">Faroe Islands</option>
                            <option value="Fiji">Fiji</option>
                            <option value="Finland">Finland</option>
                            <option value="France">France</option>
                            <option value="French Guiana">French Guiana</option>
                            <option value="French Polynesia">French Polynesia</option>
                            <option value="French Southern Territories">French Southern Territories</option>
                            <option value="Gabon">Gabon</option>
                            <option value="Gambia">Gambia</option>
                            <option value="Georgia">Georgia</option>
                            <option value="Germany">Germany</option>
                            <option value="Ghana">Ghana</option>
                            <option value="Gibraltar">Gibraltar</option>
                            <option value="Greece">Greece</option>
                            <option value="Greenland">Greenland</option>
                            <option value="Grenada">Grenada</option>
                            <option value="Guadeloupe">Guadeloupe</option>
                            <option value="Guam">Guam</option>
                            <option value="Guatemala">Guatemala</option>
                            <option value="Guernsey">Guernsey</option>
                            <option value="Guinea">Guinea</option>
                            <option value="Guinea-bissau">Guinea-bissau</option>
                            <option value="Guyana">Guyana</option>
                            <option value="Haiti">Haiti</option>
                            <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                            <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                            <option value="Honduras">Honduras</option>
                            <option value="Hong Kong">Hong Kong</option>
                            <option value="Hungary">Hungary</option>
                            <option value="Iceland">Iceland</option>
                            <option value="India">India</option>
                            <option value="Indonesia">Indonesia</option>
                            <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                            <option value="Iraq">Iraq</option>
                            <option value="Ireland">Ireland</option>
                            <option value="Isle of Man">Isle of Man</option>
                            <option value="Israel">Israel</option>
                            <option value="Italy">Italy</option>
                            <option value="Jamaica">Jamaica</option>
                            <option value="Japan">Japan</option>
                            <option value="Jersey">Jersey</option>
                            <option value="Jordan">Jordan</option>
                            <option value="Kazakhstan">Kazakhstan</option>
                            <option value="Kenya">Kenya</option>
                            <option value="Kiribati">Kiribati</option>
                            <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic
                                of
                            </option>
                            <option value="Korea, Republic of">Korea, Republic of</option>
                            <option value="Kuwait">Kuwait</option>
                            <option value="Kyrgyzstan">Kyrgyzstan</option>
                            <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                            <option value="Latvia">Latvia</option>
                            <option value="Lebanon">Lebanon</option>
                            <option value="Lesotho">Lesotho</option>
                            <option value="Liberia">Liberia</option>
                            <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                            <option value="Liechtenstein">Liechtenstein</option>
                            <option value="Lithuania">Lithuania</option>
                            <option value="Luxembourg">Luxembourg</option>
                            <option value="Macao">Macao</option>
                            <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav
                                Republic of
                            </option>
                            <option value="Madagascar">Madagascar</option>
                            <option value="Malawi">Malawi</option>
                            <option value="Malaysia">Malaysia</option>
                            <option value="Maldives">Maldives</option>
                            <option value="Mali">Mali</option>
                            <option value="Malta">Malta</option>
                            <option value="Marshall Islands">Marshall Islands</option>
                            <option value="Martinique">Martinique</option>
                            <option value="Mauritania">Mauritania</option>
                            <option value="Mauritius">Mauritius</option>
                            <option value="Mayotte">Mayotte</option>
                            <option value="Mexico">Mexico</option>
                            <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                            <option value="Moldova, Republic of">Moldova, Republic of</option>
                            <option value="Monaco">Monaco</option>
                            <option value="Mongolia">Mongolia</option>
                            <option value="Montenegro">Montenegro</option>
                            <option value="Montserrat">Montserrat</option>
                            <option value="Morocco">Morocco</option>
                            <option value="Mozambique">Mozambique</option>
                            <option value="Myanmar">Myanmar</option>
                            <option value="Namibia">Namibia</option>
                            <option value="Nauru">Nauru</option>
                            <option value="Nepal">Nepal</option>
                            <option value="Netherlands">Netherlands</option>
                            <option value="Netherlands Antilles">Netherlands Antilles</option>
                            <option value="New Caledonia">New Caledonia</option>
                            <option value="New Zealand">New Zealand</option>
                            <option value="Nicaragua">Nicaragua</option>
                            <option value="Niger">Niger</option>
                            <option value="Nigeria">Nigeria</option>
                            <option value="Niue">Niue</option>
                            <option value="Norfolk Island">Norfolk Island</option>
                            <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                            <option value="Norway">Norway</option>
                            <option value="Oman">Oman</option>
                            <option value="Pakistan">Pakistan</option>
                            <option value="Palau">Palau</option>
                            <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                            <option value="Panama">Panama</option>
                            <option value="Papua New Guinea">Papua New Guinea</option>
                            <option value="Paraguay">Paraguay</option>
                            <option value="Peru">Peru</option>
                            <option value="Philippines">Philippines</option>
                            <option value="Pitcairn">Pitcairn</option>
                            <option value="Poland">Poland</option>
                            <option value="Portugal">Portugal</option>
                            <option value="Puerto Rico">Puerto Rico</option>
                            <option value="Qatar">Qatar</option>
                            <option value="Reunion">Reunion</option>
                            <option value="Romania">Romania</option>
                            <option value="Russian Federation">Russian Federation</option>
                            <option value="Rwanda">Rwanda</option>
                            <option value="Saint Helena">Saint Helena</option>
                            <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                            <option value="Saint Lucia">Saint Lucia</option>
                            <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                            <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                            <option value="Samoa">Samoa</option>
                            <option value="San Marino">San Marino</option>
                            <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                            <option value="Saudi Arabia">Saudi Arabia</option>
                            <option value="Senegal">Senegal</option>
                            <option value="Serbia">Serbia</option>
                            <option value="Seychelles">Seychelles</option>
                            <option value="Sierra Leone">Sierra Leone</option>
                            <option value="Singapore">Singapore</option>
                            <option value="Slovakia">Slovakia</option>
                            <option value="Slovenia">Slovenia</option>
                            <option value="Solomon Islands">Solomon Islands</option>
                            <option value="Somalia">Somalia</option>
                            <option value="South Africa">South Africa</option>
                            <option value="South Georgia and The South Sandwich Islands">South Georgia and The South
                                Sandwich Islands
                            </option>
                            <option value="Spain">Spain</option>
                            <option value="Sri Lanka">Sri Lanka</option>
                            <option value="Sudan">Sudan</option>
                            <option value="Suriname">Suriname</option>
                            <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                            <option value="Swaziland">Swaziland</option>
                            <option value="Sweden">Sweden</option>
                            <option value="Switzerland">Switzerland</option>
                            <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                            <option value="Taiwan">Taiwan</option>
                            <option value="Tajikistan">Tajikistan</option>
                            <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                            <option value="Thailand">Thailand</option>
                            <option value="Timor-leste">Timor-leste</option>
                            <option value="Togo">Togo</option>
                            <option value="Tokelau">Tokelau</option>
                            <option value="Tonga">Tonga</option>
                            <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                            <option value="Tunisia">Tunisia</option>
                            <option value="Turkey">Turkey</option>
                            <option value="Turkmenistan">Turkmenistan</option>
                            <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                            <option value="Tuvalu">Tuvalu</option>
                            <option value="Uganda">Uganda</option>
                            <option value="Ukraine">Ukraine</option>
                            <option value="United Arab Emirates">United Arab Emirates</option>
                            <option value="United Kingdom">United Kingdom</option>
                            <option value="United States">United States</option>
                            <option value="United States Minor Outlying Islands">United States Minor Outlying Islands
                            </option>
                            <option value="Uruguay">Uruguay</option>
                            <option value="Uzbekistan">Uzbekistan</option>
                            <option value="Vanuatu">Vanuatu</option>
                            <option value="Venezuela">Venezuela</option>
                            <option value="Viet Nam">Viet Nam</option>
                            <option value="Virgin Islands, British">Virgin Islands, British</option>
                            <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                            <option value="Wallis and Futuna">Wallis and Futuna</option>
                            <option value="Western Sahara">Western Sahara</option>
                            <option value="Yemen">Yemen</option>
                            <option value="Zambia">Zambia</option>
                            <option value="Zimbabwe">Zimbabwe</option>
                        </select>
                    </div>
                    <div class="col-span-1">
                        <label class="inline-block mb-2 text-sm text-default-800 font-medium"
                               for="zipcodeInput">ZipCode</label>
                        <input
                            class="form-input"
                            id="zipcodeInput" placeholder="ZipCode" type="text"/>
                    </div>
                </div>
            </div>
            <div class="p-5 card mb-5">
                <h6 class="card-title mb-4">Delivery</h6>
                <div class="grid lg:grid-cols-2 grid-cols-1 gap-5">
                    <div class="flex gap-2.5 items-center">
                        <input checked="" class="peer form-radio" id="radio_1" name="level" type="radio" value="1">
                        <label
                            class="flex lg:flex-nowrap flex-wrap justify-between border border-default-200 w-full peer-checked:border-primary rounded-md p-5 gap-4"
                            for="radio_1">
                            <div class="flex gap-4">
                                <img alt="" class="h-12" src="/images/brand/delivery-1.png"/>
                                <span class="grow">
<span class="block mb-1 font-semibold text-default-800 text-[15px]">Express Delivery</span>
<span class="text-default-500 text-sm">Expected delivery: 01 Nov, Wednesday</span>
</span>
                            </div>
                            <span class="text-lg text-default-800 font-semibold">$11.99 </span>
                        </label>
                        </input></div>
                    <div class="flex items-center gap-2.5">
                        <input class="peer form-radio" id="radio_2" name="level" type="radio" value="2">
                        <label
                            class="flex flex-wrap justify-between border border-default-200 w-full peer-checked:border-primary rounded-md p-5 gap-4"
                            for="radio_2">
                            <div class="flex gap-4">
                                <img alt="" class="h-12" src="/images/brand/delivery-2.png"/>
                                <span class="grow">
<span class="block mb-1 font-semibold text-[15px] text-default-800">Air Logistic Delivery</span>
<span class="text-default-500 text-sm">Expected delivery: 06 Nov, Monday</span>
</span>
                            </div>
                            <span class="text-lg text-default-800 font-semibold">$5</span>
                        </label>
                        </input></div>
                    <div class="flex gap-2.5 items-center">
                        <input class="peer form-radio" id="radio_3" name="level" type="radio" value="3">
                        <label
                            class="flex flex-wrap justify-between border border-default-200 w-full peer-checked:border-primary rounded-md p-5 gap-4"
                            for="radio_3">
                            <div class="flex gap-4">
                                <img alt="" class="h-12" src="/images/brand/delivery-3.png"/>
                                <span class="grow">
<span class="block mb-1 font-semibold text-default-800 text-[15px]">Free Delivery</span>
<span class="text-default-500 text-sm">Expected delivery: 11 Nov, Saturday</span>
</span>
                            </div>
                            <span class="text-lg text-default-800 font-semibold">$0 </span>
                        </label>
                        </input></div>
                </div>
            </div>
            <div class="card p-5 mb-5">
                <h6 class="card-title mb-4">Payment Information</h6>
                <div class="mb-5">
                    <label class="inline-block mb-2 text-sm text-default-800 font-medium" for="cardNumberInput">Card
                        Number</label>
                    <input
                        class="form-input"
                        id="cardNumberInput" maxlength="16" pattern="\d*" placeholder="XXXX XXXX XXXX XXXX"
                        type="text"/>
                </div>
                <div class="grid lg:grid-cols-2 grid-cols-1 gap-5">
                    <div class="col-span-1">
                        <label class="inline-block mb-2 text-sm text-default-800 font-medium" for="expiringInput">Expiring
                            (MM/YY)</label>
                        <input
                            class="form-input"
                            id="expiringInput" maxlength="4" pattern="\d*" placeholder="MM/YY" type="text"/>
                    </div>
                    <div class="col-span-1">
                        <label class="inline-block mb-2 text-sm text-default-800 font-medium" for="cvvInput">CVV
                            Code</label>
                        <input
                            class="form-input"
                            id="cvvInput" maxlength="3" pattern="\d*" placeholder="000" type="text"/>
                    </div>
                </div>
                <div class="mt-3">
                    <h6 class="inline-block mb-2 text-sm text-default-800 font-medium">We accept the following
                        cards</h6>
                    <div class="flex items-center gap-2">
                        <img alt="" class="h-8" src="/images/payment/img-01.png"/>
                        <img alt="" class="h-8" src="/images/payment/img-02.png"/>
                        <img alt="" class="h-8" src="/images/payment/img-03.png"/>
                        <img alt="" class="h-8" src="/images/payment/img-04.png"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-1">
            <div class="p-5 card mb-5">
                <h6 class="card-title mb-4">Orders Summary</h6>
                <div class="px-4 py-3 mb-4 text-danger rounded-md bg-red-50">
                    These products are limited, checkout within <span class="font-bold">03m 21s</span>
                </div>
                <div class="">
                    <div class="flex justify-between items-center gap-5 py-4 border-b border-dashed border-default-200">
                        <div class="flex items-center gap-3">
                            <div class="flex items-center justify-center rounded-md size-12 bg-default-100">
                                <img alt="" class="h-8" src="/images/product/img-08.png"/>
                            </div>
                            <div class="">
                                <h6 class="mb-1 text-[15px] text-default-800 font-semibold"><a
                                        class="transition-all duration-300 ease-linear hover:text-primary"
                                        href="{{ route('second', ['ecommerce', 'product-overview'])}}">Roar Twill Blue Baseball Cap</a>
                                </h6>
                                <p class="text-default-500 text-sm">$149.99 x 02</p>
                            </div>
                        </div>
                        <span class="text-default-500 text-sm">$299.98</span>
                    </div>
                    <div class="flex justify-between items-center gap-5 py-4 border-b border-dashed border-default-200">
                        <div class="flex items-center gap-3">
                            <div class="flex items-center justify-center rounded-md size-12 bg-default-100">
                                <img alt="" class="h-8" src="/images/product/img-04.png"/>
                            </div>
                            <div class="">
                                <h6 class="mb-1 text-[15px] text-default-800 font-semibold"><a
                                        class="transition-all duration-300 ease-linear hover:text-primary"
                                        href="{{ route('second', ['ecommerce', 'product-overview'])}}">Mesh Ergonomic Green Chair</a></h6>
                                <p class="text-default-500 text-sm">$362.21 x 1</p>
                            </div>
                        </div>
                        <span class="text-default-500 text-sm">$362.21</span>
                    </div>
                    <div class="flex justify-between items-center gap-5 py-4 border-b border-dashed border-default-200">
                        <div class="flex items-center gap-3">
                            <div class="flex items-center justify-center rounded-md size-12 bg-default-100">
                                <img alt="" class="h-8" src="/images/product/img-01.png"/>
                            </div>
                            <div class="">
                                <h6 class="mb-1 text-[15px] text-default-800 font-semibold"><a
                                        class="transition-all duration-300 ease-linear hover:text-primary"
                                        href="{{ route('second', ['ecommerce', 'product-overview'])}}">Smartest Printed T-shirt</a></h6>
                                <p class="text-default-500 text-sm">$89.99 x 03</p>
                            </div>
                        </div>
                        <span class="text-default-500 text-sm">$269.97</span>
                    </div>
                </div>
                <div class="flex justify-between items-center gap-5 py-3">
                    <span class="text-default-500 text-sm">Sub Total </span>
                    <span class="text-default-800 text-sm">$932.16</span>
                </div>
                <div class="flex justify-between items-center gap-5 py-3">
                    <span class="text-default-500 text-sm">Estimated Tax (18%) </span>
                    <span class="text-default-800 text-sm">$167.79</span>
                </div>
                <div class="flex justify-between items-center gap-5 py-3">
                    <span class="text-default-500 text-sm">Item Discounts (12%)</span>
                    <span class="text-default-800 text-sm">-$111.86</span>
                </div>
                <div class="flex justify-between items-center gap-5 py-3">
                    <span class="text-default-500 text-sm">Shipping Charge </span>
                    <span class="text-default-800 text-sm">$0</span>
                </div>
                <div class="flex justify-between items-center gap-5 font-semibold pt-3">
                    <span class="text-default-500 text-sm">Total Amount (USD) </span>
                    <span class="text-default-800 text-sm">$988.09</span>
                </div>
                <div class="mt-4">
                    <button
                        class="text-[13px] py-2 px-4 rounded bg-primary text-white transition-all duration-300 hover:bg-blue-600 inline-flex justify-center w-full items-center"
                        type="button">Place Order
                        <i class="size-4 ms-1.5" data-lucide="move-right"></i>
                    </button>
                </div>
            </div>
            <div class="mb-5">
                <h6 class="mb-4 underline text-base text-default-800 font-semibold">Additional Service</h6>
                <div class="p-5 card mb-5">
                    <div class="flex justify-between flex-wrap items-center gap-3">
                        <div>
                            <div class="">
                                <h6 class="mb-1 text-[15px] text-default-800 font-semibold">Care + Package</h6>
                                <p class="text-default-500 text-sm">2 year of additional care</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <label class="text-default-800 font-semibold text-sm" for="switchPrice1">$24.99</label>
                            <input class="form-switch" id="switchPrice1" type="checkbox"/>
                        </div>
                    </div>
                </div>
                <div class="p-5 card">
                    <div class="flex justify-between flex-wrap items-center gap-3">
                        <div>
                            <div class="">
                                <h6 class="mb-1 text-[15px] text-default-800 font-semibold">Environment Friendly</h6>
                                <p class="text-default-500 text-sm">The primary goal of eco-warriors is creating</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <label class="text-default-800 font-semibold text-sm" for="switchPrice2">$19.99</label>
                            <input class="form-switch" id="switchPrice2" type="checkbox"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
